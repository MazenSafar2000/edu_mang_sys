@extends('layouts.master')

@section('title')
    {{ $subject->name }} - {{ __('Parent_trans.subject_details') }}
@endsection

@section('content')
<div class="container py-5">

    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ __('Parent_trans.quizzes') }}</h5>
        </div>
        <div class="card-body">
            @if ($quizzes->count())
                <ul class="list-group">
                    @foreach ($quizzes as $quiz)
                        <li class="list-group-item">
                            <a href="{{ route('quiz.preview', ['quiz_id' => $quiz->id, 'student_id' => $student->id]) }}">{{ $quiz->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __('Parent_trans.no_quizzes') }}</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ __('Parent_trans.homeworks') }}</h5>
        </div>
        <div class="card-body">
            @if ($homeworks->count())
                <ul class="list-group">
                    @foreach ($homeworks as $homework)
                        <li class="list-group-item">
                            <a href="{{ route('homework.preview', ['homework_id' => $homework->id, 'student_id' => $student->id]) }}">{{ $homework->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __('Parent_trans.no_homeworks') }}</p>
            @endif
        </div>
    </div>

</div>
@endsection
