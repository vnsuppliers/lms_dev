<div class="rounded-3 p-2 bg-white">
<div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
<div class="tab-pane fade show active" id="v-pills" role="tabpanel" aria-labelledby="v-pills-course-edit-tab">
<div class="row align-items-center mb-2">
<div class="col-4 col-lg-2">
<div class="view-course-imagee">
@if($user->profile_image)
<img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="course-image">
@else
<img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="course-image">
@endif
</div>
</div>
<div class="col-8 col-lg-10 ps-0">
<div class="mb-1 course-name font-weight-bold">{{$user->first_name??''}}</div>
<div class="py-1 sub-categories-styles d-flex align-items-center" value="{{$user->category_details->id??''}}"><span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span><span class="ps-2">{{$user->last_name??''}}</span></div>
<div class="py-1 sub-categories-styles d-flex align-items-center" ><span class="dashed-border-category-icon" style="font-size: 9px;padding: 3px 5px;"><i class="fa-solid fa-calendar-days"></i></span><span class="ps-2">Created on : 25-07-2024</span></div>
</div>
</div>

<!-- <div class="">
<div class="view-course-imagee">
@if($user->profile_image)
<img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="">
@else
<img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
@endif
</div>
<h4>{{$user->first_name??''}}</h4>
</div> -->
<div class="mt-3">
<nav>
<div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
<button class="nav-link nav-linkk active" id="about-course-tab" data-bs-toggle="tab" data-bs-target="#about-course" type="button" role="tab" aria-controls="t1" aria-selected="true">About the User</button>
<button class="nav-link nav-linkk" id="t3-tab" data-bs-toggle="tab" data-bs-target="#t3" type="button" role="tab" aria-controls="t3" aria-selected="true">Assigned Users</button>
<!-- <button class="nav-link nav-linkk" id="t2-tab" data-bs-toggle="tab" data-bs-target="#t2" type="button" role="tab" aria-controls="t2" aria-selected="true">Learning Path</button> -->
<button class="nav-link nav-linkk" id="t4-tab" data-bs-toggle="tab" data-bs-target="#t4" type="button" role="tab" aria-controls="t4" aria-selected="true">Reports</button>
</div> 
</nav>


<div class="tab-content border-0 mt-0 p-0 admin-course-det-height height-100vh" id="myTabContent">
<div class="tab-pane fade show active card-border border-top-0" id="about-course" role="tabpanel" aria-labelledby="about-course-tab">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
            <div id="course-details">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-4">
                        <div class="form-group row my-3">
                            <div class="col-6 col-lg-2 my-auto">
                                <label class="mb-0">First Name</label>
                            </div>
                            <div class="col-6 col-lg-10 my-auto">
                                <span>{{$user->first_name??''}}</span>
                            </div>
                        </div>

                        <div class="form-group row my-3">
                            <div class="col-6 col-lg-2 my-auto">
                                <label class="mb-0">Last Name</span></label>
                            </div>
                            <div class="col-6 col-lg-10 my-auto">
                                <div class="d-flex align-items-center">
                                    <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span><span class="ps-2">{{$user->last_name??''}}</span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row my-3">
                            <div class="col-6 col-lg-2 my-auto">
                                <label class="mb-0">Employee Id</label>
                            </div>
                            <div class="col-6 col-lg-10 my-auto">
                                <span>{{$user->emp_id??''}}</span>
                            </div>
                        </div>

                                                                <div class="form-group row my-4">
                                                                    <div class="col-6 col-lg-2 my-auto">
                                                                        <label class="mb-0">Status</label>
                                                                    </div>
                                                                    <div class="col-6 col-lg-10 my-auto">
                                                                        <div class="d-flex align-items-center">
                                                                            @if($user->active==1)
                                                                                <span><i class="fa-solid fa-circle text-light-green fs10 pe-2"></i></span><span>
                                                                                    Active
                                                                                </span>
                                                                            @else
                                                                            <span><i class="fa-solid fa-circle text-danger fs10 pe-2"></i></span><span>
                                                                                In-Active
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>


    

                        <div class="form-group row my-4">
                            <div class="col-6 col-lg-2 my-auto">
                                <label class="mb-0">Email</label>
                            </div>
                            <div class="col-6 col-lg-10 my-auto">
                                <span>{{$user->email??'0'}}</span>
                            </div>
                        </div> 


                        <div class="form-group row my-4">
                            <div class="col-6 col-lg-2 my-auto">
                                <label class="mb-0">user_type</label>
                            </div>
                            <div class="col-6 col-lg-10 my-auto">
                                @php
            $userTypes = json_decode($user->user_type, true);
            $roles = \App\Models\Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
        @endphp

                                <span>@foreach($roles as $role)
                {{ $role??'' }}@if(!$loop->last), @endif
            @endforeach</span>
                            </div>
                        </div>
                </div>
            </div> 
        </div>
    </div>   
</div>
</div>
<div class="tab-pane fade border-top" id="t3" role="tabpanel" aria-labelledby="t3-tab">
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
        <div class="row">
            <div class="col-12 col-lg-9 my-auto">
                <div class="">
                    <form class="forms-sample" id="user_list_filter">
                <input type="hidden" id="hiddencourse_id" name="user_id" value="{{$user->id}}">
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
<th>User Trainer</th>
<th>Action</th>

</tr>
</thead>
<tbody id="user_filters_body">
<?php $i=1;?>
 @foreach ($groupedAssignedUsers as $userId => $assignedUsers)
        @php
            // Retrieve user details for the current user ID
            $userDetail = $userDetails[$userId] ?? null;
        @endphp

        @if ($userDetail)

<tr>

<td>
    <div class="row">
        <div class="col-lg-2">
            <div>
                @if(!empty($userDetail->profile_image))
                <img src="{{ url('storage/app/public/' . $userDetail->profile_image) }}" class="img-fluid" alt="">
                @else
                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                @endif
            </div>
        </div>
        <div class="col-lg-10 pl-0 my-auto">
            <div class="py-1 web-text-color font-weight-bold">{{$userDetail->first_name??''}} {{$userDetail->last_name??''}}</div>
            <div class="py-1 sub-categories-styles">{{$userDetail->email??''}}</div>
            <div class="py-1 sub-categories-styles">{{$userDetail->emp_id??''}}</div>
        </div>
    </div>
<div class="d-flex align-items-center">

<!-- @if(!empty($userDetail->profile_image))
<img src="{{ url('storage/app/public/' . $userDetail->profile_image) }}" class="img-fluid" alt="">
@else
<img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
@endif
<div class="pl-2">
<div class="py-1 web-text-color font-weight-bold">{{$userDetail->first_name??''}} {{$userDetail->last_name??''}}</div> -->

</div>
</div>
</td>
<td>{{$userDetail->departmentdetails->department_name??''}}</td>
<td>{{$userDetail->designationdetails->designation_name??''}}</td>
@php
            $userTypes = json_decode($userDetail->user_type, true);
            $roles = \App\Models\Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
        @endphp

        <td>
            @foreach($roles as $role)
                {{ $role??'' }}@if(!$loop->last), @endif
            @endforeach
        </td>
<td> 
                     <div>
                         <a href="javascript:;" 
                           class="btn sbmt-btn" 
                           style="cursor:pointer" 
                           data-id="{{ $userDetail->id ?? '' }}"
                           data-profile-image="{{ $userDetail->profile_image ?? '' }}"
                           data-first-name="{{ $userDetail->first_name ?? '' }}"
                           data-last-name="{{ $userDetail->last_name ?? '' }}"
                           data-email="{{ $userDetail->email ?? '' }}"
                           data-department="{{ $userDetail->departmentdetails->department_name ?? '' }}"
                           data-designation="{{ $userDetail->designationdetails->designation_name ?? '' }}"
                           data-course_name="{{$userDetail->course_name??''}}"
                           data-course_type="{{$userDetail->course_type??''}}"
                           onclick="openData(this)">
                           User Courses Assigned
                        </a>
                     </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>   
    </div>
</div>



<div class="tab-pane fade border-top-0" id="t4" role="tabpanel" aria-labelledby="t4-tab">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card1">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon1" style="padding: 5px 5px !important;"><i class="fa-solid fa-users"></i></div>
                            <div class="ms-3">
                                <h6>Total Assigned Users</h6>
                                <h6 class="text-center mb-0">{{$userDetailscount??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card2">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon2" style="padding: 4.5px 7px !important;"><i class="fa-solid fa-check"></i></div>
                             <div class="ms-3">
                                <h6>Total Assigned Courses</h6>
                                <h6 class="text-center mb-0">{{$coursesIdscount??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidepop feedback-saidepop p-2 courses-dataOverlay" id="courses-dataOverlay">
    
        
        
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
                url: "{{url('fetch_trainer_user_deta')}}?userid=" + userid,
                type: 'GET',
                dataType: 'html',
                success: function(response) {

                    $('.courses-dataOverlay').html(response);
                }
            });
        
         

        // Open the overlay
        $('#courses-dataOverlay').css({
            'width': '65%',
            'right': '10px'
        });
    }

    function closeData() {
        $('#courses-dataOverlay').css({
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