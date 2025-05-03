<div class="row">
    @forelse($subjects as $subject)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $subject->teacher->Name }}</span>
                    <small class="text-muted">{{ $subject->created_at->format('d-m-Y') }}</small>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('dashboard/images/book-icon.png') }}" width="80" alt="subject-icon">
                    <h5 class="mt-3">{{ $subject->name }}</h5>
                    <a href="{{ route('student.subject.materials', $subject->id )}}" class="btn btn-primary mt-2">{{ trans('Students_trans.view_courses') }}</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>{{ trans('Students_trans.no_courses') }}</p>
        </div>
    @endforelse
</div>
