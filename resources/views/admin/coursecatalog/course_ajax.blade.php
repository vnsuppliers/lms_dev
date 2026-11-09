<div class="rounded-0 p-2 mt-1 bg-white">
    <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills" role="tabpanel" aria-labelledby="v-pills-course-edit-tab">
            <div class="row mb-2">
                <div class="col-4 col-lg-11">
                    <div class="d-flex align-items-center">
                        <div class="view-course-imagee">
                        @if($course->course_image)
                        <img src="{{ url('storage/app/public/' . $course->course_image) }}" class="img-fluid" alt="course-image">
                        @else
                        <img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="course-image">
                        @endif
                        </div>
                        <div class="ps-3">
                            <div class="mb-1 course-name font-weight-bold">{{$course->course_name??''}}</div>
                            <div class="py-1 sub-categories-styles d-flex align-items-center" value="{{$course->category_details->id??''}}"><span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span><span class="ps-2">{{$course->category_details->category_name??''}}</span></div>
                            <div class="py-1 sub-categories-styles d-flex align-items-center" ><span class="dashed-border-category-icon" style="font-size: 9px;padding: 3px 5px;"><i class="fa-solid fa-calendar-days"></i></span><span class="ps-2">Created on : <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($course->created_at))->format('M d, Y'); ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-1">
                    @if(hasPermission(3))
                        <div class="dropdown d-flex justify-content-end">
                            <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu vm-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{url('coursecatalog?tab=1')}}&id={{$course->id}}&edit=1"><i class="fa-solid fa-pen-to-square pr-2"></i> Edit</a></li> 
                                <li><a class="dropdown-item" href="{{url('coursecatalog?tab=1')}}&clone_course={{$course->id}}"><i class="fa-solid fa-copy fs-6 pr-2" style="margin-right: 2px;"></i>Clone Course </a></li>
                                <!-- onclick="openSidepop()" -->
                                <!--<li><a class="dropdown-item delete-courses-link" href="{{url('delete_admin_courses')}}?id={{$course->id}}" title="{{__('Delete')}}" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>-->
                                <li>
                                    <a href="javascript:void(0);"
                                    class="dropdown-item course-delete-btn"
                                    data-toggle="modal"
                                    data-target="#deleteCourseModal"
                                    data-id="{{ $course->id }}"
                                    data-name="{{ $course->course_name }}">
                                        <i class="fa-solid fa-trash me-2"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3" id="course_ajax_pop">
                <nav>
                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                        <button class="nav-link nav-linkk active" id="about-course-tab" data-bs-toggle="tab" data-bs-target="#about-course" type="button" role="tab" aria-controls="about-course" aria-selected="true">About the Course</button>
                        {{-- @php dump('COURSE ID => '.$course->id); @endphp --}}
                        <button class="nav-link nav-linkk" id="course-content-tab" data-bs-toggle="tab" data-bs-target="#course-content" type="button" role="tab" aria-controls="course-content" aria-selected="true">Course Content</button>
                        <button class="nav-link nav-linkk" id="assign-users-subtab" data-bs-toggle="tab" data-bs-target="#assignUsersSubTab" type="button" role="tab" aria-controls="assignUsersSubTab" aria-selected="true">Assign Users</button>
                        <!-- <button class="nav-link nav-linkk" id="learning-path-tab" data-bs-toggle="tab" data-bs-target="#learningPath" type="button" role="tab" aria-controls="learningPath" aria-selected="true">Learning Path</button> -->
                        <button class="nav-link nav-linkk" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-controls="reports" aria-selected="true">Reports</button>
                        <button class="nav-link nav-linkk" id="manage-groups-tab" data-bs-toggle="tab" data-bs-target="#manageGroups" type="button" role="tab" aria-controls="manageGroups" aria-selected="true">Manage Groups Assign</button> 
                    </div> 
                </nav>

                <div class="tab-content border-0 mt-0 pl-0 py-0 pr-1 admin-course-det-height height-100vh" id="myTabContent">
                    <div class="tab-pane fade show active card-border border-top-0" id="about-course" role="tabpanel" aria-labelledby="about-course-tab">

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
                                <div id="course-details">
                                    <div class="row">
                                        <div class="col-12 col-lg-7 my-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="my-2 pl-1 pr-3">
                                                    <label class="course-details-inline-label">Course code</label>
                                                    <div class="course-details-inline border-left-3p-b1 course-code_in_courses">
                                                        <span>{{$course->course_code??''}}</span>
                                                    </div>
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label class="course-details-inline-label">Due date</label>
                                                    <div class="course-details-inline border-left-3p-b3">
                                                        <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($course->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($course->expiration_date))->format('M d, Y'); ?></span>
                                                    </div>
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label class="course-details-inline-label">Course Level</label>
                                                    <div class="course-details-inline border-left-3p-b4 text-uppercase">
                                                        <span>{{$course->level??'0'}}</span>
                                                    </div>
                                                </div>

                                                <div class="my-2 px-3">
                                                    <label class="course-details-inline-label">Points</label>
                                                    <div class="course-details-inline border-left-3p-b5">
                                                        <span>{{$course->points??'0'}}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-5">
                                            <div class="mt-2 mb-3 px-3">
                                                <label class="course-details-inline-label">Course status</label>
                                                <div class="course-details-inline border-0 d-inline-block border-left-3p-b6 py-0 mt-1 rounded-0 ps-2">
                                                    @if($course->active==1)
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

                                            <div class="mt-2 mb-3 px-3">
                                                <label class="course-details-inline-label">Course Type</label>
                                                <div class="course-details-inline border-0 d-inline-block border-left-3p-b7 py-0 mt-1 rounded-0 ps-2">
                                                    <span>@if($course->course_type==2) Instructor-led training @else Online Training @endif</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mt-2">
                                                <div class="col-12">
                                                     <label class="mb-0 font-weight-bold d-flex align-items-center headings-bg-gradient"><i class="fa-regular fa-clipboard headings-icon fs-6"></i>Description</label>
                                                </div>
                                                <div class="col-12 px-2">
                                                    <div class="descrip-border px-1">
                                                        @if(isset($course->description))
                                                        <div>
                                                            <?php echo $course->description??''; ?>
                                                        </div>
                                                        @else
                                                        <div>
                                                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" width="25%" alt="">
                                                            <div class="no-data-found-text">No data found</div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @if($course->course_type==2)
                                                <div class="form-group row mt-4">
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
                                        </div>

                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>

                    <div class="tab-pane fade border-top" id="assignUsersSubTab" role="tabpanel" aria-labelledby="assign-users-subtab">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-2 pr-2">
                                <div class="row">
                                    <div class="col-12 col-lg-9 my-auto">
                                        <div class="">
                                            <form class="forms-sample" id="user_list_filter">
                                                <input type="hidden" id="hiddencourse_id" name="course_id" value="{{$course->id}}">
                                                <div class="dropdown">
                                                    <button id="filtersButton" class="btn filterBtn filters-btnn dropdown-toggle" type="button"><i class="bi bi-filter"></i>
                                                        Filters 
                                                        @if($category_department > 0)
                                                        <span id="filtersIndicator" class="filters-indicator filters-active"></span>
                                                        @else
                                                         <span id="filtersIndicator" class="filters-indicator" style="display: none;" ></span>
                                                        @endif 
                                                    </button>
                                                    @if($category_department > 0)
                                                    <button type="button" class="btn sbmt-btn ms-2 reset_filter_button">Reset</button>
                                                    @else
                                                    <button type="button" class="btn sbmt-btn ms-2 reset_filter_button" style="display:none;">Reset</button>
                                                      @endif
                                                    <div class="dropdown-menu filters-dropdown-menuu filterMenu px-3 w-100" style="display: none;">
                                                        <div class="form-group row">

                                                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                                                <label class="form-check-label ms-0 mb-2">Department</label>

                                                                <select class="form-control multiple_select user_filter" name="department[]" id="department" multiple>
                                                                    @foreach($departments as $department)
                                                                        <option value="{{$department->id}}" 
                                                                            @if(in_array($department->id, old('department', []))) selected @endif>
                                                                            {{$department->department_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                                                <label class="form-check-label ms-0 mb-2">Designation</label>

                                                                <select class="form-control multiple_select user_filter" name="designation[]" id="designation" multiple>
                                                                    @foreach($designations as $designation)
                                                                        <option value="{{$designation->id}}" 
                                                                            @if(in_array($designation->id, old('designation', []))) selected @endif>
                                                                            {{$designation->designation_name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>    
                                                        </div>

                                                              <div class="form-group row">

                                                                <div class="col-12 col-sm-12 col-md-6 my-2">
                                                                <label class="form-check-label ms-0 mb-2">User Type</label>

                                                                <select class="form-control multiple_select user_filter" name="user_type[]" id="user_type" multiple>
                                                                    @foreach($roles as $role)
                                                                        <option value="{{$role->id}}" 
                                                                            @if(in_array($role->id, old('user_type', []))) selected @endif>
                                                                            {{$role->role}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                           
                                                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                                                <label class="form-check-label ms-0 mb-2">Assigned status</label>
                                                                <select class="form-control user_filter" name="assigned_status">
                                                                    <option value="" selected>All</option>
                                                                    <option value="0" @if(isset($request) && $request->assigned_status == 0 && $request->assigned_status !="") selected @endif>UnAssigned</option>
                                                                    <option value="1" @if(isset($request) && $request->assigned_status == 1 ) selected @endif>Assigned</option>
                                                                </select>
                                                            </div>

                                                            
                                                            
                                                        </div>

                                                        <div class="col-12 my-2 px-0">
                                                            <div class="text-end">

                                                                <button id="filtersButton" class="btn filterBtn cancel-btn mr-2" type="button">

                                                        Cancel 
                                                       
                                                    </button>
                                                                 <button type="button" class="btn sbmt-btn submitBtn user_filter_button">Apply</button>
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 my-auto">
                                        <div class="d-flex">
                                            <input type="text" class="form-control course_user_search_da" name="course_user_search_data"  placeholder="Search">
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
            <th style="width: 220px;">User Details</th>
            <th>Department</th>
            <th>Designation</th>
            <th>User Type</th>
            <th>Assign To User</th>
            <th>Assignment Exam</th>
        </tr>
    </thead>
    <tbody id="user_filters_body">
        <?php $i=1;?>
        @foreach($users_lists as $user)
        <tr>
            <td  style="width: 220px;">
                <div class="d-flex align-items-center">
                   <div class="profile-image-div-sm">
                         @if(!empty($user->profile_image))
                                <img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="Profile Image">
                            @else

                                <img src="{{ getUserImage($user->first_name,$user->last_name) }}" class="img-fluid" alt="Default Image">
                            @endif
                    </div>
                    <div class="ms-2">
                        <div class="py-1 profilee-namee">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</div>
                        <div class="sub-text">{{ $user->email ?? '' }}</div>
                    </div>
                </div>
            </td>
            <td>{{ $user->departmentdetails->department_name ?? '' }}</td>
            <td>{{ $user->designationdetails->designation_name ?? '' }}</td>
            <td> 
                @if(!empty($user->role_names))
                    {{ implode(', ', $user->role_names) }}
                @else
                    No Roles
                @endif
            </td>
            <td> 
                <div class="custom-control custom-switch mb-2">
                    <input type="checkbox" class="custom-control-input toggle-class user_single_check_ajax"
                    id="toggle-{{ $user->id }}assined"
                    data-user_id="{{ $user->id }}"
                    data-category_id="{{ $user->id }}"
                    data-course_id="{{ $course->id }}"
                    @if(!empty($user->assigned_users)) Checked @endif 
                    > 
                    <label class="custom-control-label" for="toggle-{{ $user->id }}assined"></label>
                </div>
                <div>
                    @if(!empty($user->assigned_users))
                        @php
                            $createdAt = $user->assigned_users->created_at;
                            $formattedDate = $createdAt ? \Carbon\Carbon::parse($createdAt)->format('M d, Y') : '';
                        @endphp
                        Assigned Date: {{ $formattedDate }}
                    @endif
                </div>
            </td>
            <td>
                @php
                    $hasValidExam = false;
                    if (!empty($user->assigned_users->assigned_exam_datas)) {
                        foreach ($user->assigned_users->assigned_exam_datas as $ad) {
                            if (!empty($ad->exam_details) && !empty($ad->exam_details->id)) {
                                $hasValidExam = true;
                                break;
                            }
                        }
                    }
                @endphp

               @if($hasValidExam)
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#examModal{{$user->id}}">
                    View Exam
                </button>
                    <div class="modal fade" id="examModal{{$user->id}}" tabindex="-1" aria-labelledby="examModalLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="examModalLabel{{$user->id}}">Assigned Exams</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Exam Result</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->assigned_users->assigned_exam_datas as $assignment)
                                                <tr>
                                                    <td>{{ $assignment->exam_details->name ?? 'N/A' }}</td>
                                                    <td>{{ $assignment->exam_result ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($assignment->exam_result != 'Pending')
                                                            <a href="{{ route('admin.exams.Resultview') }}?course_id={{ $course->id }}&exam_name={{ urlencode(optional($assignment->exam_details)->exam_code ?? '') }}&ex_c={{ $assignment->exam_details->id ?? '' }}&user_id={{ $user->id }}&attempt_id={{ $assignment->id }}" target="_blank" class="btn btn-primary">
                                                                View Result
                                                            </a>
                                                        @else
                                                            {{ 'Waiting for evaluation' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <span class="btn btn-sm btn-outline-secondary disabled">Not Attempted</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                                </div>
                            </div>   
                        </div>
                    </div>

                    <div class="tab-pane fade" id="learningPath" role="tabpanel" aria-labelledby="learning-path-tab">
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
                        <div class="row mx-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-2">
                                @if($course->course_type == 2)
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                            <div class="reports-card reports-card1">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="reports-icon reports-icon1"><i class="fa-solid fa-book-open-reader"></i></div>
                                                    <div class="ms-3">
                                                        <h6>No of learners</h6>
                                                        <h6 class="text-center mb-0">{{count($assignedUser)??'0'}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                            <div class="reports-card reports-card2">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="reports-icon reports-icon2"><i class="fa-solid fa-user-check"></i></div>
                                                     <div class="ms-3">
                                                        <h6>No of Attended</h6>
                                                        <h6 class="text-center mb-0">{{count($attend)??'0'}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                            <div class="reports-card reports-card3">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-xmark"></i></div>
                                                     <div class="ms-3">
                                                        <h6>Not Attended</h6>
                                                        <h6 class="text-center mb-0">{{count($notattend)??'0'}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                            <div class="reports-card reports-card4">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="reports-icon reports-icon4"><i class="fa-solid fa-user-slash"></i></div>
                                                     <div class="ms-3">
                                                        <h6>Not Response</h6>
                                                        <h6 class="text-center mb-0">{{count($notresponce)??'0'}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mt-1" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 200px;">Name</th>
                                                    <th>Designation</th>
                                                    <th>Department</th>
                                                    <th>User Status</th>
                                                    <th>User Upload List</th>
                                                    <th>Admin Upload List</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($assignedUser as $user)
                                                <tr>
                                                    <td style="width: 200px;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="profile-image-div-sm">
                                                                
                                                                    @if(!empty($user->users_data->profile_image))
                                <img src="{{ url('storage/app/public/' . $user->users_data->profile_image) }}" class="img-fluid" alt="Profile Image">
                            @else

                                <img src="{{ getUserImage($user->users_data->first_name,$user->users_data->last_name) }}" class="img-fluid" alt="Default Image">
                            @endif
                                                               
                                                            </div>
                                                            <div class="ms-2">
                                                                <div class="py-1 web-text-color font-weight-bold text-truncate">{{$user->users_data->first_name??''}} </div>
                                                                <div class="py-1 sub-categories-styles text-truncate">{{$user->users_data->email??''}}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>@if($user->status==1) Attended @elseif($user->status==2) Not Attended @endif</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="user_upload_list">
                                                        @foreach($user->user_offline_documents as $doc)
                                                        <a href="{{url('storage/app/public/'.$doc->document_path)}}" download class="btn btn-sm btn-outline-primary text-muted text-nowrap">{{$doc->document_name}}</a>
                                                        @endforeach
                                                    </td>
                                                    <td class="admin_upload_list">
                                                        @foreach($user->admin_offline_documents as $doc)
                                                        <a href="{{url('storage/app/public/'.$doc->document_path)}}" download class="btn btn-sm btn-outline-primary text-muted text-nowrap">{{$doc->document_name}}</a>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <input type="text" name="assessment_path" class="form-control assessment_path mb-2" data-id="{{$user->id}}" value="{{$user->assessment_path??''}}" placeholder="Assessment Path">


                                                        <a class="btn sbmt-btn excel_upload add_work btn-sm text-white" data-bs-toggle="modal" data-bs-target="#excel_upload" data-id="{{$user->id}}" data-course_id="{{$course->id}}" data-dismiss="modal"> Upload Feedback</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                        <div class="reports-card reports-card1">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <div class="reports-icon reports-icon1"><i class="fa-solid fa-users"></i></div>
                                                <div class="ms-3">
                                                    <h6>Users Assigned</h6>
                                                    <h6 class="text-center mb-0">{{count($assignedUser)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                        <div class="reports-card reports-card2">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <div class="reports-icon reports-icon2"><i class="fa-solid fa-check"></i></div>
                                                 <div class="ms-3">
                                                    <h6>Completed</h6>
                                                    <h6 class="text-center mb-0">{{count($completed_course)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                        <div class="reports-card reports-card3">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <div class="reports-icon reports-icon3"><i class="fa-solid fa-spinner"></i></div>
                                                 <div class="ms-3">
                                                    <h6>In-Progress</h6>
                                                    <h6 class="text-center mb-0">{{count($attend)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 my-2 px-1">
                                        <div class="reports-card reports-card4">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <div class="reports-icon reports-icon4"><i class="bi bi-clock-history"></i></div>
                                                 <div class="ms-3">
                                                    <h6>Pending</h6>
                                                    <h6 class="text-center mb-0">{{count($notresponce)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 px-1">
                                    <nav>
                                        <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                            <button class="nav-link nav-linkk active" id="completed-users-tab" data-bs-toggle="tab" data-bs-target="#completedUsers" type="button" role="tab" aria-controls="completedUsers" aria-selected="true">Completed Users <span class="ps-1">- {{count($completed_course) ??''}}<span></button>
                                            <button class="nav-link nav-linkk" id="inprogress-users-tab" data-bs-toggle="tab" data-bs-target="#inprogressUsers" type="button" role="tab" aria-controls="inprogressUsers" aria-selected="true">Inprogress Users <span class="ps-1">- {{count($attend) ??''}}<span></button>
                                            <button class="nav-link nav-linkk" id="pending-users-tab" data-bs-toggle="tab" data-bs-target="#pendingUsers" type="button" role="tab" aria-controls="pendingUsers" aria-selected="true">Pending Users <span class="ps-1">- {{count($notresponce)??''}}<span></button>
                                        </div> 
                                    </nav>

                                    <div class="tab-content border-0 mt-0 p-0" id="myTabContent">
                                        <div class="tab-pane fade show active border-top" id="completedUsers" role="tabpanel" aria-labelledby="completed-users-tab">
                                            <div class="table-responsive mt-2">
                                                <!-- <label class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check headings-icon py-1"></i>Completed Users </label> -->
                                                <div class="table-responsive">
                                                   <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="max-width: 250px;">Name</th>
                                                                <!-- <th>Emp ID</th> -->
                                                                <th>Designation</th>
                                                                <th>Department</th>
                                                                <th>Result</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                                        @foreach($completed_course as $user)
                                                            @php
                                                                $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
                                                                $assessments_html = '<div class="d-flex flex-column" style="gap: 8px;">';

                                                                if (empty($user->course_details->assessments) || $user->course_details->assessments->isEmpty()) {
                                                                    $assessments_html .= '<span class="text-muted fst-italic" style="font-size: 12px;">No assessments assigned</span>';
                                                                } else {
                                                                    foreach ($user->course_details->assessments as $assess) {
                                                                        $results = $reportAssessmentResults->get($assess->id . ':' . $user->user_id, collect());

                                                                        $attemptsCount = min(3, $results->count());
                                                                        $passedAttempt = $results->sortBy('id')->values()->first(fn ($attempt) => $attempt->hasPassed());
                                                                        $latestResult = $results->sortByDesc('id')->first();
                                                                        $resultData = $latestResult ? json_decode($latestResult->result_data, true) : null;
                                                                        $passOrFail = $passedAttempt ? 'Passed' : ($resultData['results']['pass_or_fail'] ?? 'Not Attempted');

                                                                        $result_btn = '';
                                                                        if ($latestResult) {
                                                                            $link = explode('/', $assess->file_path);
                                                                            $code = ($passedAttempt ? $passedAttempt->code : $latestResult->code) ?? "";
                                                                            $result_link = "{$link[0]}/{$link[1]}/results/{$code}";
                                                                            $returnUrl = url('coursecatalog?tab=2');
                                                                            $result_btn = '<a href="javascript:;" data-course-id="' . $course->id . '" data-link="' . rtrim($assessmentBaseUrl, '/') . '/start_assessment?url=' . $result_link . '&email=' . ($user->users_data->email ?? '') . '&username=' . ($user->users_data->username ?? '') . '&first_name=' . ($user->users_data->first_name ?? '') . '&last_name=' . ($user->users_data->emp_id ?? '') . '&course_id=' . $assess->id . '&assign_id=' . $user->id . '&return_url=' . urlencode($returnUrl) . '&lms_url=' . urlencode(url('/')) . '" class="btn btn-sm btn-outline-primary py-0 px-2 take_result" style="font-size: 11px; height: 26px; line-height: 24px;"><i class="fa-solid fa-eye me-1"></i>View Result</a>';
                                                                        }

                                                                        $status_badge = '';
                                                                        if ($resultData) {
                                                                            $ordinal = [1 => '1st', 2 => '2nd', 3 => '3rd'];
                                                                            if ($passOrFail === 'Passed' && $passedAttempt) {
                                                                                $passedIndex = $results->sortBy('id')->values()->search(fn ($att) => $att->id === $passedAttempt->id);
                                                                                $attemptNum = min(3, ($passedIndex !== false ? $passedIndex + 1 : 1));
                                                                            } else {
                                                                                $attemptNum = min(3, max(1, $attemptsCount));
                                                                            }
                                                                            $attemptSuffix = $ordinal[$attemptNum] ?? ($attemptNum . 'th');

                                                                            if ($passOrFail === 'Passed') {
                                                                                $status_badge = '<span class="badge bg-success text-white py-1 px-2" style="font-size: 11px; font-weight: 500;"><i class="fa-solid fa-circle-check me-1"></i>Passed (on ' . $attemptSuffix . ' Attempt)</span>';
                                                                            } else {
                                                                                $status_badge = '<span class="badge bg-danger text-white py-1 px-2" style="font-size: 11px; font-weight: 500;"><i class="fa-solid fa-circle-xmark me-1"></i>Failed (on ' . $attemptSuffix . ' Attempt)</span>';
                                                                            }
                                                                        } else {
                                                                            $status_badge = '<span class="badge bg-secondary text-white py-1 px-2" style="font-size: 11px; font-weight: 500;"><i class="fa-solid fa-minus me-1"></i>Not Attempted</span>';
                                                                        }

                                                                        $assessments_html .= '<div class="p-2 border rounded bg-white shadow-sm" style="min-width: 250px; background-color: #fafbfc;">';
                                                                        $assessments_html .= '<div class="fw-bold text-dark mb-1" style="font-size: 12px; word-break: break-word;"><i class="fa-regular fa-file-lines me-1 text-primary"></i>' . e($assess->file_name ?? 'Assessment') . '</div>';
                                                                        $assessments_html .= '<div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 6px; margin-top: 4px;">';
                                                                        $assessments_html .= $status_badge;
                                                                        $assessments_html .= $result_btn;
                                                                        $assessments_html .= '</div>';
                                                                        $assessments_html .= '</div>';
                                                                    }
                                                                }
                                                                $assessments_html .= '</div>';
                                                            @endphp

                                                            <tr class="align-middle">
                                                                <td style="max-width: 250px;">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 my-auto ps-1 pe-0">
                                                                            <div class="profile-image-sm">
                                                                                @if(!empty($user->users_data->profile_image))
                                                                                    <img src="{{ url('storage/app/public/' . $user->users_data->profile_image) }}" class="img-fluid" alt="Profile Image">
                                                                                @else

                                                                                    <img src="{{ getUserImage($user->users_data->first_name,$user->users_data->last_name) }}" class="img-fluid" alt="Default Image">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-10 my-auto">
                                                                            <div class="py-1 text-truncate">{{ $user->users_data->first_name ?? '' }}</div>
                                                                            <div class="py-1 sub-categories-styles text-truncate">{{ $user->users_data->email ?? '' }}</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <!-- <td>{{ $user->users_data->emp_id ?? '' }}</td> -->
                                                                <td>{{ $user->users_data->designationdetails->designation_name ?? '' }}</td>
                                                                <td>{{ $user->users_data->departmentdetails->department_name ?? '' }}</td>
                                                                <td>{!! $assessments_html !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade border-top" id="inprogressUsers" role="tabpanel" aria-labelledby="inprogress-users-tab">
                                            <div class="table-responsive mt-2">
                                                <!-- <label class="mb-2 d-flex align-items-center"><i class="fa-solid fa-spinner headings-icon"></i>In-progress Users</label> -->
                                                <div class="table-responsive">
                                                    <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Emp ID</th>
                                                                <th>Designation</th>
                                                                <th>Department</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($attend as $user)
                                                            <tr>
                                                                <td style="max-width: 300px;">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 my-auto ps-1 pe-0">
                                                                            <div class="profile-image-sm">
                                                                                 @if($user->users_data->profile_image)
                                                                                    <img src="{{ url('storage/app/public/' . $user->users_data->profile_image) }}" class="img-fluid" alt="">
                                                                                @else
                                                                                   <img src="{{ getUserImage($user->users_data->first_name,$user->users_data->last_name) }}" class="img-fluid" alt="Default Image">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-10 my-auto">
                                                                            <div class="py-1 text-truncate">{{$user->users_data->first_name??''}}</div>
                                                                            <div class="py-1 sub-categories-styles text-truncate">{{$user->users_data->email??''}}</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{$user->users_data->emp_id??""}}</td>
                                                                <td>{{$user->users_data->designationdetails->designation_name??""}}</td>
                                                                <td>{{$user->users_data->departmentdetails->department_name??""}}</td>
                                                                <td>
                                                                    <!-- <button class="btn btn-primary btn-sm">Notify</button> -->
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade border-top" id="pendingUsers" role="tabpanel" aria-labelledby="pending-users-tab">
                                            <div class="table-responsive mt-2">
                                                <!-- <label class="mb-2 d-flex align-items-center"><i class="bi bi-clock-history headings-icon fs-7 py-1"></i>Pending Users</label> -->
                                                <div class="table-responsive">
                                                    <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="max-width: 300px;">Name</th>
                                                                <th>Emp ID</th>
                                                                <th>Designation</th>
                                                                <th>Department</th>
                                                                <th>Action</th>
                                                           </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($notresponce as $user)
                                                            <tr>
                                                                <td style="max-width: 300px;">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 my-auto ps-1 pe-0">
                                                                            <div class="profile-image-sm">
                                                                                 @if($user->users_data->profile_image)
                                                                                    <img src="{{ url('storage/app/public/' . $user->users_data->profile_image) }}" class="img-fluid" alt="">
                                                                                @else
                                                                                   <img src="{{ getUserImage($user->users_data->first_name,$user->users_data->last_name) }}" class="img-fluid" alt="Default Image">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-10 my-auto">
                                                                            <div class="py-1 text-truncate">{{$user->users_data->first_name??''}}</div>
                                                                            <div class="py-1 sub-categories-styles text-truncate">{{$user->users_data->email??''}}</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                  <td>{{$user->users_data->emp_id??""}}</td>
                                                                <td>{{$user->users_data->designationdetails->designation_name??""}}</td>
                                                                <td>{{$user->users_data->departmentdetails->department_name??""}}</td>
                                                                <td>
                                                                    <!-- <button class="btn sbmt-btn">Notify</button> -->
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
                            @endif
                            </div>
                        </div>
                    </div>
                   

                    <div class="tab-pane fade border-top-0" id="manageGroups" role="tabpanel" aria-labelledby="manage-groups-tab">
                        <div class="row m-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-0 pr-2">
                                <div class="table-responsive">
                                    <table class="table mt-2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Group Name</th>
                                                <th>Assign To User</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_filters_body">
                                            <?php $i=1;?>
                                            @foreach($groups_lists as $group)
                                            <tr>
                                                <td >
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


                     <div class="tab-pane fade border-top-0" id="course-content" role="tabpanel" aria-labelledby="course-content">
                        <div class="row">
                            <div class="col-12">
                                            <div class="form-group row mt-2">
                                                <div class="col-12">
                                                    <!-- <label class="mb-3 d-flex align-items-center"><i class="fa-solid fa-paperclip headings-icon"></i>Course Content</label> -->
                                                </div>
                                                <div class="text-right">
                                                <input type="checkbox" id="toggleInactive">
                                                    <label for="toggleInactive">Show Inactive Content Also</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr class="brd">
                                                                    <th>
                                                                        Type
                                                                    </th>
                                                                    <th>Name</th>
                                                                    <th>
                                                                        Link / File
                                                                    </th>
                                                                    <th>
                                                                        Status
                                                                    </th>
                                                                    <th>Action</th>
                                                                    <!-- <th>Action</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="upload_files_list">

                                                                 @if(isset($course->documents_details))
                                                                    @foreach($course->assessments as $doc)
                                                             
                                                                <tr class="{{ $doc->is_active ? 'active' : 'inactive' }}">
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
                                                                        @elseif($doc->type==7)
                                                                        Assignment
                                                                    @endif</td>
                                                                    <td>
                                                                        @if($doc->type != 7)
                                                                        {{$doc->file_name??''}}
                                                                        @else
                                                                        {{-- {{$doc->assignment_exam_name->name??''}} --}}
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        <!-- @if($doc->type==5)
                                                                        <a href="{{url('storage/app/public/'.$doc->file_path)}}" target="blank" class="btn sbmt-btn text-nowrap">view</a>
                                                                        @else
                                                                        {{$doc->file_path}}
                                                                    @endif  -->

                                                                     @if($doc->type==5)
                                                                    <a class="web-btn-sm" href="{{url('storage/app/public/'.$doc->file_path)}}" target="_blank"> <span>View File</span> </a>
                                                                    @elseif($doc->type == 3 || $doc->type == 4)
                                                                    {{ basename($doc->file_path) }}
                                                                    @else
                                                                    {{ $doc->file_path }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                                                                                                                
                                                                   <div class="custom-control custom-switch">
                                                                     <input type="checkbox" class="custom-control-input toggle-classdocument document-toggle"
                                                                           id="toggle-document-{{ $doc->id }}"
                                                                           data-document_id="{{ $doc->id }}"
                                                                           @if($doc->is_active) checked @endif>
                                                                    <label class="custom-control-label" for="toggle-document-{{ $doc->id }}"></label>

                                                                   </div>
                                                                   <div>
                                                                  <span>Expries on: <strong>{{ date('d/m/Y', strtotime($doc->expiration_date)) }}</strong></span>
                                                                   </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            class="btn btn-sm btn-outline-warning reassign-assessment-all"
                                                                            data-assessment-id="{{ $doc->id }}"
                                                                            data-assessment-name="{{ $doc->file_name ?? 'Assessment' }}"
                                                                            {{ !$doc->is_active ? 'disabled' : '' }}>
                                                                        Reassign to All
                                                                    </button>
                                                                </td>
                                                                

                                                               
                                                                    <!-- <td>
                                                                         <div class="dropdown text-center">
                                                                            <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="vm-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu vm-menu" aria-labelledby="vm-dropdown">
                                                                                <li>
                                                                                    @if($doc->type==5)
                                                                                    <a class="dropdown-item" href="{{url('storage/app/public/'.$doc->file_path)}}"><i class="fa-solid fa-eye pr-2"></i> View</a>
                                                                                    @elseif($doc->type == 3 || $doc->type == 4)
                                                                                    {{ basename($doc->file_path) }}
                                                                                    @else
                                                                                    {{ $doc->file_path }}
                                                                                    @endif
                                                                                </li> 
                                                                                <li><a class="dropdown-item content_delete" href="{{url('delete_document')}}?id={{$doc->id}}" title="{{__('Delete')}}" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>
                                                                            </ul>
                                                                        </div>
                                                                        <a href="{{url('delete_document')}}?id={{$doc->id}}" onclick="return confirm('Are you sure?')" class="btn btn-danger buttonn">Delete</a>
                                                                    </td> -->

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
                                <input type="hidden" class="form-control" name="assined_id" id="assined_id" style="height: 37px !important;" />
                                <input type="hidden" class="form-control" name="course_id" id="course_id" style="height: 37px !important;" />
                                <input type="file" class="form-control" name="document" accept=".pdf" required style="height: 37px !important;" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-md btn-primary upload_feedback_submit m-0">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('body').off('click.reassignAssessmentAll', '.reassign-assessment-all')
                    .on('click.reassignAssessmentAll', '.reassign-assessment-all', function() {
                        var button = $(this);
                        var assessmentName = button.attr('data-assessment-name');

                        if (!confirm('Reassign "' + assessmentName + '" to all users who attempted it? All existing attempts for this assessment will be reset.')) {
                            return;
                        }

                        button.prop('disabled', true).text('Reassigning...');

                        $.ajax({
                            url: "{{ url('reassign-assessment-to-all') }}",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                assessment_id: button.attr('data-assessment-id')
                            },
                            success: function(response) {
                                button.prop('disabled', false).text('Reassign to All');

                                $.toast({
                                    heading: 'Success',
                                    text: response.message + ' Users affected: ' + response.affected_user_count + '.',
                                    position: 'bottom-right',
                                    stack: false,
                                    icon: 'success'
                                });
                            },
                            error: function(xhr) {
                                button.prop('disabled', false).text('Reassign to All');

                                $.toast({
                                    heading: 'Warning',
                                    text: xhr.responseJSON && xhr.responseJSON.message
                                        ? xhr.responseJSON.message
                                        : 'Failed to reassign assessment.',
                                    position: 'bottom-right',
                                    stack: false,
                                    icon: 'warning'
                                });
                            }
                        });
                    });

                $('body').off('change.reassignAssessmentState', '.document-toggle')
                    .on('change.reassignAssessmentState', '.document-toggle', function() {
                        var checkbox = $(this);
                        var row = checkbox.closest('tr');
                        var reassignButton = row.find('.reassign-assessment-all');
                        var isActive = checkbox.is(':checked');

                        reassignButton.prop('disabled', !isActive);

                        $.ajax({
                            url: "{{ url('toggle_document_status') }}",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: checkbox.attr('data-document_id'),
                                action: isActive ? 'Active' : 'Inactive'
                            },
                            success: function() {
                                row.toggleClass('active', isActive)
                                    .toggleClass('inactive', !isActive);
                            },
                            error: function() {
                                checkbox.prop('checked', !isActive);
                                reassignButton.prop('disabled', isActive);

                                $.toast({
                                    heading: 'Warning',
                                    text: 'Failed to update assessment status.',
                                    position: 'bottom-right',
                                    stack: false,
                                    icon: 'warning'
                                });
                            }
                        });
                    });

                document.addEventListener('click', function (event) {
                    var isClickInside = document.querySelector('.filters-dropdown-menuu').contains(event.target) || document.querySelector('.filters-btnn').contains(event.target);

                    if (!isClickInside) {
                        event.stopPropagation();
                    }
                });

                document.querySelector('.filters-btnn').addEventListener('click', function (event) {
                    var dropdownMenu = document.querySelector('.filters-dropdown-menuu');

                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    } else {
                        dropdownMenu.classList.add('show');
                    }
                });

                document.querySelector('.filters-dropdown-menuu').addEventListener('click', function (event) {
                    event.stopPropagation();
                });
                //   $(document).ready(function() {
                //     $('#toggleInactive').change(function() {
                //         if ($(this).is(':checked')) {
                //             $('#upload_files_list tr.inactive').show();
                //         } else {
                //             $('#upload_files_list tr.inactive').hide();
                //         }
                //     });

                //     // Initially hide inactive rows if the checkbox is unchecked
                //     if (!$('#toggleInactive').is(':checked')) {
                //         $('#upload_files_list tr.inactive').hide();
                //     }
                // });
                    $(document).ready(function() {
                             if (!$('#toggleInactive').is(':checked')) {
                                    $('#upload_files_list tr.inactive').hide();
                                }

                                // Handle checkbox change event
                                $('#toggleInactive').change(function() {
                                    if ($(this).is(':checked')) {
                                        // Show inactive rows when checkbox is checked
                                        $('#upload_files_list tr.inactive').show();
                                    } else {
                                        // Hide inactive rows when checkbox is unchecked
                                        $('#upload_files_list tr.inactive').hide();
                                    }
                                });


                                $('body').on('click','.get_certificates',function(){
                                    var  assign_id = $(this).data('id');
                                    $.ajax({
                                        type: "GET",
                                        url: "{{ url('get_certificate') }}",
                                        data: {
                                            assign_id: assign_id
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

                      });
                  

                $(document).ready(function() {
                    $('.multiple_select').multiselect({
                        buttonWidth : '200px',
                        includeSelectAllOption : true,
                        select_all:true,
                        nonSelectedText: 'Nothing Selected'
                      });
                    $('.multiselect').on('click',function(){
                        
                         $(this).next('.multiselect-container').toggle();
                       
                    });
                   
                });


        // delete course modal.
        $(document).on('click', '.course-delete-btn', function() {
             const courseId = $(this).data('id');
            //  console.log(courseId);
            const courseName = $(this).data('name');

            $('#courseName').text(courseName);
            $('#courseId').val(courseId);
            
            $('#deleteCourseModal').modal('show');
        });


            </script>
