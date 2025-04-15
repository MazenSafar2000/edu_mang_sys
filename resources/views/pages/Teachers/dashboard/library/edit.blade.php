@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Edit_book') }}  {{ $book->title }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Edit_book') }} <span class="text-success  font-weight-bold"> {{ $book->title }} </span>
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
                        <form action="{{ route('library.update', 'test') }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.book_name') }}</label>
                                    <input type="text" name="title" value="{{ $book->title }}"
                                        class="form-control">

                                    <input type="hidden" name="id" value="{{ $book->id }}"
                                        class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}"
                                                    {{ $book->Grade_id == $grade->id ? 'selected' : '' }}>
                                                    {{ $grade->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Classroom_id">
                                            <option value="{{ $book->Classroom_id }}">
                                                {{ $book->classroom->Name_Class }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Students_trans.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            <option value="{{ $book->section_id }}">
                                                {{ $book->section->Name_Section }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div><br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#pdfModal">
                                            {{ __('Teacher_trans.viewBook') }} <span> <i class="far fa-eye"></i></span>
                                        </button><br><br>

                                        <label for="file_name"></label>
                                        <input type="file" accept="application/pdf" name="file_name">
                                    </div>

                                </div>
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                                {{ trans('Teacher_trans.save_data') }} </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

<div class="modal" id="pdfModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 50rem; width: 1500px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed id="pdfFrame"
                    src="{{ URL::asset('attachments/library/teachers/' . $teacherName . '/' . $book->file_name) }}"
                    type="application/pdf" height="600px" width="1000px">
                <br><br>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    $('#pdfModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); //Button that triggered the modal
        var pdfUrl =
            "{{ URL::asset('attachments/library/teachers/' . $teacherName . '/' . $book->file_name) }}";
        $('#pdfFrame').attr('src', pdfUrl);
    });
    $('#pdfModal').on('hidden.bs.modal', function() {
        $('#pdfFrame').attr('src', '');
    });
</script>
@endsection
