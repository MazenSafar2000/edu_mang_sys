@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.add_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.add_student') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('Students.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.personal_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_ar') }} : <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name_ar"
                                    class="form-control @error('name_ar') is-invalid @enderror"
                                    value="{{ old('name_ar') }}">
                                @error('name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_en') }} : <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                                    type="text" value="{{ old('name_en') }}">
                                @error('name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.email') }} :</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.password') }} :</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender_id">{{ trans('Students_trans.gender') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('gender_id') is-invalid @enderror"
                                    name="gender_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Genders as $Gender)
                                        <option value="{{ $Gender->id }}"
                                            {{ old('gender_id') == $Gender->id ? 'selected' : '' }}>
                                            {{ $Gender->Name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.Date_of_Birth') }} :</label>
                                <input class="form-control @error('Date_Birth') is-invalid @enderror" type="text"
                                    id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd"
                                    value="{{ old('Date_Birth') }}">
                                @error('Date_Birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.Student_information') }}
                    </h6><br>

                    <div class="row">
                        {{-- Grade --}}
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('Grade_id') is-invalid @enderror"
                                    name="Grade_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($my_classes as $c)
                                        <option value="{{ $c->id }}">{{ $c->Name }}</option>
                                    @endforeach
                                </select>
                                @error('Grade_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Classroom --}}
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('Classroom_id') is-invalid @enderror"
                                    name="Classroom_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    {{-- Add JS to populate this based on old('Grade_id') if needed --}}
                                </select>
                                @error('Classroom_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Section --}}
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="section_id">{{ trans('Students_trans.section') }} :</label>
                                <select class="custom-select mr-sm-2 @error('section_id') is-invalid @enderror"
                                    name="section_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    {{-- Populate dynamically if needed --}}
                                </select>
                                @error('section_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Parent --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_id">{{ trans('Students_trans.parent') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('parent_id') is-invalid @enderror"
                                    name="parent_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->Name_Father }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Academic Year --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('academic_year') is-invalid @enderror"
                                    name="academic_year">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php $current_year = date('Y'); @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        @php
                                            $academicYear = $year . '/' . ($year + 1);
                                        @endphp
                                        <option value="{{ $academicYear }}"
                                            {{ old('academic_year') == $academicYear ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                    @endfor

                                </select>
                                @error('academic_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div><br>

                    {{-- Attachments --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="academic_year">{{ trans('Students_trans.Attachments') }} : <span
                                    class="text-danger">*</span></label>
                            <input type="file" accept="image/*" name="photos[]" multiple
                                class="form-control-file @error('photos') is-invalid @enderror">
                            @error('photos')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>




                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

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
