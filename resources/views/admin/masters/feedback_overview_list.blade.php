@include('layouts.admin.header')

<div class="container-fluid py-3">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center py-2 flex-wrap mb-2">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <a href="{{ url('masters?tab=8') }}" class="btn btn-sm btn-outline-secondary" title="Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h5 class="mb-0 font-weight-bold text-dark">
                <i class="fa-solid fa-star headings-icon mr-2 text-warning"></i>Feedback Overview: {{ $feedbackOverview->name ?? 'Feedback' }}
            </h5>
        </div>
        <a href="{{ url('masters?tab=8') }}" class="btn web-btn btn-sm mt-2 mt-md-0">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Settings
        </a>
    </div>

    @php
        $totalResponses = $feedbackOverview->employeeRatings->count();
        $avgRating = $totalResponses > 0 ? round($feedbackOverview->employeeRatings->avg('rating'), 1) : 0;
    @endphp

    <!-- Details Info Bar -->
    <div class="card p-3 mb-3 border bg-light shadow-none">
        <div class="row g-2 align-items-center">
            @if($feedbackOverview->type == 2)
                <div class="col-md-4 col-sm-6">
                    <span class="text-muted small d-block">Category Name:</span>
                    <strong class="text-dark">{{ $feedbackOverview->category->category_name ?? '-' }}</strong>
                </div>
                <div class="col-md-5 col-sm-6">
                    <span class="text-muted small d-block">Course Name:</span>
                    <strong class="text-dark">{{ $feedbackOverview->course->course_name ?? '-' }}</strong>
                </div>
                <div class="col-md-3 col-sm-12">
                    <span class="text-muted small d-block">Average Rating:</span>
                    <strong class="text-warning">
                        <i class="fa-solid fa-star"></i> {{ $avgRating }} / 5.0
                    </strong>
                </div>
            @else
                <div class="col-md-8 col-sm-6">
                    <span class="text-muted small d-block">Setting Type:</span>
                    <strong class="text-dark">Overall LMS Feedback</strong>
                </div>
                <div class="col-md-4 col-sm-6">
                    <span class="text-muted small d-block">Average Rating:</span>
                    <strong class="text-warning">
                        <i class="fa-solid fa-star"></i> {{ $avgRating }} / 5.0
                    </strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-responsive w-100">
        <table class="table table-bordered table-striped table-hover align-middle mb-0 font-smallsize DataTablee" id="feedbackOverviewTable">
            <thead class="table-light">
                <tr>
                    <th width="50" class="text-center">#</th>
                    <th>Learner Name</th>
                    <th>Email / Employee ID</th>
                    <th width="130" class="text-center">Rating</th>
                    <th>Comments</th>
                    <th>Suggestions</th>
                    <th width="150">Submitted Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbackOverview->employeeRatings as $index => $employeeRating)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td>
                            @if($employeeRating->user)
                                <div class="fw-bold text-dark">
                                    {{ trim(($employeeRating->user->first_name ?? '') . ' ' . ($employeeRating->user->last_name ?? '')) }}
                                </div>
                            @else
                                <span class="text-muted fst-italic">User not found</span>
                            @endif
                        </td>
                        <td>
                            @if($employeeRating->user)
                                <div><i class="fa-regular fa-envelope me-1 text-muted"></i>{{ $employeeRating->user->email ?? '-' }}</div>
                                @if(!empty($employeeRating->user->emp_id))
                                    <small class="text-muted">ID: {{ $employeeRating->user->emp_id }}</small>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!empty($employeeRating->rating))
                                <div class="text-warning mb-1">
                                    @for($s = 1; $s <= 5; $s++)
                                        @if($s <= $employeeRating->rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="badge bg-light text-dark border">{{ $employeeRating->rating }} / 5</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if(!empty($employeeRating->feedback))
                                <div class="p-2 rounded bg-light border text-dark">
                                    {{ $employeeRating->feedback }}
                                </div>
                            @else
                                <span class="text-muted fst-italic">-</span>
                            @endif
                        </td>
                        <td>
                            @if(!empty($employeeRating->suggestions))
                                <div class="p-2 rounded bg-light border text-dark">
                                    {{ $employeeRating->suggestions }}
                                </div>
                            @else
                                <span class="text-muted fst-italic">-</span>
                            @endif
                        </td>
                        <td>
                            @if(!empty($employeeRating->created_at))
                                <div><i class="fa-regular fa-clock me-1 text-muted"></i>{{ date('d M, Y', strtotime($employeeRating->created_at)) }}</div>
                                <small class="text-muted">{{ date('h:i A', strtotime($employeeRating->created_at)) }}</small>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layouts.admin.footer')