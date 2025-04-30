@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('Teacher_trans.add_new_homework') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.add_new_homework') }}
@endsection
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

                <form action="{{ route('teacher.homeworks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_title') }}</label>
                        <input type="text" name="title" class="form-control" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_description') }}</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label>{{ trans('Teacher_trans.grade') }}</label>
                            <select name="grade_id" id="grade-select" class="form-control" required>
                                <option value="">{{ trans('Teacher_trans.select_grade') }}</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <label>{{ trans('Teacher_trans.classroom') }}</label>
                            <select name="classroom_id" id="classroom-select" class="form-control" required>
                                <option value="">{{ trans('Teacher_trans.select_class') }}</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label>{{ trans('Teacher_trans.section') }}</label>
                            <select name="section_id" id="section-select" class="form-control" required>
                                <option value="">{{ trans('Teacher_trans.select_section') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.subject') }}</label>
                        <select name="subject_id" class="form-control" required>
                            <option value="">{{ trans('Teacher_trans.select_subject') }}</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.total_degree') }}</label>
                        <input type="number" name="total_degree" class="form-control" min="1" required>
                        @error('total_degree')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.allowed_file_types') }}</label>
                        <select name="allowed_file_types[]" class="form-control" multiple required>
                            <option value="pdf">PDF</option>
                            <option value="doc">Word (DOC)</option>
                            <option value="docx">Word (DOCX)</option>
                            <option value="jpg">Image (JPG)</option>
                            <option value="png">Image (PNG)</option>
                            <option value="rar">RAR File</option>
                            <option value="zip">ZIP File</option>
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
                                id="allow_multiple_submissions">
                            <label class="form-check-label" for="allow_multiple_submissions">
                                {{ trans('Teacher_trans.yes_allow') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('Teacher_trans.homework_due_date') }}</label>
                        <input type="datetime-local" name="due_date" class="form-control" required>
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
                        class="btn btn-primary">{{ trans('Teacher_trans.Create_Homework') }}</button>

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
