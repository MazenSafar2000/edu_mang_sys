@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.exams_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.exams_list') }}
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
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Students_trans.subject') }}</th>
                                            <th>{{ __('Students_trans.exam_name') }}</th>
                                            <th>{{ __('main_trans.start_at') }}</th>
                                            <th>{{ __('main_trans.end_at') }}</th>
                                            <th>{{ __('Parent_trans.status') }}</th>
                                            <th>{{ __('Students_trans.inter_degree') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $quizze->subject->name }}</td>
                                                <td>{{ $quizze->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($quizze->start_at)->format('Y-m-d g:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($quizze->end_at)->format('Y-m-d g:i A') }}
                                                </td>

                                                <td>
                                                    @php
                                                        $now = now();
                                                        $start = \Carbon\Carbon::parse($quizze->start_at);
                                                        $end = \Carbon\Carbon::parse($quizze->end_at);
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
                                                </td>
                                                <td>
                                                    @if ($quizze->degree->count() > 0 && $quizze->id == $quizze->degree[0]->quizze_id)
                                                        {{ $quizze->degree[0]->score }}
                                                    @else
                                                        @if ($now->between($quizze->start_at, $quizze->end_at))
                                                            <a href="{{ route('student_exams.show', $quizze->id) }}"
                                                                class="btn btn-outline-success btn-sm" role="button"
                                                                aria-pressed="true" onclick="alertAbuse()">
                                                                <i class="fas fa-person-booth"></i>
                                                            </a>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>
                                                                غير متاح
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
