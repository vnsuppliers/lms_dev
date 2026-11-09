@php
    $attempts = $assessment->assessment_all_results->where('assign_id', $courses_data->id);
    $passedAttempt = $attempts->sortByDesc('id')->first(fn ($attempt) => $attempt->hasPassed());
@endphp

@if($passedAttempt)
    @php
        $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
        $parts = explode('/', $assessment->file_path);
        $resultPath = ($parts[0] ?? '').'/'.($parts[1] ?? '').'/results/'.$passedAttempt->code;
        $reportUrl = rtrim($assessmentBaseUrl, '/') . '/start_assessment?'.http_build_query([
            'url' => $resultPath,
            'email' => Auth::user()->email,
            'username' => Auth::user()->username,
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->emp_id,
            'course_id' => $assessment->id,
            'assign_id' => $courses_data->id,
            'lms_url' => url('/'),
        ]);
    @endphp
    <a href="javascript:;" data-link="{{ $reportUrl }}" data-assign-id="{{ $courses_data->id }}" class="{{ $actionClass }} take_result">{{ $reportLabel }}</a>
@elseif($attempts->count() >= 3)
    <span>Maximum attempts reached</span>
@elseif($assessment->expiration_date && \Carbon\Carbon::parse($assessment->expiration_date)->startOfDay()->lte(now()->startOfDay()))
    <button class="btn btn-secondary text-nowrap" disabled>Expired</button>
@else
    <a href="javascript:;"
       data-assessment-id="{{ $assessment->id }}"
       data-assign-id="{{ $courses_data->id }}"
       data-attempts-count="{{ $attempts->count() }}"
       data-attempts-remaining="{{ max(0, 3 - $attempts->count()) }}"
       class="{{ $actionClass }} take_exam assessment-launch {{ !$assessmentVideoAccessGranted ? 'assessment-locked opacity-50' : '' }}"
       aria-disabled="{{ !$assessmentVideoAccessGranted ? 'true' : 'false' }}">
        {{ $attempts->isEmpty() ? 'Take Exam' : 'Retake Exam' }}
    </a>
@endif
