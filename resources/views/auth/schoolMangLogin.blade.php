@extends('layouts.school-head')
@section('content')
    <section class="login0">

        <div class="form-container3">
            @if (\Session::has('message'))
                <div class="alert alert-danger">
                    <li>{!! \Session::get('message') !!}</li>
                </div>
            @endif
            <!-- نموذج تسجيل المعلم (افتراضي) -->
            <form id="teacherForm" class="form" style="display: block;" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" value="teacher" name="type">
                <h3> {{ trans('main_trans.teacher-login') }} </h3>
                <input id="email" type="email" name="email" placeholder="{{ trans('main_trans.Enter_ID') }}" class="input-box-teacher">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password" type="password" name="password" placeholder="{{ trans('main_trans.Enter_Password') }}"
                    class="input-box-teacher2">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="login-btn-teacher">{{ trans('main_trans.Login') }}</button>
            </form>

            <!-- نموذج تسجيل المدير -->
            <form id="adminForm" class="form" style="display: none;" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" value="admin" name="type">
                <h3> {{ trans('main_trans.manager-login') }} </h3>
                <input id="email" type="email" name="email" placeholder="{{ trans('main_trans.Enter_ID') }}"
                    class="input-box-teacher">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password" type="password" name="password" placeholder="{{ trans('main_trans.Enter_Password') }}"
                    class="input-box-teacher2">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="login-btn-teacher">{{ trans('main_trans.Login') }}</button>
            </form>

            <div class="icons">
                <a href="#" class="icon active-icon" id="icon1" onclick="showForm('teacher',this)"><img
                        src="{{ asset('assets/images/teacher.png') }}" alt="Teacher" title="تسجيل دخول المعلم"></a>
                <a href="#" class="icon" id="icon2" onclick="showForm('admin', this)"><img
                        src="{{ asset('assets/images/manager-off.png') }}" alt="Admin" title="تسجيل دخول المدير"></a>
            </div>


        </div>
    </section>


@endsection
