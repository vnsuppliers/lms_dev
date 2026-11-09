@include('layouts.user.header')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/charts/chart-2/assets/css/chart-2.css">

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

    .user-profile-imagee {
    position: relative;
    display: inline-block;
}

.profile-image {
    border-radius: 50%;
}

.edit-button {
    top: 10px;
    right: 10px;
    background-color: #ffffff;
    border: none;
    padding: 8px;
    border-radius: 50%;
    cursor: pointer;
    display: none;
}

.user-profile-imagee:hover .edit-button {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px !important;
}

.modal-content {
    border-radius: 0.5rem;
}

</style>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->

    <div class="px-0 pt-0 pb-2 content-bg rounded-3 border-0 mb-2">

         @if(session('error'))
        <script type="text/javascript">
                $.toast({
                        heading: 'warning',
                        text: '{{ session("error") }}',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
        </script>
        @endif
        @if(session('success'))
        <script type="text/javascript">
                $.toast({
                        heading: 'Success',
                        text: '{{ session("success") }}',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
        </script>
        @endif

        <div class="col-12 d-block d-lg-none px-1 px-md-2">
            <div class="res-main-headings"> <i class="fa-solid fa-home me-2 menu-icon1"></i> <span class="text-blue font-weight-500">Dashboard</span> </div>
        </div>
        <div class="col-12 px-0 px-lg-3">
            <div class="user-db-top-section rounded-3 py-0 py-lg-3">
                <div class="row mx-0 pb-2">
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="user-profile-bg h-100">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="user-profile-imagee px-5 py-4">
                                        <div class="user-main-profile-image-div">
                                            @if(!empty($user->profile_image))
                                                <img src="{{ asset('storage/app/public/' . $user->profile_image) }}" alt="profile" class="mx-auto w-100 d-block rounded-circle">
                                            @else
                                                <img src="{{ asset('public/images/face12.jpg') }}" alt="profile" class="mx-auto w-100 d-block rounded-circle">
                                            @endif
                                        </div>
                                         <button class="edit-button position-absolute" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <div class="mt-2">
                                            <a href="{{url('my_profile')}}" class="web-text-color font-weight-bold d-flex align-items-center justify-content-center">   
                                                <i class="fa fa-user profile-user-iconn"></i> 
                                                <span class="ps-2">View Profile</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row py-2">
                                <div class="col-4 col-md-3 col-lg-3">
                                    <div class="user-profile-icons">
                                        <i class="fa-solid fa-id-card"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-md-9 col-lg-9 my-auto">
                                    <div class="text-start">
                                        <div class="sub-text mb-2">Emp Id</div>
                                        <h5 class="mb-0">{{$user->emp_id??''}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4 col-md-3 col-lg-3">
                                    <div class="user-profile-icons">
                                        <i class="fa-solid fa-user-gear"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-md-9 col-lg-9 my-auto">
                                    <div class="text-start">
                                        <div class="sub-text mb-2">Designation</div>
                                        <h5 class="mb-0">{{$user->designationdetails->designation_name??''}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4 col-md-3 col-lg-3">
                                    <div class="user-profile-icons">
                                        <i class="fa-regular fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-md-9 col-lg-9 my-auto">
                                    <div class="text-start">
                                        <div class="sub-text mb-2">Role</div>
                                        <h5 class="mb-0">
                                            @foreach($roles as $role)
                                                {{ $role->role }}@if(!$loop->last), @endif
                                            @endforeach
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4 col-md-3 col-lg-3">
                                    <div class="user-profile-icons">
                                        <i class="fa-regular fa-building"></i>
                                    </div>
                                </div>
                                <div class="col-8 col-md-9 col-lg-9 my-auto">
                                    <div class="text-start">
                                        <div class="sub-text mb-2">Department</div>
                                        <h5 class="mb-0">{{$user->departmentdetails->department_name??''}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="profile-rewards-styles">
                                        <div class="row">
                                            <div class="col-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2">
                                                <img src="{{asset('public/images/rewards-icon.png')}}" alt="profile" class="mx-auto w-100 d-block">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="text-white">{{$user->point??'0'}} Points</h5>
                                            <div class="text-white opacity-50 fs-7">My Reward Points</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-12 my-3">
                                    <div class="profile-rewards-styles">
                                        <div class="row">
                                            <div class="col-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 py-2 my-1">
                                                <img src="{{asset('public/images/awards-badge.png')}}" alt="profile" class="mx-auto img-fluid d-block">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="text-white">0</h5>
                                            <div class="text-white opacity-50 fs-7">My Awarded Badges</div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="d-none d-lg-block">
                            <h1 class="pt-3 pb-1 text-white font-weight-500">Welcome, {{$user->first_name??''}} {{$user->last_name??''}}</h1>
                            <h5 class="text-white opacity-75 font-weight-normal d-flex align-items-center">
                                <i class="fa-solid fa-envelope pr-2 border p-2 rounded-circle"></i>
                                <span class="ps-2">{{$user->email??''}}</span>
                                <i class="fa-solid fa-circle id-circle-icon text-white pl-3"></i>
                                <span>Last Login :</span>
                               <span class="pl-1">
                                    @php
                                        use Carbon\Carbon;
                                        $lastLogin = isset($secondLastLogin->login_time) 
                                            ? Carbon::parse($secondLastLogin->login_time)->setTimezone('Asia/Kolkata') 
                                            : null;
                                    @endphp

                                    @if($lastLogin)
                                        {{ $lastLogin->format('F j, Y g:i a \I\S\T') }}
                                    @else
                                        No login data
                                    @endif
                                </span>

                            </h5>
                        </div>
                        <div class="mt-lg-5 pt-lg-4">
                            <div class="mt-0 pt-0 mt-lg-4 pt-lg-2">
                                <div class="horizontal-tabs-div das-tabs-border-bottom mt-3">
                                    <ul class="nav nav-tabs transparent-tabs horizontal-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                                        </li>
                                        <!-- <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="recently-visited-tab" data-bs-toggle="tab" data-bs-target="#recently-visited" type="button" role="tab" aria-controls="recently-visited" aria-selected="false">Recently Visited</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="recently-assigned-courses-tab" data-bs-toggle="tab" data-bs-target="#recently-assigned-courses" type="button" role="tab" aria-controls="recently-assigned-courses" aria-selected="false">Recently Assigned Courses</button>
                                        </li> -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="courses-due-soon-tab" data-bs-toggle="tab" data-bs-target="#courses-due-soon" type="button" role="tab" aria-controls="courses-due-soon" aria-selected="false">Courses Due Soon</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="courses-expired-tab" data-bs-toggle="tab" data-bs-target="#courses-expired" type="button" role="tab" aria-controls="courses-expired" aria-selected="false">Courses Expired</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="bookmarked-courses-tab" data-bs-toggle="tab" data-bs-target="#bookmarked-courses" type="button" role="tab" aria-controls="bookmarked-courses" aria-selected="false">Bookmarked Courses</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link transparent-nav-link" id="calender-tab" data-bs-toggle="tab" data-bs-target="#calender" type="button" role="tab" aria-controls="calender" aria-selected="false">Calender</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content border-0 mt-0 pt-2 pt-lg-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 p-2">
                                            <div class="cardd cardd7">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 my-auto">
                                                        <div class="font-weight-bold">My Assigned Courses</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 my-3 my-lg-auto">
                                                        <div class="d-flex align-items-center ps-0 ps-lg-2">
                                                            <i class="bi bi-filter"></i>
                                                            <select id="category_id" class="dasboard-filters-drpdwn dashboard_filters">
                                                                 <option value="">All Catergories</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}" @if($request->category_id==$category->id) Selected @endif>{{$category->category_name??''}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 my-auto">
                                                        <div class="">
                                                            <h2 class="mb-0">{{$total_courses??'0'}}</h2>
                                                        </div>
                                                    </div>
                                                    @if($total_courses>0)
                                                    <div class="col-6 my-auto">
                                                        <div class="row">
                                                            <div class="col-12 mpb-2 py-md-2 my-md-1">
                                                                <!-- <canvas id="PieChart" class="" style="width:100%;height: auto;"></canvas> -->
                                                                <div id="bsb-chart" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-left text-lg-center">
                                                            <div class="fs-7 text-muted">Completed</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-start justify-content-lg-center">
                                                                <span class="cardd-chat-circle bg-primary"></span>
                                                                <span class="font-weight-bold">{{$completed_course??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-left text-lg-center">
                                                            <div class="fs-7 text-muted">In-progress</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-start justify-content-lg-center">
                                                                <span class="cardd-chat-circle bg-warning"></span>
                                                                <span class="font-weight-bold">{{$inprogress_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-left text-lg-center">
                                                            <div class="fs-7 text-muted">Pending</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-start justify-content-lg-center">
                                                                <span class="cardd-chat-circle bg-success"></span>
                                                                <span class="font-weight-bold">{{$pending_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--   <div class="col-12 col-lg-3 px-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Expired</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-info"></span>
                                                                <span class="font-weight-bold">{{$expired_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-12 col-lg-20 px-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Instructor-Led</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-danger"></span>
                                                                <span class="font-weight-bold">{{$instructor_lead??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-6 p-2">
                                            <div class="cardd cardd8">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6 my-auto">
                                                        <div class="font-weight-bold">My Instructor led Courses</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 my-3 my-lg-auto">
                                                        <div class="d-flex align-items-center ps-0 ps-lg-2">
                                                            <i class="bi bi-filter"></i>
                                                            <select id="instructor_category_id" class="dasboard-filters-drpdwn dashboard_filters">
                                                                 <option value="">All Catergories</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}" @if($request->instructor_category_id==$category->id) Selected @endif>{{$category->category_name??''}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 my-auto">
                                                        <div class="my-2">
                                                            <h2 class="my-5 py-4">{{$instructor_lead??'0'}}</h2>
                                                        </div>
                                                    </div>
                                                    @if($instructor_lead > 0)
                                                    <div class="col-6 my-auto">
                                                        <div class="row">
                                                            <div class="col-12 py-2 my-1">
                                                                <div id="instructor_bsb-chart" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                              <div class="row {{ $instructor_lead <= 0 ? '' : '' }}">

                                                 @if($instructor_lead > 0)
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Completed</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-primary"></span>
                                                                <span class="font-weight-bold">{{$instructor_completed_course??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">In-progress</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-warning"></span>
                                                                <span class="font-weight-bold">{{$instructor_inprogress_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-3 p-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Pending</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-success"></span>
                                                                <span class="font-weight-bold">{{$instructor_pending_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                  <!--   <div class="col-12 col-lg-3 px-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Expired</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-info"></span>
                                                                <span class="font-weight-bold">{{$instructor_expired_count??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-12 col-lg-20 px-2">
                                                        <div class="text-center">
                                                            <div class="fs-7 text-muted">Instructor-Led</div>
                                                            <div class="pt-2 d-flex align-items-center justify-content-center">
                                                                <span class="cardd-chat-circle bg-danger"></span>
                                                                <span class="font-weight-bold">{{$instructor_lead??'0'}}</span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>


                                      

                                        <!-- <div class="col-12 col-lg-4 p-2">
                                            <div class="cardd cardd8">
                                                <div class="row">
                                                    <div class="col-6 my-auto">
                                                        <div class="font-weight-bold">My Certificates</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6 my-auto">
                                                        <div class="d-flex align-items-center justify-content-end ps-2">
                                                            <i class="bi bi-filter"></i>
                                                            <select id="certificate_category_id" class="dasboard-filters-drpdwn dashboard_filters">
                                                                 <option value="">All Catergories</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}" @if($request->certificate_category_id==$category->id) Selected @endif>{{$category->category_name??''}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 my-auto">
                                                        <div class="">
                                                            <h2 class="mb-0">{{$certificate_count??'0'}}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 my-auto">
                                                        <div class="row">
                                                            <div class="col-12 py-2 my-1">
                                                                <div id="instructor_bsb-chart" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                       <div class="col-6 ">
    <div class="cardd ">
        <div class="row">
            <div class="col-6 my-auto">
                <div class="font-weight-bold">My Learn hours</div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 my-auto">
                <div class="d-flex align-items-center justify-content-end ps-2">
                    <i class="bi bi-filter"></i>
                    <select id="day_learn_filter" class="dasboard-filters-drpdwn dashboard_filters">
                        <option value="day" @if($request->day_learn_filter=="day") Selected @endif>Day</option>
                        <option value="past_week" @if($request->day_learn_filter=="past_week") Selected @endif>Past Week</option>
                        <option value="this_month" @if($request->day_learn_filter=="this_month" || $request->day_learn_filter=="") Selected @endif >This Month</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12 my-auto">
                <div class="row">
                    <div class="col-12 py-2 my-1">
                  
                        <div id="workingHoursChart" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                                        

                                    </div>
                                </div>
                                <!--  <div class="col-12 col-md-6 col-lg-6 p-2">
                                   <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="font-weight-bold">Login History of Past One Month</div>
                                            <canvas id="login-history-chart" style="width: 100%; height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>-->        
                                <div class="tab-pane fade" id="recently-visited" role="tabpanel" aria-labelledby="recently-visited-tab">
                                   @if($recently->isEmpty())
                                    <?php $events = []; $i=1; ?>
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div class="bg-white">
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            <div class="no-data-found-text pb-3">No data found</div>
                                        </div>
                                    </div>
                                     @else
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div>
                                            <label class="mb-2 font-weight-bold d-flex align-items-center fs-6 px-2 py-1 border-left-3p-b7">Quickly access the courses you have visited recently</label>
                                        </div>
                                        <div class="mt-3">
                                            <table class="table border">
                                                <tbody>
                                                    <?php $events = []; $i=1; ?>
                                                    @foreach($recently as $recent)
                                                    <?php $events[]=['title'=>substr($recent->assign_details->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->view_time)).'T'.date('H:i:s',strtotime($recent->view_time)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->view_time)).'T'.date('H:i:s',strtotime($recent->view_time. ' + 1 hour')).".000000Z",'backgroundColor'=>'blue','id'=>$recent->assign_details->id]; ?>
                                                    <tr>
                                                        <td class="p-2 border-top-0">
                                                            <div class="row">
                                                                <div class="col-lg-1p5">
                                                                    <div class="course-image-sm">
                                                                        @php
                                                                            $recentVisitedImg = $recent->assign_details->course_details->course_image ?? $recent->assign_details->course_data->course_image ?? null;
                                                                        @endphp
                                                                        @if(!empty($recentVisitedImg))
                                                                            <img src="{{ url('storage/app/public/' . $recentVisitedImg) }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                                                        @else
                                                                            <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10p5 ps-2 ps-lg-0 mt-2 mb-0 my-lg-auto">
                                                                    <div>
                                                                        <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="course-name font-weight-bold">{{$recent->assign_details->course_details->course_name??''}}</a>
                                                                    </div>
                                                                    <div class="py-1 sub-categories-styles">
                                                                        <small class="d-flex justify-content-start align-items-center">
                                                                        <span>{{$recent->assign_details->category_details->category_name??''}}</span>
                                                                        <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Visited On :</span><span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->view_time))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->view_time))->diffForHumans() ?></span></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                            
                                                </tbody>
                                            </table>
                                            <div class="text-end mt-2">
                                                <a href="{{url('user_courses')}}" class="btn web-btn btn-sm">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="recently-assigned-courses" role="tabpanel" aria-labelledby="recently-assigned-courses-tab">
                                    @if($recently_assign->isEmpty())

                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div class="bg-white">
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            <div class="no-data-found-text pb-3">No data found</div>
                                        </div>
                                    </div>
                                     @else
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div>
                                            <label class="mb-2 font-weight-bold d-flex align-items-center fs-6 px-2 py-1 border-left-3p-b7">Recently Assigned Courses</label>
                                        </div>
                                        <div class="mt-3">
                                            <table class="table border">
                                                <tbody>
                                                @foreach($recently_assign as $recent)

                                                 <?php $events[]=['title'=>substr($recent->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at. ' + 1 hour')).".000000Z",'backgroundColor'=>'green','id'=>$recent->id]; ?>
                                                <tr>
                                                    <td class="p-2 border-top-0">
                                                        <div class="row">
                                                            <div class="col-lg-1p5">
                                                                <div class="course-image-sm">
                                                                    @php
                                                                        $recentlyAssignImg = $recent->course_details->course_image ?? $recent->course_data->course_image ?? null;
                                                                    @endphp
                                                                    @if(!empty($recentlyAssignImg))
                                                                        <img src="{{ url('storage/app/public/' . $recentlyAssignImg) }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                                                    @else
                                                                        <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-10p5 ps-2 ps-lg-0 mt-2 mb-0 my-lg-auto">
                                                                <div>
                                                                    <a href="{{url('start_course')}}?id={{$recent->id}}" class="course-name font-weight-bold">{{$recent->course_details->course_name??''}}</a>
                                                                </div>
                                                                <div class="py-1 sub-categories-styles">
                                                                    <small class="d-flex justify-content-start align-items-center">
                                                                    <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                        <i class="fa-solid fa-circle id-circle-icon pl-2"></i> 
                                                                        <span>Assigned On :</span><span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->format('F j, Y g:i a T') }}"> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->diffForHumans() ?></span>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                 @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-end mt-2">
                                                <a href="{{url('user_courses')}}" class="btn web-btn btn-sm">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="courses-due-soon" role="tabpanel" aria-labelledby="courses-due-soon-tab">
                                     @if($due_soon->isEmpty())

                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div class="bg-white">
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            <div class="no-data-found-text pb-3">No data found</div>
                                        </div>
                                    </div>
                                     @else
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div>
                                            <label class="mb-2 font-weight-bold d-flex align-items-center fs-6 px-2 py-1 border-left-3p-b7">Courses Due Soon</label>
                                        </div>
                                        <div class="mt-3">
                                            <table class="table border">
                                                <tbody>
                                                @foreach($due_soon as $recent)
                                                 <?php $events[]=['title'=>substr($recent->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date. ' + 1 hour')).".000000Z",'backgroundColor'=>'red','id'=>$recent->id]; ?>
                                                    <tr>
                                                        <td class="p-2 border-top-0">
                                                            <div class="row">
                                                                <div class="col-4 col-md-3 col-lg-1p5">
                                                                    <div class="course-image-sm">
                                                                        @php
                                                                            $dueSoonCourseImg = $recent->course_details->course_image ?? $recent->course_data->course_image ?? null;
                                                                        @endphp
                                                                        @if(!empty($dueSoonCourseImg))
                                                                            <img src="{{ url('storage/app/public/' . $dueSoonCourseImg) }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                                                        @else
                                                                            <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-8 col-lg-9 col-lg-10p5 ps-0 ps-lg-0 mt-1 mt-lg-2 mb-0 my-lg-auto">
                                                                    <div>
                                                                        <a href="{{url('start_course')}}?id={{$recent->id}}" class="course-name font-weight-bold">{{$recent->course_details->course_name??''}}</a>
                                                                    </div>
                                                                    <div class="py-1 sub-categories-styles">
                                                                        <small class="d-flex justify-content-start align-items-center">
                                                                            <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                            <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Due :</span><span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_details->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_details->expiration_date))->diffForHumans() ?></span>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-end mt-2">
                                                <a href="{{url('user_courses')}}?expire=1&menu=expire" class="btn web-btn btn-sm">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                 <div class="tab-pane fade" id="courses-expired" role="tabpanel" aria-labelledby="courses-expired-tab">
                                     @if($expired->isEmpty())

                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div class="bg-white">
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            <div class="no-data-found-text pb-3">No data found</div>
                                        </div>
                                    </div>
                                     @else
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div>
                                            <label class="mb-2 font-weight-bold d-flex align-items-center fs-6 px-2 py-1 border-left-3p-b7">Courses Expired</label>
                                        </div>
                                        <div class="mt-3">
                                            <table class="table border">
                                                <tbody>
                                                         @foreach($expired as $recent)

                                                          <?php $events[]=['title'=>substr($recent->course_data->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->course_data->expiration_date)).'T'.date('H:i:s',strtotime($recent->course_data->expiration_date. ' + 1 hour')).".000000Z",'backgroundColor'=>'grey','id'=>$recent->id]; ?>
                                                    <tr>
                                                        <td class="p-2 border-top-0">
                                                            <div class="row">
                                                                <div class="col-4 col-md-3 col-lg-1p5">
                                                                    <div class="course-image-sm">
                                                                        @php
                                                                            $expiredCourseImg = $recent->course_data->course_image ?? $recent->course_details->course_image ?? null;
                                                                        @endphp
                                                                        @if(!empty($expiredCourseImg))
                                                                            <img src="{{ url('storage/app/public/' . $expiredCourseImg) }}" class="img-fluid w-100 rounded-3" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                                                        @else
                                                                            <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-8 col-lg-9 col-lg-10p5 ps-0 ps-lg-0 mt-1 mt-lg-2 mb-0 my-lg-auto">
                                                                    <div>
                                                                        <a href="javascript:;" class="course-name font-weight-bold">{{$recent->course_data->course_name??''}}</a>
                                                                    </div>
                                                                    <div class="py-1 sub-categories-styles d-none d-md-block">
                                                                        <small class="d-flex justify-content-start align-items-center">
                                                                            <span class="">{{$recent->category_details->category_name??''}}</span>
                                                                                <i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Expired On :</span><span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_data->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_data->expiration_date))->diffForHumans() ?></span>
                                                                        </small>
                                                                    </div>
                                                                    <div class="py-1 sub-categories-styles d-block d-md-none">
                                                                        <small class="">
                                                                            <div class="">{{$recent->category_details->category_name??''}}</div>
                                                                            <div class="pt-1"><span>Expired On :</span>
                                                                                <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_data->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->course_data->expiration_date))->diffForHumans() ?></span>
                                                                            </div>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-end mt-2">
                                                <a href="{{url('user_courses')}}" class="btn web-btn btn-sm">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                 </div>
                                 <div class="tab-pane fade" id="bookmarked-courses" role="tabpanel" aria-labelledby="bookmarked-courses-tab">
                                    <!-- <div class="row">
                                        <div class="col-2 offset-5 py-3">
                                            <div>
                                                <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="pb-2 pt2 text-center">No bookmarked courses found</div>
                                        </div>
                                    </div> -->
                                    @if($bookmark->isEmpty())

                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div class="bg-white">
                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                            <div class="no-data-found-text pb-3">No data found</div>
                                        </div>
                                    </div>
                                     @else
                                    <div class="col-12 content-bg p-0 p-lg-2">
                                        <div>
                                            <label class="mb-2 font-weight-bold d-flex align-items-center fs-6 px-2 py-1 border-left-3p-b7">Bookmarked Courses</label>
                                        </div>
                                        <div class="mt-2 mt-lg-3">
                                            <table class="table border">
                                                <tbody>
                                                     @foreach($bookmark as $recent)
                                                      <?php $events[]=['title'=>substr($recent->assign_details->course_details->course_name,0,25),'start'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at)).".000000Z",'end'=>date('Y-m-d',strtotime($recent->created_at)).'T'.date('H:i:s',strtotime($recent->created_at. ' + 1 hour')).".000000Z",'backgroundColor'=>'#f69336','id'=>$recent->assign_details->id]; ?>
                                                    <tr>
                                                        <td class="p-2 border-top-0">
                                                            <div class="row">
                                                                <div class="col-lg-1p5">
                                                                    <div class="course-image-sm">
                                                                        @php
                                                                            $bookmarkCourseImg = $recent->assign_details->course_details->course_image ?? $recent->assign_details->course_data->course_image ?? null;
                                                                        @endphp
                                                                        @if(!empty($bookmarkCourseImg))
                                                                            <img src="{{ url('storage/app/public/' . $bookmarkCourseImg) }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="" onerror="this.onerror=null; this.src='{{ url('public/images/course.jpg') }}';">
                                                                        @else
                                                                            <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" style="height: auto !important;" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10p5 px-2 ps-lg-0 my-auto">
                                                                    <div>
                                                                        <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="course-name font-weight-bold">{{$recent->assign_details->course_details->course_name??''}}</a>
                                                                    </div>
                                                                    <div class="py-1 sub-categories-styles">
                                                                        <small class="d-flex justify-content-start align-items-center">
                                                                            <span class="">{{$recent->assign_details->category_details->category_name??''}}</span><i class="fa-solid fa-circle id-circle-icon pl-2"></i> <span>Bookmarked On :</span><span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($recent->created_at))->diffForHumans() ?></span>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                 </div>
                                 
                                <div class="tab-pane fade show active" id="calender" role="tabpanel" aria-labelledby="calender-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <div class="d-none d-lg-block">
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
                                                </div>
                                                <div class="d-block d-lg-none">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-6 col-md-3 py-2">
                                                                    <div class="d-flex align-items-center mr-2">
                                                                        <span class="in-progress-barr"></span>
                                                                        <span>Recently Visited</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-2 py-2">
                                                                    <div class="d-flex align-items-center mr-2">
                                                                        <span class="completed-barr"></span>
                                                                        <span>Assigned</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-2 py-2">
                                                                    <div class="d-flex align-items-center mr-2">
                                                                        <span class="due-barr"></span>
                                                                        <span>Due Soon</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-2 py-2">
                                                                    <div class="d-flex align-items-center mr-2">
                                                                        <span class="expired-barr"></span>
                                                                        <span>Expired</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-3 py-2">
                                                                    <div class="d-flex align-items-center mr-2">
                                                                        <span class="bookmarked-barr"></span>
                                                                        <span>Bookmarked</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                </div>
            </div>
            
        </div>
       

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('my_profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="orignasation_dashboard_url" type="hidden" value="1">
                <div class="modal-body">
                    <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" required accept=".jpg,.jpeg,.png" style="height: 37px !important;">
                            <small class="form-text text-muted py-1">Please upload images of type JPG, JPEG, or PNG, and less than 5MB in size.</small>
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="{{asset('public/css/horizontal-layout/calendar.min.css')}}" defer="defer">
<script src="{{asset('public/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/js/fullcalendar_local.min.js')}}"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

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

              
                    calendar.render();
               
                    $('#calender').removeClass('show');
                    $('#calender').removeClass('active');
            
        </script>
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
      
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <script>
  
    $( ".date_picker" ).datepicker({maxDate: '0'});

    $('.dashboard_filters').change(function(){
            var category_id = $('#category_id').val();
            var instructor_category_id = $('#instructor_category_id').val();
            var certificate_category_id = $('#certificate_category_id').val();
             var day_learn_filter = $('#day_learn_filter').val();
            
             window.location.href="{{url('organization_dashboard')}}?category_id="+category_id+'&instructor_category_id='+instructor_category_id+'&certificate_category_id='+certificate_category_id+'&day_learn_filter='+day_learn_filter;
        });
 
  </script>
<!-- <script>
    var completedCount = @json($completed_course);
    var inprogressCount = @json($inprogress_count);
    var pendingCount = @json($pending_count);
    var expiredCount = @json($expired_count);

    var xValues = ["Completed", "In Progress", "Pending", "Expired"];
    var yValues = [completedCount, inprogressCount, pendingCount, expiredCount];
    var barColors = [
        "#009eec",
        "#ffc300",
        "#40c1c0",
        "#911a79"
    ];

    new Chart("PieChart", {
        type: "doughnut",
        data: {
           //labels: xValues, 
            datasets: [{
                backgroundColor: barColors,
                data: yValues,

            }]
        }
    });
</script> -->
<script type="text/javascript">
    !(function () {

        var completedCount = @json($completed_course);
        var inprogressCount = @json($inprogress_count);
        var pendingCount = @json($pending_count);
        // var expiredCount = @json($expired_count);
        
        var e = {
            460: function () {
                !(function () {
                    const e = {
                        init() {
                            new ApexCharts(document.querySelector("#bsb-chart"), {
                                series: [completedCount, inprogressCount, pendingCount],

                                labels: ["Completed", "In-Progress", "Pending"],
                                legend: {
                                    show: false // Hides the legend
                                },
                                theme: { palette: "palette1" },
                                chart: { type: "donut" },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            labels: {
                                                show: false 
                                            }
                                        }
                                    }
                                },
                                colors: [
                                    "#009eec", 
                                    "#ffc300", 
                                    "#40c1c0"
                                  
                                ],
                                // tooltip: {
                                //     y: {
                                //         formatter: function (value, { seriesIndex }) {
                                //             const labels = ["Completed", "In-Progress", "Pending", "Expired Count"];
                                //             return `${labels[seriesIndex]}: ${value}`;
                                //         }
                                //     }
                                // }
                            }).render();
                        },
                    };
                    function t() {
                        e.init();
                    }
                    "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", t) : t(), window.addEventListener("load", function () {}, !1);
                })();
            },
        },
        t = {};
        
        function n(r) {
            var o = t[r];
            if (void 0 !== o) return o.exports;
            var i = (t[r] = { exports: {} });
            return e[r](i, i.exports, n), i.exports;
        }
        
        (n.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return n.d(t, { a: t }), t;
        }),
        (n.d = function (e, t) {
            for (var r in t) n.o(t, r) && !n.o(e, r) && Object.defineProperty(e, r, { enumerable: !0, get: t[r] });
        }),
        (n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (function () {
            "use strict";
            n(460);
        })();
    })();
</script>

<script type="text/javascript">
    !(function () {

        var instructor_completedCount = @json($instructor_completed_course);
        var instructor_inprogressCount = @json($instructor_inprogress_count);
        var instructor_pendingCount = @json($instructor_pending_count);
        // var instructor_expiredCount = @json($instructor_expired_count);
        
        var e = {
            460: function () {
                !(function () {
                    const e = {
                        init() {
                            new ApexCharts(document.querySelector("#instructor_bsb-chart"), {
                                series: [instructor_completedCount, instructor_inprogressCount, instructor_pendingCount],

                                labels: ["Completed", "In-Progress", "Pending"],
                                legend: {
                                    show: false // Hides the legend
                                },
                                theme: { palette: "palette1" },
                                chart: { type: "donut" },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            labels: {
                                                show: false 
                                            }
                                        }
                                    }
                                },
                                colors: [
                                    "#009eec", 
                                    "#ffc300", 
                                    "#40c1c0", 
                                    "#911a79"  
                                ],
                            }).render();
                        },
                    };
                    function t() {
                        e.init();
                    }
                    "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", t) : t(), window.addEventListener("load", function () {}, !1);
                })();
            },
        },
        t = {};
        
        function n(r) {
            var o = t[r];
            if (void 0 !== o) return o.exports;
            var i = (t[r] = { exports: {} });
            return e[r](i, i.exports, n), i.exports;
        }
        
        (n.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return n.d(t, { a: t }), t;
        }),
        (n.d = function (e, t) {
            for (var r in t) n.o(t, r) && !n.o(e, r) && Object.defineProperty(e, r, { enumerable: !0, get: t[r] });
        }),
        (n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (function () {
            "use strict";
            n(460);
        })();
    })();



</script>

<!-- <script>
    // Example data - replace these with your dynamic data
    const loginCounts = @json($loginCounts); // Ensure this is the total logins per category

    const ctx = document.getElementById('login-history-chart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut', // Change to 'doughnut'
        data: {
            labels: @json($dates), // Each login date as a label
            datasets: [{
                label: 'Logins',
                data: loginCounts, // Total logins for each date
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    // Add more colors if needed
                ],
            }]
        },
        options: {
            responsive: true
        }
    });
</script> -->

<!-- <script>
    // Example data - replace these with your dynamic data
    const loginCounts = @json($loginCounts); // Ensure this is the total logins per category

    const ctx = document.getElementById('login-history-chart').getContext('2d');
    new Chart(ctx, {
        type: 'pie', // Change to 'pie'
        data: {
            labels: @json($dates), // Each login date as a label
            datasets: [{
                label: 'Logins',
                data: loginCounts, // Total logins for each date
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    // Add more colors if needed
                ],
            }]
        },
        options: {
            responsive: true
        }
    });
</script> -->

<script>
    // Example data - replace these with your dynamic data
    const loginHistoryData = {
        labels: @json($dates), // e.g., ["2024-09-19", "2024-09-13", "2024-07-20"]
        datasets: [{
            label: 'Logins',
            data: @json($loginCounts), // e.g., [1, 1, 1]
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
        }]
    };

    console.log(loginHistoryData); // Check your data structure

    const ctx = document.getElementById('login-history-chart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Change to 'bar'
        data: loginHistoryData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Logins'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Dates'
                    }
                }
            }
        }
    });
</script>



<script>
    // Prepare the data for CanvasJS
    var dates = @json($dates);  // Dates array from the controller
    var hours = @json($hours);  // Total working minutes for each day

    // Define the chart options for CanvasJS
    var chart = new CanvasJS.Chart("workingHoursChart", {
        theme: "light2", // Optional: Choose a theme
        title: {
            text: "Login Learn Hours per day"
        },
        axisX: {
            title: "Date",
            interval: 1,  // Optional: Control interval of X-axis ticks
        },
        axisY: {
            title: "Working Hours (Minutes)",
            includeZero: true,
        },
        data: [{
            type: "column", // Column type bar chart
            indexLabel: "{y} min", // Show the value on top of each bar
            dataPoints: (function() {
                // Prepare the dataPoints dynamically based on the dates and hours data
                var dataPoints = [];
                for (var i = 0; i < dates.length; i++) {
                    dataPoints.push({ label: dates[i], y: hours[i] });
                }
                return dataPoints;
            })()
        }]
    });

    // Render the chart
    chart.render();
</script>










    @include('layouts.user.footer')



