@extends('layouts.loginhead')
@section('content')
    <!-- Login Section -->
    <section class="login">
        <div class="container">
            <div class="left-section">
                <div class="image-container">
                    <img src="{{ URL::asset('assets/images/child.png') }}" alt="Student Image" class="student-img">
                </div>
            </div>
            <div class="right-section">
                <div class="login-box">

                    @if (\Session::has('message'))
                        <div class="alert alert-danger">
                            <li>{!! \Session::get('message') !!}</li>
                        </div>
                    @endif

                    <!-- Student Login Form-->
                    <form id="student-form" class="form" style="display: block;" method="POST"
                        action="{{ route('login') }}">
                        @csrf
                        <h2> {{ trans('main_trans.Student_Login') }} </h2>
                        <input type="hidden" value="student" name="type">
                        <input id="email" type="email" name="email" placeholder="{{ trans('main_trans.Enter_ID') }}"
                            class="input-box  @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password" type="password" name="password"
                            placeholder="{{ trans('main_trans.Enter_Password') }}"
                            class="input-box2 @error('password') is-invalid @enderror" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button type="submit" class="login-btn"> {{ trans('main_trans.Login') }} </button>
                    </form>

                    <!-- Parent Login Form-->
                    <form id="parent-form" class="form" method="POST" action="{{ route('login') }}"
                        style="display: none;">
                        @csrf

                        <h2> {{ trans('main_trans.Parent_Login') }} </h2>
                        <input type="hidden" id="user-type" name="type" value="parent">
                        <input id="email" type="email" name="email"
                            placeholder="{{ trans('main_trans.Enter_ID') }}"
                            class="input-box @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" name="password"
                            placeholder="{{ trans('main_trans.Enter_Password') }}"
                            class="input-box2 @error('password') is-invalid @enderror" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="login-btn"> {{ trans('main_trans.Login') }} </button>
                    </form>

                    <div class="icons">
                        <a href="#" class="icon active-icon" id="icon1" onclick="showForm('student',this)"><img
                                src="{{ asset('assets/images/std-on.png') }}" alt="Student"
                                title="{{ trans('main_trans.Student_Login') }}"></a>
                        <a href="#" class="icon" id="icon2" onclick="showForm('parent', this)"><img
                                src="{{ asset('assets/images/par-off.png') }}" alt="Parent"
                                title="{{ trans('main_trans.Parent_Login') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
