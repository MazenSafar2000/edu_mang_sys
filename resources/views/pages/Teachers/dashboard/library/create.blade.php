@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.add_new_book') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.add_new_book') }}
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
                        <form action="{{ route('library.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">

                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.book_name') }}</label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('Students_trans.Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id" id="grade-select">
                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="classroom_id" id="classroom-select">
                                            <option value="">{{ trans('Teacher_trans.select_class') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Students_trans.section') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="section_id" id="section-select">
                                            <option value="">{{ trans('Teacher_trans.select_section') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="subject_id">{{ trans('Students_trans.subjects') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id" id="subject-select">
                                            <option value="">{{ trans('Teacher_trans.select_subject') }}</option>
                                        </select>
                                    </div>
                                </div>

                            </div><br>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="file_name">{{ trans('Parent_trans.Attachments') }} : <span
                                                class="text-danger">*</span></label>
                                        <input type="file" accept="application/pdf" name="file_name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row" hidden>
                                <div class="col">
                                    <div>
                                        <label for="teacher_name"></label>
                                        <input type="text" name="teacher_name"
                                            value="{{ Auth::user()->getTranslation('Name', 'en') }}">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Teacher_trans.save_data') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    $('#grade-select').on('change', function() {
        var gradeId = $(this).val();
        if (gradeId) {
            $.get('/teacher/homeworks/filter-classrooms/' + gradeId, function(data) {
                $('#classroom-select').empty().append(
                    '<option value="">{{ trans('Teacher_trans.select_class') }}</option>');
                $('#section-select').empty().append(
                    '<option value="">{{ trans('Teacher_trans.select_section') }}</option>');
                $('#subject-select').empty().append(
                    '<option value="">{{ trans('Teacher_trans.select_subject') }}</option>');
                $.each(data, function(key, classroom) {
                    $('#classroom-select').append('<option value="' + classroom.id + '">' +
                        classroom.name + '</option>');
                });
            });
        }
    });

    $('#classroom-select').on('change', function() {
        var classId = $(this).val();
        if (classId) {
            $.get('/teacher/homeworks/filter-sections/' + classId, function(data) {
                $('#section-select').empty().append(
                    '<option value="">{{ trans('Teacher_trans.select_section') }}</option>');
                $('#subject-select').empty().append(
                    '<option value="">{{ trans('Teacher_trans.select_subject') }}</option>');
                $.each(data, function(key, section) {
                    $('#section-select').append('<option value="' + section.id + '">' + section
                        .name + '</option>');
                });
            });
        }
    });

    $('#section-select').on('change', function() {
        let gradeID = $('#grade-select').val();
        let classID = $('#classroom-select').val();
        let sectionID = $(this).val();

        if (gradeID && classID && sectionID) {
            $.ajax({
                url: `/teacher/homeworks/filter-subjects/${gradeID}/${classID}/${sectionID}`,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#subject-select').empty().append(
                        '<option value="">{{ trans('Teacher_trans.select_subject') }}</option>'
                    );
                    $.each(data, function(key, subject) {
                        $('#subject-select').append(
                            `<option value="${subject.id}">${subject.name}</option>`);
                    });
                }
            });
        }
    });
</script>
@endsection
