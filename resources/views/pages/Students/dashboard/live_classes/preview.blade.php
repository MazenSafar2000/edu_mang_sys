@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('Students_trans.live_classes') }}
@stop

@section('page-header')
@section('PageTitle')
    {{ trans('Students_trans.live_class') }} : {{ $liveClasses->topic }}
@stop
@endsection

@section('content')
@if (session()->has('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif

<div class="col-md-12 mb-4">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="container mt-4">

                <!-- Back Button -->
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                    {{ trans('Students_trans.Back') }}
                </a>

                <!-- Card Title -->
                <div class="card p-4">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('Students_trans.subject') }}</th>
                                <th>{{ trans('Students_trans.title') }}</th>
                                <th> {{ trans('Students_trans.start_at') }}</th>
                                <th>{{ trans('Students_trans.duration') }}</th>
                                <th class="text-center">{{ trans('Students_trans.join') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $liveClasses->subject->name }}</td>
                                <td>{{ $liveClasses->topic }}</td>
                                <td>
                                    @php
                                        use Carbon\Carbon;

                                        $now = Carbon::now();
                                        $start = Carbon::parse($liveClasses->start_at);
                                        $end = $start->copy()->addMinutes($liveClasses->duration);

                                        if ($now->lt($start)) {
                                            $status = 'upcoming';
                                            $timeLeft = $start->diffForHumans($now, [
                                                'parts' => 2,
                                                'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                                                'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS,
                                            ]);
                                        } elseif ($now->between($start, $end)) {
                                            $status = 'live';
                                        } else {
                                            $status = 'finished';
                                        }
                                    @endphp

                                    @if ($status === 'upcoming')
                                        <span class="text-info">{{ trans('Students_trans.starts_in') }}
                                            {{ $timeLeft }}</span>
                                    @elseif ($status === 'live')
                                        <span class="text-success">{{ trans('Students_trans.live_now') }}</span>
                                    @else
                                        <span class="text-secondary">{{ trans('Students_trans.class_ended') }}</span>
                                    @endif
                                </td>
                                <td>{{ $liveClasses->duration }} mins</td>
                                <td class="text-center">
                                    @if ($status === 'live')
                                        <a href="{{ $liveClasses->join_url }}" target="_blank" class="btn btn-success">
                                            {{ trans('Students_trans.join_now') }}
                                        </a>
                                    @elseif ($status === 'upcoming')
                                        <button class="btn btn-warning" disabled>
                                            {{ trans('Students_trans.not_started') }}
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" disabled>
                                            {{ trans('Students_trans.class_ended') }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@toastr_js
@toastr_render
@endsection
