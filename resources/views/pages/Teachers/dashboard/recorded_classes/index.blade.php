@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.recorded_classes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.recorded_classes') }}
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
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{ route('recorded-classes.create') }}" class="btn btn-success" role="button"
                                aria-pressed="true">{{ trans('Teacher_trans.Add_new_recordedClass') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('Teacher_trans.grade') }}</th>
                                            <th>{{ trans('Teacher_trans.classroom') }}</th>
                                            <th>{{ trans('Teacher_trans.section') }}</th>
                                            <th>{{ trans('Teacher_trans.subject') }}</th>
                                            <th>{{ trans('Teacher_trans.Class_title') }}</th>
                                            <th>{{ trans('Teacher_trans.Class_link') }}</th>
                                            <th>{{ trans('Teacher_trans.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recordedClasses as $class)
                                            <tr>
                                                <td>{{ $class->grade->Name }}</td>
                                                <td>{{ $class->classroom->Name_Class }}</td>
                                                <td>{{ $class->section->Name_Section }}</td>
                                                <td>{{ $class->subject->name }}</td>
                                                <td>{{ $class->title }}</td>
                                                <td><a href="{{ $class->video_url }}"
                                                        target="_blank">{{ trans('Teacher_trans.Watch_the_class') }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('recorded-classes.edit', $class->id) }}"
                                                        class="btn btn-info btn-sm"
                                                        title="{{ trans('Teacher_trans.Update_recordedClass') }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form action="{{ route('recorded-classes.destroy', $class->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="{{ trans('Teacher_trans.delete') }} "><i
                                                                class="fa fa-trash"></i> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
