@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.homeworks_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.homeworks_list') }}
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

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Students_trans.subject') }}</th>
                                            <th>{{ __('Students_trans.homework_title') }}</th>
                                            <th>{{ __('Students_trans.deadline') }}</th>
                                            <th>{{ __('Students_trans.file_type') }}</th>
                                            <th>{{ __('Students_trans.multiple_submissions') }}</th>
                                            <th>{{ __('Students_trans.Submitted') }}</th>
                                            <th>{{ __('Students_trans.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($homeworks as $homework)
                                            @php
                                                $submission = $homework->submissions
                                                    ->where('student_id', auth('student')->id())
                                                    ->first();
                                                $now = \Carbon\Carbon::now();
                                                $due = \Carbon\Carbon::parse($homework->due_date);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $homework->subject->name }}</td>
                                                <td>{{ $homework->title }}</td>

                                                {{-- Deadline column --}}
                                                <td>
                                                    @if ($due->isPast())
                                                        <span
                                                            class="text-danger">{{ __('Students_trans.its_over') ?? 'It\'s over' }}</span>
                                                    @else
                                                        <span
                                                            class="text-success">{{ $due->diffForHumans($now, ['parts' => 2]) }}</span>
                                                    @endif
                                                </td>

                                                <td>{{ implode(', ', $homework->allowed_file_types) }}</td>
                                                <td>{{ $homework->allow_multiple_submissions ? __('Students_trans.yes') : __('Students_trans.No') }}
                                                </td>

                                                {{-- Submission status --}}
                                                <td>
                                                    @if ($submission && $submission->file_path)
                                                        <span
                                                            class="badge badge-success">{{ __('Students_trans.Submitted') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ __('Students_trans.Not_Submitted') }}</span>
                                                    @endif
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    @if ($submission && $submission->file_path)
                                                        <a href="{{ route('student.submissions.show', $homework->id) }}"
                                                            class="btn btn-info btn-sm">{{ __('Students_trans.view') }}</a>
                                                        @if ($homework->allow_multiple_submissions)
                                                            <a href="{{ route('student.submissions.create', $homework->id) }}"
                                                                class="btn btn-warning btn-sm">{{ __('Students_trans.Resubmit') }}</a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('student.submissions.create', $homework->id) }}"
                                                            class="btn btn-primary btn-sm">{{ __('Students_trans.Submit') }}</a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">{{ __('Students_trans.no_homeworks') }}</td>
                                            </tr>
                                        @endforelse
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

<script>
    function alertAbuse() {
        alert(
            "برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك "
        );
    }
</script>

@endsection
