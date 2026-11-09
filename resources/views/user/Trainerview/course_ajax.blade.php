<div class="rounded-3 p-2 bg-white">
<div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
<div class="tab-pane fade show active" id="v-pills" role="tabpanel" aria-labelledby="v-pills-course-edit-tab">
<div class="row align-items-center mb-2">
<div class="col-4 col-lg-2">
<div class="view-course-imagee">
@if($course->course_image)
<img src="{{ url('storage/app/public/' . $course->course_image) }}" class="img-fluid" alt="course-image">
@else
<img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="course-image">
@endif
</div>
</div>
<div class="col-8 col-lg-10 ps-0">
<div class="mb-1 course-name font-weight-bold">{{$course->course_name??''}}</div>
<div class="py-1 sub-categories-styles d-flex align-items-center" value="{{$course->category_details->id??''}}"><span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span><span class="ps-2">{{$course->category_details->category_name}}</span></div>
<div class="py-1 sub-categories-styles d-flex align-items-center" ><span class="dashed-border-category-icon" style="font-size: 9px;padding: 3px 5px;"><i class="fa-solid fa-calendar-days"></i></span><span class="ps-2">Created on : 25-07-2024</span></div>
</div>
</div>

<!-- <div class="">
<div class="view-course-imagee">
@if($course->course_image)
<img src="{{ url('storage/app/public/' . $course->course_image) }}" class="img-fluid" alt="">
@else
<img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
@endif
</div>
<h4>{{$course->course_name??''}}</h4>
</div> -->
<div class="mt-3">
<nav>
<div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
<button class="nav-link nav-linkk active" id="about-course-tab" data-bs-toggle="tab" data-bs-target="#about-course" type="button" role="tab" aria-controls="about-course" aria-selected="true">About the Course</button>
<button class="nav-link nav-linkk" id="asignn-users-tab" data-bs-toggle="tab" data-bs-target="#asignn-users" type="button" role="tab" aria-controls="asignn-users" aria-selected="true">Assigned Users</button>
<!-- <button class="nav-link nav-linkk" id="learning-path-tab" data-bs-toggle="tab" data-bs-target="#learning-path" type="button" role="tab" aria-controls="learning-path" aria-selected="true">Learning Path</button> -->
<button class="nav-link nav-linkk" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-controls="reports" aria-selected="true">Reports</button>
<!-- <button class="nav-link nav-linkk active" id="about-course-tab" data-bs-toggle="tab" data-bs-target="#about-course" type="button" role="tab" aria-controls="t1" aria-selected="true">About the Course</button>
<button class="nav-link nav-linkk" id="t3-tab" data-bs-toggle="tab" data-bs-target="#t3" type="button" role="tab" aria-controls="t3" aria-selected="true">Assigned Users</button>
<button class="nav-link nav-linkk" id="t2-tab" data-bs-toggle="tab" data-bs-target="#t2" type="button" role="tab" aria-controls="t2" aria-selected="true">Learning Path</button>
<button class="nav-link nav-linkk" id="t4-tab" data-bs-toggle="tab" data-bs-target="#t4" type="button" role="tab" aria-controls="t4" aria-selected="true">Reports</button> -->
</div> 
</nav>


<div class="tab-content border-0 mt-0 p-0 admin-course-det-height height-100vh" id="myTabContent">
<div class="tab-pane fade show active card-border border-top-0" id="about-course" role="tabpanel" aria-labelledby="about-course-tab">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
            <div id="course-details">
                <div class="row">
                    <div class="col-8 my-auto">
                        <div class="d-flex align-items-center">

                            <div class="my-2 px-2">
                                <label class="course-details-inline-label">Course code</label>
                                <div class="course-details-inline border-left-3p-b1">
                                    <span>{{$course->course_code??''}}</span>
                                </div>
                            </div>

                            <div class="my-2 px-2">
                            <label class="course-details-inline-label">Due date</label>
                            <div class="course-details-inline border-left-3p-b2">
                                <span>{{date('d-m-Y',strtotime($course->expiration_date))}}</span>
                            </div>
                        </div>

                        <div class="my-2 px-2">
                            <label class="course-details-inline-label">Course status</label>
                            <div class="course-details-inline border-left-3p-b3">
                                <!-- @if($course->active==1)
                                    <span><i class="fa-solid fa-circle text-light-green fs10 pe-2"></i></span><span>
                                        Active
                                    </span>
                                @else
                                <span><i class="fa-solid fa-circle text-danger fs10 pe-2"></i></span><span>
                                    In-Active
                                </span>
                                @endif -->
                                In-progress
                            </div>
                        </div>

                            <div class="my-2 px-2">
                                <label class="course-details-inline-label">Course Level</label>
                                <div class="course-details-inline border-left-3p-b5">
                                    <span>{{$course->level??'0'}}</span>
                                </div>
                            </div>

                            <div class="my-2 px-2">
                                <label class="course-details-inline-label">Points</label>
                                <div class="course-details-inline border-left-3p-b6">
                                    <span>{{$course->points??'0'}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="my-2 px-3">
                                <label class="course-details-inline-label">Course Category</label>
                                <div class="course-details-inline border-0 d-inline-block">
                                    <span>{{$course->category_details->category_name??''}}</span>
                                </div>
                            </div>

                            <div class="my-2 px-3">
                                <label class="course-details-inline-label">Course Type</label>
                                <div class="course-details-inline border-0 d-inline-block">
                                    <span>@if($course->course_type==2) Instructor-led training @endif</span>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">

                    <!-- <div class="form-group row my-4">
                        <div class="col-6 col-lg-2">
                            <label class="mb-0">Description</label>
                        </div>
                        <div class="col-6 col-lg-10">
                            <span><?php echo $course->description??''; ?></span>
                        </div>
                    </div> -->
                    <div class="form-group row my-3">
                        <div class="col-12">
                             <label class="mb-2 font-weight-bold d-flex align-items-center"><i class="fa-regular fa-clipboard headings-icon fs-6"></i>Description</label>
                        </div>
                        <div class="col-12 px-2">
                            <div class="descrip-border px-2">
                                <div>
                                    <?php echo $course->description??''; ?>
                                </div>
                                <div>
                                    <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" width="10%" alt="">
                                    <div class="no-data-found-text">No data found</div>
                                </div>
                            </div>
                        </div>
                    </div>

                        @if($course->course_type==2)
                        <div class="form-group row my-4">
                            <div class="table-responsive">
                           <table class="table">

                            <thead>
                                <tr>
                                    <th>Trainer Name</th>
                                    <th>Training Date</th>
                                    <th>Timing - From</th>
                                    <th>Timing - To</th>
                                    <th>Duration</th>
                                    <th>Location</th>

                                </tr>
                            </thead>
                            <tbody id="trainer_details_list">
                                @foreach($course->training_details as $train)
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

 

                    <!-- <div class="form-group row my-3">
                        <div class="col-12">
                            <label class="mb-2 font-weight-bold d-flex align-items-center"><i class="fa-regular fa-clipboard headings-icon fs-6"></i>Description</label>
                        </div>
                        <div class="col-12 px-0">
                            <div class="descrip-border">
                                <?php echo $course->description??''; ?>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row my-4">
                        <div class="col-12">
                            <label class="mb-2 d-flex align-items-center"><i class="fa-solid fa-paperclip headings-icon"></i>Course Content</label>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="brd">
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Link / File
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="upload_files_list">
                                    @if(isset($course->documents_details))
                                    @foreach($course->documents_details as $doc)
                                    <tr>
                                        <td>@if($doc->type==1)
                                            Amazon Link
                                            @elseif($doc->type==2)
                                            Youtube Link
                                            @elseif($doc->type==3)
                                            Local Video
                                            @elseif($doc->type==4)
                                            Scorm Video
                                            @elseif($doc->type==5)
                                            Attachments
                                            @elseif($doc->type==6)
                                            Assessment
                                        @endif</td>

                                        <td>
                                             @if($doc->type==5)
                                                        <a class="dropdown-item" href="{{url('storage/app/public/'.$doc->file_path)}}"><i class="fa-solid fa-eye pr-2"></i> View</a>
                                                        @elseif($doc->type == 3 || $doc->type == 4)
                                                        {{ basename($doc->file_path) }}
                                                        @else
                                                        {{ $doc->file_path }}
                                                        @endif
                                    </td>
                                        <td>
                                             <div class="dropdown text-center">
                                                <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="vm-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu vm-menu" aria-labelledby="vm-dropdown">
                                                    <li>
                                                       
                                                    </li> 
                                                    <li><a class="dropdown-item" href="{{url('delete_document')}}?id={{$doc->id}}" title="{{__('Delete')}}" onclick="return confirm('Are you sure?')" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                            <!-- <a href="{{url('delete_document')}}?id={{$doc->id}}" onclick="return confirm('Are you sure?')" class="btn btn-danger buttonn">Delete</a> -->
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
        </div>
    </div>   
</div>
</div>
<div class="tab-pane fade border-top" id="asignn-users" role="tabpanel" aria-labelledby="asignn-users-tab">
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
        <div class="row">
            <div class="col-12 col-lg-9 my-auto">
                <div class="">
                    <form class="forms-sample" id="user_list_filter">
                <input type="hidden" id="hiddencourse_id" name="course_id" value="{{$course->id}}">
                <div class="dropdown">
                   <button id="filtersButton" class="btn filters-btnn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-filter"></i>
                    
                   Filters 
                   <span id="filtersIndicator" class="filters-indicator"></span>
                   <!-- <i id="filtersIndicator" class="fa fa-circle filters-dot-icon"></i> -->
                    </button>
                    <button type="button" class="btn sbmt-btn ms-2 reset_filter_button" style="display: none;">Reset</button>
                    <ul class="dropdown-menu filters-dropdown-menuu px-3 w-100">
                    <div class="form-group row">
                        <div class="col-sm-4 my-2">
                            <label>Designation</label>
                            <select name="designation" class="user_filter  form-select-control">
                                <option value="">Select Designation</option>
                                @foreach($designations as $designation)
                                <option value="{{$designation->id??''}}" >{{$designation->designation_name??''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 my-2">
                            <label>Department</label>
                            <select name="department" class="user_filter  form-select-control">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id??''}}" >{{$department->department_name??''}}</option>
                                @endforeach
                            </select>
                        </div>

<!--                         <div class="col-sm-4 my-2">
                            <label>Assigned status</label>
                            <select  class="js-example-basic-single form-select-control user_filter" name="assigned_status">
                                <option value="" selected>Status</option>
                                <option value="0" @if(isset($request) && $request->assigned_status == 0 && $request->assigned_status !="") selected @endif>UnAssigned</option>
                                <option value="1" @if(isset($request) && $request->assigned_status == 1 ) selected @endif>Assigned</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="col-12 my-2 px-0">
                        <div class="text-end">
                             <button type="button" class="btn sbmt-btn user_filter_button">Submit</button>
                         </div>
                    </div>
                </ul>
                </div>
            </form>
                </div>
            </div>
            <div class="col-12 col-lg-3 my-auto">
                <div class="d-flex">
 <input type="text" class="form-control course_user_search_data" name="course_user_search_data" placeholder="Search">
 <div class="input-group-append">
      <span class="input-group-text" style="height: 40px;">
        <button type="submit" class="bi bi-search border-0 search_course_to_user_button"></button>
    </span>
</div>
</div>
            </div>
        </div>
        <div class="table-responsive">
<table class="table mt-2" style="width:100%">
<thead>
<tr>
<th>User Details</th>
<th>Department</th>
<th>Designation</th>
<th>User Type</th>
<th>Assigned at</th>
<th>Action</th>

</tr>
</thead>
<tbody id="user_filters_body">
<?php $i=1;?>
@foreach($assignedUser as $user)

<tr>

<td style="width: 200px;">
    <div class="d-flex align-items-center">
        <div class="profile-image-div-sm">
            <div>
                @if(!empty($user->users_data->profile_image))
                <img src="{{ url('storage/app/public/' . $user->users_data->profile_image) }}" class="img-fluid" alt="">
                @else
                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                @endif
            </div>
        </div>
        <div class="ms-2">
            <div class="py-1 web-text-color font-weight-bold text-truncate" style="width: 200px;">{{$user->users_data->first_name??''}} {{$user->users_data->last_name??''}}</div>
            <div class="py-1 sub-categories-styles text-truncate">{{$user->users_data->email??''}}</div>
        </div>
    </div>
</td>
<td>{{$user->users_data->departmentdetails->department_name??''}}</td>
<td>{{$user->users_data->designationdetails->designation_name??''}}</td>

        @php
            $userTypes = json_decode($user->users_data->user_type, true);
            $roles = \App\Models\Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
        @endphp

        <td>
            @foreach($roles as $role)
                {{ $role??'' }}@if(!$loop->last), @endif
            @endforeach
        </td>
<td>
@if(isset($user->created_at))
        @php
            $createdAt = new DateTime($user->created_at);
            $createdAt->setTimezone(new DateTimeZone('Asia/Kolkata'));
            $formattedDate = $createdAt->format('F j, Y g:i a \I\S\T');
        @endphp
        {{ $formattedDate }}
    @else
        No Assigned Data
    @endif
    </td>
<td> 
                     <div>
                         <a href="javascript:;" 
                           class="btn sbmt-btn" 
                           style="cursor:pointer"
                           data-id="{{ $user->users_data->id ?? '' }}" 
                           data-profile-image="{{ $user->users_data->profile_image ?? '' }}"
                           data-first-name="{{ $user->users_data->first_name ?? '' }}"
                           data-last-name="{{ $user->users_data->last_name ?? '' }}"
                           data-email="{{ $user->users_data->email ?? '' }}"
                           data-department="{{ $user->users_data->departmentdetails->department_name ?? '' }}"
                           data-designation="{{ $user->users_data->designationdetails->designation_name ?? '' }}"
                           data-course_name="{{$course->course_name??''}}"
                           data-course_type="{{$course->course_type??''}}"
                           onclick="openData(this)">
                           Assessments and Certificates
                        </a>
                     </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>   
    </div>
</div>

<div class="tab-pane fade" id="learning-path" role="tabpanel" aria-labelledby="learning-path-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border border-top-0 shadow-none rounded-0">
                <div class="card-body p-2 rounded-0">
                    <!-- <div>
                        <form class="forms-sample">
                            <div class="dropdown mb-2">
                                <button class="btn btn-md btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filters
                                </button>
                                <ul class="dropdown-menu px-2 w-100">
                                    <div class="form-group row">
                                        <div class="col-sm-4 pr-1">
                                            <select class="js-example-basic-single form-select-control">
                                                <option value="AL">Select a Category</option>
                                                <option value="WY">User-type</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 px-1">
                                            <select class="js-example-basic-single form-select-control">
                                                <option value="AL">Select a Sub Category</option>
                                                <option value="WY">User-type</option>
                                            </select>
                                        </div>
                                        <div class="input-group col-sm-4 pl-1">
                                            <input type="text" class="form-control" placeholder="Search" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </form>
                    </div> -->
                    <div class="work-in-prog">Work In Progress</div>
                </div>           
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade border-top-0" id="reports" role="tabpanel" aria-labelledby="reports-tab">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
            @if($course->course_type == 2)
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card1">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon1"><i class="fa-solid fa-book-open-reader"></i></div>
                            <div class="ms-3">
                                <h6>Total No of learners</h6>
                                <h6 class="text-center mb-0">{{count($assignedUser)??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card2">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon2"><i class="fa-solid fa-user-check"></i></div>
                             <div class="ms-3">
                                <h6>Total No of Attended</h6>
                                <h6 class="text-center mb-0">{{count($attend)??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card3">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-xmark"></i></div>
                             <div class="ms-3">
                                <h6>Total No of Not Attended</h6>
                                <h6 class="text-center mb-0">{{count($notattend)??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card4">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon4"><i class="fa-solid fa-user-slash"></i></div>
                             <div class="ms-3">
                                <h6>Total No of Not Response</h6>
                                <h6 class="text-center mb-0">{{count($notresponce)??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="mb-3 d-flex justify-content-between">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Total no of learners</th>
                                <th>Total no of Attended</th>
                                <th>Total no of Not Attended</th>
                                <th>Total no of Not Response</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{count($assignedUser)??'0'}}</td>
                                <td>{{count($attend)??'0'}}</td>
                                <td>{{count($notattend)??'0'}}</td>
                                <td>{{count($notresponce)??'0'}}</td>

                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div> -->
            


          
            <!-- <div class="mb-3 d-flex justify-content-between">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Assigned to no of users</th>
                                <th>Completed</th>
                                <th>In-Progress</th>
                                <th>Pending</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{count($assignedUser)}}</td>
                                <td>{{count($completed_course)}}</td>
                                <td>{{count($attend)}}</td>
                                <td>{{count($notresponce)}}</td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div> -->
        

<div class="table-responsive mt-4">

@endif
</div>
</div>
</div>

                    <div class="tab-pane fade border-top-0" id="t5" role="tabpanel" aria-labelledby="t5-tab">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
         
            <div class="mb-3 d-flex justify-content-between">
                 <table class="table mt-2" style="width:100%">
<thead>
<tr>
<th scope="col">Group Name</th>
<th>Assign To User</th>

</tr>
</thead>
<tbody id="user_filters_body">
<?php $i=1;?>
@foreach($groups_lists as $group)

<tr>

<td scope="row ">
<div class="d-flex align-items-center">


<div class="pl-2">
<div class="py-1">{{$group->name??''}}</div>

</div>
</div>
</td>

<td> 
               

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input toggle-class group_check_ajax"
                                id="toggle-{{ $group->id }}group_assined"
                                data-group_id="{{ $group->id }}"
                                data-category_id="{{$group->id}}"
                                data-course_id="{{$course->id}}"
                                @if(!empty($group->assignedUsers->toArray())) Checked @endif 

                                > 
                                <label class="custom-control-label" for="toggle-{{ $group->id }}group_assined"></label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>


</div>
</div>
</div>

</div>

<div class="sidepop feedback-saidepop p-2 courses-dataOverlayss" id="courses-dataOverlayss">
   
</div>
</div>
</div>
<!-- <div class="modal fade" id="excel_upload" tabindex="-1">
<div class="modal-dialog" role="document">
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
    <button type="submit" class="btn btn-primary upload_feedback_submit">Submit</button>
    
</form>
</div>

</div>
</div>
</div> -->

<div class="modal fade" id="excel_upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="excel--upload" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="excel--upload">Upload Feedback</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form id="upload_feedback_form" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" class="form-control" name="assined_id" id="assined_id" style="height: 37px !important;">
<input type="hidden" class="form-control" name="course_id" id="course_id" style="height: 37px !important;">
<input type="file" class="form-control" name="document" accept=".pdf" required style="height: 37px !important;">
</form>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-md btn-primary upload_feedback_submit m-0">Submit</button>
</div>
</div>
</div>
</div>

<script>
   function openData(element) {
       var userid = $(element).data('id');
      
           //alert(userid);
            $.ajax({
                url: "{{url('fetch_trainer_user_assessments')}}?userid=" + userid,
                type: 'GET',
                dataType: 'html',
                success: function(response) {

                    $('.courses-dataOverlayss').html(response);
                }
            });
         

        // Open the overlay
        $('#courses-dataOverlayss').css({
            'width': '65%',
            'right': '10px'
        });
    }

    function closeData() {
        $('#courses-dataOverlayss').css({
            'width': '0',
            'right': '-32px'
        });
    }

    // Bind the close function to the close button
    $(document).ready(function() {
        $('.closebtn').on('click', closeData);
    });
</script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/plugins/ckfinder/ckfinder.js')}}"></script>

<script>
    CKEDITOR.replace('feedback-editor');
</script>  