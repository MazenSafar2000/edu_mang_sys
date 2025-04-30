@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
@section('title')
    {{ trans('Students_trans.take_quizz') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.take_quizz') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

@livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
@toastr_js
@toastr_render
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts
@endsection
