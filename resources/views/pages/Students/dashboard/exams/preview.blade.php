@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Students_trans.exam_details') }} : {{ $quiz->subject->name ?? '-' }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.exam_details') }} : {{ $quiz->subject->name ?? '-' }}
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
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="mb-3">{{ trans('Students_trans.exam_details') }}</h4>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.exam_name') }}:</strong>
                                            {{ $quiz->name }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.subject') }}:</strong>
                                            {{ $quiz->subject->name ?? '-' }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.duration') }}:</strong>
                                            {{ $quiz->duration }} دقيقة
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.start_at') }}:</strong>
                                            {{ \Carbon\Carbon::parse($quiz->start_at)->format('Y-m-d g:i A') }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.end_at') }}:</strong>
                                            {{ \Carbon\Carbon::parse($quiz->end_at)->format('Y-m-d g:i A') }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ trans('Students_trans.Status') }}:</strong>
                                            @php
                                                $now = now();
                                                $start = \Carbon\Carbon::parse($quiz->start_at);
                                                $end = \Carbon\Carbon::parse($quiz->end_at);
                                            @endphp

                                            @if ($now->lt($start))
                                                <span class="text-warning">@php
                                                    $diffStart = $now->diff($start);
                                                @endphp
                                                    يبدأ بعد
                                                    {{ $diffStart->h > 0 ? $diffStart->h . ' ساعة و ' : '' }}{{ $diffStart->i }}
                                                    دقيقة
                                                </span>
                                            @elseif($now->between($start, $end))
                                                <span class="text-success">@php
                                                    $diffEnd = $now->diff($end);
                                                @endphp
                                                    متاح الآن (ينتهي بعد
                                                    {{ $diffEnd->h > 0 ? $diffEnd->h . ' ساعة و ' : '' }}{{ $diffEnd->i }}
                                                    دقيقة)
                                                </span>
                                            @else
                                                <span class="text-danger">انتهى</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            @php
                                                $now = now();
                                                $can_start = $now >= $quiz->start_at && $now <= $quiz->end_at;
                                            @endphp

                                            @if ($quiz->degree->count() > 0 && $quiz->id == $quiz->degree[0]->quizze_id)
                                                <strong>{{ trans('Students_trans.degree') }} : </strong>
                                                {{ $quiz->degree[0]->score }}
                                            @else
                                                @if ($now->between($quiz->start_at, $quiz->end_at))
                                                    <a href="{{ route('student_exams.show', $quiz->id) }}"
                                                        class="btn btn-outline-success w-100" role="button"
                                                        aria-pressed="true" onclick="alertAbuse()">
                                                        <i class="fas fa-person-booth"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                        {{ trans('Students_trans.not_available') }}
                                                    </button>
                                                @endif
                                            @endif
                                        </li>
                                    </ul>
                                </div>
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
<script>
    function alertAbuse() {
        alert(
            "برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك "
        );
    }
</script>
@endsection
