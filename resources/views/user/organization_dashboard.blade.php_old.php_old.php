@include('layouts.user.header')

<style>
    .table > thead > tr > th {
        font-weight: 500;
        font-size: 16px;
        color: #28313c !important;
        font-weight: 600 !important;
    }
    .select-dropdown{
        background: #2b5797;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 4px;
        font-size: 12px;
    }
    .fc-time{
        display: none !important;
    }
    .fc-day-grid-event .fc-content {
        white-space: normal !important;
    }
    button.fc-prev-button.fc-button.fc-button-primary, button.fc-next-button.fc-button.fc-button-primary,.fc-timeGridWeek-button.fc-button.fc-button-primary,.fc-timeGridDay-button.fc-button.fc-button-primary,.fc-dayGridMonth-button.fc-button.fc-button-primary {
        color: #000 !important;
    }
    button.fc-prev-button.fc-button.fc-button-primary:hover , button.fc-next-button.fc-button.fc-button-primary:hover,.fc-timeGridWeek-button.fc-button.fc-button-primary:hover,.fc-timeGridDay-button.fc-button.fc-button-primary:hover,.fc-dayGridMonth-button.fc-button.fc-button-primary:hover,button.fc-dayGridMonth-button.fc-button.fc-button-primary.fc-button-active {
        color: #fff !important;
    }
    button.fc-prev-button.fc-button.fc-button-primary:focus , button.fc-next-button.fc-button.fc-button-primary:focus,.fc-timeGridWeek-button.fc-button.fc-button-primary:focus,.fc-timeGridDay-button.fc-button.fc-button-primary:focus,.fc-dayGridMonth-button.fc-button.fc-button-primary:focus {
        color: #fff !important;
    }
    a.fc-daygrid-event.fc-daygrid-dot-event.fc-event.fc-event-start.fc-event-end {
        background-color: #fff;
        color: #000;
        border: 1px solid #ccc;
    }
    .fc-event-time{
        display: none !important;
    }
    .fc .fc-header-toolbar {
        margin-top: 1.2rem;
    }
</style>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->

<div class="tab-content px-0 py-0 content-bg rounded-3 border-0 pt-0 p-0 mb-2" id="navtabContent" style="border-top: 1px solid #eeeef0;">
    <div class="tab-pane fade show active py-2" id="od" role="tabpanel" aria-labelledby="od-tab">
        <div class="col-12">
            <div class="user-db-top-section rounded-3">
                <div class="row mx-0">
                    <div class="col-lg-3 pt-5 mt-5">
                        <div class="user-profile-bg mt-5">
                            <div class="">
                                <img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="" width="" height="" />
                            </div>
                            <div class="my-2 text-muted fs-7 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-circle id-circle-icon"></i>
                            <span class="mr-4"> Emp Id</span>
                            <!-- <i class="fa-solid fa-id-card pr-1"></i> -->
                            <i class="fa-solid fa-circle id-circle-icon"></i>
                            <span> joe@gmail.com</span>
                            <!-- <i class="fa-solid fa-envelope pr-1"></i> -->
                        </div>
                        <div class="my-2 text-muted fs-7"><i class="fa-solid fa-user-gear pr-1"></i>Manager</div>
                        <div class="my-2 text-muted fs-7"><i class="fa-regular fa-building pr-1"></i> Department</div>
                        <div class="my-2 text-muted fs-7">Last Login: August 2, 2024 3:42 PM</div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <div class="row px-2">
            <div class="col-12 col-lg-3">
                <div class="bg-white rounded-3 p-3 text-center h-100">
                    <div class="">
                        <img src="{{asset('public/images/face12.jpg')}}" alt="profile" class="" width="" height="" />
                    </div>
                    <div class="my-2">
                        <div class="font-weight-bold web-text-color my-2">Joe</div>
                        <div class="my-2 text-muted fs-7 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-circle id-circle-icon"></i>
                            <span class="mr-4"> Emp Id</span>
                            <!-- <i class="fa-solid fa-id-card pr-1"></i> -->
                            <i class="fa-solid fa-circle id-circle-icon"></i>
                            <span> joe@gmail.com</span>
                            <!-- <i class="fa-solid fa-envelope pr-1"></i> -->
                        </div>
                        <div class="my-2 text-muted fs-7"><i class="fa-solid fa-user-gear pr-1"></i>Manager</div>
                        <div class="my-2 text-muted fs-7"><i class="fa-regular fa-building pr-1"></i> Department</div>
                        <div class="my-2 text-muted fs-7">Last Login: August 2, 2024 3:42 PM</div>
                    </div>
                    
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <ul class="nav nav-pills mb-2 nav-pillss d-flex justify-content-end" id="list-n-calender-pills-tab" role="tablist">
                    <li class="nav-item mr-2">
                        <button class="nav-link active" id="calender-tab" data-bs-toggle="pill" data-bs-target="#calender" type="button" role="tab" aria-controls="calender" aria-selected="false">
                            <i class="fa-solid fa-calendar-days"></i>
                        </button>
                    </li>
                    <li class="nav-item mr-0">
                        <button class="nav-link" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">
                            <i class="fa-solid fa-list"></i>
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0" id="pills-tabContent">
                    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                        <div class="align-items-center rounded-3 border-bottom">
                            <ul class="nav nav-tabs p-0" id="list-pills-tab" role="tablist">
                              <li class="nav-item bg-white rounded-left" role="presentation">
                                <button class="nav-link d-flex align-items-center active" id="recently-visited-tab" data-bs-toggle="pill" data-bs-target="#recently-visited" type="button" role="tab" aria-controls="recently-visited" aria-selected="true"><i class="fa-solid fa-clock-rotate-left menuu-icon"></i><span>Recently Visited</span></button>
                              </li>
                              <li class="nav-item bg-white" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="recently-assigned-courses-tab" data-bs-toggle="pill" data-bs-target="#recently-assigned-courses" type="button" role="tab" aria-controls="recently-assigned-courses" aria-selected="false"><i class="fa-solid fa-user-check menuu-icon"></i><span>Recently Assigned Courses</span></button>
                              </li>
                              <li class="nav-item bg-white rounded-right" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="courses-due-soon-tab" data-bs-toggle="pill" data-bs-target="#courses-due-soon" type="button" role="tab" aria-controls="courses-due-soon" aria-selected="false"><i class="fa-solid fa-circle-exclamation menuu-icon"></i><span>Courses Due Soon</span></button>
                              </li>
                              <li class="nav-item bg-white" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="courses-expired-tab" data-bs-toggle="pill" data-bs-target="#courses-expired" type="button" role="tab" aria-controls="courses-expired" aria-selected="false"><i class="fa-solid fa-file-circle-exclamation menuu-icon"></i><span>Courses Expired</span></button>
                              </li>
                              <li class="nav-item bg-white rounded-right" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="bookmarked-courses-tab" data-bs-toggle="pill" data-bs-target="#bookmarked-courses" type="button" role="tab" aria-controls="bookmarked-courses" aria-selected="false"><i class="fa-solid fa-bookmark menuu-icon"></i><span>Bookmarked Courses</span></button>
                              </li>
                            </ul>
                        </div>
                        <div>
                            <div class="tab-content bg-white mt-2 p-3 rounded-3" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="recently-visited" role="tabpanel" aria-labelledby="recently-visited-tab"> 
                                <div class="col-12 px-0">
                                    <div class="table-responsive">
                                        <table class="table-bordered border-bottom table">
                                            <tbody>
                                                <?php $events = []; $i=1; ?>
                                                @foreach($recently as $recent)
                                                <?php $events[]=['title'=>substr($recent->assign_details->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->view_time)).'T'.date('H:i:s',strtotime($recent->view_time)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->view_time)).'T'.date('H:i:s',strtotime($recent->view_time. ' + 1 hour')).".000000Z",'backgroundColor'=>'blue','id'=>$recent->assign_details->id]; ?>
                                                <tr>
                                                    <td class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                                                <i class="fas fa-book-open fs-5 text-white"></i>
                                                            </div>
                                                            
                                                            <div class="pl-3 table-categories">
                                                                <div>
                                                                    <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="course-name text-primary">{{$recent->assign_details->course_details->course_name??''}}</a>
                                                                </div>
                                                                <div class="d-flex justify-content-start">
                                                                    <small class="d-flex justify-content-center align-items-center">
                                                                    <span>{{$recent->assign_details->category_details->category_name??''}}</span>
                                                                    <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Visited On : <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->view_time))->diffForHumans() ?></span></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                               
                                                 <tr>
                                                    <td class="p-2">
                                                        <div class="text-end">
                                                            <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="recently-assigned-courses" role="tabpanel" aria-labelledby="recently-assigned-courses-tab">
                                    <div class="table-responsive">
                                        <table class="table-bordered border-bottom table">
                                            
                                                <tbody>
                                                @foreach($recently_assign as $recent)

                                                 <?php $events[]=['title'=>substr($recent->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at. ' + 1 hour')).".000000Z",'backgroundColor'=>'green','id'=>$recent->id]; ?>
                                            <tr>
                                                <td class="p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                                            <i class="fas fa-book-open fs-5 text-white"></i>
                                                        </div>
                                                        
                                                        <div class="pl-3 table-categories">
                                                            <div>
                                                                <a href="{{url('start_course')}}?id={{$recent->id}}" class="course-name text-primary">{{$recent->course_details->course_name??''}}</a>
                                                            </div>
                                                            <div class="d-flex justify-content-start">
                                                                <small class="d-flex justify-content-center align-items-center">
                                                                    <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                    <i class="fa-solid fa-circle id-circle-icon pl-2"></i> 
                                                                    <span>Assigned On : <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->diffForHumans() ?></span>
                                                                </small>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                             @endforeach
                                                <tr>
                                                    <td class="p-2">
                                                        <div class="text-end">
                                                            <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                              </div>
                              <div class="tab-pane fade" id="courses-due-soon" role="tabpanel" aria-labelledby="courses-due-soon-tab">
                                  <div class="table-responsive">
                                    <table class="table-bordered border-bottom table">
                                       
                                            <tbody>
                                            @foreach($due_soon as $recent)
                                             <?php $events[]=['title'=>substr($recent->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date. ' + 1 hour')).".000000Z",'backgroundColor'=>'red','id'=>$recent->id]; ?>
                                        <tr>
                                            <td class="p-2">
                                                
                                                <div class="d-flex align-items-center">
                                                    <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                                        <i class="fas fa-book-open fs-5 text-white"></i>
                                                    </div>
                                                    
                                                    <div class="pl-3 table-categories">
                                                        <div>
                                                            <a href="{{url('start_course')}}?id={{$recent->id}}" class="course-name text-primary">{{$recent->course_details->course_name??''}}</a>
                                                        </div>
                                                        <div class="d-flex justify-content-start">
                                                            <small class="d-flex justify-content-center align-items-center">
                                                                <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Due : <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_details->expiration_date))->diffForHumans() ?></span>
                                                            </small>
                                                        </div>
                                                    </div>


                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                            <tr>
                                                <td class="p-2">
                                                    <div class="text-end">
                                                        <a href="{{url('user_courses')}}?expire=1&menu=expire" class="btn btn-outline-primary btn-xs">View All</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="courses-expired" role="tabpanel" aria-labelledby="courses-expired-tab">
                                  <div class="table-responsive">
                                    <table class="table-bordered border-bottom table">
                                        
                                        <tbody>
                                                 @foreach($expired as $recent)

                                                  <?php $events[]=['title'=>substr($recent->course_data->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date. ' + 1 hour')).".000000Z",'backgroundColor'=>'grey','id'=>$recent->id]; ?>
                                            <tr>
                                                <td class="p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                                            <i class="fas fa-book-open fs-5 text-white"></i>
                                                        </div>
                                                        
                                                        <div class="pl-3 table-categories">
                                                            <div>
                                                                <a href="javascript:;" class="course-name text-primary">{{$recent->course_data->course_name??''}}</a>
                                                            </div>
                                                            <div class="d-flex justify-content-start">
                                                                <small class="d-flex justify-content-center align-items-center">
                                                                    <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                    <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Expired On : <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_data->expiration_date))->diffForHumans() ?></span>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="p-2">
                                                    <div class="text-end">
                                                        <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="bookmarked-courses" role="tabpanel" aria-labelledby="bookmarked-courses-tab">
                                <div class="row">
                                    <div class="col-2 offset-5 py-3">
                                        <div>
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="pb-2 pt2 text-center">No bookmarked courses found</div>
                                    </div>
                                </div>

                                  <div class="table-responsive">
                                    <table class="table-bordered border-bottom table">
                                       
                                        <tbody>
                                             @foreach($bookmark as $recent)
                                              <?php $events[]=['title'=>substr($recent->assign_details->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at. ' + 1 hour')).".000000Z",'backgroundColor'=>'#f69336','id'=>$recent->assign_details->id]; ?>
                                        <tr>
                                            <td class="p-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                                        <i class="fas fa-book-open fs-5 text-white"></i>
                                                    </div>
                                                    
                                                    <div class="pl-3 table-categories">
                                                        <div>
                                                            <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="course-name text-primary">{{$recent->assign_details->course_details->course_name??''}}</a>
                                                        </div>
                                                        <div class="d-flex justify-content-start">
                                                            <small class="d-flex justify-content-center align-items-center">
                                                                <span class="">{{$recent->assign_details->category_details->category_name??''}}</span><i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Bookmarked On :<?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->diffForHumans() ?></span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                            <tr>
                                                <!-- <td class="p-2">
                                                    <div class="text-end">
                                                        <a href="{{url('user_courses')}}?bookmark=1" class="btn btn-outline-primary btn-xs">View All</a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="calender" role="tabpanel" aria-labelledby="calender-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-0">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="d-flex align-items-center mr-4">
                                            <span class="in-progress-barr"></span>
                                            <span>Recently Visited</span>
                                        </div>
                                        <div class="d-flex align-items-center mr-4">
                                            <span class="completed-barr"></span>
                                            <span>Assigned</span>
                                        </div>
                                        <div class="d-flex align-items-center mr-4">
                                            <span class="due-barr"></span>
                                            <span>Due Soon</span>
                                        </div>
                                        <div class="d-flex align-items-center mr-4">
                                            <span class="expired-barr"></span>
                                            <span>Expired</span>
                                        </div>
                                        <div class="d-flex align-items-center mr-4">
                                            <span class="bookmarked-barr"></span>
                                            <span>Bookmarked</span>
                                        </div>
                                    </div>
                                    <div id="fullcalendardashboard"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
           
        </div>
        <div class="row px-3">
           
          
        </div>
    </div>
    </div>


<link rel="stylesheet" href="{{asset('public/css/horizontal-layout/calendar.min.css')}}" defer="defer">
<script src="{{asset('public/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/js/fullcalendar_local.min.js')}}"></script>
<script type="text/javascript">

          
                var calendarEl = document.getElementById('fullcalendardashboard');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                   
                    timeZone: 'Asia/Kolkata',
                    firstDay: parseInt("1"),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    navLinks: true, // can click day/week names to navigate views
                    selectable: false,
                    initialView: 'dayGridMonth',
                    selectMirror: true,
                    eventRender: function (event, element) {
                            element.find('.fc-title').html(event.title);
                        },
                    eventClick: function(arg) {
                       // console.log(arg.event.id);
                         window.location = "{{url('course_view')}}?id=" + arg.event.id;
                        //getEventDetail(arg.event.id,arg.event.extendedProps.event_type);
                    },
                    editable: false,
                    dayMaxEvents: true, // allow "more" link when too many events
                    events: <?php echo json_encode($events); ?>,
                   
                    eventTimeFormat: { // like '14:30:00'
                        hour:  '2-digit' ,
                        minute: '2-digit',
                        meridiem: false
                    }
                });

                if (calendarEl != null) {
                    calendar.render();
                }


            
        </script>
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
       <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <script>
  
    $( ".date_picker" ).datepicker({maxDate: '0'});
 
  </script>

    @include('layouts.user.footer')

