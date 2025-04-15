@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.Students_Promotions') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Students_Promotions') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (Session::has('error_promotions'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error_promotions') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <h6 style="color: red;font-family: Cairo">{{ trans('main_trans.Old_school_stage') }}</h6><br>

                <form method="post" action="{{ route('Promotion.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Grade_id">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2 @error('Grade_id') is-invalid @enderror" name="Grade_id" id="Grade_id" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                            @error('Grade_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2 @error('Classroom_id') is-invalid @enderror" name="Classroom_id" id="Classroom_id" required>
                            </select>
                            @error('Classroom_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="section_id">{{ trans('Students_trans.section') }}</label>
                            <select class="custom-select mr-sm-2 @error('section_id') is-invalid @enderror" name="section_id" id="section_id">
                            </select>
                            @error('section_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('academic_year') is-invalid @enderror" name="academic_year" id="academic_year">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php $current_year = date('Y'); @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        @php $academicYear = $year . '/' . ($year + 1); @endphp
                                        <option value="{{ $academicYear }}" {{ old('academic_year') == $academicYear ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                    @endfor
                                </select>
                                @error('academic_year')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>
                    <h6 style="color: red;font-family: Cairo">{{ trans('main_trans.New_academic_stage') }}</h6><br>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Grade_id_new">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2 @error('Grade_id_new') is-invalid @enderror" name="Grade_id_new" id="Grade_id_new">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach
                            </select>
                            @error('Grade_id_new')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="Classroom_id_new">{{ trans('Students_trans.classrooms') }}: <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2 @error('Classroom_id_new') is-invalid @enderror" name="Classroom_id_new" id="Classroom_id_new">
                            </select>
                            @error('Classroom_id_new')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="section_id_new">{{ trans('Students_trans.section') }}</label>
                            <select class="custom-select mr-sm-2 @error('section_id_new') is-invalid @enderror" name="section_id_new" id="section_id_new">
                            </select>
                            @error('section_id_new')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year_new">{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('academic_year_new') is-invalid @enderror" name="academic_year_new" id="academic_year_new">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php $current_year = date('Y'); @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        @php $academicYear = $year . '/' . ($year + 1); @endphp
                                        <option value="{{ $academicYear }}" {{ old('academic_year_new') == $academicYear ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                    @endfor
                                </select>
                                @error('academic_year_new')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('Students_trans.submit') }}</button>
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
