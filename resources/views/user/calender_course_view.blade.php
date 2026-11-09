    @include('layouts.user.header')

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded-3 p-2 my-3">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="d-flex align-items-center">
                            <div class="courses-image-div">
                                @if(!empty($courses_data->course_details->course_image))
                                    <img src="{{ url('storage/app/public/' . $courses_data->course_details->course_image) }}" class="img-fluid user-courses-listing-view-image" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                @else
                                    <img src="{{ url('public/images/course.jpg') }}" class="img-fluid user-courses-listing-view-image" alt="">
                                @endif
                            </div>
                            <div class="ms-3 w-100">
                                <div class="mb-1 course-name font-weight-bold">{{$courses_data->course_details->course_name}}</div>
                                <div class="fs-7 my-course-categori-name">
                                    <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                    <span class="ps-1">{{$courses_data->course_details->category_details->category_name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-end">
                            <a href="{{url('organization_dashboard')}}" class="btn web-btn">Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 position-absolute">
                        <div class="text-end btns-in-course-view">
                            @if($courses_data->course_details->expiration_date >= date('Y-m-d'))
                                <div class="attended_div border-bottom">
                                    <p class="attended_status">
                                         @if($courses_data->course_details->course_type==2)
                                         @if($courses_data->status==1) Attended @elseif($courses_data->status==2) Not Attended @endif @endif</p>

                                    @if($courses_data->course_details->course_type==1)
                                     <a href="{{url('start_course')}}?id={{$courses_data->id}}" class="btn web-btn bottom-btn-in-course-view-cal border-radius-top ms-1"> Start from Beginning </a>
                                    @if(!empty($courses_data->scorm_details))

                                    <a href="{{url('start_course')}}?id={{$courses_data->id}}" class="btn web-btn bottom-btn-in-course-view-cal border-radius-top ms-1">Resume</a>
                                    @endif

                                    @else

                                    <a href="javascript:;" class="btn web-btn bottom-btn-in-course-view-cal border-radius-top ms-1 accept_course" data-id="{{$courses_data->id}}" data-status="1">Attended</a>

                                    <a href="javascript:;" class="btn web-btn bottom-btn-in-course-view-cal border-radius-top ms-1 accept_course" data-id="{{$courses_data->id}}" data-status="2">Not Attended</a>

                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-3">
                        <nav class="">
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link nav-linkk active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                    About the Course
                                </button>
                                  @if($courses_data->course_details->course_type==2)
                                <button class="nav-link nav-linkk" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-controls="reports" aria-selected="true">
                                    Reports
                                </button>
                                @endif
                            </div>
                        </nav>
                        <div class="tab-content border-0 mt-0 p-0 pr-2" id="myTabContent">
                            <div class="tab-pane fade show active mb-2 card-border" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="row">
                                    <div class="col-9 my-auto">
                                        <div class="d-flex align-items-center">

                                            <div class="my-2 pl-2 pr-3">
                                                <label class="course-details-inline-label">Course code</label>
                                                <div class="course-details-inline border-left-3p-b1">
                                                    <span>@if(!empty($courses_data)){{$courses_data->course_details->course_code??''}}@endif</span>
                                                </div>
                                            </div>
                                            <div class="my-2 px-3">
                                                <label class="course-details-inline-label">Assigned date</label>
                                                <div class="course-details-inline border-left-3p-b2">
                                                    <span class="ps-1">@if(!empty($courses_data)){{date('d-m-Y',strtotime($courses_data->created_at))}}@endif</span>
                                                </div>
                                            </div>

                                            <div class="my-2 px-3">
                                                <label class="course-details-inline-label">Due date</label>
                                                <div class="course-details-inline border-left-3p-b3">
                                                    <span class="ps-1">@if(!empty($courses_data)) <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->course_details->expiration_date))->diffForHumans() ?>@endif</span>
                                                </div>
                                            </div>

                                            <div class="my-2 px-3">
                                                <label class="course-details-inline-label">Course Level</label>
                                                <div class="course-details-inline border-left-3p-b4 text-uppercase">
                                                    <span>{{$courses_data->course_details->level??'0'}}</span>
                                                </div>
                                            </div>

                                            <div class="my-2 px-3">
                                                <label class="course-details-inline-label">Points</label>
                                                <div class="course-details-inline border-left-3p-b5">
                                                    <span>{{$courses_data->course_details->points??'0'}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="my-2 px-3">
                                            <label class="course-details-inline-label">Goal</label>
                                            <div class="course-details-inline border-0 d-inline-block border-left-3p-b6 py-0 mt-1 rounded-0 ps-2">
                                                <span>{{$courses_data->course_details->goal_details->name??''}}</span>
                                            </div>
                                        </div>

                                        <div class="my-2 px-3">
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
                                        <div class="form-group row my-3">
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
                                        @endif
                                        <div class="form-group row my-3">
                                            <div class="col-12">
                                                <label class="mb-2 font-weight-bold">Description</label>
                                            </div>
                                            <div class="col-12 px-0">
                                                <div class="descrip-border px-1">
                                                   @if(isset($courses_data->course_details->description))
                                                    <div>
                                                        <?php echo $courses_data->course_details->description??''; ?>
                                                    </div>
                                                    @else
                                                    <div>
                                                        <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" width="10%" alt="">
                                                        <div class="no-data-found-text">No data found</div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                            
                                        @foreach($courses_data->course_details->only_attachments as $attachment)
                                        <div class="form-group row mt-3">
                                            <div class="col-12">
                                                <div class="p-3 border d-flex align-items-center justify-content-between">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div>
                                                            <img src="{{asset('public/images/attached-file.png')}}" style="width:40px;height: 40px;" alt="powerpoint-icon" />
                                                        </div>
                                                        <div class="pl-3">
                                                            <a href="{{url('start_course')}}?id={{$courses_data->id}}"><h6>{{$attachment->file_name??''}}</h6></a>
                                                            <div>{{$attachment->org_file_name??''}}</div>
                                                        </div>
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
                </div>
            </div>
        </div>
    </div>

    @include('layouts.user.footer')

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
    </script>
