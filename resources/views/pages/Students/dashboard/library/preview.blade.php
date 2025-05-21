@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Students_trans.preview_book') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Students_trans.preview_book') }}
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
                            <ul class="list-unstyled">
                                <li><strong>{{ trans('Teacher_trans.book_name') }}:
                                    </strong>{{ $book->title }}
                                </li>
                                <li><strong>{{ trans('Teacher_trans.subject') }}:
                                    </strong>{{ $book->subject->name }}
                                </li>
                                <li><strong>{{ trans('Teacher_trans.created_at') }}:
                                    </strong>{{ $book->created_at }}
                                </li>
                                <a href="{{ asset('attachments/library/teachers/' . $book->teacher->Name . '/' . $book->file_name) }}" target="_blank">
                                    <button class="btn btn-outline-info rounded">View Book</button>
                                </a>

                            </ul>
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
