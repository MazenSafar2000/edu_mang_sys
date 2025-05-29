<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function  chekGuard($request)
    {

        $type = $request->input('type');

        return match ($type) {
            'student' => 'student',
            'parent' => 'parent',
            'teacher' => 'teacher',
            default => 'manager',
        };
    }

    public function redirect($request)
    {

        return match ($request->input('type')) {
            'student' => redirect()->intended(RouteServiceProvider::STUDENT),
            'parent' => redirect()->intended(RouteServiceProvider::PARENT),
            'teacher' => redirect()->intended(RouteServiceProvider::TEACHER),
            default => redirect()->intended(RouteServiceProvider::HOME),
        };
    }
}
