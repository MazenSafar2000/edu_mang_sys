@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.library_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.library_list') }}
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
                                            <th>{{ trans('Teacher_trans.book_name') }}</th>
                                            <th>{{ trans('Teacher_trans.teacher_name') }}</th>
                                            <th>{{ trans('Teacher_trans.subject') }}</th>
                                            <th>{{ trans('Students_trans.uploaded_at') }}</th>
                                            <th>{{ trans('Teacher_trans.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($books as $book)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->teacher->Name}}</td>
                                                <td>{{ $book->subject->name}}</td>
                                                <td>{{ \Carbon\Carbon::parse($book->created_at)->format('Y-m-d g:i A') }}</td>
                                                <td>
                                                    <a href="{{ asset('attachments/library/teachers/' . $book->teacher->getTranslation('Name', 'en') . '/' . $book->file_name) }}"
                                                        target="_blank" class="btn btn-sm btn-primary">{{ trans('Students_trans.view_book') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No books available for your section.</td>
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
@endsection
