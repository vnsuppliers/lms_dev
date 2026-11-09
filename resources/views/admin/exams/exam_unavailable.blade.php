@if(Request::get('type') == 'lead')
    @include('layouts.user.header')
@else
    @include('layouts.admin.header')
@endif

<div class="container py-5">
    <div class="card p-4">
        <h1 class="h4">Exam details unavailable</h1>
        <p>The attempt is saved, but its original exam record is missing. Its questions and answers cannot be displayed or evaluated.</p>
        <p><strong>Saved result:</strong> {{ $examAttempt->exam_result ?? 'Pending' }}</p>
        <p><strong>Exam ID:</strong> {{ $examAttempt->exam_id }} · <strong>Attempt ID:</strong> {{ $examAttempt->id }}</p>
        <p class="mb-0">Please ask your LMS administrator to restore the original exam data from a backup. The saved result has not been changed.</p>
    </div>
</div>

@if(Request::get('type') == 'lead')
    @include('layouts.user.footer')
@else
    @include('layouts.admin.footer')
@endif
