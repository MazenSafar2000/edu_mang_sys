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
                                            <th>{{ trans('Teacher_trans.cheating') }}</th>
                                            <th>{{ trans('teacher_trans.test_date') }}</th>
                                            <th>{{ trans('Teacher_trans.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($degrees as $degree)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $degree->student->name }}</td>
                                                <td>{{ $degree->score }}</td>
                                                @if ($degree->abuse == 0)
                                                    <td style="color: green">{{ trans('teacher_trans.no_cheating') }}</td>
                                                @else
                                                    <td style="color: red"> {{ trans('teacher_trans.is_cheating') }}</td>
                                                @endif
                                                <td>{{ $degree->date }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#repeat_quizze{{ $degree->quizze_id }}"
                                                        title="{{ trans('teacher_trans.re_open')}}">
                                                        <i class="fas fa-repeat"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="repeat_quizze{{ $degree->quizze_id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('repeat.quizze', $degree->quizze_id) }}"
                                                        method="post">
                                                        {{ method_field('post') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{ trans('main_trans.reopen_test') }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>{{ $degree->student->name }}</h6>
                                                                <input type="hidden" name="student_id"
                                                                    value="{{ $degree->student_id }}">
                                                                <input type="hidden" name="quizze_id"
                                                                    value="{{ $degree->quizze_id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-info">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
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
