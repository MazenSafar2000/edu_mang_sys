@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('Teacher_trans.Sections') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Sections') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="container mt-4">
                    <h2 class="mb-4 text-primary">📚 {{ trans('Teacher_trans.Materials_for_Section') }}:
                        <span class="text-dark">{{ $section->Name_Section ?? 'Section' }}</span>
                    </h2>

                    <div class="row g-4">
                        <!-- Books -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-info shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <strong><i class="fas fa-book"></i> {{ trans('Teacher_trans.books') }}</strong>
                                </div>
                                <div class="card-body">
                                    @forelse($books as $book)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    📘 {{ $book->title }} - {{ $book->subject->name }}
                                                </div>
                                                <small
                                                    class="text-muted">{{ $book->created_at->format('Y-m-d') }}</small>
                                                <button type="button" class="btn btn-sm btn-outline-success ml-2"
                                                    data-toggle="modal" data-target="#BookModal{{ $book->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="BookModal{{ $book->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="BookModalLabel{{ $book->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-info">
                                                        <div class="modal-header bg-info text-white">
                                                            <h5 class="modal-title text-white"
                                                                id="BookModalLabel{{ $book->id }}">
                                                                <i class="fas fa-question-circle"></i>
                                                                {{ trans('Teacher_trans.RecordClassDetails') }}
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"
                                                            style="font-family: 'Cairo', sans-serif;">
                                                            <ul class="list-unstyled">
                                                                <li><strong>{{ trans('Teacher_trans.book_name') }}:
                                                                    </strong>{{ $book->title }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.grade') }}:
                                                                    </strong>{{ $book->grade->Name }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.classroom') }}:
                                                                    </strong>{{ $book->classroom->Name_Class }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.section') }}:
                                                                    </strong>{{ $book->section->Name_Section }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.subject') }}:
                                                                    </strong>{{ $book->subject->name }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.created_at') }}:
                                                                    </strong>{{ $book->created_at }}
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                            <a href="{{ route('downloadAttachment', $book->file_name) }}"
                                                                class="btn btn-warning btn-sm"
                                                                title="{{ trans('Teacher_trans.download') }}"
                                                                role="button" aria-pressed="true"><i
                                                                    class="fas fa-download"></i></a>
                                                            <a href="{{ route('library.edit', $book->id) }}"
                                                                class="btn btn-info btn-sm"
                                                                title="{{ trans('Teacher_trans.edit') }}"
                                                                role="button" aria-pressed="true"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <form action="{{ route('quizzes.destroy', $book->id) }}"
                                                                method="POST" style="display:inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm m-1"
                                                                    onclick="return confirm('{{ trans('My_Classes_trans.Warning_Grade') }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ trans('Teacher_trans.No_books_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Homeworks -->
                        <div class="col-md-6">
                            <div class="card border-success shadow-sm">
                                <div class="card-header bg-success text-white">
                                    <strong><i class="fas fa-tasks"></i>
                                        {{ trans('Teacher_trans.Homeworks') }}</strong>
                                </div>
                                <div class="card-body">
                                    @forelse($homeworks as $hw)
                                        <div class="mb-2">
                                            📝 {{ $hw->title }}
                                            <small class="text-muted">({{ trans('Teacher_trans.due') }}:
                                                {{ \Carbon\Carbon::parse($hw->due_date)->format('d M Y h:i A') }})</small>

                                            <button type="button" class="btn btn-sm btn-outline-success ml-2"
                                                data-toggle="modal" data-target="#hwModal{{ $hw->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <hr>
                                        <!-- 📦 Modal for Homework -->
                                        <div class="modal fade" id="hwModal{{ $hw->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalLabel{{ $hw->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border-success">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="modalLabel{{ $hw->id }}">
                                                            {{ trans('Teacher_trans.HomeworkDetails') }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-unstyled">
                                                            <li><strong>{{ trans('Teacher_trans.grade') }}:</strong>
                                                                {{ $hw->grade->Name }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.classroom') }}:</strong>
                                                                {{ $hw->classroom->Name_Class }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.section') }}:</strong>
                                                                {{ $hw->section->Name_Section }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.homework_title') }}:</strong>
                                                                {{ $hw->title }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.homework_description') }}:</strong>
                                                                {{ $hw->description }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.total_degree') }}:</strong>
                                                                {{ $hw->total_degree }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.allow_multiple_submissions') }}:</strong>
                                                                {{ $hw->allow_multiple_submissions ? 'Yes' : 'No' }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.due') }}:</strong>
                                                                {{ \Carbon\Carbon::parse($hw->due_date)->format('d M Y h:i A') }}
                                                            </li>
                                                        </ul>
                                                        <a href="{{ route('teacher.homeworks.edit', $hw->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            title="{{ trans('Teacher_trans.edit') }}"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <form
                                                            action="{{ route('teacher.homeworks.destroy', $hw->id) }}"
                                                            method="POST" style="display:inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm m-1"
                                                                onclick="return confirm('{{ trans('My_Classes_trans.Warning_Grade') }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('teacher.homeworks.submissions', $hw->id) }}"
                                                            class="btn btn-success btn-sm"
                                                            title="{{ trans('Teacher_trans.Display_Delivered_Students') }}"
                                                            role="button" aria-pressed="true"><i
                                                                class="fas fa-users"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ trans('Teacher_trans.No_homeworks_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Quizzes -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-warning shadow-sm">
                                <div class="card-header bg-warning text-white">
                                    <strong><i class="fas fa-question-circle"></i>
                                        {{ trans('Teacher_trans.exams') }}</strong>
                                </div>
                                <div class="card-body">
                                    @forelse($quizzes as $quiz)
                                        <div class="mb-2">
                                            🧠 {{ $quiz->name }}
                                            <small class="text-muted">({{ $quiz->start_at }} -
                                                {{ $quiz->end_at }})</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                            data-toggle="modal" data-target="#quizModal{{ $quiz->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <hr>
                                        <!-- Quiz Modal -->
                                        <div class="modal fade" id="quizModal{{ $quiz->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="quizModalLabel{{ $quiz->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-warning">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title"
                                                            id="quizModalLabel{{ $quiz->id }}">
                                                            <i class="fas fa-question-circle"></i>
                                                            {{ trans('Teacher_trans.ExamDetails') }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="font-family: 'Cairo', sans-serif;">
                                                        <ul class="list-unstyled">
                                                            <li><strong>{{ trans('Teacher_trans.quizz_name') }}:</strong>
                                                                {{ $quiz->name }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.subject') }}:</strong>
                                                                {{ $quiz->subject->name }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.grade') }}:</strong>
                                                                {{ $quiz->grade->Name }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.classroom') }}:</strong>
                                                                {{ $quiz->classroom->Name_Class }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.section') }}:</strong>
                                                                {{ $quiz->section->Name_Section }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.durartion') }}:</strong>
                                                                {{ $quiz->duration }}</li>
                                                            <li><strong>{{ trans('Teacher_trans.start_at') }}:</strong>
                                                                {{ \Carbon\Carbon::parse($quiz->start_at)->format('d M Y h:i A') }}
                                                            </li>
                                                            <li><strong>{{ trans('Teacher_trans.end_at') }}:</strong>
                                                                {{ \Carbon\Carbon::parse($quiz->end_at)->format('d M Y h:i A') }}
                                                            </li>
                                                        </ul>
                                                        <hr>
                                                        <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            title="{{ trans('Teacher_trans.edit') }}"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                            class="btn btn-warning btn-sm"
                                                            title="{{ trans('Teacher_trans.Show_questions') }}"
                                                            role="button" aria-pressed="true"><i
                                                                class="fa fa-binoculars"></i></a>
                                                        <a href="{{ route('student.quizze', $quiz->id) }}"
                                                            class="btn btn-primary btn-sm"
                                                            title="{{ trans('Teacher_trans.Display_Tested_Students') }}"
                                                            role="button" aria-pressed="true"><i
                                                                class="fa fa-street-view"></i></a>
                                                        <form action="{{ route('quizzes.destroy', $quiz->id) }}"
                                                            method="POST" style="display:inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm m-1"
                                                                onclick="return confirm('{{ trans('My_Classes_trans.Warning_Grade') }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ trans('Teacher_trans.No_quizzes_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Online Classes --}}
                        <div class="col-md-6">
                            <div class="card border-primary shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <strong><i class="fas fa-video"></i>
                                        {{ trans('Teacher_trans.Online_classes') }}</strong>
                                </div>
                                <div class="card-body">
                                    @forelse($onlineClasses as $class)
                                        <div class="mb-3">
                                            🎥 {{ $class->topic }}
                                            <!-- View Details Button -->
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-toggle="modal" data-target="#classModal{{ $class->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="classModal{{ $class->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="classModalLabel{{ $class->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-primary">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title"
                                                                id="classModalLabel{{ $class->id }}">
                                                                <i class="fas fa-question-circle"></i>
                                                                {{ trans('Teacher_trans.LiveClassDetails') }}
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"
                                                            style="font-family: 'Cairo', sans-serif;">
                                                            <ul class="list-unstyled">
                                                                <li><strong>{{ trans('Teacher_trans.grade') }}:
                                                                    </strong>{{ $class->grade->Name }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.classroom') }}:
                                                                    </strong>{{ $class->classroom->Name_Class }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.section') }}:
                                                                    </strong>{{ $class->section->Name_Section }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.Class_title') }}:
                                                                    </strong>{{ $class->topic }}
                                                                </li>
                                                                {{-- <li><strong>{{ trans('Teacher_trans.subject') }}:
                                                                    </strong>{{ $class->subject->name }}</li>
                                                                </li> --}}
                                                                <li><strong>{{ trans('Teacher_trans.start_at') }}:
                                                                    </strong>{{ $class->start_at }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.durartion') }}:
                                                                    </strong>{{ $class->duration }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.Password') }}:
                                                                    </strong>{{ $class->password }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.meeting_id') }}:
                                                                    </strong>{{ $class->meeting_id }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.start_url_host') }}:
                                                                    </strong>
                                                                    <a href="{{ $class->start_url }}"
                                                                        target="_blank">{{ trans('Teacher_trans.start_meeting') }}</a>
                                                                </li>
                                                                <li>
                                                                    <strong>{{ trans('Teacher_trans.start_url_std') }}:
                                                                    </strong>
                                                                    <a href="{{ $class->join_url }}"
                                                                        target="_blank">{{ trans('Teacher_trans.join_meeting') }}</a>
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">
                                            {{ trans('Teacher_trans.No_online_classes_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Recorded Classes --}}
                        <div class="col-md-12">
                            <div class="card border-dark shadow-sm">
                                <div class="card-header bg-dark text-white">
                                    <strong><i class="fas fa-film"></i>
                                        {{ trans('Teacher_trans.recorded_classes') }}</strong>
                                </div>
                                <div class="card-body">
                                    @forelse($recordedClasses as $record)
                                        <div class="mb-3">
                                            🎬 {{ $record->title }}
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-toggle="modal"
                                                data-target="#RecordClassModal{{ $record->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="RecordClassModal{{ $record->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="RecordClassModalLabel{{ $record->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-dark">
                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title text-white"
                                                                id="RecordClassModalLabel{{ $record->id }}">
                                                                <i class="fas fa-question-circle"></i>
                                                                {{ trans('Teacher_trans.RecordClassDetails') }}
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"
                                                            style="font-family: 'Cairo', sans-serif;">
                                                            <ul class="list-unstyled">
                                                                <li><strong>{{ trans('Teacher_trans.grade') }}:
                                                                    </strong>{{ $record->grade->Name }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.classroom') }}:
                                                                    </strong>{{ $record->classroom->Name_Class }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.section') }}:
                                                                    </strong>{{ $record->section->Name_Section }}</li>
                                                                <li><strong>{{ trans('Teacher_trans.Class_title') }}:
                                                                    </strong>{{ $record->title }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.subject') }}:
                                                                    </strong>{{ $record->subject->name }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.created_at') }}:
                                                                    </strong>{{ $record->created_at }}
                                                                </li>
                                                                <li><strong>{{ trans('Teacher_trans.Class_link') }}:
                                                                    </strong>
                                                                    <a href="{{ $record->video_url }}"
                                                                        target="_blank">{{ trans('Teacher_trans.open_viedo') }}</a>
                                                                </li>
                                                                <li>
                                                            </ul>
                                                            <hr>
                                                            <a href="{{ route('recorded-classes.edit', $record->id) }}"
                                                                class="btn btn-info btn-sm"
                                                                title="{{ trans('Teacher_trans.Update_recordedClass') }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <form
                                                                action="{{ route('quizzes.destroy', $record->id) }}"
                                                                method="POST" style="display:inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm m-1"
                                                                    onclick="return confirm('{{ trans('My_Classes_trans.Warning_Grade') }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">
                                            {{ trans('Teacher_trans.No_recorded_classes_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Book Detail Modal -->
    {{-- <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="bookDetailModalLabel">📘 Book Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="bookTitle"></h5>
                    <p><strong>Subject:</strong> <span id="bookSubject"></span></p>
                    <p><strong>Uploaded at:</strong> <span id="bookDate"></span></p>
                    <a href="#" id="bookDownload" target="_blank" class="btn btn-sm btn-primary me-2">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <a href="#" id="bookUpdate" class="btn btn-sm btn-warning me-2">
                        <i class="fas fa-edit"></i> Update
                    </a>
                    <form method="POST" id="bookDeleteForm" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


</div>
@endsection
@section('js')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('bookDetailModal'));

        document.querySelectorAll('.show-book').forEach(button => {
            button.addEventListener('click', function() {
                const title = this.dataset.title;
                const subject = this.dataset.subject;
                const date = this.dataset.date;
                const file = this.dataset.file;
                const update = this.dataset.update;
                const deleteUrl = this.dataset.delete;

                document.getElementById('bookTitle').innerText = title;
                document.getElementById('bookSubject').innerText = subject;
                document.getElementById('bookDate').innerText = date;
                document.getElementById('bookDownload').href = file;
                document.getElementById('bookUpdate').href = update;
                document.getElementById('bookDeleteForm').action = deleteUrl;

                modal.show();
            });
        });
    });
</script> --}}

@endsection
