@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الفواتير الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Parent_trans.financial_report') }}@stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>{{ __('Parent_trans.name') }}</th>
                                                <th>{{ __('Parent_trans.fee_type') }}</th>
                                                <th>{{ __('Parent_trans.amount') }}</th>
                                                <th>{{ __('Parent_trans.grade') }}</th>
                                                <th>{{ __('Parent_trans.class_room') }}</th>
                                                <th>{{ __('Parent_trans.Statement') }}</th>
                                                <th>{{ __('Parent_trans.operations') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
