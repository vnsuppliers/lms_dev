@php
    $attempts = $assessment->assessment_all_results->where('assign_id', $courses_data->id);
    if ($attempts->isEmpty()) {
        $allType6Docs = \App\Models\Course_documents::where('course_id', $courses_data->course_id)
            ->where('type', 6)
            ->where('is_delete', 0)
            ->get();
        $matchedDocIds = $allType6Docs->filter(function($d) use ($assessment) {
            return $d->id == $assessment->id || trim(strtolower($d->file_name)) === trim(strtolower($assessment->file_name));
        })->pluck('id');
        $courseDocIds = $matchedDocIds->isNotEmpty() ? $matchedDocIds : $allType6Docs->pluck('id');

        $attempts = \App\Models\Assessment_results::where(function($q) use ($courses_data, $courseDocIds) {
                if ($courses_data->id) {
                    $q->where('assign_id', $courses_data->id);
                }
                if ($courseDocIds->isNotEmpty()) {
                    $q->orWhere(function($subQ) use ($courseDocIds, $courses_data) {
                        $subQ->whereIn('course_document_id', $courseDocIds)
                            ->where(function($aQ) use ($courses_data) {
                                $aQ->whereNull('assign_id')
                                   ->orWhere('assign_id', 0)
                                   ->orWhere('assign_id', $courses_data->id);
                            });
                    });
                }
            })
            ->where('user_id', $courses_data->user_id ?? \Illuminate\Support\Facades\Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->get();
    }
    $latestThreeAttempts = $attempts->sortBy('id')->values()->slice(-3)->values();
    $passedAttempt = $latestThreeAttempts->first(fn ($attempt) => $attempt->hasPassed());
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
