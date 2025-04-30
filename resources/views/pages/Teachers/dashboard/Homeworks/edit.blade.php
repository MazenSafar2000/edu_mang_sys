@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Update_Homework') }} : {{ $homework->title }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Update_Homework') }} : {{ $homework->title }}
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('teacher.homeworks.update', $homework->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_title') }}</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $homework->title) }}" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_description') }}</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $homework->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('grade_id') is-invalid @enderror"
                                    name="grade_id" id="grade-select" required>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $grade->id == $homework->grade_id ? 'selected' : '' }}>
                                            {{ $grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('classroom_id') is-invalid @enderror"
                                    name="classroom_id" id="classroom-select" required>
                                    <option value="{{ $homework->classroom_id }}">
                                        {{ $homework->classroom->Name_Class }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                <select class="custom-select mr-sm-2 @error('section_id') is-invalid @enderror"
                                    name="section_id" id="section-select" required>
                                    <option value="{{ $homework->section_id }}">
                                        {{ $homework->section->Name_Section }}</option>
                                </select>
                            </div>
                        </div>

                    </div><br>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.subject') }}</label>
                        <select name="subject_id" class="form-control" required>
                            <option value="">{{ trans('Teacher_trans.select_subject') }}</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $homework->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.total_degree') }}</label>
                        <input type="number" name="total_degree" class="form-control" min="1"
                            value="{{ old('total_degree', $homework->total_degree) }}" required>
                        @error('total_degree')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.allowed_file_types') }}</label>
                        <select name="allowed_file_types[]" class="form-control" multiple required>
                            @php
                                $selectedTypes = old('allowed_file_types', $homework->allowed_file_types ?? []);
                            @endphp
                            @foreach (['pdf', 'doc', 'docx', 'jpg', 'png', 'rar', 'zip'] as $type)
                                <option value="{{ $type }}"
                                    {{ in_array($type, $selectedTypes) ? 'selected' : '' }}>
                                    {{ strtoupper($type) }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">{{ trans('Teacher_trans.hold_ctrl') }}</small>
                        @error('allowed_file_types')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.allow_multiple_submissions') }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="allow_multiple_submissions"
                                id="allow_multiple_submissions"
                                {{ old('allow_multiple_submissions', $homework->allow_multiple_submissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="allow_multiple_submissions">
                                {{ trans('Teacher_trans.yes_allow') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_due_date') }}</label>
                        <input type="datetime-local" name="due_date" class="form-control"
                            value="{{ old('due_date', \Carbon\Carbon::parse($homework->due_date)->format('Y-m-d\TH:i')) }}"
                            required>
                        @error('due_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_attachment') }}
                            ({{ trans('Teacher_trans.optional') }})</label>
                        <input type="file" name="attachment" class="form-control-file"
                            accept=".pdf,.doc,.docx,.jpg,.png,.rar,.zip">
                        @if (isset($homework) && $homework->attachment_path)
                            <div class="mt-2">
                                <a href="{{ Storage::url($homework->attachment_path) }}" target="_blank">
                                    {{ trans('Teacher_trans.view_current_attachment') }}
                                </a>
                                <label class="ml-3">
                                    <input type="checkbox" name="remove_attachment">
                                    {{ trans('Teacher_trans.remove_attachment') }}
                                </label>
                            </div>
                        @endif
                        @error('attachment')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-success">{{ trans('Teacher_trans.Update_Homework') }}</button>

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
                $.each(data, function(key, section) {
                    $('#section-select').append('<option value="' + section.id + '">' + section
                        .name + '</option>');
                });
            });
        }
    });
</script>
@endsection
