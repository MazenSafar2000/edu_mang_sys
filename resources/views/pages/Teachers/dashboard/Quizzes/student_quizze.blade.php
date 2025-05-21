@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('teacher_trans.lsit_tested_students') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('teacher_trans.lsit_tested_students') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
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
                                            <th>{{ trans('Students_trans.student_name') }}</th>
                                            <th>{{ trans('Teacher_trans.degree') }}</th>
                                            <th>{{ trans('Teacher_trans.Feedback') }}</th>
                                            <th>{{ trans('Teacher_trans.cheating') }}</th>
                                            <th>{{ trans('teacher_trans.test_date') }}</th>
                                            <th>{{ trans('Teacher_trans.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            @php
                                                $degree = $degrees->firstWhere('student_id', $student->id);
                                            @endphp
                                            <tr @if($degree) class="table-success" @endif>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $degree?->score ?? '-' }}</td>
                                                <td>{{ $degree?->feedback ?? '-' }}</td>
                                                <td>
                                                    @if ($degree)
                                                        @if ($degree->abuse == 0)
                                                            <span style="color: green">{{ trans('teacher_trans.no_cheating') }}</span>
                                                        @else
                                                            <span style="color: red">{{ trans('teacher_trans.is_cheating') }}</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $degree ? $degree->date : '-' }}
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#gradeModal-{{ $student->id }}">
                                                        {{ trans('Teacher_trans.grade_exam') }}
                                                    </button>

                                                    @if ($degree)
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#repeat_quizze{{ $degree->quizze_id }}"
                                                            title="{{ trans('teacher_trans.re_open') }}">
                                                            <i class="fas fa-repeat"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Grade Modal -->
                                            <div class="modal fade" id="gradeModal-{{ $student->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="gradeModalLabel-{{ $student->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form method="POST" action="{{ route('manual.degree.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                        <input type="hidden" name="quizze_id" value="{{ $quiz->id }}">

                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title">{{ trans('Teacher_trans.grade_exam') }} - {{ $student->name }}</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>{{ trans('Teacher_trans.degree') }}</label>
                                                                    <input type="number" name="score" class="form-control"
                                                                        value="{{ $degree?->score ?? '' }}"
                                                                        step="0.1" min="0" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{ trans('Teacher_trans.Feedback') }}</label>
                                                                    <textarea name="feedback" class="form-control" rows="4">{{ $degree?->feedback ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">{{ trans('Teacher_trans.save') }}</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('Teacher_trans.Close') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            @if ($degree)
                                                <!-- Reopen Quiz Modal -->
                                                <div class="modal fade" id="repeat_quizze{{ $degree->quizze_id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('repeat.quizze', $degree->quizze_id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        {{ trans('main_trans.reopen_test') }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h6>{{ $student->name }}</h6>
                                                                    <input type="hidden" name="student_id"
                                                                        value="{{ $student->id }}">
                                                                    <input type="hidden" name="quizze_id"
                                                                        value="{{ $degree->quizze_id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-info">{{ trans('My_Classes_trans.submit') }}</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
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
@endsection
