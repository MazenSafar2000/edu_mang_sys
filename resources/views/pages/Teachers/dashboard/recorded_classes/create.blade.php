@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Add_new_recordedClass') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Add_new_recordedClass') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('recorded-classes.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="grade_id">{{ trans('Students_trans.Grade') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="grade_id" id="grade-select" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="classroom_id" id="classroom-select" required>
                                <option value="">{{ trans('Teacher_trans.select_class') }}</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="section_id">{{ trans('Students_trans.section') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="section_id" id="section-select" required>
                                <option value="">{{ trans('Teacher_trans.select_section') }}</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="subject_id">{{ trans('Students_trans.subjects') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="subject_id" id="subject-select" required>
                                <option value="">{{ trans('Teacher_trans.select_subject') }}</option>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label>{{ trans('Teacher_trans.Class_title') }}</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <label>{{ trans('Teacher_trans.class_description_optional') }}</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ trans('Teacher_trans.Class_link') }} <small>
                                    {{ trans('Teacher_trans.video_types') }}</small></label>
                            <input type="url" class="form-control" name="video_url" required>
                        </div>
                    </div>
                    <br>

                    <button class="btn btn-primary" type="submit">{{ trans('Teacher_trans.save_data') }}</button>
                </form>

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
