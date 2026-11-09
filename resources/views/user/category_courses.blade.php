<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Digicat-LMS</title>
    <!-- plugins:css -->
 
   
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
    

</head>

<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 bg-dark p-3 fixed-top">
			<div class="row">
				<div class="col-11">
					<!-- <div class="mb-0 text-white course-name"> Code Exercises for Business and Mercantile Occupancies </div> -->
					<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
					  <ol class="breadcrumb border-0 mb-0 ">
					    <li class="breadcrumb-item"  style="line-height: 20px;"><a href="{{ url('organization_dashboard') }}" class="text-white">Home</a></li>
					    <li class="breadcrumb-item breadcrumb-itemm active course-name ms-0 text-white" aria-current="page">{{$category_view->category_name??''}}</li>
					  </ol>
					</nav>
				</div>
				<div class="col-1 my-auto">
					<div class="text-end">
						<button onclick="window.history.back()" class="border-0 bg-transparent"><i class="fa-solid fa-xmark text-white"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="gradient-banner" style="margin-top: 72px;">
			<h2 class="text-white font-weight-normal mt-4">{{$category_view->category_name??''}}</h2>
			<div class="text-white"><span>{{count($category_view->category_assigned_cousers)}} Courses </span> </div>
		</div>
	</div>
</div>

<div class="container my-4">			
	<div class="col-12 col-lg-10">
		<h5 class="mt-4">Description</h5>
		<div>
			{{$category_view->description??''}}
		</div>

		

		<div class="d-flex justify-content-between align-items-end">
			<!-- <div>
				<h5 class="">Courses Learning Plan</h5>
				<div class="mt-2 fs-7">0 out of {{count($category_view->category_assigned_cousers)}} courses completed</div>
			</div> -->
			<ul class="nav nav-pills pb-0" id="pills-tab" role="tablist">
                <li class="nav-item mr-0">
                    <a class="nav-linkk nav-link active btn btn-sm web-transparent-btn mr-2" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                        <i class="fa-solid fa-list"></i>
                    </a>
                </li>
                <!--  <li class="nav-item mr-0">
                    <a class="nav-linkk nav-link btn btn-sm web-transparent-btn mr-2" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>  -->
            </ul>
		</div>
		
		<div class="tab-content border-0 mt-2 pr-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
            	<div class="col-12 px-0">
            		@foreach($category_view->category_assigned_cousers as $data)
					<div class="border border-grey p-2">
	                    <div class="row">
	                        <div class="col-lg-3 pe-0">
	                            <div class="courses-image-div">
	                               @if($data->course_details->course_image)
                                        <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid" alt="">
                                    @else
                                        <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                                    @endif
	                            </div>

	                           
	                        </div>
	                        <div class="col-lg-8">
	                            <h6 class="text-start course-name mb-0">
	                                {{$data->course_details->course_name??''}}
	                            </h6>
	                            <div class="mt-1 fs-7 pt-1">
	                                <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
	                                @if($data->course_details->course_type==1)
                                                                 <label class="ps-1">Due : </label>
                                                                   
                                                                    <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                    @else
                                                                    <label class="ps-1">Training Date : </label>
                                                                   
                                                                    <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                    @endif
	                            </div>
	                            <div class="mt-1 attended_div">
                                                                    <p class="attended_status">
                                                                        @if($data->course_details->course_type==2) @if($data->status==1) Attended @elseif($data->status==2) Not Attended @endif @endif</p>
                                                                    @if($data->course_details->course_type==1)
                                                                     <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-sm me-2"> Start from Beginning </a>
                                                                    @if(!empty($data->scorm_details))

                                                                   
                                                                    <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-sm me-2">Resume</a>

                                                                    @endif

                                                                    @else


                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a>

                                                                    @endif
                                                                    
                                                                    <!-- <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span> -->
                                                                </div>
	                        </div>
	                        <div class="col-lg-1">
	                            <div class="text-right">
	                                @if(!empty($data->bookmark_data))
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-solid fa-star"></i></a>
                                                                    @else
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-regular fa-star"></i></a>
                                                                    @endif
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            
	                @endforeach

	               </div> 
				</div>
           
            
            <div class="tab-pane fade" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">
                <div class="row px-1">
                	@foreach($category_view->category_assigned_cousers as $data)
				    <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
				        <div class="bg-light">
				            <div class="card-view-fav-icon">
				                <i class="fa-regular fa-star"></i>
				            </div>
				            <div class="courses-image-div">
				                 @if($data->course_details->course_image)
                                    <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid" alt="" style="height: 170px;">
                                @else
                                    <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt=""  style="height: 170px;">
                                @endif
				            </div>
				            <!-- <div class="progress progress list-view-p-bar">
				                <div class="progress-bar progress-bar-striped bg-pink text-white border-bottom-0" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
				            </div> -->
				            <div class="p-2">
				                <div class="course-name">{{$data->course_details->course_name??''}}</div>
				                <div class="exp-date">
				                    <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
				                     @if($data->course_details->course_type==1)
                                                                 <label class="ps-1">Due : </label>
                                                                   
                                                                    <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                    @else
                                                                    <label class="ps-1">Training Date : </label>
                                                                   
                                                                    <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                    @endif
				                </div>
				                <div class="mt-1 attended_div">
                                                                    <p class="attended_status">@if($data->status==1) Attended @elseif($data->status==2) Not Attended @endif</p>
                                                                    @if($data->course_details->course_type==1)
                                                                     <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-sm me-2"> Start from Beginning </a>
                                                                    @if(!empty($data->scorm_details))

                                                                   
                                                                    <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-sm me-2">Resume</a>

                                                                    @endif

                                                                    @else


                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a>

                                                                    @endif
                                                                    
                                                                    <!-- <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span> -->
                                                                </div>
				            </div>
				        </div>
				    </div>
				    @endforeach
				    
				</div>
            </div>
        </div>
	</div>
</div>

  <!-- container-scroller -->
  <!-- plugins:js -->

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 
<script type="text/javascript">
    $('.accept_course').click(function(){
        var  assign_id = $(this).data('id');
        var  status = $(this).data('status');
        var class_name = $(this);
        $.ajax({
            type: "GET",
            url: "{{ url('accept_course') }}",
            data: {
                assign_id: assign_id,status:status
            },
            dataType:"json",
            success: function(response) {
              

               if(response.status==1){
                class_name.parent('.attended_div').find('.attended_status').text('Attended');
                   $.toast({
                        heading: 'Success',
                        text: 'Attended Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
               }else{
                class_name.parent('.attended_div').find('.attended_status').text('Not Attended');
                $.toast({
                        heading: 'Success',
                        text: 'Not Attended Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
               }
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    });
    $('.bookmark_course').click(function(){
        var  assign_id = $(this).data('id');
        var class_name =$(this);
         $.ajax({
            type: "GET",
            url: "{{ url('add_remove_bookmark') }}",
            data: {
                assign_id: assign_id
            },
            dataType:"html",
            success: function(response) {
               class_name.html(response.html);
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    });
</script>
  <script>
    $(document).ready(function() {


    
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
});

$(document).ready(function () {
        $('#role-select').change(function () {
            var selectedOption = $(this).val();
            window.location.href = '/' + selectedOption; // Redirect to the selected route
        });
    });
  </script>
</body>
</html>