@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.student_informations') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.student_informations') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="card p-4">
    <h4 class="mb-4">{{ trans('Teacher_trans.student_informations') }}</h4>

    <div class="row">
        <!-- Student Info -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ trans('Teacher_trans.student_informations') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>{{ trans('Students_trans.name') }} :</strong>
                            {{ $student->name }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.email') }} :</strong>
                            {{ $student->email }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.gender') }} :</strong>
                            {{ $student->gender->Name }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.Grade') }} :</strong>
                            {{ $student->grade->Name }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.classrooms') }} :</strong>
                            {{ $student->classroom->Name_Class }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.section') }} :</strong>
                            {{ $student->section->Name_Section }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.Date_of_Birth') }} :</strong>
                            {{ $student->Date_Birth }}</li>
                        <li class="list-group-item"><strong>{{ trans('Students_trans.academic_year') }} :</strong>
                            {{ $student->academic_year }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Father Info -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">{{ trans('Teacher_trans.Father_Information') }}</h5>
                </div>
                <div class="card-body">
                    @if ($student->myparent)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>{{ trans('Parent_trans.name_father') }} :</strong>
                                {{ $student->myparent->Name_Father }}</li>
                            <li class="list-group-item"><strong>{{ trans('Parent_trans.Phone_Father') }} :</strong>
                                {{ $student->myparent->Phone_Father }}</li>
                            <li class="list-group-item"><strong>{{ trans('Parent_trans.Job_Father') }} :</strong>
                                {{ $student->myparent->Job_Father }}</li>
                            <li class="list-group-item"><strong>{{ trans('Parent_trans.Address_Father') }} :</strong>
                                {{ $student->myparent->Address_Father }}</li>
                        </ul>
                    @else
                        <p class="text-muted">{{ trans('Parent_trans.no_info_available') }}</p>
                    @endif
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
