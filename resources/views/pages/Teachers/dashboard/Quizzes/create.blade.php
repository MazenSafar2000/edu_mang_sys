@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('Teacher_trans.add_new_quizz') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.add_new_quizz') }}
@endsection
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('quizzes.store') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="Name_ar">{{ trans('Teacher_trans.quizz_name_ar') }}</label>
                                    <input type="text" name="Name_ar"
                                        class="form-control @error('Name_ar') is-invalid @enderror"
                                        value="{{ old('Name_ar') }}" required>
                                    @error('Name_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="Name_en">{{ trans('Teacher_trans.quizz_name_en') }}</label>
                                    <input type="text" name="Name_en"
                                        class="form-control @error('Name_en') is-invalid @enderror"
                                        value="{{ old('Name_en') }}" required>
                                    @error('Name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="subject_id"> {{ trans('Teacher_trans.subject') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2 @error('subject_id') is-invalid @enderror"
                                            name="subject_id" required>
                                            <option selected disabled>{{ trans('Teacher_trans.select_subject') }}
                                            </option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('Teacher_trans.grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2 @error('Grade_id') is-invalid @enderror"
                                            name="Grade_id" required>
                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}"
                                                    {{ old('Grade_id') == $grade->id ? 'selected' : '' }}>
                                                    {{ $grade->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('Grade_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="custom-select mr-sm-2 @error('Classroom_id') is-invalid @enderror"
                                            name="Classroom_id" required>

                                        </select>
                                        @error('Classroom_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                        <select class="custom-select mr-sm-2 @error('section_id') is-invalid @enderror"
                                            name="section_id" required>

                                        </select>
                                        @error('section_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="duration">{{ trans('Teacher_trans.duration_minute') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="duration"
                                        class="form-control @error('duration') is-invalid @enderror" min="1"
                                        placeholder="{{ trans('Teacher_trans.enter_test_duration') }}" required>
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="start_at">{{ trans('main_trans.start_at') }}</label>
                                    <input type="datetime-local" name="start_at"
                                        class="form-control @error('start_at') is-invalid @enderror" required>
                                    @error('start_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="end_at">{{ trans('main_trans.end_at') }}</label>
                                    <input type="datetime-local" name="end_at"
                                        class="form-control @error('end_at') is-invalid @enderror" required>
                                    @error('end_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Teacher_trans.save_data') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
