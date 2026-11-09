<style>
    /*body{
        height: 100vh;
        overflow-y: hidden;
    }*/
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }
    .filters-indicator {
        display: none;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        position: relative;
        left: 0px;
        top: -8px;
    }
</style>
@if(isset($request->id))
<div class="tab-pane card-border border-top-0 fade @if(Request::get('menu')=='1') show active @endif" id="vu" role="tabpanel" aria-labelledby="vu-tab">
    <div class="card card-border border-top-0 shadow-none rounded-0">
        <div class="card-body p-1 p-0 rounded-0">
            <form class="forms-sample p-1" id="category_course_form"  method="get" action="{{url('users')}}">
                <input type="hidden" name="tab" value="1">
                <input type="hidden" name="menu" value="1">
                <input type="hidden" name="id" value="{{Request::get('id')}}">

                <div class="form-group row">
                    <div class="col-sm-3 my-2">
                        <label>Category</label>
                        <select name="category_id" class="category_filter  form-select-control">
                            <option value="">Select Category</option>
                            @foreach($category_list as $category)
                            <option value="{{$category->id??''}}" @if($request->category_id == $category->id ) selected @endif>{{$category->category_name??''}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3 mt-4 mb-2 pt-2">
                        <div class="pt2">
                            <button type="submit" class="btn btn-primary btn-md">Submit</button>
                            @if(!empty(Request::get('category_id')))
                            <a href="{{ url('users') }}?tab=1&menu=1&id={{Request::get('id')}}" class="btn btn-primary ms-2 btn-md">Reset</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Course Name</th>
                            <th scope="col">Category</th>

                            <th>Assign Course</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses_lists as $course_list)
                        <tr>

                            <td>{{$course_list->course_name ?? ''}}</td>
                            <td>{{$course_list->category_details->category_name ?? ''}}</td>

                            <td >


                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input toggle-class"
                                    id="toggle-{{ $course_list->id }}"
                                    data-course_id="{{ $course_list->id }}"
                                    data-user_id="{{ Request::get('id') }}"
                                    data-category_id="{{$course_list->category_id}}">
                                    <label class="custom-control-label" for="toggle-{{ $course_list->id }}"></label>
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
@endif

</div>
</div>
</div>

<div class="tab-pane fade {{ request()->query('tab') == 2 ? 'show active' : ''}}" id="v-pills-user1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
    <div>
        <!-- <div class="col-12 col-lg-4 pe-0">
            <div class="py-2 mx-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <label class="mb-0 d-flex align-items-center font-weight-bold"><span class="togyle-btn" onclick="togglePanel()"><i class="fa-solid fa-bars-staggered"></i></span><i class="fa-solid fa-eye headings-icon"></i>Users List </label>
                    </div>

                    <div>
                        <a href="{{url('users?tab=1')}}" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add User</a>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-lg-4 pe-0">
            <div class="py-1 mx-0">
                <div class="d-flex align-items-center">
                    <div>
                        <label class="mb-0 d-flex align-items-center font-weight-bold">
                            <span class="togyle-btn" id="togyle-btn" onclick="togglePanel()">
                                <i class="fa-solid fa-bars-staggered"></i>
                            </span>
                           
                        </label>
                    </div>
                    <div class="mr-4 d-flex align-items-center font-weight-bold text-blue">
                        Users List </label>
                    </div>
                    <div>
                        <a href="{{url('users?tab=1')}}" class="btn web-btn admin-add-btns"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content border-0 mt-0 px-2 pt-0" id="myTabContent">
            <div class="tab-pane fade show active" id="vw" role="tabpanel" aria-labelledby="vw-tab">
                <div class="row px-0">
                    <div class="col-12">
                        <div class="card card-border border-top-0 shadow-none rounded-0 pb-2">
                            <div class="card-body px-2 py-0 rounded-0">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-4 bg-white py-2 rounded-3 laft-syde-content pr-lg-1">
                                        @php
                                            $activeStatuses = isset($selectedStatuses) ? (array)$selectedStatuses : (Request::has('user_status') ? (array)Request::get('user_status') : (Request::has('user_active') ? (Request::get('user_active') === 'all' ? ['1','0','2'] : [(string)Request::get('user_active')]) : ['1']));
                                            $isCustomStatus = (count($activeStatuses) !== 1 || !in_array('1', $activeStatuses));
                                            $hasAnyFilter = !empty(Request::get('dept_id')) || !empty(Request::get('desig_id')) || !empty(Request::get('search_name')) || $isCustomStatus;
                                        @endphp
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <form class="forms-sample pb-2" id="view_users_form" method="get" action="{{url('users')}}">
                                                    <input type="hidden" name="tab" value="2">
                                                    @foreach($activeStatuses as $st)
                                                        <input type="hidden" name="user_status[]" value="{{ $st }}">
                                                    @endforeach
                                                    @if(Request::filled('search_name'))
                                                    <input type="hidden" name="search_name" value="{{ Request::get('search_name') }}">
                                                    @endif
                                                    <button class="btn filterBtn filters-btnn dropdown-toggle" type="button"><i class="bi bi-filter"></i>
                                                        Filters @if($hasAnyFilter)<i class="fa-solid fa-circle filters-dot-icon"></i> @endif
                                                    </button>
                                                    @if($hasAnyFilter)
                                                    <a href="{{ url('users') }}?tab=2" class="btn sbmt-btn ms-2">Reset</a>@endif
                                                    <ul class="dropdown-menu filterMenu filters-dropdown-menuu p-3 w-96" style="display: none; top: 7%;">
                                                        <div class="form-group row">


                                                  <!--         <div class="col-sm-4 auto">
  
                                                                    <label>Category:</label><br>
                                                                    @foreach($category_list as $category)
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input category_filter" type="checkbox" name="catg_id[]" value="{{$category->id}}" @if(isset($request->catg_id) && in_array($category->id, $request->catg_id)) checked @endif>
                                                                            <label class="form-check-label">{{$category->category_name}}</label>
                                                                        </div>
                                                                    @endforeach

                                                            </div> -->

                                                            <div class="col-sm-6">
                                                                <select class="js-example-basic-single form-select-control dept_filter" name="dept_id">
                                                                   <option value="">Select a Departments</option>
                                                                   @foreach($departments as $department)
                                                                   <option value="{{$department->id??''}}" @if($request->dept_id == $department->id ) selected @endif>{{$department->department_name??''}}</option>
                                                                   @endforeach
                                                               </select>
                                                           </div>
                                                           <div class="col-sm-6">
                                                                <select class="js-example-basic-single form-select-control desig_filter" name="desig_id" >
                                                                    <option value="">Select a Designation</option>
                                                                    @foreach($designations as $designation)
                                                                    <option value="{{$designation->id??''}}" @if($request->desig_id == $designation->id ) selected @endif>{{$designation->designation_name??''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-12 mt-3">
                                                                <div class="text-end">
                                                                    <button type="button" class="btn cancel-btn mr-2">Cancel</button>
                                                                  <button type="submit" class="btn sbmt-btn submitBtn">Apply</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </ul>
                                                </form>
                                            </div>
                                            <div>
                                                <form class="forms-sample pb-2"  method="get" action="{{url('users')}}">
                                                    <div class="d-flex">
                                                        <input type="hidden" name="tab" value="2">
                                                        @foreach($activeStatuses as $st)
                                                            <input type="hidden" name="user_status[]" value="{{ $st }}">
                                                        @endforeach
                                                        @if(Request::filled('dept_id'))
                                                        <input type="hidden" name="dept_id" value="{{ Request::get('dept_id') }}">
                                                        @endif
                                                        @if(Request::filled('desig_id'))
                                                        <input type="hidden" name="desig_id" value="{{ Request::get('desig_id') }}">
                                                        @endif
                                                        <input type="text" class="form-control rounded-0" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" style="height: 40px;">
                                                                <button type="submit" class="bi bi-search border-0"  ></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <style>
                                            .status-filter-card {
                                                background-color: #f8fafc;
                                                border: 1px solid #cbd5e1;
                                                border-radius: 8px;
                                                padding: 10px 14px;
                                                margin-bottom: 12px;
                                                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                                            }
                                            .status-check-item {
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 7px;
                                                cursor: pointer;
                                                user-select: none;
                                                margin: 0;
                                                padding: 2px 4px;
                                                border-radius: 4px;
                                                transition: background-color 0.15s;
                                            }
                                            .status-check-item:hover {
                                                background-color: #edf2f7;
                                            }
                                            .status-check-item span {
                                                font-size: 13px;
                                                font-weight: 600;
                                                line-height: 1;
                                            }
                                            .custom-status-checkbox {
                                                appearance: none;
                                                -webkit-appearance: none;
                                                -moz-appearance: none;
                                                width: 18px;
                                                height: 18px;
                                                min-width: 18px;
                                                border-radius: 4px;
                                                cursor: pointer;
                                                display: inline-block;
                                                margin: 0;
                                                vertical-align: middle;
                                                background-color: #ffffff;
                                                box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
                                                transition: all 0.15s ease-in-out;
                                            }
                                            /* Active (Green) */
                                            .cb-active {
                                                border: 2px solid #16a34a !important;
                                            }
                                            .cb-active:checked {
                                                background-color: #16a34a !important;
                                                border-color: #16a34a !important;
                                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
                                                background-position: center !important;
                                                background-repeat: no-repeat !important;
                                                background-size: 13px 13px !important;
                                            }
                                            /* Inactive (Amber) */
                                            .cb-inactive {
                                                border: 2px solid #d97706 !important;
                                            }
                                            .cb-inactive:checked {
                                                background-color: #d97706 !important;
                                                border-color: #d97706 !important;
                                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
                                                background-position: center !important;
                                                background-repeat: no-repeat !important;
                                                background-size: 13px 13px !important;
                                            }
                                            /* Deactivated (Red) */
                                            .cb-deactivated {
                                                border: 2px solid #dc2626 !important;
                                            }
                                            .cb-deactivated:checked {
                                                background-color: #dc2626 !important;
                                                border-color: #dc2626 !important;
                                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
                                                background-position: center !important;
                                                background-repeat: no-repeat !important;
                                                background-size: 13px 13px !important;
                                            }
                                        </style>
                                        <div class="status-filter-card">
                                            <form id="status_checkbox_filter_form" method="get" action="{{ url('users') }}" class="m-0">
                                                <input type="hidden" name="tab" value="2">
                                                @if(Request::filled('dept_id'))
                                                    <input type="hidden" name="dept_id" value="{{ Request::get('dept_id') }}">
                                                @endif
                                                @if(Request::filled('desig_id'))
                                                    <input type="hidden" name="desig_id" value="{{ Request::get('desig_id') }}">
                                                @endif
                                                @if(Request::filled('search_name'))
                                                    <input type="hidden" name="search_name" value="{{ Request::get('search_name') }}">
                                                @endif

                                                <!-- Row 1: The 3 Checkboxes with clear borders and spacing -->
                                                <div class="d-flex align-items-center justify-content-between pb-2">
                                                    <label class="status-check-item" for="cb_active" title="Filter Active users">
                                                        <input class="custom-status-checkbox cb-active" type="checkbox" name="user_status[]" id="cb_active" value="1" {{ in_array('1', $activeStatuses) ? 'checked' : '' }}>
                                                        <span class="text-success fw-bold">Active</span>
                                                    </label>
                                                    <label class="status-check-item" for="cb_inactive" title="Filter Inactive users">
                                                        <input class="custom-status-checkbox cb-inactive" type="checkbox" name="user_status[]" id="cb_inactive" value="0" {{ in_array('0', $activeStatuses) ? 'checked' : '' }}>
                                                        <span class="fw-bold" style="color: #b45309;">Inactive</span>
                                                    </label>
                                                    <label class="status-check-item" for="cb_deactivated" title="Filter Deactivated users">
                                                        <input class="custom-status-checkbox cb-deactivated" type="checkbox" name="user_status[]" id="cb_deactivated" value="2" {{ in_array('2', $activeStatuses) ? 'checked' : '' }}>
                                                        <span class="text-danger fw-bold">Deactivated</span>
                                                    </label>
                                                </div>

                                                <!-- Row 2: Selected Status Counts (left) + Apply and Reset Buttons (right) -->
                                                <div class="d-flex align-items-center justify-content-between pt-2 border-top flex-wrap" style="gap: 8px;">
                                                    <div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
                                                        @if(in_array('1', $activeStatuses))
                                                            <span class="badge bg-success text-white px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                                Active: {{ $statusCounts['1'] ?? 0 }}
                                                            </span>
                                                        @endif
                                                        @if(in_array('0', $activeStatuses))
                                                            <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                                Inactive: {{ $statusCounts['0'] ?? 0 }}
                                                            </span>
                                                        @endif
                                                        @if(in_array('2', $activeStatuses))
                                                            <span class="badge bg-danger text-white px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                                Deactivated: {{ $statusCounts['2'] ?? 0 }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center ms-auto" style="gap: 6px;">
                                                        <button type="submit" class="btn sbmt-btn py-1 px-3" style="font-size: 12px; font-weight: 600;">Apply</button>
                                                        <a href="{{ url('users?tab=2') }}" class="btn btn-outline-secondary py-1 px-2" style="font-size: 12px; font-weight: 500;" title="Reset back to Active users default">Reset</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="height-78vh">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 150px;">User Details</th>
                                                        <th style="width: 150px;">Designation</th>
                                                        <th class="user-dep-widt">Department</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1;?>
                                                        @foreach($users as $user)

                                                        <tr class="user_check" data-id="{{$user->id}}" style="cursor:pointer;">
                                                            <td style="width: 150px;">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="profile-image-div-sm">
                                                                        <!-- @if($user->profile_image)
                                                                            <img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="">
                                                                        @else
                                                                            <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                                                                        @endif -->

                                                                        @if(!empty($user->profile_image))
                                                                        <img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="Profile Image">
                                                                    @else

                                                                        <img src="{{ getUserImage($user->first_name,$user->last_name) }}" class="img-fluid" alt="Default Image">
                                                                    @endif
                                                                    </div>
                                                                    <div class="ms-2">
                                                                        <div class="py-1 web-text-color font-weight-bold text-truncate d-flex align-items-center" style="max-width: 170px;">
                                                                            <span class="text-truncate">{{$user->first_name??''}} {{$user->last_name??''}}</span>
                                                                            @if((method_exists($user, 'trashed') && $user->trashed()) || $user->active == 2 || !empty($user->deactivation_reason))
                                                                                <span class="badge bg-danger text-white ms-1" style="font-size: 9px; padding: 2px 4px;">Deactivated</span>
                                                                            @elseif($user->active == 0 || $user->active === null)
                                                                                <span class="badge bg-warning text-dark ms-1" style="font-size: 9px; padding: 2px 4px;">Inactive</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="py-1 sub-categories-styles text-truncate">{{$user->email??''}}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><div class="py-1 text-start">{{$user->designationdetails->designation_name??''}}</div></td>
                                                            <td>
                                                                <div class="py-1 user-dep-widt">{{$user->departmentdetails->department_name??''}}
                                                                </div>
                                                                <!-- <div class="py-1">{{$user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('Y-m-d') : ''}}</div> -->
                                                            </td>
                                                            <!-- @if(hasPermission(1))
                                                            <td>
                                                                <a href="{{url('delete_admin_users')}}?id={{$user->id}}" title="{{__('Delete')}}" class="btn btn-danger btn-sm" style="width: 95px;"><i class="bi bi-trash pe-2"></i>Delete</a>
                                                            </td>
                                                            @endif -->
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 user_before_select rite-syde-content">
                                        <div class="py-5">
                                            <div class="py-4 mt-5">
                                                <img src="{{ url('public/images/file.png') }}" class="img-fluid mx-auto d-block opacity-10" alt="">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center text-dark fs-5 opacity-10">---- ---- Please select a User ---- ----</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 user_after_select rite-syde-content position-relative" style="min-height: 500px;">
                                        <div id="loader" style="display:none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; min-height: 400px; background: rgba(255, 255, 255, 0.85); z-index: 1050;" class="align-items-center justify-content-center flex-column">
                                            <img src="{{ url('public/images/loading.gif') }}" class="img-fluid opacity-50" style="max-height: 80px;" alt="Loading...">
                                            <div class="mt-2 text-muted fw-semibold font-smallsize">Loading user details...</div>
                                        </div>
                                            <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                    <!-- <h3 class="font-weight-normal pt-2 mb-1">User Details</h3> -->
                                                    <div class="ajax-user-imagee"></div>
                                                    <div class="px-2 pb-2 pt-3">
                                                        <nav class="">
                                                            <div class="nav nav-tabs font-smallsize mb-2" id="nav-tab" role="tablist">
                                                                <button class="nav-link nav-linkk active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Profile</button>
                                                                @if(hasPermission(7))
                                                                <button class="nav-link nav-linkk" id="manage-courses-access-tab" data-bs-toggle="tab" data-bs-target="#mca" type="button" role="tab" aria-controls="mca" aria-selected="true">Manage Courses Access</button>
                                                                @endif
                                                                <button class="nav-link nav-linkk" id="user-list-reports-tab" data-bs-toggle="tab" data-bs-target="#ul-reports" type="button" role="tab" aria-controls="ul-reports" aria-selected="true">Reports <small>(Assessments & Assignments)</small> </button>
                                                                <button class="nav-link nav-linkk" id="user-list-activity-tab" data-bs-toggle="tab" data-bs-target="#ul-activity" type="button" role="tab" aria-controls="ul-activity" aria-selected="true">Activity</button>
                                                            </div>
                                                        </nav>

                                                        <div class="tab-content border-0 mt-0 p-0 user-profile-scroll" id="userSubTabsContent">
                                                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                                                <div class="card border-0 shadow-none border-radius-none">
                                                                    <div class="row px-0 user_form" id="user_form">
                                                                        <div class=" pr-2" >
                                                                        <form class="px-0" id="userProfileForm" action="{{url('user_registrations_store')}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="col-12 py-2">
                                                                                <input type="hidden" class="form-control" id="id" name="id" />
                                                                                <input type="hidden" class="form-control" value="2" name="tab" />
                                                                                <input type="hidden" class="form-control" id="hidden_deactivation_reason" name="deactivation_reason" value="" />


                                                                                <div class="form-group row">
                                                                                    <label for="first_name" class="col-sm-2 col-form-label">First name</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="text" class="form-control" id="first_name" name="first_name" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="last_name" class="form-control" id="last_name" name="last_name" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="emp_id" class="col-sm-2 col-form-label">EMP ID</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="emp_id" class="form-control" id="emp_id" name="emp_id" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="email" class="form-control" id="email" name="email" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                                                                    <div class="col-sm-10">
                                                                                        <textarea class="form-control mb-2" id="description" rows="4" name="description"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-12">
                                                                                <div class="form-group row">
                                                                                    <label for="username" class="col-sm-2 col-form-label">Email / Username </label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="text" class="form-control" id="username" name="username" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-12">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-2 col-form-label">User type</label>
                                                                                    <div class="col-sm-10">
                                                                                
                                                                                      <select class="form-control multiple_select user_roles" id="user_type1" name="roles[]" multiple>
                                                                @foreach($roles_lists as $roles_list)
                                                                    <option value="{{$roles_list->id}}" @if(in_array($roles_list->id, request()->input('roles', []))) selected @endif>
                                                                        {{$roles_list->role}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                                               </div>
                                                                           </div>


                                                                       </div>

                                                                       <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Designation</label>
                                                                            <div class="col-sm-10">
                                                                                <select class="form-control" name="designation" id="designation">
                                                                                   @foreach($designations as $designation)
                                                                                   <option value="{{ $designation->id }}">{{ $designation->designation_name ??''}}</option>
                                                                                   @endforeach
                                                                               </select>
                                                                           </div>
                                                                       </div>
                                                                   </div>

                                                                   <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Department</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="form-control" name="department" id="department">
                                                                               @foreach($departments as $department)
                                                                               <option value="{{ $department->id }}">{{ $department->department_name ??''}}</option>
                                                                               @endforeach
                                                                           </select>
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                               <div class="col-12">


                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Team Lead</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="team_lead" id="team_lead">
                                                                           @foreach($team_leads as $team_lead)
                                                                            <option value="{{$team_lead->emp_id??''}}">{{ $team_lead->first_name??'' }} {{ $team_lead->last_name??'' }}- {{ $team_lead->emp_id??'' }}</option>
                                                                           @endforeach
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <div class="col-12">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Reporting manager1</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="reporting_manager1" id="reporting_manager1">

                                                                            @foreach($manager1_users as $manager1_user)
                                                                             <option value="{{$manager1_user->emp_id??''}}">{{ $manager1_user->first_name??'' }} {{ $manager1_user->last_name??'' }}- {{ $manager1_user->emp_id ??''}}</option>
                                                                            @endforeach


                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Reporting manager2</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="reporting_manager2" id="reporting_manager2">

                                                                           @foreach($manager2_users as $manager2_user)
                                                                         <option value="{{$manager2_user->emp_id??''}}">{{ $manager2_user->first_name??'' }} {{ $manager2_user->last_name??'' }}- {{ $manager2_user->emp_id ??''}}</option>
                                                                           @endforeach
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>



                                                       <div class="col-12">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Training Manager</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control training_manager" name="training_manager" id="training_manager1">

                                                                        @foreach($training_managers as $training_manager)
                                                                        <option value="{{ $training_manager->emp_id??'' }}">{{ $training_manager->first_name??'' }} {{ $training_manager->last_name??'' }} - {{ $training_manager->emp_id??'' }}</option>
                                                                        @endforeach


                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Senior Training Manager</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control senior_training_manager" name="senior_training_manager" id="senior_training_manager1">

                                                                       @foreach($senior_training_managers as $senior_training_manager)
                                                                        <option value="{{ $senior_training_manager->emp_id??'' }}">{{ $senior_training_manager->first_name??'' }} {{ $senior_training_manager->last_name??'' }}- {{ $senior_training_manager->emp_id??'' }}</option>
                                                                        @endforeach
                                                                   </select>
                                                               </div>
                                                           </div>
                                                       </div>


                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Status</label>
                                                                <div class="col-sm-10 d-flex align-items-center pt-2">
                                                                    <div class="form-check me-4">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="active" id="status_active" class="form-check-input" value="1" /> Active
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check me-4">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="active" id="status_inactive" class="form-check-input" value="0" /> In-Active
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check me-4">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="active" id="status_deactivate" class="form-check-input" value="2" /> Deactivate
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" id="deactivation_reason_display_row" style="display: none;">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Deactivation Reason</label>
                                                                <div class="col-sm-10 pt-1">
                                                                    <div class="p-2 border rounded bg-light font-smallsize" id="deactivation_reason_display_text" style="color: #495057;"></div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                       
                                                        <div class="col-12">
                                                            <div class="pb-2 text-center">
                                                                <button type="button" class="btn cancel-btn mr-2">Cancel</button>
                                                                <button type="submit" class="btn sbmt-btn submitBtn">Save</button>
                                                            </div>

                                                        </div>
                                                     
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="mca" role="tabpanel" aria-labelledby="manage-courses-access-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-border border-top-0 shadow-none rounded-0">
                                                    <div class="card-body p-2 rounded-0 p-0">
                                                        <div class="row">
                                                            <div class="col-12 col-md-8">
                                                                <form class="forms-sample pt-1" id="course_list_filter">
                                                                    <input type="hidden" id='hiddenuser_id' name="user_id">
                                                                    <div class="dropdown mb-2">

                                                                      <button id="filtersButton" class="btn filterBtn filters-btnn dropdown-toggle" type="button"><i class="bi bi-filter"></i>
                                                                        Filters <span id="filtersIndicator" class="filters-indicator"></span>
                                                                    </button>

                                                                    <p class="text-blue department_based">
       <span class="course-names"></span>
        <button type="button" class="linnk-text ms-4 reset_filters_button ">Reset</button>
    </p>

                                                                    
                                                                    <div class="dropdown-menu filterMenu filters-dropdown-menuu filter-dropdown-hite p-3 mt-2 w-100">
                                                                        <div class="form-group row">
                                                                           <div class="col-sm-6">
                                                                                <div>
                                                                                    <label class="form-check-label ms-0 mb-2">Category</label>
                                                                                </div>
                                                                                  <select class="form-control multiple_select course_filter" id="category_id" name="catg_id[]" multiple>
                                                                                @foreach($category_list as $category)
                                                                                    <option value="{{$category->id ?? ''}}" @if(in_array($category->id, request()->input('catg_id', []))) selected @endif>
                                                                                        {{$category->category_name}}
                                                                                    </option>
                                                                                @endforeach
                                                                                </select>
                                                                            </div>
    


                                                                            <div class="col-sm-6">
                                                                                <div>
                                                                                    <label class="form-check-label ms-0 mb-2">Status</label>
                                                                                </div>
                                                                               <select  class="js-example-basic-single form- form-select-control course_filter" name="assigned_status">
                                                                                <option value="" selected>Assigned Status</option>

                                                                                <option value="0" @if(isset($request) && $request->assigned_status == 0 && $request->assigned_status !="") selected @endif>UnAssigned</option>
                                                                                <option value="1" @if(isset($request) && $request->assigned_status == 1 ) selected @endif>Assigned</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12 mt-3">
                                                                            <div class="text-end">
                                                                                <button type="button" class="btn cancel-btn mr-2">Cancel</button>
                                                                               <button type="button"  class="btn sbmt-btn submitBtn course_filter_button">Submit</button>
                                                                           </div>
                                                                       </div>

                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </form>
                                                   </div>
                                                   <div class="col-12 col-md-4">
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control search_query rounded-0" name="search_query" placeholder="Search">

                                               <!--  <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary search_user_courses_button">
                                                        <i class="bi bi-search"></i>
                                                    </button>
                                                </div> -->
                                                <div class="input-group-append">
                                                  <span class="input-group-text" style="height: 40px;">
                                                     <button type="submit" class="bi bi-search border-0 search_user_courses_button"></button>
                                                 </span>
                                             </div>
                                         </div>
                                     </div>

                       <!--                 <div class="col-12">
                                           <p class="text-blue department_based">
                                           <span class="course-names"></span>
                                            <button type="button" class="linnk-text ms-4 reset_filters_button">Reset</button>
                                        </p>
                                       </div> -->
                                 </div>  
                                 <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true"> 
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p id="successMessage"></p>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="messageContainer"></div>
                                <div id="assigned_courses_container">
                                    <div class="user-course-details-hite">
                                        <div class="table-responsive">
                                            <table class="table" id="userDetailsContainer">
                                                <thead>
                                                    <tr>
                                                        <th>Course Details</th>
                                                        <th>Category</th>
                                                        <th>Assign Course</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="course_filters_body">

                                                </tbody >
                                            </table>
                                        </div> 
                                    </div>  
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane card-border border-top-0 fade" id="ul-reports" role="tabpanel" aria-labelledby="user-list-reports-tab">
                <div class="row mx-0 user_report_list">

                </div>
            </div>
            <div class="user_assignments_list" style="display:none;"></div>
          

<div class="tab-pane fade" id="ul-activity" role="tabpanel" aria-labelledby="user-list-activity-tab">
    <div class="row p-2">
        <div class="col-12">
            <div class="row mb-3 align-items-center">
                <div class="col-12 col-lg-3 my-auto">
                    <div class="font-weight-bold">
                        Activity Log & Sessions <i class="fa-solid fa-circle-info"></i>
                    </div>
                </div>
                
                <!-- Filter Section with No Default Active Buttons -->
                <div class="col-12 col-lg-9 my-auto">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                        
                        <!-- Preset Filter Buttons (None are active initially) -->
                        <div class="btn-group btn-group-sm me-2 mb-1" role="group">
                            <button type="button" class="btn preset-filter-btn" data-preset="today" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Today</button>
                            <button type="button" class="btn preset-filter-btn" data-preset="last_week" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Last Week</button>
                            <button type="button" class="btn preset-filter-btn" data-preset="this_month" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Last Month</button>
                            <button type="button" class="btn preset-filter-btn active" data-preset="all" style="border: 1px solid #005452; background-color: #005452; color: #ffffff;">Custom</button>
                        </div>

                        <!-- Manual/Custom Date Pickers (From Date & To Date) -->
                        <div class="d-flex align-items-center border p-1 rounded bg-white mb-1">
                            <span class="small font-weight-bold me-1 text-muted px-1">From:</span>
                            <input type="date" id="filter_from_date" class="form-control form-control-sm border-0 p-0 me-1">
                            
                            <span class="small font-weight-bold me-1 text-muted px-1">To:</span>
                            <input type="date" id="filter_to_date" class="form-control form-control-sm border-0 p-0 me-1">
                            
                            <button type="button" class="btn btn-sm py-0 px-2 ms-1" id="apply_custom_date_filter" style="background-color: #005452; border-color: #005452; color: #ffffff;">Filter</button>
                        </div>

                    </div>
                </div>
            </div>
          
            <!-- Session Duration / Time Spent Section -->
            <div class="row mb-3 px-2" id="session_duration_container" style="display: none;">
                <div class="col-12 border p-3 bg-light rounded shadow-sm">
                    <h6 class="font-weight-bold text-primary mb-2"><i class="fa-solid fa-clock"></i> Session Time Spent Summary</h6>
                    <div class="row text-secondary">
                        <div class="col-md-4">
                            <strong>Login Time:</strong> <span id="val_login_time">--</span>
                        </div>
                        <div class="col-md-4">
                            <strong>Logout Time:</strong> <span id="val_logout_time">--</span>
                        </div>
                        <div class="col-md-4">
                            <strong>Total Time Spent:</strong> <span id="val_total_time" class="text-success font-weight-bold">--</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-0 user_activity_list">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="certificateView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateViewLabel">Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body certificate_html">

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


<div class="modal fade" id="certificateView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateViewLabel">Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body certificate_html">

            </div>
        </div>
    </div>
</div>

<div id="assignmentExamModalsContainer"></div>

<!-- Deactivate User Account Modal -->
<div class="modal fade" id="deactivateUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deactivateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title font-weight-bold text-blue" id="deactivateUserModalLabel" style="font-size: 16px;">
                    <i class="fa-solid fa-user-slash me-2" style="color: #005452;"></i>Deactivate User Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeDeactivateModalBtn"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning py-2 px-3 mb-3 font-smallsize border-0" style="background-color: #fff9e6; color: #856404; border-left: 4px solid #ffc107 !important; border-radius: 4px;">
                    <i class="fa-solid fa-triangle-exclamation me-1 text-warning"></i>
                    Are you sure you want to deactivate <strong id="deactivate_user_display_name">this user</strong>?  Deactivating this account will prevent the user from logging in to the LMS.
                </div>
                <div class="mb-3">
                    <label for="deactivation_reason_input" class="form-label font-weight-bold font-smallsize mb-1">
                        Reason for Deactivation <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="deactivation_reason_input" rows="3" placeholder="Please enter the reason for deactivating this account..." required style="font-size: 13px;"></textarea>
                    <div class="text-danger font-smallsize mt-1 d-none" id="deactivation_reason_validation_msg">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> Please provide a reason before submitting deactivation.
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDeactivateModalBtn" style="border-radius: 7px; padding: 8px 16px; font-size: 14px;">Cancel</button>
                <button type="button" class="btn sbmt-btn" id="confirmDeactivateBtn" style="padding: 8px 16px;">
                    <i class="fa-solid fa-user-slash me-1"></i> Submit & Deactivate
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    $("#user_add_form").validate();
    $(document).ready(function() {
        
        // Block future dates in User activity log.
        var todayStr = new Date().toISOString().split('T')[0];
        $('#filter_from_date').attr('max', todayStr);
        $('#filter_to_date').attr('max', todayStr);

        // Ensure 'To Date' cannot be earlier than 'From Date'
        $('#filter_from_date').on('change', function() {
            var fromVal = $(this).val();
            $('#filter_to_date').attr('min', fromVal);
            if ($('#filter_to_date').val() && $('#filter_to_date').val() < fromVal) {
                $('#filter_to_date').val(fromVal);
            }
        });

        // Ensure 'From Date' cannot be later than 'To Date'
        $('#filter_to_date').on('change', function() {
            var toVal = $(this).val();
            $('#filter_from_date').attr('max', toVal);
            if ($('#filter_from_date').val() && $('#filter_from_date').val() > toVal) {
                $('#filter_from_date').val(toVal);
            }
        });

        function handleTrainingManagerRequirement() {
            if ($('.user_type').val() == '6') {
                $('#training_manager').prop('required', true);
                $('#senior_training_manager').prop('required', true);
            } else {
                $('#training_manager').prop('required', false);
                $('#senior_training_manager').prop('required', false);
            }
        }
        handleTrainingManagerRequirement();

        $('.user_type').change(function() {
            handleTrainingManagerRequirement();
        });

        function handleTrainingManagerRequirement1() {
            if ($('#user_type1').val() == '6') {
                $('#training_manager1').prop('required', true);
                $('#senior_training_manager1').prop('required', true);
            } else {
                $('#training_manager1').prop('required', false);
                $('#senior_training_manager1').prop('required', false);
            }
        }
        handleTrainingManagerRequirement1();

        $('#user_type1').change(function() {
            handleTrainingManagerRequirement1();
        });

        var lastConfirmedStatus = '1';
        var isDeactivationSubmitted = false;

        function openDeactivateModal() {
            var modalEl = document.getElementById('deactivateUserModal');
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                modalInstance.show();
            } else if (typeof $(modalEl).modal === 'function') {
                $(modalEl).modal('show');
            }
        }

        function closeDeactivateModal() {
            var modalEl = document.getElementById('deactivateUserModal');
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                var modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    modalInstance.hide();
                }
            } else if (typeof $(modalEl).modal === 'function') {
                $(modalEl).modal('hide');
            }
        }

        // When user clicks status radio button
        $(document).on('click', 'input[name="active"]', function(e) {
            var val = $(this).val();
            if (val === '2') {
                var currentUserId = $('#id').val();
                if (!currentUserId) {
                    alert('Please select a user first.');
                    $('input[name="active"][value="' + lastConfirmedStatus + '"]').prop('checked', true);
                    return;
                }

                var userName = (($('#first_name').val() || '') + ' ' + ($('#last_name').val() || '')).trim();
                if (userName) {
                    $('#deactivate_user_display_name').text(userName);
                }

                isDeactivationSubmitted = false;
                $('#deactivation_reason_validation_msg').addClass('d-none');
                $('#confirmDeactivateBtn').prop('disabled', false).html('<i class="fa-solid fa-user-slash me-1"></i> Submit & Deactivate');

                if ($('#hidden_deactivation_reason').val()) {
                    $('#deactivation_reason_input').val($('#hidden_deactivation_reason').val());
                } else {
                    $('#deactivation_reason_input').val('');
                }

                openDeactivateModal();
            } else {
                lastConfirmedStatus = val;
                $('#hidden_deactivation_reason').val('');
                $('#deactivation_reason_display_row').hide();
            }
        });

        // Revert radio button back to previous state if modal is closed/dismissed without submitting
        $('#deactivateUserModal').on('hidden.bs.modal', function() {
            if (!isDeactivationSubmitted) {
                $('input[name="active"][value="' + lastConfirmedStatus + '"]').prop('checked', true);
            }
        });

        // Handle submit directly inside modal popup (no need to click Save button on viewuser page)
        $('#confirmDeactivateBtn').on('click', function(e) {
            e.preventDefault();
            var reason = $.trim($('#deactivation_reason_input').val());
            if (!reason) {
                $('#deactivation_reason_validation_msg').removeClass('d-none');
                $('#deactivation_reason_input').focus();
                return;
            }
            $('#deactivation_reason_validation_msg').addClass('d-none');

            var currentUserId = $('#id').val();
            if (!currentUserId) {
                alert('Please select a user first.');
                closeDeactivateModal();
                return;
            }

            isDeactivationSubmitted = true;
            $('#hidden_deactivation_reason').val(reason);
            $('#status_deactivate').prop('checked', true);

            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Deactivating...');

            // Submit the form directly so user does not need to click Save button on viewuser
            $('#userProfileForm')[0].submit();
        });

        $('body').on('click','#get_data_button',function(){ 
            $(this).append('<img class="img_loader" src="{{asset("public/images/Loading.gif")}}" style="height:15px;width:20px;">');
            var email = $('#add_email').val();
            $.ajax({
                url: "{{url('fetchUserDataApi')}}?email="+email,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#add_first_name').val(response.name);
                    $('#add_username').val(email);
                    $('#add_emp_id').val(response.emp_id);
                    $("#add_designation option:contains("+response.add_employee.emp_desgn+")").attr('selected', true);
                    $("#add_department option:contains("+response.add_employee.emp_dept+")").attr('selected', true);
                    $('#add_team_lead').val(response.add_employee.emp_team_lead);
                    $('#add_reporting_manager1').val(response.add_employee.emp_reporting_manager_1);
                    $('#add_reporting_manager2').val(response.add_employee.emp_reporting_manager_2);
                    $('body').find('.img_loader').remove();
                    if(response.emp_id){
                       $.toast({
                        heading: 'Success',
                        text: 'Data fetched successfully',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
                   }else{
                       $.toast({
                        heading: 'warning',
                        text: 'No data found. Please recheck the email.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
                   }
                }, error: function(xhr, status, error) {
                    $('body').find('.img_loader').remove();
                    $.toast({
                    heading: 'warning',
                    text: 'No data found. Please recheck the email.',
                    position: 'bottom-right',
                    stack: false,
                    icon: 'warning'
                });
               }
            });
        });

        $('#user_form').hide();
        $(".user_before_select").show();
        $(".user_after_select").hide();
        
        $('.user_check').on('click', function() {
            $('#activity_range_dropdown').val('');
            $('#session_duration_container').hide();
            $('.user_report_list').html('');
            $('#assignmentExamModalsContainer').html('');
            $('.user_assignments_list').html('');
            $('.user_activity_list').html('');
          
            $('.user_check').find('td').removeClass('course-active');
            $(this).find('td').addClass('course-active');
            $(".user_before_select").hide();
            $(".user_after_select").show();

            $('#loader').css('display', 'flex').show();

            var userId = $(this).data('id');
            $.ajax({
                url: "{{url('fetchUserData')}}?userId="+userId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var user_data ='<div class="col-12 pt-2"><div class="d-flex align-items-center"><div class="profile-image-div-md"><img src="'+response.profile_image+'" class="img-fluid" alt=""></div><div class="ms-2"><h4>'+response.first_name+'</h4></div></div>'; 
                    $('.ajax-user-imagee').html(user_data);

                    $('#hiddenuser_id').val(response.id);
                    $('#id').val(response.id);
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('#emp_id').val(response.emp_id);
                    $('#email').val(response.email);
                    $('#password').val(response.password);
                    $('#description').val(response.description);
                    $('#username').val(response.username);
                    $('#language').val(response.language);
                    $('#role_id').val(response.role);
                    $('#designation').val(response.designation);
                    $('#department').val(response.department);
                    $('#team_lead').val(response.team_lead);
                    $('#reporting_manager1').val(response.reporting_manager1);
                    $('#reporting_manager2').val(response.reporting_manager2);
                    $('#senior_training_manager1').val(response.senior_training_manager);
                    $('#training_manager1').val(response.training_manager);
                    $('#deactivation_date').val(response.deactivation_date);
                    var userFullName = ((response.first_name || '') + ' ' + (response.last_name || '')).trim();
                    $('#deactivate_user_display_name').text(userFullName || 'this user');

                    if (response.is_deleted == 1 || response.deleted_at != null) {
                        $('#status_deactivate').prop('checked', true);
                        lastConfirmedStatus = '2';
                        if (response.deactivation_reason) {
                            $('#deactivation_reason_display_text').text(response.deactivation_reason);
                            $('#deactivation_reason_display_row').show();
                            $('#deactivation_reason_input').val(response.deactivation_reason);
                        } else {
                            $('#deactivation_reason_display_row').hide();
                            $('#deactivation_reason_input').val('');
                        }
                    } else if (response.active == 1) {
                        $('#status_active').prop('checked', true);
                        lastConfirmedStatus = '1';
                        $('#deactivation_reason_display_row').hide();
                        $('#deactivation_reason_input').val('');
                    } else {
                        $('#status_inactive').prop('checked', true);
                        lastConfirmedStatus = '0';
                        $('#deactivation_reason_display_row').hide();
                        $('#deactivation_reason_input').val('');
                    }
                    $('#hidden_deactivation_reason').val(response.deactivation_reason || '');
                    isDeactivationSubmitted = false;
                    
                    if (response.deactivation_date != null) {
                        $('#deactivation_date').prop('checked', true);
                    } else {
                        $('#deactivation_date').prop('checked', false);
                    }
                    $('#depart_id').val(response.department);

                    if (response.courses && response.courses.trim() !== '') {
                        $('.department_based .course-names').text('Showing courses from ' + response.courses + '. Click here to reset.');
                        $('.department_based').show();
                    } else {
                        $('.department_based .course-names').text('No Courses is matching for this user\'s department. Click here to reset.');
                        $('.department_based').show();
                    }

                    var selectedOptions = JSON.parse(response.user_type);
                    $("#user_type1").find("option").prop("selected", false);
                    for (var i in selectedOptions) {
                        var optionVal = selectedOptions[i].trim(); 
                        $("#user_type1").find("option[value='" + optionVal + "']").prop("selected", true);
                    }
                    $("#user_type1").multiselect('refresh');

                    $('#language option').removeAttr('selected'); 
                    $('#language option[value="' + response.language + '"]').attr('selected', 'selected');
                    $('#user_form').show();

                    $('.user_report_list').html(response.reports_html);
                    $('#assignmentExamModalsContainer').html(response.assignment_modals_html || '');
                    $('.user_assignments_list').html(response.assignments_html);
                    $('.user_activity_list').html(response.activity_html);

                    var userDetailsContainer = $('#userDetailsContainer tbody');
                    userDetailsContainer.empty();
                    $('body').find('.course_filter').removeAttr('checked', false); 
                    response.course.forEach(function(user) {
                        $('body').find('#role-'+user.category_name).attr('checked','checked'); 
                        $('.reset_filters_button').show();
                        $('#filtersButton').addClass('filters-active');
                        $('#filtersIndicator').css('display', 'inline-block');
                        var isChecked = user.assign_id !== 0 ? 'checked' : '';
                        var userDetailsHtml = `
                        <tr>
                        <td style="width: 560px;">
                             <div class="d-flex align-items-center">
                                 <div class="profile-image-div-sm">
                                     <img src="${user.profile_image ? user.profile_image : '{{ url('public/images/face12.jpg') }}'}" class="img-fluid" alt="">
                                 </div>
                                 <div class="ms-2">
                                     <div class="course-name font-weight-bold">${user.course_name}</div>
                                 </div>
                             </div>
                        </td>
                       <td>${user.category_name}</td>
                       <td><div class="d-flex align-items-center"><div class="custom-control custom-switch">
                       <input type="checkbox" data-courseid="${user.course_id}" 
                       data-assigned_user_id="${user.assign_id}" data-user_id="${response.id}" data-onstyle="1" data-offstyle="0" id="gstoggle-${user.course_id}" class="user_checked custom-control-input toggle-class" ${isChecked} > <label class="custom-control-label" for="gstoggle-${user.course_id}"></label>
                       </div>${user.assign_id !== 0 ? `<button type="button" class="btn btn-sm btn-outline-primary ms-2 reassign-course" data-course-id="${user.course_id}" data-user-id="${response.id}">Reassign</button>` : ''}</div></td>
                       </tr>
                        `;
                        userDetailsContainer.append(userDetailsHtml);
                    });

                    $('body').on('change','.user_checked', function() {
                        var courseId = $(this).data('courseid');
                        var assignedUserId = $(this).data('assigned_user_id');
                        var userid = $(this).data('user_id');
                        var isChecked = $(this).prop('checked');
                        var status = isChecked ? 1 : 0; 
                        
                        $.ajax({
                            url: "{{url('fetch_signleCourse_userData')}}",
                            method: 'get',
                            data: {
                                courseid: courseId,
                                id: assignedUserId,
                                userid: userid,
                                status: status
                            },
                            success: function(response) {
                                if(status == 1){
                                    $.toast({
                                        heading: 'Success',
                                        text: 'Added Course to user successfully',
                                        position: 'bottom-right',
                                        stack: false,
                                        icon: 'success'
                                    });
                                }else{
                                   $.toast({
                                        heading: 'warning',
                                        text: 'Removed Course to user successfully.',
                                        position: 'bottom-right',
                                        stack: false,
                                        icon: 'warning'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                               $.toast({
                                    heading: 'warning',
                                    text: 'Failed to add users.',
                                    position: 'bottom-right',
                                    stack: false,
                                    icon: 'warning'
                                });
                           }
                       });
                    });        
                },
                error: function(xhr, status, error) {
                    console.error(error);
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        });

        $('body').on('click', '.reassign-course', function() {
            var button = $(this);
            var courseId = button.attr('data-course-id');
            var userId = button.attr('data-user-id');

            if (!confirm('Reassign this course? All assessment attempts for this user and course will be reset.')) {
                return;
            }

            button.prop('disabled', true).text('Reassigning...');

            $.ajax({
                url: "{{ url('reassign-course-to-user') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    course_id: courseId,
                    user_id: userId
                },
                success: function(response) {
                    button.closest('td').find('.user_checked')
                        .attr('data-assigned_user_id', response.assignment_id)
                        .data('assigned_user_id', response.assignment_id);

                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
                },
                error: function(xhr) {
                    $.toast({
                        heading: 'Warning',
                        text: xhr.responseJSON && xhr.responseJSON.message
                            ? xhr.responseJSON.message
                            : 'Failed to reassign course.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
                },
                complete: function() {
                    var courseIsAssigned = button.closest('td').find('.user_checked').prop('checked');
                    button.prop('disabled', !courseIsAssigned).text('Reassign');
                }
            });
        });

        $('body').on('change', '.user_checked', function() {
            $(this).closest('td').find('.reassign-course')
                .prop('disabled', !$(this).prop('checked'));
        });

        $(".assign_to_added_user").click(function() {
            assignCourses();
        });

        $('.toggle-class').change(function() {
            var courseid = $(this).data('course_id');
            var categoryid = $(this).data('category_id');
            var user_id = $(this).data('user_id');
            var isChecked = $(this).prop('checked');
            var status = isChecked ? 1 : 0; 

            $.ajax({
                url: "{{url('fetch_signleCourse_userData')}}",
                method: 'GET',
                data: {
                    courseid: courseid,
                    categoryid: categoryid,
                    userid: user_id,
                    status: status
                },
                success: function(response) {
                    if (response.status == 0) {
                        $.toast({
                            heading: 'warning',
                            text: response.message,
                            position: 'bottom-right',
                            stack: false,
                            icon: 'warning'
                        });
                    } else {
                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            position: 'bottom-right',
                            stack: false,
                            icon: 'success'
                        });
                    }
                },
                error: function(xhr, status, error) {}
            });
        });

        $('body').on('click', '.course_filter_button', function() {
            $('.search_query').val('');
            var formData = $('body').find('#course_list_filter').serialize();

            $.ajax({
                type: 'get',
                url: "{{url('get_courses_based_on_filters')}}",
                data: formData,
                dataType: 'html',
                success: function (response) {
                    $('body').find('#course_filters_body').html(response);
                    var filtersApplied = false;
                    $('body').find('.course_filter').each(function() {
                        if ($(this).is(':checked')) {
                            filtersApplied = true;
                            return false; 
                        }
                    });

                    if (filtersApplied) {
                        $('.reset_filters_button').show();
                        $('#filtersButton').addClass('filters-active');
                        $('#filtersIndicator').css('display', 'inline-block');
                    } else {
                        $('#filtersButton').removeClass('filters-active');
                        $('#filtersIndicator').css('display', 'none');
                    }
                }
            });
        });

        $('body').on('click','.search_user_courses_button',function(){
            var search_query = $('.search_query').val();
            var user_id = $('#hiddenuser_id').val();

            $.ajax({
                type: 'get',
                url: "{{url('get_courses_based_on_filters')}}",
                data: {
                    search_query: search_query,
                    user_id: user_id
                },
                dataType: 'html',
                success: function(response) {
                    $('#course_filters_body').html(response);
                    var filtersApplied = false;
                    $('body').find('.search_query').each(function() {
                        if ($('.search_query').val() !== '') {
                            filtersApplied = true;
                            return false; 
                        }
                    });

                    if (filtersApplied) {
                        $('.reset_filters_button').show();
                        $('#filtersButton').addClass('filters-active');
                        $('#filtersIndicator').css('display', 'inline-block');
                    } else {
                        $('#filtersButton').removeClass('filters-active');
                        $('#filtersIndicator').css('display', 'none');
                    }
                }
            });
        }); 

        $('body').on('click', '.reset_filters_button', function () {
            $('#course_list_filter')[0].reset();
            $('.course_filter_button').trigger('click');
        });
        // Auto-select user and activate reports tab when returning from Assessment (matching Course catalog behavior)
        var urlParams = new URLSearchParams(window.location.search);
        var activeUserId = urlParams.get('userId') || sessionStorage.getItem('lms_last_active_user_id');
        var activeUserSubTab = urlParams.get('open_tab') || urlParams.get('subtab') || sessionStorage.getItem('lms_last_active_user_tab') || 'reports';
        var activeCourseId = urlParams.get('course_id') || sessionStorage.getItem('lms_last_active_course_collapse_id');

        var autoSelectAttempts = 0;
        function trySelectUser() {
            autoSelectAttempts++;
            var $targetUserRow = $('.user_check[data-id="' + activeUserId + '"]').first();
            if ($targetUserRow.length) {
                // Clear sessionStorage once target user is found
                sessionStorage.removeItem('lms_last_active_user_id');
                sessionStorage.removeItem('lms_last_active_user_tab');
                sessionStorage.removeItem('lms_last_active_course_collapse_id');

                if ($targetUserRow[0].scrollIntoView) {
                    $targetUserRow[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                $targetUserRow.trigger('click');

                if (activeUserSubTab === 'info') {
                    $('#v-pills-user1').addClass('show active');
                    $('#vw').addClass('show active');
                    $('#manage-courses-access-tab, #user-list-reports-tab, #user-list-activity-tab').removeClass('active');
                    $('#info-tab').addClass('active');
                    $('#mca, #ul-reports, #ul-activity').removeClass('show active');
                    $('#info').addClass('show active');
                } else if (activeUserSubTab === 'reports' || !activeUserSubTab) {
                    var checkReportInterval = setInterval(function() {
                        var $reportsTabBtn = $('#user-list-reports-tab');
                        if ($reportsTabBtn.length && $('.user_after_select').is(':visible') && $('.user_report_list').children().length > 0) {
                            clearInterval(checkReportInterval);

                            // Ensure parent tab pane #vw and #v-pills-user1 are completely shown and active (preventing blank screen)
                            $('#v-pills-user1').addClass('show active');
                            $('#vw').addClass('show active');

                            // Switch to Reports sub-tab cleanly without affecting other page containers
                            $('#info-tab, #manage-courses-access-tab, #user-list-activity-tab').removeClass('active');
                            $reportsTabBtn.addClass('active');

                            $('#info, #mca, #ul-activity').removeClass('show active');
                            $('#ul-reports').addClass('show active');

                            if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                                try {
                                    var bsTab = bootstrap.Tab.getOrCreateInstance ? bootstrap.Tab.getOrCreateInstance($reportsTabBtn[0]) : new bootstrap.Tab($reportsTabBtn[0]);
                                    bsTab.show();
                                } catch(e) {}
                            }

                            // Open that particular course accordion cleanly
                            if (activeCourseId) {
                                setTimeout(function() {
                                    var collapseSelector = '#courseCollapse_' + activeCourseId;
                                    var $courseCollapse = $(collapseSelector);
                                    var $toggleBtn = $('button[data-bs-target="' + collapseSelector + '"], button[data-assign-id="' + activeCourseId + '"], button[data-course-id="' + activeCourseId + '"]').first();

                                    if ($toggleBtn.length) {
                                        if (!$courseCollapse.hasClass('show')) {
                                            $toggleBtn.trigger('click');
                                        }
                                        $toggleBtn.attr('aria-expanded', 'true');
                                        if ($courseCollapse.length) {
                                            $courseCollapse.addClass('show');
                                        }
                                        if ($toggleBtn[0].scrollIntoView) {
                                            $toggleBtn[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        }
                                    } else if ($courseCollapse.length) {
                                        $courseCollapse.addClass('show');
                                        var $btn = $('button[data-bs-target="#' + $courseCollapse.attr('id') + '"]');
                                        if ($btn.length) {
                                            $btn.attr('aria-expanded', 'true');
                                        }
                                    }
                                }, 250);
                            }
                        }
                    }, 100);

                    setTimeout(function() {
                        clearInterval(checkReportInterval);
                    }, 10000);
                }
            } else if (autoSelectAttempts < 25) {
                setTimeout(trySelectUser, 150);
            }
        }

        if (activeUserId) {
            trySelectUser();
        }
    });

    // Auto-close previously opened course dropdown when opening another one in Reports
    $(document).on('show.bs.collapse', '.user_report_list .collapse', function () {
        var currentCollapse = this;
        $('.user_report_list .collapse.show').each(function () {
            if (this !== currentCollapse) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                    var inst = bootstrap.Collapse.getInstance(this) || new bootstrap.Collapse(this, { toggle: false });
                    inst.hide();
                } else if ($.fn.collapse) {
                    $(this).collapse('hide');
                } else {
                    $(this).removeClass('show');
                }
                var otherId = $(this).attr('id');
                $('button[data-bs-target="#' + otherId + '"]').attr('aria-expanded', 'false');
            }
        });
    });

    $(document).on('click', '.dropdown-toggle-course', function() {
        var targetSelector = $(this).attr('data-bs-target');
        var $targetCollapse = targetSelector ? $(targetSelector) : null;
        var assignId = $(this).data('assign-id');

        if (assignId) {
            sessionStorage.setItem('lms_last_active_course_collapse_id', assignId);
        }

        // If target is currently closed, close all other open course dropdowns
        if ($targetCollapse && !$targetCollapse.hasClass('show')) {
            $('.user_report_list .collapse.show').not($targetCollapse).each(function() {
                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                    var inst = bootstrap.Collapse.getInstance(this) || new bootstrap.Collapse(this, { toggle: false });
                    inst.hide();
                } else if ($.fn.collapse) {
                    $(this).collapse('hide');
                } else {
                    $(this).removeClass('show');
                }
                var otherId = $(this).attr('id');
                $('button[data-bs-target="#' + otherId + '"]').attr('aria-expanded', 'false');
            });
        }
    });

    $('body').on('click','.get_certificates',function(){
        var assign_id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "{{ url('get_certificate') }}",
            data: {
                assign_id: assign_id,
                admin: 1
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

    $(document).on('click', '.take_result', function(e) { 
        e.preventDefault();
        var link = $(this).data('link');
        var userId = $(this).data('user-id') || $('#hiddenuser_id').val();
        var courseId = $(this).data('course-id');
        if (userId) {
            sessionStorage.setItem('lms_last_active_user_id', userId);
            sessionStorage.setItem('lms_last_active_user_tab', 'reports');
            if (courseId) {
                sessionStorage.setItem('lms_last_active_course_collapse_id', courseId);
            }
        }
        if (link) {
            window.location.href = link;
        }
    });

</script>

<script>
    function formatDate(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    function getTodayRange() {
        var today = new Date();
        return {
            from: formatDate(today),
            to: formatDate(today)
        };
    }

    function getLastWeekRange() {
        // Fixes UTC offset issue by using local date components
        var today = new Date();
        var lastWeekEnd = new Date(today.getTime() - (today.getDay() * 24 * 60 * 60 * 1000)); // End of last week (Saturday/Sunday)
        var lastWeekStart = new Date(lastWeekEnd.getTime() - (6 * 24 * 60 * 60 * 1000)); // 7 days prior

        return {
            from: formatDate(lastWeekStart),
            to: formatDate(lastWeekEnd)
        };
    }

    function getLastMonthRange() {
        var today = new Date();
        // Fully accurate local previous month calculation avoiding UTC shift bugs
        var year = today.getFullYear();
        var month = today.getMonth();
        
        var lastMonthStart = new Date(year, month - 1, 1);
        var lastMonthEnd = new Date(year, month, 0);

        return {
            from: formatDate(lastMonthStart),
            to: formatDate(lastMonthEnd)
        };
    }

    function resetPresetButtons() {
        $('.preset-filter-btn').css({
            'background-color': '#fff',
            'color': '#005452',
            'border-color': '#005452'
        }).removeClass('active');
    }

    function activatePreset(preset) {
        resetPresetButtons();
        $('.preset-filter-btn[data-preset="' + preset + '"]').css({
            'background-color': '#005452',
            'color': '#ffffff',
            'border-color': '#005452'
        }).addClass('active');
    }

    function checkMatchingPreset(fromDate, toDate) {
        if (!fromDate || !toDate) {
            activatePreset('all'); 
            return;
        }

        var todayRange = getTodayRange();
        var lastWeekRange = getLastWeekRange();
        var lastMonthRange = getLastMonthRange();

        if (fromDate === todayRange.from && toDate === todayRange.to) {
            activatePreset('today');
            return;
        }

        if (fromDate === lastWeekRange.from && toDate === lastWeekRange.to) {
            activatePreset('last_week');
            return;
        }

        if (fromDate === lastMonthRange.from && toDate === lastMonthRange.to) {
            activatePreset('this_month');
            return;
        }

        // If range doesn't match presets, activate Custom
        activatePreset('all');
    }

    function loadActivitiesByDates(fromDate, toDate) {
        var userId = $('#hiddenuser_id').val();
        if (!userId) return;

        $.ajax({
            type: 'GET',
            url: "{{ url('fetch_user_activity_filter') }}",
            data: {
                from_date: fromDate,
                to_date: toDate,
                user_id: userId
            },
            dataType: 'json',
            success: function(response) {
                $('.user_activity_list').html(response.activity_html);

                if (response.login_time || response.total_time_spent) {
                    $('#val_login_time').text(response.login_time || '--');
                    $('#val_logout_time').text(response.logout_time || '--');
                    $('#val_total_time').text(response.total_time_spent || '--');
                    $('#session_duration_container').show();
                } else {
                    $('#val_login_time').text('--');
                    $('#val_logout_time').text('--');
                    $('#val_total_time').text('0 minutes');
                    $('#session_duration_container').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching activity logs:', error);
            }
        });
    }

    $('.preset-filter-btn').on('click', function() {
        var preset = $(this).data('preset');
        var fromDate = '';
        var toDate = '';

        if (preset === 'today') {
            var todayRange = getTodayRange();
            fromDate = todayRange.from;
            toDate = todayRange.to;
        } else if (preset === 'last_week') {
            var lastWeekRange = getLastWeekRange();
            fromDate = lastWeekRange.from;
            toDate = lastWeekRange.to;
        } else if (preset === 'this_month') {
            var lastMonthRange = getLastMonthRange();
            fromDate = lastMonthRange.from;
            toDate = lastMonthRange.to;
        } else if (preset === 'all') {
            // Clicking Custom clears out the date input fields completely
            fromDate = '';
            toDate = '';
            $('#filter_from_date').val('');
            $('#filter_to_date').val('');
            activatePreset('all');
            loadActivitiesByDates('', '');
            return;
        }

        $('#filter_from_date').val(fromDate);
        $('#filter_to_date').val(toDate);

        checkMatchingPreset(fromDate, toDate);
        loadActivitiesByDates(fromDate, toDate);
    });

    $('#apply_custom_date_filter').on('click', function() {
        var fromDate = $('#filter_from_date').val();
        var toDate = $('#filter_to_date').val();

        if (!fromDate || !toDate) {
            activatePreset('all');
            loadActivitiesByDates('', '');
            return;
        }

        if (fromDate > toDate) {
            alert('From date cannot be later than To date.');
            return;
        }

        checkMatchingPreset(fromDate, toDate);
        loadActivitiesByDates(fromDate, toDate);
    });

    $('#filter_from_date, #filter_to_date').on('change', function() {
        var fromDate = $('#filter_from_date').val();
        var toDate = $('#filter_to_date').val();

        if (fromDate && toDate) {
            checkMatchingPreset(fromDate, toDate);
        } else {
            activatePreset('all');
        }
    });

    $('.user_check').on('click', function() {
        $('#filter_from_date').val('');
        $('#filter_to_date').val('');
        activatePreset('all');
        $('#session_duration_container').hide();
        $('.user_activity_list').html('');

        setTimeout(function() {
            loadActivitiesByDates('', '');
        }, 200);
    });

    $(document).ready(function() {
        activatePreset('all');
        $('#filter_from_date').val('');
        $('#filter_to_date').val('');
    });

    $(document).on('submit', '#status_checkbox_filter_form, #view_users_form', function(e) {
        if ($(this).find('input[name="user_status[]"]:checked').length === 0) {
            $(this).find('input[name="user_status[]"][value="1"]').prop('checked', true);
        }
    });
</script>
