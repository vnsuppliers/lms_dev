<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ATS - LMS</title>
    <!-- plugins:css -->
   
    <link rel="stylesheet" href="{{asset('public/vendors/css/bootstrap.min.css')}}">
    <link href="{{asset('public/vendors/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/css/horizontal-layout/style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/css/horizontal-layout/lms.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="" />
    <style>
    	.course-name, .exam-name{
    		font-weight: normal;
    	}
    	.bg-green {
		    background: #007774 !important;
		}
    	label {
		    font-size: 16px;
		}
		.text-violet{
		    color: #4859cc;
		}
		.text-orange{
		    color: #eb7664;
		}
		.text-skyblue {
		    color: #15d5f9;
		}
		.text-pink{
		    color: #ff60a6 !important;
		}
		.text-orange:hover{
		    color: #eb7664 !important;
		}
	    iframe {
		    width: 100%;
		    height: 88.5vh;
		    overflow-y: auto;
		}
	    .showcase img {
		  width: 100%;
		  height: 175px;
		  position: absolute;
		  top: 0;
		  left: 0;
		  z-index:99
		}
		.showcase .overlay {
		  width: 100%;
		  height: 175px;
		  background-color: rgba(0, 35, 82, 0.7);
		  position: relative;
		  top: 0;
		  left: 0;
		  z-index:999;
		  display: flex;
		}
		.feedbck-date-n-time{
			display: flex;
		    text-align: center;
		    justify-content: center;
		    position: relative;
		}
		.feedbck-date-n-time small{
			background: #fff;
		    border: 1px solid #f3f3f3;
		    padding: 4px 8px;
		    border-radius: 4px;
		    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
		    position: relative;
		    top: 13px;
		}
		#feedback-div{
			height: 65vh;
    		overflow-y: auto;
		}
		iframe{
			width: 100%;
		}
		.bg-navyblue{
			    background-color: #1c273c !important;
			}
		.accordion-button::after {
		    background-image: url('public/images/arrow-down.svg') !important;
			transform: rotate(-180deg);
			background-size: 55%;
		    top: -4px;
		    position: relative;
		}
		.accordion-button:not(.collapsed)::after{
			background-image: url('public/images/arrow-up.svg') !important;
		    transform: rotate(-180deg);
		       background-size: 55%;
		    top: -4px;
		    position: relative;
		}
		.accordion-item:last-of-type .accordion-collapse{
			border-top: 4px solid #6cb5d7;
		}
		.accordion-button:not(.collapsed) {
    		color: #ffffff;
    		box-shadow: none;
    	}
    	.accordion-button:focus{
    		box-shadow: none;
    	}
    	.border-bottom-blue{
		    border-bottom: 1px solid #395b63 !important;
		}
		.videos_division {
		    overflow-x: hidden;
		}
		/*.headings-bg-gradient{
			background-image: linear-gradient(-45deg, #4b506e, #373C5A, #232846);
		    box-shadow: 3px 3px 17px rgba(0, 0, 0, 0.3), -3px -3px 17px rgba(255, 255, 255, 0.3);
		    border: 0px solid !important;
		    color: #fff;
		    border: 0px solid #105289 !important;
		    box-shadow: 3px 3px 17px rgb(86 81 72 / 22%), -1px -1px 0px rgb(179 103 116);
		    padding: 3px 5px;
		    border-radius: 5px;
		}
		.course-name, .exam-name {
		    color: #d8d8d8;
		}
		.web-btn{
			color: #cdcdcd;
		    background-color: #373c5a !important;
		    border-radius: .25rem !important;
		    padding: 9px 10px !important;
		    border-radius: 7px !important;
		    box-shadow: 12px 12px 16px 0 rgb(74 80 115) inset, -8px -8px 12px 0 rgb(15 15 15 / 25%) inset !important;
		    border: 0px solid;
		}
		.video-sidebar-sec {
		    background: #373c5a;
		}*/
		.no-video-message {
		    display: flex;
		    justify-content: center; 
		    align-items: center;     
		    height: 100vh;           
		    text-align: center;      
		}
	</style>

</head>

<body class="pt-0">
<!-- <div class=" ">
    <div class="d-flex align-items-center justify-content-center h-100vh px-4 text-center" style="flex-direction: column;height: 100vh;">"This application is not supported on mobile devices. Please use a computer or laptop."</div>
</div> -->
<div class="">
<div class="container-fluid">
	<div class="row">
		<div class="col-12 bg-green p-2 p-lg-3">
			<div class="row">
				<div class="col-12 col-md-2 col-lg-1 pb-2 pb-md-0 my-auto">
					<div>
						<img src="{{asset('public/images/ats-logo.png')}}" class="img-fluid img-fluid bg-white" alt="">
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-8">
					<h4 class="text-white my-auto" style="line-height: 24px;">
		    			<div class="text-white text-truncate pb-1">{{$courses_data->course_details->course_name}}
		    			</div>
		    		</h4>
		    		<div class="text-grey-lite"><i class="fa-solid fa-bullseye"></i> {{$courses_data->course_details->goal_details->name??''}}</div>
					<!-- <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
					  <ol class="breadcrumb border-0 mb-0 px-2">
					    <li class="breadcrumb-item"  style="line-height: 20px;"><a href="{{url('user_courses')}}" class="text-white">{{$courses_data->category_details->category_name}}</a></li>
					    <li class="breadcrumb-item breadcrumb-itemm active course-name ms-0 text-white" aria-current="page">{{$courses_data->course_details->course_name}}</li>
					  </ol>
					</nav> -->
				</div>
				<div class="col-12 col-md-5 col-lg-3 mt-3 my-md-auto">
					<div class="d-flex justify-content-end align-items-center">
						<!-- <a class="write-feedbck-txt mr-2 mr-md-3 mr-lg-5" data-bs-toggle="modal" href="#feedbackToggle" role="button">Write Feedback</a> -->  
						@if($courses_data->status ==3)
						<!-- <a href="{{url('mycompleted_courses')}}" onclick="return confirm('Are you sure?')" class="border-0 btn bg-white">Back to All Courses</a> -->
						<a href="{{url('user_courses')}}" onclick="return confirm('Are you sure?')" class="border-0 btn bg-white p-2 p-lg-3">Back to All Courses</a>
						@else
						<a href="{{url('user_courses')}}" onclick="return confirm('Are you sure?')" class="border-0 btn bg-white p-2 p-lg-3">Back to All Courses</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-8 col-lg-9 py-2">

			<div class="videos_division bg-white">
				

				@if(empty($courses_data->course_details->only_scorm->where('is_active',1)->toArray()) && 
    empty($courses_data->course_details->other_videos->where('is_active',1)->toArray()) && 
    !empty($courses_data->course_details->only_attachments->where('is_active',1)->toArray()))

				<iframe width="100%" height="600" src="{{url('storage/app/public/'.$courses_data->course_details->only_attachments[0]->file_path)}}" allowfullscreen></iframe>

			@endif

			@if(empty($courses_data->course_details->only_scorm->where('is_active',1)->toArray()) && 
    empty($courses_data->course_details->other_videos->where('is_active',1)->toArray()) && 
    empty($courses_data->course_details->only_attachments->where('is_active',1)->toArray()))
    <div class="no-video-message">
        <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
        <h3>Videos are not available for this course</h3>
    </div>
@endif

				@foreach ($courses_data->course_details->only_scorm as $key => $value) 

				<div class="Video_div mx-0" >

					 @php
				            $filePath = storage_path('app/public/scrom_videos/'.$value->id.'/index_lms.html');
				        @endphp

		        @if(file_exists($filePath))


					 <div id="loader_user_video" ><img src="{{ url('public/images/big_spinner.gif') }}" class="img-fluid mx-auto d-block opacity-50" alt=""></div>

					<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						<div class="readability"><center>
					<script>

tl_sco_data =$.parseJSON(<?php echo json_encode(json_encode($scorm_data)); ?>);
</script>
 <script src="{{asset('public/js/scorm.js')}}"></script>
<center>
	<iframe id='scorm-frame' class='tl-scorm-frame' name='scorm-frame' width='980' height='600' data-launch-point="{{url('storage/app/public/scrom_videos/'.$value->id.'/index_lms.html')}}" src="{{url('talentscorm.html')}}" allowfullscreen=
'allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen=
'webkitallowfullscreen' onload="hideLoader()"></iframe>
</center>

<script>
window.onload = function () {
	tl_sco_data.scorm = {
		'frame_border': false,
		'height': 600,
		'src': $('#scorm-frame').data('launch-point'),
		'width': '100%',
		'launch_url': window.location.href
	};

    $('#scorm-frame').ready(function () { 
        document.getElementById('scorm-frame').contentWindow.postMessage(tl_sco_data, '*');
    });
	function receiveMessage(e) {
			
		if('fetch' in window){ 
			var opts = {
				keepalive: true,
				method: "POST",
				body: $.param(e.data.sendValues),
				headers: {
					
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				}
			};

			fetch(tl_sco_data.commit_url, opts)
				.then(function(response) {
					return response.text();
				})
				 .then(function(json){
					updateProgress(json);
					updateSCORMProgress(json);
				})
				 .catch(function(err){
					console.log('Commit-Fetch error', err);
				});
		}
		else{ 
			$.ajax(
				tl_sco_data.commit_url, {
					async: false,
					type: "post",
					headers: {
					 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				},
					data: $.param(e.data.sendValues),
					success: function(response){
						updateProgress(response);
						updateSCORMProgress(response);
					}
				});
		}
			}

	window.addEventListener('message', receiveMessage);
};



function updateSCORMProgress(response) {

	//console.log("madhu"+response);

}
function updateProgress(response) {
	//console.log("test"+response);
}
 function hideLoader() {
                                $('#loader_user_video').hide(); // Hide the loader
                            }
</script></center></div>
@else

            <div class="row">
                                                <div class="col-12">
                                                   
                                                    <div class="bg-white rounded-3">
                                                         <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                          <div class="no-data-found-text pb-5">Videos is not available for this courses</div>
                                                      </div>
                                                  </div>
                                              </div>
@endif
				</div>
				<?php break; ?>
				@endforeach





				@foreach ($courses_data->course_details->other_videos->where('is_active',1) as $key => $value)
    @php
        // Determine the video link based on type
        if ($value->type == 2) {
            $youtubeId = '';
            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/i', (string)$value->file_path, $matches)) {
                $youtubeId = $matches[1];
            }
            $link = $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}?enablejsapi=1" : $value->file_path;
        } else {
            // If it's a local video file, create the correct path
            $link = url('storage/app/public/' . $value->file_path);
            $filePath = storage_path('app/public/' . $value->file_path); // Absolute path to the file
        }
    @endphp

    @if($value->type == 2)
        {{-- For YouTube videos (type == 2), using embed URL --}}
        <div class="Video_div mx-0 my-3 mx-lg-2">
            <iframe width="100%" height="600" src="{{ $link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    @elseif(file_exists($filePath)) 
        {{-- For local video files (check if the file exists on the server) --}}
        <div class="Video_div mx-0 my-3 mx-lg-2">
            <video width="100%" height="600" controls>
                <source src="{{ asset('storage/app/public/' . $value->file_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @else
        {{-- If neither YouTube nor the local video exists, show a fallback message --}}
        <div class="row">
            <div class="col-12">
                <div class="bg-white rounded-3">
                    <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block" alt="">
                    <div class="no-data-found-text pb-5">Video is not available for this course</div>
                </div>
            </div>
        </div>
    @endif
@endforeach

			</div>
			<div class="pdf_division" style="display:none;">

				<div class="Video_div mx-0 my-3 mx-lg-2" >
					<iframe width="100%" height="600" src="" id="pdf_views" allowfullscreen></iframe>
				</div>
				
			</div>

			@if($courses_data->course_details->goal==2 && $courses_data->status !=3)
			<div class="text-center my-2">
			<a href="{{url('user_course_status_update')}}?assign_id={{$courses_data->id}}" class="btn btn-primary " onclick="return confirm('Are you sure complete the course?')">Complete the Course</a> </div>
			@endif
			

		</div>


		<div class="col-12 col-md-4 col-lg-3 mt-2 mb-3 mb-md-0 pb-2 pb-md-0 px-0">
			<div class="row mx-2 ml-lg-0 mr-lg-2">
				<!-- <div class="col-12 px-0">
					<div class="showcase">
					  	<img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
					  	<div class="overlay">
					    	<div class="d-flex align-items-center">
					    		<div class="px-3">
		                        </div>
					    	</div>

					  	</div>
					</div>
				</div> -->
				<div class="accordion video-sidebar-sec px-1 pb-2" id="accordionExams">
				    <div class="col-12 pt-2 px-1">
				        <div class="accordion-item">
				            <h2 class="accordion-header" id="headingOne">
				                <button class="accordion-button d-flex align-items-center headings-bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				                    <i class="fa-solid fa-user-gear headings-icon fs-6 border-0"></i>Assessment Exam
				                </button>
				            </h2>
				            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
				                <div class="accordion-body p-2">
				                    <div id="takeExam">
				                        <?php $i=1; $pass_count=0; ?>
				                        @if(empty($courses_data->course_details->assessments->toArray()))
				                        <div>
				                            <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block w-40" width="" alt="" />
				                            <div class="no-data-found-text my-2">No data found</div>
				                        </div>
				                        @endif 
				                        @foreach($courses_data->course_details->assessments->where('is_active',1) as $assessment)

				                        <?php //dd(count($assessment->assessment_all_results)); ?>

				                        <div class="panel-body mt-2">
				                            <div class="d-flex justify-content-between align-items-center my-1">
				                                <div class="course-name font-weight-normal mx-0">
				                                    <span>{{$i++}}. {{$assessment->file_name??''}} </span>
				                                </div>
				                            </div>
				                            <div class="d-flex align-items-center justify-content-between">
				                                <div class="my-2">
				                                    @if(count($assessment->assessment_all_results) > 0)
				                                    <a href="#" data-id="{{$assessment->id}}" data-assign_id="{{$courses_data->id}}" class="text-violet font-weight-bold" data-bs-toggle="modal" data-bs-target="#resultsView">View Score</a>
				                                    @endif
				                                </div>
				                                <div class="my-2">
				                                    @if(count($assessment->assessment_all_results) <= 2) @if(empty($assessment->assessment_result))
				                                    <!-- <a
				                                        href="javascript:;"
				                                        data-link="https://assessment.digicat.ai/start_assessment?url={{$assessment->file_path}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&first_name={{Auth::user()->first_name}}&last_name={{Auth::user()->emp_id}}&course_id={{$assessment->id}}&assign_id={{$courses_data->id}}"
				                                        class="btn web-btn btn-sm p-2 take_exam"
				                                    >
				                                        Take Exam
				                                    </a> -->
				                                    <a
				                                        href="javascript:;"
				                                        data-link="https://assessment.tasdesigntech.com/start_assessment?url={{$assessment->file_path}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&first_name={{Auth::user()->first_name}}&last_name={{Auth::user()->emp_id}}&course_id={{$assessment->id}}&assign_id={{$courses_data->id}}"
				                                        class="p-2 take_exam text-violet font-weight-bold"
				                                    >
				                                       <i class="fa-solid fa-clipboard-list me-1"></i>Take Exam
				                                    </a>

				                                    @else

				                                    <?php $result_data = json_decode($assessment->assessment_result->results); if($result_data->percentage >= $result_data->cutoff){ $link = explode('/', $assessment->file_path); $pass_count++; $result_link
				                                    =$link[0].'/'.$link[1].'/results/'.$assessment->assessment_result->code; ?>

				                                    <a
				                                        href="javascript:;"
				                                        data-link="https://assessment.tasdesigntech.com/start_assessment?url={{$result_link}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&first_name={{Auth::user()->first_name}}&last_name={{Auth::user()->emp_id}}&course_id={{$assessment->id}}&assign_id={{$courses_data->id}}"
				                                        class="text-violet text-nowrap take_result font-weight-bold"
				                                    >
				                                        View Completed Report
				                                    </a>
				                                    <?php }else{ ?>

				                                    <a
				                                        href="javascript:;"

				                                        data-link="https://assessment.tasdesigntech.com/start_assessment?url={{$assessment->file_path}}&email={{Auth::user()->email}}&username={{Auth::user()->username}}&first_name={{Auth::user()->first_name}}&last_name={{Auth::user()->emp_id}}&course_id={{$assessment->id}}&assign_id={{$courses_data->id}}"
				                                        class="text-decoration-underline text-primary text-nowrap take_exam"

				                                    >
				                                        Retry Exam
				                                    </a>

				                                    <?php } ?>

				                                    @endif
				                                    <!-- <?php if($pass_count==count($courses_data->course_details->assessments) && $courses_data->status !=3){

				            				   		\App\Models\Asigneduser::where('id',$courses_data->id)->update(['status'=>3,'completed_on'=>date('Y-m-d H:i:s')]);


				            			} ?> -->@else

				                                    <div>Maximum attempts reached</div>

				                                    @endif
				                                </div>
				                            </div>
				                            <?php 
													if ($pass_count == count($courses_data->course_details->assessments) && $courses_data->status != 3) {
													     \App\Models\Asigneduser::where('id',$courses_data->id)->update(['status'=>3,'completed_on'=>date('Y-m-d H:i:s')]);

													}

													    $couse_assigned_exam = \App\Models\Course_documents::where('course_id', $courses_data->course_details->id)
													        ->where('type', 7)
													        ->where('is_delete', 0)
													        ->get();
													    
													    if (!empty($couse_assigned_exam)) {
													        
													        $all_passed = true; 
													        
													        foreach ($couse_assigned_exam as $couse_assign_exam) {
													            
													        
													            $exam_details = \App\Models\Exam::where('exam_code', $couse_assign_exam->file_path)->first();
													            
													            if (!empty($exam_details)) {
													                
													                $exam_attempt = \App\Models\ExamAttempt::where('exam_id', $exam_details->id)
													                    ->where('user_id', Auth::user()->id)
													                    ->where('course_id', $courses_data->course_details->id)
													                    ->first();
													               
													                if (empty($exam_attempt) || $exam_attempt->exam_result != 'Passed') {
													                    $all_passed = false;
													                     \App\Models\Asigneduser::where('id',$courses_data->id)->update(['status'=>1,'completed_on'=>date('Y-m-d H:i:s')]);

													                    break; 
													                }
													            }
													        }
													        
													        if ($all_passed) {
													           \App\Models\Asigneduser::where('id',$courses_data->id)->update(['status'=>3,'completed_on'=>date('Y-m-d H:i:s')]);
													        }
													    }



											?>
				                        </div>
				                        @endforeach
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				    <hr class="my-2" />
				    <div class="col-12 px-1">
				        <div class="accordion-item">
				            <h2 class="accordion-header" id="headingTwo">
				                <button class="accordion-button collapsed d-flex align-items-center headings-bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				                    <i class="fa-solid fa-file-pen headings-icon fs-6 border-0"></i>Assignment Exam
				                </button>
				            </h2>
				            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
				                <div class="accordion-body p-0">
				                    <div id="downloads" class="">
				                        <div class="panel-body">
				                            <?php $i=1; ?>
				                            @if(empty($courses_data->course_details->assignment_exam->toArray()))
				                            <div>
				                                <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block w-40" width="" alt="" />
				                                <div class="no-data-found-text my-2">No data found</div>
				                            </div>
				                            @endif @foreach($courses_data->course_details->assignment_exam->where('is_active',1) as $assignment_exam)
				                            <div class="p-2 rounded-3">
				                                <div class="row">
				                                    <div class="col-12">
				                                        <div class="d-flex justify-content-start align-items-center mb-1">
				                                            <div>
				                                                <div class="exam-name ms-0 lh18">
				                                                    <a href="javascript:;" class="pdf_name font-weight-bold text-dark"> <span>{{$assignment_exam->assignment_exam_name->name??''}}</span></a>
				                                                </div>
				                                            </div>
				                                        </div>
				                                    </div>

				                                    @php $examId = $assignment_exam->assignment_exam_name->id ?? null; $attempted = $courses_data->assigned_exam_datas->where('exam_id', $examId)->first(); @endphp @if($attempted && $attempted->exam_result ==
				                                    'Pending')
				                                    <div class="col-12">
				                                        <div class="bg-warning p-2 rounded-3">Your assignment exam has been submitted successfully. Results will be announced soon after evaluation.</div>
				                                    </div>
				                                    @elseif($attempted && $attempted->exam_result != 'Pending')

				                                    <div class="my-1 text-end">
				                                        <a
				                                            href="{{ route('exams.Resultview') }}?course_id={{ $courses_data->course_id }}&exam_name={{ urlencode($assignment_exam->file_path) }}&ex_c={{ $assignment_exam->assignment_exam_name->id?? '' }}"
				                                            class="btn btn-sm text-nowrap p-2 web-btn"
				                                        >
				                                            View Result
				                                        </a>
				                                    </div>
				                                    @else
				                                    <div class="my-1 text-end">
				                                        <a href="{{ route('exams.take') }}?course_id={{ $courses_data->course_id }}&exam_name={{ urlencode($assignment_exam->file_path) }}" class="btn btn-sm text-nowrap p-2 web-btn">Take Exam </a>
				                                    </div>
				                                    <!-- {{$assignment_exam->assignment_exam_name->id??0}}  -->
				                                    @endif
				                                </div>
				                            </div>
				                            @endforeach
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				    <hr class="my-2" />

				    <div class="col-12 px-1">
				        <div class="accordion-item">
				            <h2 class="accordion-header" id="headingThree">
				                <button class="accordion-button collapsed d-flex align-items-center headings-bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				                    <i class="fa-solid fa-paperclip headings-icon fs-6 border-0"></i>Attachments
				                </button>
				            </h2>
				            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
				                <div class="accordion-body px-2 pt-2 pb-0">
				                    <div id="downloads" class="">
				                        <div class="panel-body">
				                            <?php $i=1; ?>
				                            @if(empty($courses_data->course_details->only_attachments->toArray()))
				                            <div>
				                                <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block w-40" width="" alt="" />
				                                <div class="no-data-found-text my-2">No data found</div>
				                            </div>
				                            @endif @foreach($courses_data->course_details->only_attachments->where('is_active',1) as $attachment)

				                            <div class="py-2 rounded-3 shadow-border mb-2 px-2">
				                                <div class="row">
				                                    <div class="col-12">
				                                        <div class="d-flex justify-content-start align-items-center">
				                                            <div>
				                                                <i class="fa-regular fa-file-lines fs-4 text-violet"></i>
				                                            </div>
				                                            <div class="ms-2 ps-1">
				                                                <div class="exam-name">
				                                                    <a href="javascript:;" class="pdf_name font-weight-bold text-dark" data-path="{{url('storage/app/public/'.$attachment->file_path)}}"> <span> {{$attachment->file_name??''}}</span></a>
				                                                </div>
				                                                <p class="mt-1 mb-0">{{$attachment->org_file_name??''}}</p>
				                                            </div>
				                                        </div>
				                                    </div>
				                                    <!-- <div class="col-2">
				                                        <div>
				                                            <a href="{{url('storage/app/public/'.$attachment->file_path)}}" download class="btn btn-sm btn-outline-primary text-muted text-nowrap"><i class="fa-solid fa-download"></i></a>
				                                        </div>
				                                    </div> -->
				                                </div>
				                            </div>
				                            @endforeach
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>

				    <hr class="my-2" />

				    <div class="col-12 px-1">
				        <div class="accordion-item">
				            <h2 class="accordion-header" id="headingFour">
				                <button class="accordion-button collapsed d-flex align-items-center headings-bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				                    <i class="fa-solid fa-laptop-file headings-icon fs-6 border-0"></i>Next Courses
				                </button>
				            </h2>
				            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
				                <div class="accordion-body p-1">
				                    @foreach($category_courses as $cat_course)
				                  <a href="{{url('start_course')}}?id={{$cat_course->id}}" class="courses-styles course_list">
				                    <!-- <div><i class="fa-regular fa-circle-play play-icon"></i></div> -->
				                    <div class="course-image-div-xs">
				                      <!-- <img src="public/images/course.jpg" alt="course-image"> -->
				                      @if(isset($cat_course->course_details->course_image))
				                                <img src="{{ url('storage/app/public/' . $cat_course->course_details->course_image) }}" alt="course-image">
				                                @else
				                                <img src="{{ url('asset/public/images/course.jpg') }}"  alt="course-image">
				                                @endif
				                    </div>
				                    <div class="ms-2 ps-1">
				                      <h6 class="font-weight-bold text-primary course-name" style="line-height:18px;">{{$cat_course->course_details->course_name??''}}</h6>
				                      <div class="descriptionn"><?php echo substr(strip_tags($cat_course->course_details->description),0,100); ?> </div>
				                    </div>
				                  </a>
				                @endforeach
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

			</div>
		</div>

	</div>
</div>
        
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="modal fade" id="feedbackToggle" aria-hidden="true" aria-labelledby="feedbackToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-lg my-3">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h5 class="modal-title" id="feedbackToggleLabel">Write Your Feedback</h5>
                            <div class="work-in-prog ml-5 pl-5 d-none d-lg-block">Work In Progress</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-2">
                           	<div class="col-12" id="feedback-div">
                       			<div>
                       				<div class="feedbck-date-n-time">
	                       				<small class="text-muted">Yesterday 07:00 PM</small>
	                       			</div>
	                           		<div class="shadow-sm border p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">James</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">Hai</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border bg-light p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face16.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">Charan</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">Hello</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">James</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">How r you..?</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border bg-light p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face16.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">Charan</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">I am Fine</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           				</div>
	                           			</div>
	                           		</div>
                       			</div>
                       			<div>
                       				<div class="feedbck-date-n-time">
	                       				<small class="text-muted">Today 04:00 PM</small>
	                       			</div>
	                           		<div class="shadow-sm border p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">James</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">Hai</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border bg-light p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face16.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">Charan</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">Hello</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" >
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">James</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">How are you..?</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           					
	                           				</div>
	                           			</div>
	                           		</div>

	                           		<div class="shadow-sm border bg-light p-3">
	                           			<div class="row">
	                           				<div class="col-12">
	                           					<div class="d-flex">
	                           						<div>
					                           			<img src="{{asset('public/images/face16.jpg')}}" alt="profile" class="rounded-circle" width="40" height="40" />
					                           		</div>
					                           		<div class="ml-3">
					                           			<div class="mb-1">
						                           			<span class="font-weight-bold">Charan</span> <span class="text-muted px-2">|</span> <span class="text-muted">10:50 AM</span> 
						                           		</div>
						                           		<small class="text-muted fs6">Student</small>
						                           		<div class="pt-2">I am Fine</div>
						                           		<!-- <div class="">Lorem Ipsum</div> -->
					                           		</div>
	                           					</div>
	                           				</div>
	                           			</div>
	                           		</div>
                       			</div>
                           	</div>

                           	<div class="col-12 mt-4">
                       			<!-- <div class="row">
                       				<div class="col-11 my-auto">
                       					<form>
                       						<div>
                       							<textarea class="form-control" placeholder="Type Message"></textarea>
                       						</div>
                       					</form>
                       				</div>
                       				<div class="col-1 my-auto">
                       					<div><i class="fa-solid fa-paper-plane"></i></div>
                       				</div>
                       			</div> -->
                       			<div class="d-flex justify-content-between align-items-center">
                       				<form style="width: 98%;">
                   						<div>
                   							<textarea class="form-control" placeholder="Type Message ..."></textarea>
                   						</div>
                   					</form>
                   					<div>
                   						<a href="#?" class="btn btn-transparent border-0"><i class="fa-solid fa-paper-plane"></i></a>
                   					</div>
                       			</div>
                       		</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resultsView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h5 class="modal-title" id="certificateViewLabel">Course completion certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      	<div class="table-responsive">
                      	<table class="table">

                      		
                      			<thead>
                      				<tr>
                      					<th>No</th>
                      					<th>Exam Written Date</th>
                      					<th>Exam Result (%)</th>

                      					<th>Status</th>
                      				</tr>
                      			</thead>
                      			<tbody class="certificate_html">
                      				
                      			</tbody>
                      		
                      	</table>

                      </div>

                            
                      </div>
                      
                    </div>
                  </div>
                </div>
            </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
  	$('.pdf_name').click(function(){
  		$('.videos_division').hide();
  		$('.pdf_division').show();

  		$('#pdf_views').attr('src',$(this).data('path'));

  	});
  	$('.take_exam').click(function(){
  		var link=$(this).data('link');
  		Swal.fire({
			  title: "Please click `Yes` if you are ready to take the exam, Otherwise click cancel?",
			  text: "",
			  icon: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#3085d6",
			  cancelButtonColor: "#d33",
			  confirmButtonText: "Yes"
			}).then((result) => {
			  if (result.isConfirmed) {
			  	window.location.href=link;
			  	//var popup = window.open(link,"popupWindow", "width=1200, height=800, scrollbars=yes");
			        var checkPopupURL = setInterval(function() {
			            if (!popup || popup.closed) {
			                clearInterval(checkPopupURL);
			                 location.reload();
			            } else {
			                try {
			                    
			                    
			                } catch (e) {
			                    console.log('Cannot access popup URL due to cross-origin restrictions.');
			                }
			            }
			        }, 1000); // Check every 1 second
			  }
			});
  		
  	});
  	$('.take_result').click(function(){
  		var link=$(this).data('link');
  		//window.location.href=link;
  		window.open(link,"popupWindow", "width=1200, height=800, scrollbars=yes");
  	});


  	$('body').on('click','.resultsView',function(){

  		 var  id = $(this).data('id');
  		 var  assign_id = $(this).data('assign_id');

         $.ajax({
            type: "GET",
            url: "{{ url('get_results') }}",
            data: {

                assign_id: assign_id,id:id

            },
            dataType:"html",
            success: function(response) {
               $('.certificate_html').html(response);
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }

        });
  	});
  </script>
  
</body>

</html>
