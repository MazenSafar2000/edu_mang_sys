@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.preview_homework') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.preview_homework') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @if (session()->has('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>{{ $homework->title }}</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>{{ trans('Students_trans.homework_description') }}:</strong>
                                    {{ $homework->description }}</p>
                                <p><strong>{{ trans('Students_trans.total_degree') }}:</strong>
                                    {{ $homework->total_degree }}</p>
                                <p><strong>{{ trans('Students_trans.Delivery_Deadline') }}:</strong>
                                    {{ $homework->due_date }}</p>

                                @if ($homework->file_path)
                                    <p><strong>{{ trans('Students_trans.Submitted_File') }}:</strong>
                                        <a href="{{ asset($submission->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            {{ trans('Students_trans.View File') }}
                                        </a>
                                    </p>
                                @endif

                                <hr>

                                @if ($submission)
                                    <div class="alert alert-success">{{ trans('Students_trans.you_submit') }}</div>
                                    <p><strong>{{ trans('Students_trans.Status') }}:</strong>
                                        @if ($submission->is_late)
                                            <span
                                                class="badge badge-warning">{{ trans('Students_trans.Late_Submission') }}</span>
                                        @else
                                            <span
                                                class="badge badge-success">{{ trans('Students_trans.on_time') }}</span>
                                        @endif
                                    </p>
                                    <p><strong>{{ trans('Students_trans.Submission_Date') }}:</strong>
                                        {{ $submission->submitted_at }}</p>
                                    @if ($submission && ($submission->degree !== null || $submission->feedback))
                                        <div class="mt-4">
                                            <div class="card border-success shadow-sm">
                                                <div class="card-header bg-success text-white">
                                                    <h5 class="mb-0">{{ __('Students_trans.Grading_Feedback') }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    @if ($submission->degree !== null)
                                                        <p class="mb-2">
                                                            <strong>{{ __('Students_trans.degree') }}:</strong>
                                                            <span class="badge badge-pill badge-primary px-3 py-2"
                                                                style="font-size: 16px;">
                                                                {{ $submission->degree }} /
                                                                {{ $homework->total_degree }}
                                                            </span>
                                                        </p>
                                                    @endif

                                                    @if ($submission->feedback)
                                                        <p class="mt-3 mb-0">
                                                            <strong>{{ __('Students_trans.Feedback') }}:
                                                            </strong><span> {{ $submission->feedback }}</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
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
