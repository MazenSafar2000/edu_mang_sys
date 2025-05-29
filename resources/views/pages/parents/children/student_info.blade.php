@extends('layouts.master')

@section('title')
    {{ __('Parent_trans.student_information') }}
@endsection

@section('content')
    <div class="container py-5">

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">{{ $student->name }}</h4>
                <p><strong>{{ __('Parent_trans.grade') }}:</strong> {{ $student->grade->Name }}</p>
                <p><strong>{{ __('Parent_trans.class_room') }}:</strong> {{ $student->classroom->Name_Class }}</p>
                <p><strong>{{ __('Parent_trans.section') }}:</strong> {{ $student->section->Name_Section }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Parent_trans.subjects') }}</h5>
            </div>
            <div class="card-body">
                @if (count($subjects) > 0)
                    <ul class="list-group">
                        @foreach ($subjects as $subject)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('subject.details', [$student->id, $subject->id]) }}">
                                    {{ $subject->name }}
                                </a>
                                <span class="badge badge-primary badge-pill">
                                    {{ $subject->teacher->Name ?? 'No Teacher Assigned' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('Parent_trans.no_subjects') }}</p>
                @endif
            </div>
        </div>

    </div>
@endsection
