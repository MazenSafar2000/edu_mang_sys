@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة سؤال جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة سؤال جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('questions.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.question') }}</label>
                                    <input type="text" name="title" id="input-name"
                                        class="form-control form-control-alternative @error('title') is-invalid @enderror" autofocus required>
                                    <input type="hidden" value="{{ $quizz_id }}" name="quizz_id">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="answers"> {{ trans('Teacher_trans.answers') }} <span style="color: red; font-size: smaller">{{ trans('Teacher_trans.Questions_separated_by_comma') }}</span> </label>
                                    <textarea name="answers" class="form-control @error('answers') is-invalid @enderror"  rows="4" required></textarea>
                                    @error('answers')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="right_answer">{{ trans('Teacher_trans.right_answer') }}</label>
                                    <input type="text" name="right_answer" id="right_answer"
                                        class="form-control form-control-alternative" autofocus required>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('Teacher_trans.degree') }}: <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score" required>
                                            <option selected disabled> {{ trans('Teacher_trans.select_degree') }}</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('Teacher_trans.save_data') }}</button>
                        </form>
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
