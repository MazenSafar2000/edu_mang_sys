@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.subject_materials') }} : {{ $subject->name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.subject_materials') }} : {{ $subject->name }}
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
                    @foreach ($materials as $material)
                        <div class="mb-4">
                            <div
                                class="card shadow-sm border-start-4
                                    @switch($material['type'])
                                        @case('book') border-primary @break
                                        @case('homework') border-warning @break
                                        @case('exam') border-danger @break
                                        @case('VideoClass') border-primary @break
                                        @case('live_classes') border-primary @break
                                    @endswitch
                                ">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="card-title mb-0">{{ $material['title'] }}</h5>
                                        <span
                                            class="badge
                                                @switch($material['type'])
                                                    @case('book') text-white bg-primary @break
                                                    @case('homework') text-white bg-warning @break
                                                    @case('exam') text-white bg-danger @break
                                                    @case('VideoClass') text-white bg-info @break
                                                    @case('live_classes') text-white bg-info @break
                                                @endswitch
                                            ">
                                            @switch($material['type'])
                                                @case('book')
                                                    {{ trans('Students_trans.Book') }}
                                                @break

                                                @case('homework')
                                                    {{ trans('Students_trans.Homework') }}
                                                @break

                                                @case('exam')
                                                    {{ trans('Students_trans.exam') }}
                                                @break

                                                @case('VideoClass')
                                                    {{ trans('Students_trans.VideoClass') }}
                                                @break

                                                @case('live_classes')
                                                    {{ trans('Students_trans.live_classes') }}
                                                @break
                                            @endswitch
                                        </span>
                                    </div>

                                    <p class="text-muted small mb-2">{{ trans('Students_trans.created_at') }}:
                                        {{ $material['created_at']->format('Y-m-d') }}</p>

                                    <div class="d-grid gap-2">
                                        @if ($material['type'] == 'book')
                                            <a href="{{ route('student.library.preview', $material['data']->id) }}" class="btn btn-outline-primary btn-sm"
                                                title="{{ trans('Students_trans.view_book') }}">
                                                <i class="fas fa-book me-1"></i> {{ trans('Students_trans.view') }}
                                            </a>
                                        @elseif($material['type'] == 'homework')
                                            <a href="{{ route('student.homeworks.preview', $material['data']->id) }}"
                                                class="btn btn-outline-warning btn-sm"
                                                title="{{ trans('Students_trans.view_homework') }}">
                                                <i class="fas fa-tasks me-1"></i> {{ trans('Students_trans.view') }}
                                            </a>
                                        @elseif($material['type'] == 'exam')
                                            <a href="{{ route('student.exams.preview', $material['data']->id) }}"
                                                class="btn btn-outline-danger btn-sm"
                                                title="{{ trans('Students_trans.view_exam') }}">
                                                <i class="fas fa-file-alt me-1"></i> {{ trans('Students_trans.view') }}
                                            </a>
                                        @elseif($material['type'] == 'VideoClass')
                                            <a href="{{ route('student.VideoClass.preview', $material['data']->id) }}"
                                                class="btn btn-outline-info btn-sm"
                                                title="{{ trans('Students_trans.view_class') }}">
                                                <i class="fas fa-file-alt me-1"></i> {{ trans('Students_trans.view') }}
                                            </a>
                                        @elseif($material['type'] == 'live_classes')
                                            <a href="{{ route('student.LiveClass.preview', $material['data']->id) }}"
                                                class="btn btn-outline-info btn-sm"
                                                title="{{ trans('Students_trans.view_class') }}">
                                                <i class="fas fa-file-alt me-1"></i> {{ trans('Students_trans.view') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
