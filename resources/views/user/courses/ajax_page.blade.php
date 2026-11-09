<style type="text/css">
    .modal-backdrop{
        z-index: 0;
    }
    .modal-sd{
        z-index: 9999;
        background: rgb(0 0 0 / 40%);
    }
    .course-feedback-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .course-feedback-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1 !important;
    }
    .course-feedback-header {
        background: #f8fafc;
        padding: 18px 24px;
        border-bottom: 1px solid #e2e8f0;
    }
    .course-feedback-title {
        color: #1e293b;
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: -0.01em;
    }
    .course-star-rating {
        display: inline-flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        align-items: center;
        gap: 6px;
        padding: 4px 0;
    }
    .course-star-rating input {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
        pointer-events: none;
    }
    .course-star-rating label {
        color: #e2e8f0;
        cursor: pointer;
        font-size: 34px;
        line-height: 1;
        margin: 0;
        transition: color .2s ease, transform .15s ease;
    }
    .course-star-rating label:hover,
    .course-star-rating label:hover ~ label,
    .course-star-rating input:checked ~ label {
        color: #f59e0b;
    }
    .course-star-rating label:active {
        transform: scale(0.9);
    }
    .course-star-rating input:disabled ~ label {
        cursor: not-allowed;
        opacity: 0.55;
    }
    .course-feedback-label {
        font-size: 0.92rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }
    .course-feedback-textarea {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.95rem;
        color: #1e293b;
        resize: vertical;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .course-feedback-textarea:focus {
        background: #ffffff;
        border-color: #008080;
        box-shadow: 0 0 0 3.5px rgba(0, 128, 128, 0.15);
        outline: none;
    }
    .course-feedback-textarea:disabled {
        background: #f1f5f9;
        cursor: not-allowed;
        opacity: 0.7;
    }
    .course-feedback-submit {
        background: linear-gradient(135deg, #008080 0%, #006666 100%);
        border: none;
        color: #ffffff;
        min-width: 190px;
        padding: 10px 26px;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 50px;
        box-shadow: 0 4px 14px rgba(0, 128, 128, 0.25);
        transition: all 0.25s ease;
    }
    .course-feedback-submit:hover:not(:disabled) {
        background: linear-gradient(135deg, #006666 0%, #004d4d 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 128, 128, 0.35);
    }
    .course-feedback-submit:disabled {
        background: #cbd5e1;
        color: #64748b;
        border-color: #cbd5e1;
        box-shadow: none;
        cursor: not-allowed;
        opacity: 0.8;
    }
    .report-stat-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        padding: 20px;
        height: 100%;
        transition: all 0.2s ease;
    }
    .report-stat-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }
    .report-card-heading {
        color: #005452;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0;
    }
    .report-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .report-value-big {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
    }
    .report-value-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
    }
    .report-badge-pass {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.82rem;
        display: inline-block;
    }
    .report-badge-fail {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.82rem;
        display: inline-block;
    }
    .report-badge-neutral {
        background-color: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.82rem;
        display: inline-block;
    }
</style>
    <!-- <div>
        <h4 class="mb-1 course-name font-weight-bold">{{$courses_data->course_details->course_name??''}}</h4>
    </div> -->
    <div class="col-11 px-0">
        <div class="d-flex align-items-center">
            <div class="courses-image-div">
                @if(isset($courses_data->course_details->course_image))
                <img src="{{ url('storage/app/public/'.$courses_data->course_details->course_image) }}" class="img-fluid user-courses-listing-view-image" alt="">
                @else
                <img src="{{ url('public/images/course.jpg') }}" class="img-fluid user-courses-listing-view-image" alt="">
                @endif
            </div>
            <div class="ms-2 ms-lg-3">
                <div class="mb-1 course-name font-weight-bold">{{$courses_data->course_details->course_name??''}}</div>
                <div class="fs-7 my-course-categori-name py-1">
                    <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                    <span class="ps-1">{{$courses_data->course_details->category_details->category_name??''}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <nav class="horizontal-tabs-div">
            <div class="nav nav-tabs font-smallsize border-bottom-0 horizontal-tabs" id="nav-tab" role="tablist">
                <button class="nav-link nav-linkk active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                    About the Course
                </button>
                <button class="nav-link nav-linkk" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment" type="button" role="tab" aria-controls="assessment" aria-selected="true">
                    Assessments & Assignments
                </button>
                 @if($courses_data->course_details->course_type==1)
                <button class="nav-link nav-linkk" id="online-reports-tab" data-bs-toggle="tab" data-bs-target="#online-reports" type="button" role="tab" aria-controls="online-reports" aria-selected="true">
                   Reports
                </button>
                @endif
                  @if($courses_data->course_details->course_type==2)
                <button class="nav-link nav-linkk" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-controls="reports" aria-selected="true">
                    Reports
                </button>
                @endif

                <button class="nav-link nav-linkk" id="feedback-ratings-tab" data-bs-toggle="tab" data-bs-target="#feedback-ratings" type="button" role="tab" aria-controls="feedback-ratings" aria-selected="false">
                   Feedback & Ratings
                </button>
            </div>
        </nav>
        <div class="tab-content border-0 mt-0 p-0 pr-md-2" id="myTabContent">
            <div class="tab-pane fade show active mb-2 card-border" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-9 my-auto">
                        <div class="d-block d-md-flex align-items-center">

                            <div class="my-2 pl-2 pr-2 pr-lg-3 pb-1">
                                <label class="course-details-inline-label">Course code</label>
                                <div class="course-details-inline border-left-3p-b1 course-code_in_courses">
                                    <span>{{$courses_data->course_details->course_code??''}}</span>
                                </div>
                            </div>
                            <!-- <div class="col-6 col-lg-8 my-auto">
                                <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                <span class="ps-1">

                                    @php
                                        use Carbon\Carbon;
                                        $lastLogin = isset($courses_data->created_at) 
                                            ? Carbon::parse($courses_data->created_at)->setTimezone('Asia/Kolkata') 
                                            : null;
                                    @endphp

                                    @if($lastLogin)
                                        {{ $lastLogin->format('F j, Y g:i a \I\S\T') }}
                                    @else
                                    @endif


                                 </span>
                            </div> -->

                            <div class="my-2 px-2 px-lg-3 pb-1">
                                <label class="course-details-inline-label">Assigned date</label>
                                <div class="course-details-inline border-left-3p-b2">
                                    <span>{{date('d-m-Y',strtotime($courses_data->created_at))}}</span>
                                </div>
                            </div>

                            <div class="my-2 px-2 px-lg-3 pb-1">
                                <label class="course-details-inline-label">Due date</label>
                                <div class="course-details-inline border-left-3p-b3">
                                    <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->course_details->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->course_details->expiration_date))->diffForHumans() ?></span>
                                </div>
                            </div>

                            <div class="my-2 px-2 px-lg-3 pb-1">
                                <label class="course-details-inline-label">Course Level</label>
                                <div class="course-details-inline border-left-3p-b4 text-uppercase">
                                    <span>{{$courses_data->course_details->level??'0'}}</span>
                                </div>
                            </div>

                            <div class="my-2 px-2 px-lg-3 pb-1">
                                <label class="course-details-inline-label">Points</label>
                                <div class="course-details-inline border-left-3p-b5">
                                    <span>{{$courses_data->course_details->points??'0'}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-3">
                        <div class="my-2 px-2 px-lg-3 pb-1">
                            <label class="course-details-inline-label">Goal</label>
                            <div class="course-details-inline border-0 d-inline-block border-left-3p-b6 py-0 mt-1 rounded-0 ps-2">
                                <span>{{$courses_data->course_details->goal_details->name??''}}</span>
                            </div>
                        </div>

                        <div class="my-2 px-2 px-lg-3 pb-1">
                            <label class="course-details-inline-label">Course status</label>
                            <div class="course-details-inline border-0 d-inline-block border-left-3p-b7 py-0 mt-1 rounded-0 ps-2">
                                <span>@if($courses_data->status==1)
                                    In-Progress
                                    @elseif($courses_data->status==3)
                                    Completed
                                    @else
                                    Not Yet Started
                                @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row px-2">
                    <div class="col-12">
                        @if($courses_data->course_details->course_type==2)
                        <div class="my-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Trainer Name</td>
                                            <td>Training Date</td>
                                            <td>Timing - From</td>
                                            <td>Timing - To</td>
                                            <td>Duration</td>
                                            <td>Location</td>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="trainer_details_list">
                                        @foreach($courses_data->course_details->training_details as $train)
                                        <tr>
                                            <td>{{$train->userdetails->first_name??''}}</td>
                                            <td>{{$train->training_date}}</td>
                                            <td>{{$train->training_time_from}}</td>
                                            <td>{{$train->training_time_to}}</td>
                                            <td>{{$train->training_duration}}</td>
                                            <td>{{$train->training_location}}</td>
                                           
                                            
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row my-3">
                            <div class="col-12">
                                 <label class="mb-2 font-weight-bold d-flex align-items-center"><i class="fa-regular fa-clipboard headings-icon fs-6"></i>Description</label>
                            </div>
                            <div class="col-12 px-2">
                                <div class="descrip-border px-1">
                                    @if(isset($courses_data->course_details->description))
                                    <div class="dark-teme-para">
                                        <?php echo $courses_data->course_details->description??''; ?>
                                    </div>
                                    @else
                                    <div>
                                        <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" width="25%" alt="">
                                        <div class="no-data-found-text darkk-theme pt-2">No data found</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
            
                        @foreach($courses_data->course_details->only_attachments as $attachment)
                        <div class="form-group row my-3">
                            <div class="col-12">
                                <label class="mb-2 font-weight-bold d-flex align-items-center"><i class="fa-solid fa-paperclip headings-icon fs-6"></i>Attachments</label>
                                <div class="p-3 border d-flex align-items-center justify-content-between">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div>
                                            <img src="{{asset('public/images/attached-file.png')}}" style="width:40px;height: 40px;" alt="powerpoint-icon" />
                                        </div>
                                        <div class="pl-3">
                                           
                                            <div><a href="{{url('start_course')}}?id={{$courses_data->id}}"><h6 class="mb-0 darkk-theme-text">{{$attachment->file_name??''}}</h6></a></div>
                                            
                                        </div>
                                    </div>
                                     </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
 



                                    <div class="tab-pane fade card-border border-top-lg-0" id="assessment" role="tabpanel" aria-labelledby="assessment-tab">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
                                              
                                                <div class="my-2">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Assessment Name</th>
                                                                    <th>Status of Assessment</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="trainer_details_list">
                                                            @if(empty($courses_data->course_details->assessments->toArray()))
                                                                    <tr>
                                                                        <td colspan="3" class="text-center">No data available.</td>
                                                                    </tr>
                                                            @else  

                                                               @foreach ($courses_data->course_details->assessments->where('is_active', 1) as $assessment)
                                                                    @php
                                                                        // Fetch all assessment results for the current assessment and user
                                                                        $results = $assessment->assessment_all_results
                                                                            ->where('assign_id', $courses_data->id);
                                                                        $attemptsCount = min(3, $results->count());
                                                                        $passedAttempt = $results->sortBy('id')->values()->first(fn ($attempt) => $attempt->hasPassed());
                                                                        
                                                                        // Assuming you want the most recent result for display
                                                                        $latestResult = $results->sortByDesc('id')->first();
                                                                        $resultData = $latestResult ? (json_decode($latestResult->result_data, true) ?: ['results' => json_decode($latestResult->results, true)]) : null;
                                                                        $passOrFail = $passedAttempt ? 'Passed' : ($resultData['results']['pass_or_fail'] ?? 'Not Attempted');
                                                                        
                                                                        $ordinal = [1 => '1st', 2 => '2nd', 3 => '3rd'];
                                                                        if ($passOrFail === 'Passed' && $passedAttempt) {
                                                                            $passedIndex = $results->sortBy('id')->values()->search(fn ($att) => $att->id === $passedAttempt->id);
                                                                            $attemptNum = min(3, ($passedIndex !== false ? $passedIndex + 1 : 1));
                                                                        } else {
                                                                            $attemptNum = min(3, max(1, $attemptsCount));
                                                                        }
                                                                        $attemptSuffix = $ordinal[$attemptNum] ?? ($attemptNum . 'th');
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $assessment->file_name ?? '' }}</td>
                                                                        <td>
                                                                            @if ($resultData)
                                                                                {{ $passOrFail }} (on {{ $attemptSuffix }} Attempt)
                                                                            @else
                                                                                Not Attempted
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @include('user.courses.assessment_action', [
    'actionClass' => 'btn btn-primary text-nowrap',
    'reportLabel' => 'View Exam Result',
])
</td>
                                                                    </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="mb-2 mt-3">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Assignment Exam Name</th>
                                                                    <th>Status of Assignment</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              
                                                        @if(empty($courses_data->course_details->assignment_exam->toArray()))
                                                                    <tr>
                                                                        <td colspan="3" class="text-center">No data available.</td>
                                                                    </tr>
                                                        @else
                                                           @foreach($courses_data->course_details->assignment_exam->unique(function ($assignment_exam) {
                                                                return optional($assignment_exam->assignment_exam_name)->id;
                                                            }) as $assignment_exam)
                                                                    @php
                                                                       $examId = $assignment_exam->assignment_exam_name->id ?? null; 
                                                                        $attempted = $courses_data->assigned_exam_datas->where('exam_id', $examId)->first();
                                                                    @endphp
                                                                        <tr>
                                                                            <td>{{ optional($assignment_exam->assignment_exam_name)->name ?? 'N/A' }}</td>


                                                                            <td>{{ $attempted->exam_result ?? 'Not Attempted' }}</td>

                                                                            <td>
                                                                                @if($attempted && $attempted->exam_result == 'Pending')
                                                                                <p>waiting for evaluation</p>

                                                                                @elseif($attempted && $attempted->exam_result != 'Pending')
                                                                                 <a href="{{ route('exams.Resultview') }}?course_id={{ $courses_data->course_id }}&exam_name={{ urlencode($assignment_exam->file_path) }}&ex_c={{ $assignment_exam->assignment_exam_name->id?? '' }}" class="btn btn-sm text-nowrap p-2 web-btn">View Result
                                                                                </a>
                                                                                @else
                                                                                <a href="{{ route('exams.take') }}?course_id={{ $courses_data->course_id }}&exam_name={{ urlencode($assignment_exam->file_path) }}" class="btn btn-sm text-nowrap p-2 web-btn">Take Exam
                                                                                </a>
                                                                                @endif


                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                           @endif
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="tab-pane fade card-border" id="online-reports" role="tabpanel" aria-labelledby="online-reports-tab">
                <div class="row g-3 my-2 px-2">
                    <!-- Heading 1: Total Learning Time -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                    <i class="fa-solid fa-clock fs-5" style="color: #005452;"></i>
                                </div>
                                <div>
                                    <h6 class="report-card-heading">Total Learning Time</h6>
                                    <small class="text-muted">Course duration and access records</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="report-label mb-1">Total time on course</div>
                                <div class="report-value-big" style="color: #005452;">{{ $reportData['total_time'] ?? '0 min' }}</div>
                            </div>

                            <div class="pt-3 border-top">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="report-label"><i class="fa-regular fa-calendar-check text-muted me-1"></i> First Accessed</div>
                                    <div class="report-value-text">{{ $reportData['first_accessed'] ?? 'Not Yet Accessed' }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="report-label"><i class="fa-regular fa-calendar-days text-muted me-1"></i> Last Accessed</div>
                                    <div class="report-value-text">{{ $reportData['last_accessed'] ?? 'Not Yet Accessed' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Heading 2: Assessments -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                    <i class="fa-solid fa-chart-line fs-5" style="color: #005452;"></i>
                                </div>
                                <div>
                                    <h6 class="report-card-heading">Assessments</h6>
                                    <small class="text-muted">Attempts and score summary</small>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">No. of Attempts</div>
                                        <div class="report-value-big text-dark">{{ $reportData['attempt_count'] ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">Passed In</div>
                                        <div class="mt-1">
                                            @if(($reportData['passed_in'] ?? '') === 'Passed' || (!empty($reportData['passed_in']) && str_contains(strtolower($reportData['passed_in']), 'attempt')))
                                                <span class="report-badge-pass"><i class="fa-solid fa-circle-check me-1"></i>Passed</span>
                                            @elseif(($reportData['passed_in'] ?? '') === 'Failed')
                                                <span class="report-badge-fail"><i class="fa-solid fa-circle-xmark me-1"></i>Failed</span>
                                            @else
                                                <span class="report-badge-neutral">{{ $reportData['passed_in'] ?? 'Not Attempted' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-up text-success me-1"></i> Highest Score</div>
                                    <div class="fs-5 fw-bold text-success">{{ $reportData['highest_score'] ?? '-' }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-down text-danger me-1"></i> Lowest Score</div>
                                    <div class="fs-5 fw-bold text-secondary">{{ $reportData['lowest_score'] ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade card-border" id="feedback-ratings" role="tabpanel" aria-labelledby="feedback-ratings-tab">
                <div class="row">
                    <div class="col-12 my-3 px-3">
                        @if(!$assessmentVideoAccessGranted)
                            <div class="alert alert-warning mb-4 shadow-sm border-0 d-flex align-items-center" style="border-radius: 12px;">
                                <i class="fa-solid fa-triangle-exclamation me-2 fs-5 text-warning"></i>
                                <div>Please complete course videos to submit new feedback and ratings.</div>
                            </div>
                        @endif

                        @forelse($feedbackRatings as $ratingItem)
                            @php
                                $existingRating = $employeeFeedbackRatings->get($ratingItem->id);
                                $canInteract = $assessmentVideoAccessGranted || !empty($existingRating);
                            @endphp
                            <div class="card course-feedback-card mb-4">
                                <div class="course-feedback-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-comments text-primary me-2 fs-5"></i>
                                        <h5 class="course-feedback-title mb-0">{{ $ratingItem->name }}</h5>
                                    </div>
                                    <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-semibold badge-submitted-status {{ $existingRating ? '' : 'd-none' }}">
                                        <i class="fa-solid fa-check-circle me-1"></i> Submitted
                                    </span>
                                </div>
                                <div class="card-body p-4 p-md-4">
                                    <form class="courseFeedbackRatingsForm" action="{{ route('submit.feedback') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="feedback_rating_setting_id" value="{{ $ratingItem->id }}">
                                        <input type="hidden" name="assign_id" value="{{ $courses_data->id }}">

                                        <div class="row gy-3">
                                            @if($ratingItem->rating_enabled)
                                                <div class="col-12 col-lg-4 mb-3">
                                                    <label class="course-feedback-label d-block">
                                                        Rate your experience <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="course-star-rating">
                                                        @for($star = 5; $star >= 1; $star--)
                                                            <input type="radio" 
                                                                   id="course_star_{{ $ratingItem->id }}_{{ $star }}" 
                                                                   name="rating" 
                                                                   value="{{ $star }}" 
                                                                   {{ ($existingRating && $existingRating->rating == $star) ? 'checked' : '' }}
                                                                   {{ !$canInteract ? 'disabled' : '' }} 
                                                                   required>
                                                            <label for="course_star_{{ $ratingItem->id }}_{{ $star }}" title="{{ $star }} star{{ $star > 1 ? 's' : '' }}">&#9733;</label>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endif

                                            @if($ratingItem->feedback_enabled)
                                                <div class="col-12 {{ $ratingItem->rating_enabled ? 'col-lg-4' : 'col-lg-6' }} mb-3">
                                                    <label for="course_feedback_{{ $ratingItem->id }}" class="course-feedback-label d-block">
                                                        <i class="fa-regular fa-comment-dots text-primary me-1"></i> Comments <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea id="course_feedback_{{ $ratingItem->id }}" 
                                                              name="feedback" 
                                                              class="form-control course-feedback-textarea w-100" 
                                                              rows="3" 
                                                              placeholder="Tell us more about your experience..." 
                                                              {{ !$canInteract ? 'disabled' : '' }} 
                                                              required>{{ old('feedback', $existingRating->feedback ?? '') }}</textarea>
                                                </div>

                                                <div class="col-12 {{ $ratingItem->rating_enabled ? 'col-lg-4' : 'col-lg-6' }} mb-3">
                                                    <label for="course_suggestions_{{ $ratingItem->id }}" class="course-feedback-label d-block">
                                                        <i class="fa-regular fa-lightbulb text-warning me-1"></i> Suggestions <span class="text-muted" style="font-size: 0.85em;">(Optional)</span>
                                                    </label>
                                                    <textarea id="course_suggestions_{{ $ratingItem->id }}" 
                                                              name="suggestions" 
                                                              class="form-control course-feedback-textarea w-100" 
                                                              rows="3" 
                                                              placeholder="Any suggestions for improvement?" 
                                                              {{ !$canInteract ? 'disabled' : '' }}>{{ old('suggestions', $existingRating->suggestions ?? '') }}</textarea>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-end border-top pt-3 mt-2">
                                            <button type="submit" class="btn course-feedback-submit" {{ !$canInteract ? 'disabled' : '' }}>
                                                <i class="fa-solid {{ $existingRating ? 'fa-arrows-rotate' : 'fa-paper-plane' }} me-1"></i>
                                                {{ $existingRating ? 'Update Feedback' : 'Submit Feedback' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 bg-white shadow-sm rounded-4">
                                <i class="fa-solid fa-folder-open text-muted fs-1 mb-3"></i>
                                <div class="no-data-found-text darkk-theme">No feedback or rating is configured for this course category.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="tab-pane fade card-border" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                <div class="row g-3 my-2 px-2">
                    <!-- Heading 1: Total Learning Time -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                    <i class="fa-solid fa-clock fs-5" style="color: #005452;"></i>
                                </div>
                                <div>
                                    <h6 class="report-card-heading">Total Learning Time</h6>
                                    <small class="text-muted">Course duration and access records</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="report-label mb-1">Total time on course</div>
                                <div class="report-value-big" style="color: #005452;">{{ $reportData['total_time'] ?? '0 min' }}</div>
                            </div>

                            <div class="pt-3 border-top">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="report-label"><i class="fa-regular fa-calendar-check text-muted me-1"></i> First Accessed</div>
                                    <div class="report-value-text">{{ $reportData['first_accessed'] ?? 'Not Yet Accessed' }}</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="report-label"><i class="fa-regular fa-calendar-days text-muted me-1"></i> Last Accessed</div>
                                    <div class="report-value-text">{{ $reportData['last_accessed'] ?? 'Not Yet Accessed' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Heading 2: Assessments -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                    <i class="fa-solid fa-chart-line fs-5" style="color: #005452;"></i>
                                </div>
                                <div>
                                    <h6 class="report-card-heading">Assessments</h6>
                                    <small class="text-muted">Attempts and score summary</small>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">No. of Attempts</div>
                                        <div class="report-value-big text-dark">{{ $reportData['attempt_count'] ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">Passed In</div>
                                        <div class="mt-1">
                                            @if(($reportData['passed_in'] ?? '') === 'Passed' || (!empty($reportData['passed_in']) && str_contains(strtolower($reportData['passed_in']), 'attempt')))
                                                <span class="report-badge-pass"><i class="fa-solid fa-circle-check me-1"></i>Passed</span>
                                            @elseif(($reportData['passed_in'] ?? '') === 'Failed')
                                                <span class="report-badge-fail"><i class="fa-solid fa-circle-xmark me-1"></i>Failed</span>
                                            @else
                                                <span class="report-badge-neutral">{{ $reportData['passed_in'] ?? 'Not Attempted' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-up text-success me-1"></i> Highest Score</div>
                                    <div class="fs-5 fw-bold text-success">{{ $reportData['highest_score'] ?? '-' }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-down text-danger me-1"></i> Lowest Score</div>
                                    <div class="fs-5 fw-bold text-secondary">{{ $reportData['lowest_score'] ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                        @if(!empty($courses_data->assessment_path))
                        @php
                            $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
                        @endphp
                        <span>Assessment : 
                        <a href="javascript:;" data-assign-id="{{$courses_data->id}}" data-link="{{ rtrim($assessmentBaseUrl, '/') }}/start_assessment?url={{$courses_data->assessment_path}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&course_id={{$courses_data->course_details->id}}&assign_id={{$courses_data->id}}&lms_url={{ urlencode(url('/')) }}&return_url={{ urlencode(url('user_courses?assign_id=' . $courses_data->id . '&open_tab=assessment')) }}" class="btn btn-sm btn-outline-primary text-nowrap take_exam {{ !$assessmentVideoAccessGranted ? 'assessment-locked opacity-50' : '' }}" aria-disabled="{{ !$assessmentVideoAccessGranted ? 'true' : 'false' }}">Take Exam</a></span>

                        @endif

                        @if($courses_data->course_details->course_type==2)

                        <h4 class="darkk-theme-text">Admin Uploaded Documents</h4>
                         @foreach($courses_data->admin_offline_documents as $doc)

                         <div class="form-group row my-3">
                            <div class="col-12">
                                <div class="p-3 border d-flex align-items-center justify-content-between">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div>
                                            <img src="{{asset('public/images/attached-file.png')}}" style="width:40px;height: 40px;" alt="powerpoint-icon" />
                                        </div>
                                        <div class="pl-3">
                                            <a href="{{url('storage/app/public/'.$doc->document_path)}}" download class="btn btn-sm btn-outline-primary text-nowrap font-weight-bold">{{$doc->document_name??''}}</a>
                                           
                                        </div>
                                    </div>
                                    
                                  
                                </div>
                            </div>
                        </div>
                          
                        @endforeach

                        <h4 class="darkk-theme-text">Your Uploaded Documents 
                            <a class="btn btn-primary ml-0 mt-2 mt-md-0 ml-md-4 excel_upload text-white add_work btn-sm text-white" data-bs-toggle="modal" data-bs-target="#excel_upload" data-id="{{$courses_data->id}}" data-course_id="{{$courses_data->course_id}}" > Upload&nbsp;Feedback</a>
                            <!-- <a class="btn btn-primary text-white excel_upload add_work btn-sm" data-toggle="modal" data-target="#excel_upload" data-id="{{$courses_data->id}}" data-course_id="{{$courses_data->course_id}}" data-dismiss="modal"> Upload Feedback</a> -->
                        </h4>

                         @foreach($courses_data->user_offline_documents as $doc)

                         <div class="form-group row my-3">
                            <div class="col-12">
                                <div class="p-3 border d-flex align-items-center justify-content-between">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div>
                                            <img src="{{asset('public/images/attached-file.png')}}" style="width:40px;height: 40px;" alt="powerpoint-icon" />
                                        </div>
                                        <div class="pl-3">
                                            <a href="{{url('storage/app/public/'.$doc->document_path)}}" download class="btn btn-sm btn-outline-primary text-nowrap font-weight-bold">{{$doc->org_file_name ??''}}</a>
                                           
                                        </div>
                                    </div>


			  
       
   

                                    </div>
                                    </div>
                                    </div>
                                        
                                    
                                                  
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>


                
                       


    <!-- <div class="modal fade" id="excel_upload" tabindex="-1">
        <div class="modal-dialog modal modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upload_feedback_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="assined_id" id="assined_id" >
                        <input type="hidden" name="course_id" id="course_id" >
                        <input type="file" name="document" accept=".pdf" required>
                        
                        
                    </form>
                </div>
       
    </div>
        </div>
    </div> -->

    <div class="modal fade modal-sd" id="excel_upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="excel--upload" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="excel--upload">Upload Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
                <!-- <form id="upload_feedback_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="assined_id" id="assined_id" style="height: 37px !important;">
                    <input type="hidden" class="form-control" name="course_id" id="course_id" style="height: 37px !important;">
                    <input type="file" class="form-control" name="document" accept=".pdf" required style="height: 37px !important;">
                </form> -->
                    <form id="upload_feedback_form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="form-control" name="assined_id" id="assined_id" style="height: 37px !important;">
                            <input type="hidden" class="form-control" name="course_id" id="course_id" style="height: 37px !important;">
                            <input type="file" class="form-control" name="document" accept=".pdf" required style="height: 37px !important;">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary upload_feedback_submit">Submit</button>
                          </div>
                    </form>
              
              
            </div>
          </div>
        </div>

<script>
    $(document).off('submit', '.courseFeedbackRatingsForm').on('submit', '.courseFeedbackRatingsForm', function(event) {
        event.preventDefault();
        const form = $(this);
        if (form.data('submitting')) {
            return false;
        }

        const submitButton = form.find('button[type="submit"]');
        const originalButtonHtml = submitButton.html();

        form.data('submitting', true);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                submitButton.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Saving...');
            },
            success: function(response) {
                submitButton.html('<i class="fa-solid fa-arrows-rotate me-1"></i> Update Feedback');
                const badge = form.closest('.course-feedback-card').find('.badge-submitted-status');
                badge.removeClass('d-none');
                // Ensure inputs remain interactive for further updates
                form.find('input, textarea, button').prop('disabled', false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                submitButton.html(originalButtonHtml);
                const errors = xhr.responseJSON && xhr.responseJSON.errors;
                const message = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : (errors ? Object.values(errors)[0][0] : 'Unable to save feedback and ratings.');
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Notice',
                        text: message
                    });
                } else {
                    alert(message);
                }
            },
            complete: function() {
                form.data('submitting', false);
                submitButton.prop('disabled', false);
            }
        });
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.take_exam').click(function(event){
        event.preventDefault();
        event.stopPropagation();
        if ($(this).hasClass('assessment-locked')) {
            Swal.fire('Assessment locked', 'Watch course video completely before taking an assessment.', 'warning');
            return;
        }
        var assessmentId = $(this).data('assessment-id');
        var assignId = $(this).data('assign-id');
        var attemptsCount = parseInt($(this).data('attempts-count')) || 0;
        var attemptsRemaining = parseInt($(this).data('attempts-remaining')) || 0;
        var existingDirectLink = $(this).data('link');

        var modalHtml = "";
        if (attemptsCount > 0) {
            modalHtml = '<div style="color: #dc3545; font-weight: 600; font-size: 15px; margin-top: 10px; text-align: center;">' +
                        '<i class="fa-solid fa-circle-exclamation" style="margin-right: 5px;"></i>' +
                        attemptsRemaining + (attemptsRemaining === 1 ? ' Attempt' : ' Attempts') + ' remaining.' +
                        '</div>';
        }

        Swal.fire({
              title: "Please click `Yes` if you are ready to take the exam, Otherwise click cancel?",
              html: modalHtml,
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                var returnUrlObj = new URL(window.location.origin + window.location.pathname);
                var currentParams = new URLSearchParams(window.location.search);
                if (assignId) {
                    currentParams.set('assign_id', assignId);
                }
                currentParams.set('open_tab', 'assessment');
                returnUrlObj.search = currentParams.toString();
                var returnUrl = returnUrlObj.toString();

                if (!assessmentId && existingDirectLink) {
                    try {
                        var directUrl = new URL(existingDirectLink, window.location.origin);
                        directUrl.searchParams.set('return_url', returnUrl);
                        window.location.href = directUrl.toString();
                    } catch (e) {
                        window.location.href = existingDirectLink;
                    }
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('launch_course_assessment') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        assessment_id: assessmentId,
                        assign_id: assignId,
                        return_url: returnUrl
                    },
                    success: function (response) {
                        try {
                            sessionStorage.setItem('assessment_unlocked_' + assignId, 'true');
                        } catch (e) {}
                        window.location.href = response.launch_url;
                    },
                    error: function (xhr) {
                        var message = xhr.responseJSON && (xhr.responseJSON.message || xhr.responseJSON.error)
                            ? (xhr.responseJSON.message || xhr.responseJSON.error)
                            : 'Unable to start the assessment.';
                        Swal.fire('Assessment locked', message, 'warning');
                    }
                });
              }
            });
        
    });

    $('.take_result').click(function(){
        var link = $(this).data('link');
        var assignId = $(this).data('assign-id');
        if (link) {
            try {
                var urlObj = new URL(link, window.location.origin);
                var returnUrlObj = new URL(window.location.origin + window.location.pathname);
                var currentParams = new URLSearchParams(window.location.search);
                if (assignId) {
                    currentParams.set('assign_id', assignId);
                }
                currentParams.set('open_tab', 'assessment');
                returnUrlObj.search = currentParams.toString();
                urlObj.searchParams.set('return_url', returnUrlObj.toString());
                window.location.href = urlObj.toString();
            } catch (e) {
                window.location.href = link;
            }
        }
    });

</script>
