<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ZoomService
{
    private $clientId;
    private $clientSecret;
    private $accountId;
    private $baseUrl;

    public function __construct()
    {
        $this->clientId = config('services.zoom.client_id');
        $this->clientSecret = config('services.zoom.client_secret');
        $this->accountId = config('services.zoom.account_id');
        $this->baseUrl = 'https://api.zoom.us/v2/';

        // dd($this->clientId, $this->clientSecret, $this->accountId);
    }

    private function getAccessToken()
    {
        $response = Http::asForm()->withBasicAuth($this->clientId, $this->clientSecret)
            ->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => $this->accountId,
            ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Failed to get Zoom access token: ' . $response->body());
    }

    public function createMeeting($request)
    {
        $accessToken = $this->getAccessToken();

        $startTime = Carbon::parse($request->start_time, 'Asia/Gaza')->toDateTimeString();
        $duration = $request->duration;

        $response = Http::withToken($accessToken)->post($this->baseUrl . 'users/me/meetings', [
            'topic' => $request->topic,
            'type' => 2, // Scheduled meeting
            'start_time' => $startTime,
            'duration' =>  $duration,
            'password' => $request->password ?? '123456',
            'settings' => [
                'join_before_host' => false,
                'host_video' => true,
                'participant_video' => true,
                'mute_upon_entry' => true,
                'waiting_room' => true,
            ]
        ]);

        if ($response->successful()) {
            return $response->json();
        }
        dd($response);
        throw new \Exception('Failed to create Zoom meeting: ' . $response->body());
    }

    public function deleteMeeting($meetingId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)->delete($this->baseUrl . 'meetings/' . $meetingId);

        if (!$response->successful()) {
            throw new \Exception('Failed to delete Zoom meeting: ' . $response->body());
        }

        return true;
    }
}
