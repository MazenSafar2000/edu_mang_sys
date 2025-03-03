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


                    <form id="student-form" method="POST" action="{{ route('login') }}">
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

                    <form id="parent-form" method="POST" action="{{ route('login') }}" style="display: none;">
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
                        <img src="{{ URL::asset('assets/images/std-on.png') }}" alt="Student" title="تسجيل دخول الطالب"
                            id="student-btn">
                        <img src="{{ URL::asset('assets/images/par-off.png') }}" alt="Parent"
                            title="تسجيل دخول ولي الأمر" id="parent-btn">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
