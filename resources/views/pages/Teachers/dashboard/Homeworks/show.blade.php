@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.homeworks_deliverd_list') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.homeworks_deliverd_list') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h4>{{ $homework->title }}</h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Students_trans.student_name') }}</th>
                                <th>{{ trans('Students_trans.classrooms') }}</th>
                                <th>{{ trans('Students_trans.section') }}</th>
                                <th>{{ trans('Teacher_trans.submitted_file') }}</th>
                                <th>{{ trans('Teacher_trans.submission_timing') }}</th>
                                <th>{{ trans('Teacher_trans.degree') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $index => $student)
                                @php
                                    $submission = $student->submissions->firstWhere('homework_id', $homework->id);
                                    $submittedAt = optional($submission)->submitted_at;
                                    $deadline = \Carbon\Carbon::parse($homework->due_date);
                                @endphp
                                <tr @if ($submission && $submission->degree !== null) class="table-success" @endif>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->classroom->Name_Class }}</td>
                                    <td>{{ $student->section->Name_Section }}</td>
                                    <td>
                                        @if ($submission && $submission->file_path)
                                            <a href="{{ asset($submission->file_path) }}" target="_blank">
                                                {{ basename($submission->file_path) }}
                                            </a>
                                        @else
                                            <span class="text-danger">{{ trans('Teacher_trans.no_submissions') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($submission && $submission->file_path && $submittedAt)
                                            @if ($submittedAt->gt($deadline))
                                                <span class="text-danger">{{ __('Late by') }}
                                                    {{ $submittedAt->diff($deadline)->format('%d days %h hours %i minutes') }}
                                                </span>
                                            @else
                                                <span class="text-success">{{ __('Early by') }}
                                                    {{ $deadline->diff($submittedAt)->format('%d days %h hours %i minutes') }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">{{ trans('Teacher_trans.no_submissions') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#gradeModal-{{ $student->id }}">
                                            {{ trans('Teacher_trans.grade_homework') }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="gradeModal-{{ $student->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="gradeModalLabel-{{ $student->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form
                                                    action="{{ route('teacher.homeworks.grade', [$homework->id, $student->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title"
                                                                id="gradeModalLabel-{{ $student->id }}">
                                                                {{ trans('Teacher_trans.grade_homework') }} -
                                                                {{ $student->name }}
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>{{ trans('Teacher_trans.degree') }}</label>
                                                                <input type="number" name="degree"
                                                                    class="form-control"
                                                                    value="{{ $submission?->degree ?? '' }}"
                                                                    max="{{ $homework->total_degree }}" min="0"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{{ trans('Teacher_trans.Feedback') }}</label>
                                                                <textarea name="feedback" rows="4" class="form-control">{{ $submission?->feedback ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Teacher_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('Teacher_trans.Save_changes') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ trans('Teacher_trans.no_students') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('teacher.homeworks.index') }}" class="btn btn-secondary mt-3">
                    {{ trans('Teacher_trans.Back') }}
                </a>
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
