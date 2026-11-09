<style type="text/css">
    .modal-backdrop{
        z-index: 0;
    }
    .modal-sd{
        z-index: 9999;
        background: rgb(0 0 0 / 40%);
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
                                            Assessments
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
                                    </div>
                                </nav>
                                <div class="tab-content border-0 mt-0 p-0 pr-md-2" id="myTabContent">
                                    <div class="tab-pane fade show active mb-2 card-border" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-9 my-auto">
                                                <div class="d-block d-md-flex align-items-center">

                                                    <div class="my-2 pl-2 pr-2 pr-lg-3 pb-1">
                                                        <label class="course-details-inline-label">Course code</label>
                                                        <div class="course-details-inline border-left-3p-b1">
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
                                                                 @foreach ($courses_data->course_details->assessments as $assessment)
                                                                    @php
                                                                        // Fetch all assessment results for the current assessment and user
                                                                        $results = $assessment->assessment_all_results->where('assign_id', $courses_data->id);
                                                                        $attemptsCount = min(3, $results->count());
                                                                        $passedAttempt = $results->sortBy('id')->values()->first(fn ($attempt) => $attempt->hasPassed());
                                                                        
                                                                        // Assuming you want the most recent result for display
                                                                        $latestResult = $results->sortByDesc('id')->first();
                                                                        $resultData = $latestResult ? json_decode($latestResult->result_data, true) : null;
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
                                                                        <td>{{ $assessment->file_name ?? 'N/A' }}</td>
                                                                        <td>
                                                                            @if ($resultData)
                                                                                {{ $passOrFail }} (on {{ $attemptSuffix }} Attempt)
                                                                            @else
                                                                                Not Attempted
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($resultData)
                                                                                @if ($passOrFail === 'Failed')
                                                                                    @if($attemptsCount < 3)
                                                                                        <a href="javascript:;" 
                                                                                           data-assign-id="{{ $courses_data->id }}"
                                                                                           data-attempts-count="{{ $attemptsCount }}"
                                                                                           data-attempts-remaining="{{ max(0, 3 - $attemptsCount) }}"
                                                                                           data-link="https://assessment.digicat.ai/start_assessment?url={{ $assessment->file_path }}&email={{ Auth::user()->email }}&username={{ Auth::user()->username }}&first_name={{ Auth::user()->first_name }}&last_name={{ Auth::user()->emp_id }}&course_id={{ $assessment->id }}&assign_id={{ $courses_data->id }}" 
                                                                                           class="btn btn-primary text-nowrap take_exam">
                                                                                            Retake Exam
                                                                                        </a>
                                                                                    @else
                                                                                        Maximum attempts completed.
                                                                                    @endif
                                                                                @else
                                                                                    @php
                                                                                        // Check if the result meets the cutoff for viewing the result
                                                                                        $resultData = json_decode($latestResult->result_data, true);
                                                                                        $percentage = $resultData['results']['percentage'] ?? 0;
                                                                                        $cutoff = $resultData['results']['cutoff'] ?? 0;
                                                                                        $link = explode('/', $assessment->file_path);
                                                                                        $code = ($passedAttempt ? $passedAttempt->code : optional($assessment->assessment_result)->code ?? '');
                                                                                        $resultLink = $link[0] . '/' . $link[1] . '/results/' . $code;
                                                                                    @endphp
                                                                                    @if ($percentage >= $cutoff)
                                                                                        <a href="javascript:;" data-assign-id="{{ $courses_data->id }}" data-link="https://assessment.digicat.ai/start_assessment?url={{$resultLink}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&first_name={{Auth::user()->first_name}}&last_name={{Auth::user()->emp_id}}&course_id={{$assessment->id}}&assign_id={{$courses_data->id}}" class="btn btn-primary text-nowrap take_result">View Exam Result</a>
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                <a href="javascript:;" 
                                                                                   data-assign-id="{{ $courses_data->id }}"
                                                                                   data-attempts-count="0"
                                                                                   data-attempts-remaining="3"
                                                                                   data-link="https://assessment.digicat.ai/start_assessment?url={{ $assessment->file_path }}&email={{ Auth::user()->email }}&username={{ Auth::user()->username }}&first_name={{ Auth::user()->first_name }}&last_name={{ Auth::user()->emp_id }}&course_id={{ $assessment->id }}&assign_id={{ $courses_data->id }}" 
                                                                                   class="btn btn-primary text-nowrap take_exam">
                                                                                    Take Exam
                                                                                </a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="my-2">
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
                                                                @if ($courses_data->assigned_exam_datas->isEmpty())
                                                                    <tr>
                                                                        <td colspan="3">No assigned exams available.</td>
                                                                    </tr>
                                                                @else
                                                                    @foreach ($courses_data->assigned_exam_datas as $assignment)
                                                                        <tr>
                                                                            <td>{{ optional($assignment->exam_details)->name ?? 'N/A' }}</td>
                                                                            <td>{{ $assignment->exam_result ?? 'N/A' }}</td>

                                                                            <td>
                                                                                @if($assignment->exam_result != 'Pending')
                                                                                <a href="{{ route('exams.Resultview') }}?course_id={{ $courses_data->course_details->id }}&exam_name={{ urlencode(optional($assignment->exam_details)->exam_code ?? '') }}&ex_c={{ $assignment->exam_details->id ?? '' }}&attempt_id={{ $assignment->id }}" target="_blank" class="btn btn-primary">
                                                                                  View Result
                                                                                 </a>
                                                                                 @else
                                                                                 {{'WaitIng for evaluation'}}
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
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade card-border" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                @if(!empty($courses_data->assessment_path))
                                                @php
                                                    $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
                                                @endphp
                                                <span>Assessment : 
                                                <a href="javascript:;" data-link="{{ rtrim($assessmentBaseUrl, '/') }}/start_assessment?url={{$courses_data->assessment_path}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&course_id={{$courses_data->course_details->id}}&assign_id={{$courses_data->id}}&lms_url={{ urlencode(url('/')) }}" class="btn btn-sm btn-outline-primary text-nowrap take_exam">Take Exam</a></span>

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
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.take_exam').click(function(){
        var link = $(this).data('link');
        var assignId = $(this).data('assign-id');
        var attemptsCount = parseInt($(this).data('attempts-count')) || 0;
        var attemptsRemaining = parseInt($(this).data('attempts-remaining')) || 0;
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
                        link = urlObj.toString();
                    } catch (e) {}
                }
                window.location.replace(link);
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
                link = urlObj.toString();
            } catch (e) {}
        }
        window.location.replace(link);
    });

</script>
