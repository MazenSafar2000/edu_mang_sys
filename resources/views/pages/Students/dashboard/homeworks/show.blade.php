@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
@section('title')
    {{ trans('Students_trans.homework_status') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.homework_status') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="col-xl-12 mb-30">
                    <div class="card-body">
                        <div class="table-responsive">

                            <div class="container mt-4">
                                <h4>{{ trans('Students_trans.Submission_Details') }}: <strong>{{ $homework->title }}</strong></h4>

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <p><strong>{{ trans('Students_trans.Homework_Title') }}:</strong> {{ $homework->title }}</p>
                                        <p><strong>{{ trans('Students_trans.Delivery_Deadline') }}:</strong> {{ $homework->due_date }}</p>
                                        <p><strong>{{ trans('Students_trans.Submission_Date') }}:</strong> {{ $submission->submitted_at ?? 'Not Submitted' }}</p>

                                        <p><strong>{{ trans('Students_trans.Status') }}:</strong>
                                            @if($submission->is_late)
                                                <span class="badge badge-warning">{{ trans('Students_trans.Late_Submission') }}</span>
                                            @else
                                                <span class="badge badge-success">{{ trans('Students_trans.on_time') }}</span>
                                            @endif
                                        </p>

                                        <p><strong>{{ trans('Students_trans.Submitted_File') }}:</strong>
                                            <a href="{{ asset($submission->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                {{ trans('Students_trans.View File') }}
                                            </a>
                                        </p>

                                        @if($submission->status === 'graded')
                                            <hr>
                                            <p><strong>{{ trans('Students_trans.Grade') }}{{ trans('Students_trans.Late_Submission') }}:</strong> {{ $submission->degree }} / {{ $homework->total_degree }}</p>
                                            <p><strong>{{ trans('Students_trans.Teacher_Notes') }}:</strong> {{ $submission->teacher_notes ?? 'None' }}</p>
                                        @else
                                            <p><strong>{{ trans('Students_trans.homework_status') }}:</strong> <span class="badge badge-secondary">{{ trans('Students_trans.Not_Graded_Yet') }}</span></p>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('student.submissions.index') }}" class="btn btn-secondary mt-3">{{ trans('Students_trans.Back') }}</a>

                        </div>
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
