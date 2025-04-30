@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.submit_homework') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.submit_homework') }}
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <form method="POST" action="{{ route('student.submissions.store', $homework->id) }}"
                                enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <input type="hidden" name="homework_id" value="{{ $homework->id }}">

                                <div class="form-group">
                                    <label for="submission_file">Choose File (Allowed:
                                        {{ implode(', ', $homework->allowed_file_types) }})</label>
                                    <input type="file"
                                        class="form-control @error('submission_file') is-invalid @enderror"
                                        name="submission_file" required>

                                    @error('submission_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($existing && !$homework->allow_multiple_submissions)
                                    <div class="alert alert-warning">You already submitted this homework. Multiple
                                        submissions are not allowed.</div>
                                @endif

                                <button type="submit" class="btn btn-success">Submit Homework</button>
                                <a href="{{ route('student.submissions.index') }}" class="btn btn-secondary">Back</a>
                            </form>
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
