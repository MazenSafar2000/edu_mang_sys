@extends('layouts.master')

@section('css')
    @toastr_css


@section('title')
    {{ trans('Students_trans.preview_VideoClass') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.preview_VideoClass') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
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
                    <div class="card p-4">
                        <h4 class="mb-3 text-primary">{{ $recordedClass->title }}</h4>
                        <p><strong>{{ trans('Students_trans.subject') }}:</strong> {{ $recordedClass->subject->name }}
                        </p>
                        <p><strong>{{ trans('Students_trans.teacher_name') }}:</strong>
                            {{ $recordedClass->teacher->Name }}</p>
                        <p><strong> {{ trans('Students_trans.class_description') }}:</strong>
                            {{ $recordedClass->description ?? trans('Students_trans.no_description') }}</p>
                        <div class="mt-4">
                            @php
                                $url = $recordedClass->video_url;
                            @endphp
                            <!-- YouTube View -->
                            @if (Str::contains($url, 'youtube.com') || Str::contains($url, 'youtu.be'))
                                @php
                                    // استخراج ID الفيديو
                                    preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
                                    $youtubeId = $matches[2] ?? null;
                                @endphp

                                @if ($youtubeId)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <p class="text-danger">{{ trans('Students_trans.cant_open_youtube_video') }}</p>
                                @endif

                                <!-- Drive View -->
                            @elseif (Str::contains($url, 'drive.google.com'))
                                @php
                                    preg_match('/\/d\/(.*?)\//', $url, $matches);
                                    $driveId = $matches[1] ?? null;
                                @endphp

                                @if ($driveId)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/{{ $driveId }}/preview"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <p class="text-danger">{{ trans('Students_trans.cant_open_drive_video') }}</p>
                                @endif
                            @else

                                <!-- Other links View -->
                                <a href="{{ $url }}" target="_blank"
                                    class="btn btn-info">{{ trans('Students_trans.open_video') }}</a>
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
