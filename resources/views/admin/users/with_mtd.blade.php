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
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <form class="forms-sample pb-2" id="view_users_form" method="get" action="{{url('users')}}">
                                                    <input type="hidden" name="tab" value="2">
                                                    <button class="btn filterBtn filters-btnn dropdown-toggle" type="button"><i class="bi bi-filter"></i>
                                                        Filters @if(!empty(Request::get('dept_id')) || !empty(Request::get('desig_id')) || !empty(Request::get('search_name')))<i class="fa-solid fa-circle filters-dot-icon"></i> @endif
                                                    </button>
                                                    @if(!empty(Request::get('dept_id')) || !empty(Request::get('desig_id')) || !empty(Request::get('search_name')) )
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
                                                                        <div class="py-1 web-text-color font-weight-bold text-truncate" style="width: 150px;">{{$user->first_name??''}} {{$user->last_name??''}}</div>
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
                                             <div class="py-5">
                                <div id="loader" style="display: none;"><img src="{{ url('public/images/loading.gif') }}" class="img-fluid mx-auto d-block opacity-30" alt=""></div>
                            </div>
                                        </div>
                                    </div>
                                        <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 user_after_select rite-syde-content">
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
                                                                <button class="nav-link nav-linkk" id="user-list-reports-tab" data-bs-toggle="tab" data-bs-target="#ul-reports" type="button" role="tab" aria-controls="ul-reports" aria-selected="true">Reports</button>
                                                                <button class="nav-link nav-linkk" id="user-list-activity-tab" data-bs-toggle="tab" data-bs-target="#ul-activity" type="button" role="tab" aria-controls="ul-activity" aria-selected="true">Activity</button>
                                                            </div>
                                                        </nav>

                                                        <div class="tab-content border-0 mt-0 p-0 user-profile-scroll" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                                                <div class="card border-0 shadow-none border-radius-none">
                                                                    <div class="row px-0 user_form" id="user_form">
                                                                        <div class=" pr-2" >
                                                                        <form class="px-0" action="{{url('user_registrations_store')}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="col-12 py-2">
                                                                                <input type="hidden" class="form-control" id="id" name="id" />
                                                                                <input type="hidden" class="form-control" value="2" name="tab" />


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
                                                            <div class="form-group row px-2">
                                                                <div class="col-sm-2 col-form-label"></div>
                                                                <div class="col-sm-10">
                                                                    <div class="form-check ">
                                                                        <label class="form-check-label"> <input type="checkbox" name="active" id="active" class="form-check-input" value="1" /> Active </label>
                                                                    </div>

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
          

<div class="tab-pane fade" id="ul-activity" role="tabpanel" aria-labelledby="user-list-activity-tab">
    <div class="row p-2">
        <div class="col-12">
            <div class="row mb-3 align-items-center">
                <div class="col-12 col-lg-3 my-auto">
                    <div class="font-weight-bold">
                        Activity Log & Sessions <i class="fa-solid fa-circle-info"></i>
                    </div>
                </div>
                
                <!-- Filter Section with Custom, Today, WTD, MTD Buttons -->
                <div class="col-12 col-lg-9 my-auto">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                        
                        <!-- Preset Filter Buttons (Including "Custom" button) -->
                        <div class="btn-group btn-group-sm me-2 mb-1" role="group">
                            <button type="button" class="btn preset-filter-btn" data-preset="today" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Today</button>
                            <button type="button" class="btn preset-filter-btn" data-preset="week_to_date" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Week to Date</button>
                            <button type="button" class="btn preset-filter-btn" data-preset="month_to_date" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Month to Date</button>
                            <button type="button" class="btn preset-filter-btn" data-preset="all" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Custom</button>
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
            $('.user_activity_list').html('');
          
            $('.user_check').find('td').removeClass('course-active');
            $(this).find('td').addClass('course-active');
            $(".user_before_select").hide();
            $(".user_after_select").show();

            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 100000);

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
                    $('#active').prop('checked', response.active == 1);
                    
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
                       <td><div class="custom-control custom-switch">
                       <input type="checkbox" data-courseid="${user.course_id}" 
                       data-assigned_user_id="${user.assign_id}" data-user_id="${response.id}" data-onstyle="1" data-offstyle="0" id="gstoggle-${user.course_id}" class="user_checked custom-control-input toggle-class" ${isChecked} > <label class="custom-control-label" for="gstoggle-${user.course_id}"></label>
                       </div></td>
                       </tr>
                        `;
                        userDetailsContainer.append(userDetailsHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    // Helper function to check if custom dates match Today, WTD, MTD, or Custom
    function checkMatchingPreset(fromDate, toDate) {
        var today = new Date();
        var todayStr = today.toISOString().split('T')[0];

        // Reset all buttons first
        $('.preset-filter-btn').css({
            'background-color': '#fff',
            'color': '#005452',
            'border-color': '#005452'
        }).removeClass('active');

        // Empty dates = Custom
        if (!fromDate && !toDate) {
            $('.preset-filter-btn[data-preset="all"]').css({
                'background-color': '#005452',
                'color': '#ffffff',
                'border-color': '#005452'
            }).addClass('active');

            return;
        }

        var matchedPreset = null;

        // -----------------------------------
        // Calculate WTD range
        // -----------------------------------
        var curr = new Date(today);
        var day = curr.getDay();

        var diff = curr.getDate() - day + (day === 0 ? -6 : 1);

        var monday = new Date(curr);
        monday.setDate(diff);

        var mondayStr = monday.toISOString().split('T')[0];

        // -----------------------------------
        // Calculate MTD range
        // -----------------------------------
        var monthStartStr =
            today.getFullYear() +
            '-' +
            String(today.getMonth() + 1).padStart(2, '0') +
            '-01';

        // -----------------------------------
        //  Today
        // -----------------------------------
        if (fromDate === todayStr && toDate === todayStr) {
            matchedPreset = 'today';
        }

        // -----------------------------------
        //  WTD
        // From and To must both be inside
        // Monday -> Today
        // -----------------------------------
        else if (
            fromDate >= mondayStr &&
            fromDate <= todayStr &&
            toDate >= mondayStr &&
            toDate <= todayStr
        ) {
            matchedPreset = 'week_to_date';
        }

        // -----------------------------------
        // MTD
        // From and To must both be inside
        // Month Start -> Today
        // -----------------------------------
        else if (
            fromDate >= monthStartStr &&
            fromDate <= todayStr &&
            toDate >= monthStartStr &&
            toDate <= todayStr
        ) {
            matchedPreset = 'month_to_date';
        }

        // -----------------------------------
        // Anything outside MTD = Custom
        // -----------------------------------
        else {
            matchedPreset = 'all';
        }

        // Activate matched button
        $('.preset-filter-btn[data-preset="' + matchedPreset + '"]').css({
            'background-color': '#005452',
            'color': '#ffffff',
            'border-color': '#005452'
        }).addClass('active');
    }

    // Helper function for AJAX call
    function loadActivitiesByDates(fromDate, toDate) {
        var userId = $('#hiddenuser_id').val();

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

                if(response.login_time || response.total_time_spent) {
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

    // Handle Preset Button Clicks (Today, Week-to-Date, Month-to-Date, Custom)
    $('.preset-filter-btn').on('click', function() {
        var preset = $(this).data('preset');
        var today = new Date();
        var todayStr = today.toISOString().split('T')[0];
        var fromDate = '';
        var toDate = '';

        if (preset === 'today') {
            fromDate = todayStr;
            toDate = todayStr;
        } else if (preset === 'week_to_date') {
            var curr = new Date(today);
            var day = curr.getDay();
            var diff = curr.getDate() - day + (day === 0 ? -6 : 1);
            var monday = new Date(curr.setDate(diff));
            fromDate = monday.toISOString().split('T')[0];
            toDate = todayStr;
        } else if (preset === 'month_to_date') {
            fromDate = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-01';
            toDate = todayStr;
        } else if (preset === 'all') {
            fromDate = '';
            toDate = '';
        }

        $('#filter_from_date').val(fromDate);
        $('#filter_to_date').val(toDate);

        checkMatchingPreset(fromDate, toDate);
        loadActivitiesByDates(fromDate, toDate);
    });

    // Handle Custom Filter Button Click & Auto-Check Ranges
    $('#apply_custom_date_filter').on('click', function() {
        var fromDate = $('#filter_from_date').val();
        var toDate = $('#filter_to_date').val();
        
        checkMatchingPreset(fromDate, toDate);
        loadActivitiesByDates(fromDate, toDate);
    });

    // Clear/Reset filter fields and activate "Custom" button by default when clicking a new user
    $('.user_check').on('click', function() {
        $('#filter_from_date').val('');
        $('#filter_to_date').val('');
        
        $('.preset-filter-btn').css({
            'background-color': '#fff',
            'color': '#005452',
            'border-color': '#005452'
        }).removeClass('active');
        
        $('.preset-filter-btn[data-preset="all"]').css({
            'background-color': '#005452',
            'color': '#ffffff',
            'border-color': '#005452'
        }).addClass('active');
        
        var userId = $(this).data('id');
        setTimeout(function() {
            loadActivitiesByDates('', '');
        }, 200);
    });

</script>