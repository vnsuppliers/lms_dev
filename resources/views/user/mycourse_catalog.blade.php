@include('layouts.user.header')
<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="{{ asset('public/css/video_style.css')}}" />
<div class="tab-pane fade show" id="db" role="tabpanel" aria-labelledby="db-tab">
    <div class="row">
        <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
            <div>
                <div class="nav-link nav-s active border-0 p-0" id="v-pills-tab-ones" data-toggle="pill" href="#v-pills1111" role="tab" aria-controls="v-pills1111" aria-selected="true" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <div id="mySidenav" class="sidenav">
                        <?php $i=0;$j=0; ?>
                        @foreach($categories as $category)
                        
                        <div class="accordion" id="MainServicesAccordion{{$i}}">

                            <div class="card border-0">
                                <div class="parent-card-header" data-toggle="collapse" data-target="#collapseServices{{$i}}" aria-expanded="false" aria-controls="collapseServices">
                                    
                                    <span class="title nav-s active">{{ $category->category_name ?? '' }}</span>
                                    <span class="acc-icon"><i class="bi bi-plus-lg"></i></span>
                                </div>
                                <div id="collapseServices{{$i}}" class="collapse" data-parent="#MainServicesAccordion{{$i}}">
                                    <div class="card-bodyy p0">
                                        <div class="accordion child-accordian" id="servicesAccordion">
                                            <div class="card border-0">

                               <?php
                                    $sub_categories = App\models\Subcategory::with(['assignedCourses'=>function($q){
                                         $q->where('user_id', Auth::user()->id);
                                    }])->whereHas('assignedCourses', function ($query) {
                                        $query->where('user_id', Auth::user()->id);
                                    })->where('category_id', $category->id)->get();
                                   // dd($sub_categories);
                                    ?>                                          
                                                @foreach($sub_categories as $subcategory)
                                                <div class="card-headerr" data-toggle="collapse" data-target="#collapseOne{{$j}}" aria-expanded="false" aria-controls="collapseOne">
                                                    <span class="title nav-s active">{{ $subcategory->subcategory_name ?? '' }}</span>
                                                    <span class="acc-icon"><i class="bi bi-plus-lg"></i></span>
                                                </div>


                                                     
                                             
                                                <div id="collapseOne{{$j}}" class="collapse" data-parent="#servicesAccordion">
                                            @foreach($subcategory->assignedCourses as $assignedCourse)
                                                    <div class="card-bodyy p0">
                                                        <nav>
                                                            <div class="nav nav-tabs font-smallsize border-bottom-0 background-lyt inner-sub-sidemenu p4" id="nav-tab" role="tablist">
                                                @if ($assignedCourse && $assignedCourse->course_details)



                                                    @if($assignedCourse->course_details->content_type == 'Amazon_view_url')
                                                               <button onclick="loadVideo('{{ $assignedCourse->course_details->content_type_upload }}', '{{ $assignedCourse->course_details->intro_video_link }}', '{{ $assignedCourse->course_details->content_type_upload }}', '{{ $assignedCourse->course_details->id }}','{{ $assignedCourse->course_details->course_name }}','{{ $assignedCourse->course_details->category_details->category_name }}','{{ $assignedCourse->course_details->subcategory_details->subcategory_name }}','{{ $assignedCourse->course_details->created_at }}','{{ $assignedCourse->course_details->description }}','{{ $assignedCourse->course_details->course_code }}','{{ $assignedCourse->course_details->expiration_date }}','{{ $assignedCourse->course_details->start_date }}','{{ $assignedCourse->course_details->certificate }}','{{ $assignedCourse->course_details->level }}')" class="course_link nav-link button active border-0 mr-0 bg-transparent pl-4 ml-3" style="border-bottom: 0px !important;" data-bs-toggle="tab" data-bs-target="#d1" type="button" role="tab" aria-controls="d1" aria-selected="true">
                                                              

                                                    @elseif($assignedCourse->course_details->content_type == 'local_url')
                                                             <button onclick="loadVideo('{{ $assignedCourse->course_details->content_type }}', '{{ $assignedCourse->course_details->intro_video_link }}', '{{ url('storage/app/public/' . $assignedCourse->course_details->content_type_upload) }}', '{{ $assignedCourse->course_details->id }}','{{ $assignedCourse->course_details->course_name }}','{{ $assignedCourse->course_details->category_details->category_name }}','{{ $assignedCourse->course_details->subcategory_details->subcategory_name }}','{{ $assignedCourse->course_details->created_at }}','{{ $assignedCourse->course_details->description }}','{{ $assignedCourse->course_details->course_code }}','{{ $assignedCourse->course_details->start_date }}','{{ $assignedCourse->course_details->expiration_date }}','{{ $assignedCourse->course_details->certificate }}','{{ $assignedCourse->course_details->level }}')" class="course_link nav-link button active border-0 mr-0 bg-transparent pl-4 ml-3" style="border-bottom: 0px !important;" data-bs-toggle="tab" data-bs-target="#d1" type="button" role="tab" aria-controls="d1" aria-selected="true">

                                                    @endif  
                                                     {{ $assignedCourse->course_details->course_name ?? '' }}          

                                                @endif
                                                        </button>



                                                            </div>
                                                        </nav>
                                                    </div>
                                                    @endforeach
                                                     
                                                </div>
                                                <?php $j++; ?>
                                                 
                                              
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                  
                        </div>
                         <?php $i++; ?>
                         @endforeach
                 
             
                    </div>
                    <!-- <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                                            <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="d6.php" role="tab" aria-controls="d6" aria-selected="false">
                                                                                <img src="images/icons/add-courses.jpg" alt="">
                                                                                <span>Advanced English Learning-A</span>
                                                                            </a>
                                                                        </div> -->
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
            <div class="tab-content border-0 pt-1 pr-1 pb-1 px-0 py-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="d1" role="tabpanel" aria-labelledby="d1">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="border-bottom: 0px !important;" id="addc-tab" data-bs-toggle="tab" data-bs-target="#addc" type="button" role="tab" aria-controls="addc" aria-selected="true">Courses</button>
                            </div>
                        </nav>
                        <div class="tab-content mt-0 px-0 p-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="addc" role="tabpanel" aria-labelledby="addc-tab">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-7">
                                         <div class="card border-radius-none">
                                            <div class="row g-0">
                                                <div class="col-md-12">
                                                     <h5 class="card-title pt-2 intro_show" style="display:none;">Introduction Video :</h5>                                                 
                                                    <div class="Video_div m-3" id="Video_div">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-8">
                                                    <div class="card-body py-md-3 py-lg-4" style="display: none;">
                                                        <p>Ceco/Door Options</p>
                                                        <h5 class="card-title pt-2">Door Introduction-1</h5>
                                                        <p class="card-text pt-2">Description about the course</p>
                                                    </div>
                                                    <div class="d-flex justify-content-end p-3 py-md-3 p-lg-0 mt-lg-4">
                                                        <div>
                                                            <a href="#" class="btn btn-primary customized-btn-green shadow-none px-5 py-2 mx-2" style="display: none;">Resume</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{url('mycourse_videos')}}"  class="btn btn-primary customized-btn-blue shadow-none px-5 py-2 mx-2 start_from_beginning" style="display:none;">Start From Begining</a>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-5 border-left">
                                        <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                <div>
                                                    <div class="nav nav-tabs horizontal-scroll font-smallsize" id="nav-tab" role="tablist">
                                                        <button class="nav-link active" style="border-bottom: 0px !important;" id="t1-tab" data-bs-toggle="tab" data-bs-target="#t1" type="button" role="tab" aria-controls="t1" aria-selected="true">
                                                                        Info
                                                                                                    </button>
                                                <button class="nav-link" id="t2-tab" data-bs-toggle="tab" data-bs-target="#t2" type="button" role="tab" aria-controls="t2" aria-selected="false">
                                                                                                        Progress
                                                                                                    </button>
                                               <button class="nav-link" id="t3-tab" data-bs-toggle="tab" data-bs-target="#t3" type="button" role="tab" aria-controls="t3" aria-selected="false">
                                                                                                        Assessment Test
                                                                                                    </button>
                                                <button class="nav-link" id="t4-tab" data-bs-toggle="tab" data-bs-target="#t4" type="button" role="tab" aria-controls="t4" aria-selected="false">
                                                                                                        Learning Material
                                                                                                    </button>
                                                    </div>
                                                    <div class="tab-content mt-0" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="t1" role="tabpanel" aria-labelledby="t1-tab">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-3 p-0">
                                            <div>                                        <div class="col-md-8">
                                            <div class="card-body py-md-3 py-lg-4" >
                                                <!-- <p>Ceco/Door Options</p> -->
                                                <h5 class="card-title pt-2 course_details"></h5>
                                                 <p class="card-text pt-2 category_details"></p>
                                                 <p class="card-text pt-2 subcategory_details"></p> 
                                                 <p class="card-text pt-2 created_at"></p>
                                                 <p class="card-text pt-2 description"></p>
                                                 <p class="card-text pt-2 course_code"></p>
                                                 <p class="card-text pt-2 start_date"></p>
                                                 <p class="card-text pt-2 expiration_date"></p>
                                                 <p class="card-text pt-2 certificate"></p>
                                                 <p class="card-text pt-2 level"></p>
                                            </div>
                                            <div class="d-flex justify-content-end p-3 py-md-3 p-lg-0 mt-lg-4">
                                              </div>
                                        </div>
                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <div class="tab-pane fade" id="t2" role="tabpanel" aria-labelledby="t2-tab">
                                                            <div class="row mx-0">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-2">
                                                                    <div class="work-in-prog">Work In Progress</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="t3" role="tabpanel" aria-labelledby="t3-tab">
                                                            <div class="row mx-0">
                                                                <div class="ccol-12 col-sm-12 col-md-12 col-lg-12 p-2">
                                                                    <div>There is no better advertisement campaign that is low cost and also successful at the same timess.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="t4" role="tabpanel" aria-labelledby="t4-tab">
                                                            <div class="row mx-0">
                                                                <div class="ccol-12 col-sm-12 col-md-12 col-lg-12 p-2">
                                                                    <div>There is no better advertisement campaign that is low cost and also successful at the same timesss.</div>
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

                  
                        </div>
                    </div>
                </div>
       
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@include('layouts.user.footer')
<script>
      @if($assigned_latest_course && $assigned_latest_course->Assign_userdetails) 

       @if($assigned_latest_course->Assign_userdetails->content_type == 'Amazon_view_url')
        loadVideo('{{ $assigned_latest_course->Assign_userdetails->content_type }}', '{{ $assigned_latest_course->Assign_userdetails->intro_video_link }}', '{{ $assigned_latest_course->Assign_userdetails->content_type_upload }}', '{{ $assigned_latest_course->Assign_userdetails->id }}', '{{ $assigned_latest_course->Assign_userdetails->course_name }}','{{ $assigned_latest_course->Assign_userdetails->category_details->category_name??'' }}','{{ $assigned_latest_course->Assign_userdetails->subcategory_details->subcategory_name }}','{{ $assigned_latest_course->Assign_userdetails->created_at }}','{{ $assigned_latest_course->Assign_userdetails->description }}','{{ $assigned_latest_course->Assign_userdetails->course_code }}','{{ $assigned_latest_course->Assign_userdetails->start_date }}','{{ $assigned_latest_course->Assign_userdetails->expiration_date }}','{{ $assigned_latest_course->Assign_userdetails->certificate }}','{{ $assigned_latest_course->Assign_userdetails->level }}');
        @elseif($assigned_latest_course->Assign_userdetails->content_type == 'local_url')
          loadVideo('{{ $assigned_latest_course->Assign_userdetails->content_type }}', '{{ $assigned_latest_course->Assign_userdetails->intro_video_link }}', '{{url('storage/app/public/' .  $assigned_latest_course->Assign_userdetails->content_type_upload) }}', '{{ $assigned_latest_course->Assign_userdetails->id }}', '{{ $assigned_latest_course->Assign_userdetails->course_name }}','{{ $assigned_latest_course->Assign_userdetails->category_details->category_name??'' }}','{{ $assigned_latest_course->Assign_userdetails->subcategory_details->subcategory_name }}','{{ $assigned_latest_course->Assign_userdetails->created_at }}','{{ $assigned_latest_course->Assign_userdetails->description }}','{{ $assigned_latest_course->Assign_userdetails->course_code }}','{{ $assigned_latest_course->Assign_userdetails->start_date }}','{{ $assigned_latest_course->Assign_userdetails->expiration_date }}','{{ $assigned_latest_course->Assign_userdetails->certificate }}','{{ $assigned_latest_course->Assign_userdetails->level }}');
        @endif
    @endif
function loadVideo(contentType, introVideoLink, contentVideoLink, courseId, courseName,categoryName,subcategoryName,createdAt,description,course_code,start_date,expiration_date,certificate,level) {
    var playbackTime = localStorage.getItem('videoPlaybackTime');
    var videoElement;
    
    $.ajax({
        type: "GET",
        url: "{{ url('getVideoPlaybackTime') }}",
        data: {
            course_id: courseId
        },
        success: function(response) {
            var videoPlaybackTime = response.video_time_played;
            playbackTime = videoPlaybackTime ? parseFloat(videoPlaybackTime) : 0;
            createVideoElement(playbackTime);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching video playback time:", error);
            createVideoElement(playbackTime);
        }
    });

    function createVideoElement(playbackTime) {
        $('#Video_div').html('');
        videoElement = document.createElement('video');
        videoElement.preload = 'metadata';
        videoElement.className = 'main-video';
        videoElement.id = 'mainVideo';
        videoElement.controls = true;
        videoElement.style.cssText = 'width:100%;';
        videoElement.innerHTML = `
            <source src="${contentVideoLink}" size="480" type="video/mp4">
            <source src="${contentVideoLink}" size="720" type="video/mp4">
            <source src="${contentVideoLink}" size="1080" type="video/mp4">
            <track label="English" kind="subtitles" src="./How To Get Started With VSCode.vtt" srclang="en">
            <track label="Urdu" kind="subtitles" src="./test.vtt" srclang="en">`;

        if (playbackTime) {
            videoElement.currentTime = playbackTime;
        }


       //alert(description);
        document.getElementById('Video_div').appendChild(videoElement);
        document.querySelector('.course_details').textContent = 'Course : '+ courseName;
        document.querySelector('.category_details').innerHTML = '<strong>Category: </strong> ' + categoryName;
        document.querySelector('.subcategory_details').innerHTML = '<strong>Subcategory : '+ subcategoryName;
        document.querySelector('.created_at').innerHTML = '<strong>Created on : </strong>'+ createdAt;
        document.querySelector('.description').innerHTML = '<strong>Description : </strong>'+ description;
        document.querySelector('.course_code').innerHTML = '<strong>course code : </strong>'+ course_code;
        document.querySelector('.start_date').innerHTML = '<strong>start date : </strong>'+ start_date;
        document.querySelector('.expiration_date').innerHTML = '<strong>expiration date : </strong>'+ expiration_date;
        document.querySelector('.certificate').innerHTML = '<strong>certificate : </strong>'+ certificate;
        document.querySelector('.level').innerHTML = '<strong>level : </strong>'+ level;

        videoElement.addEventListener('pause', function() {
            localStorage.setItem('videoPlaybackTime', videoElement.currentTime);
            saveVideoTime(courseId, videoElement.currentTime);
        });
    }

    function saveVideoTime(courseId, currentTime) {
        $.ajax({
            type: "GET",
            url: "{{ url('saveVideoTime') }}",
            data: {
                course_id: courseId,
                video_time_played: currentTime
            },
            success: function(response) {
                console.log("Video time saved successfully.");
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    }
}
</script>







