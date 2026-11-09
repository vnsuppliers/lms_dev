<style type="text/css">
    .hidden {
        display: none;
    }
    .green-background {
        background-color: #c6e4ff !important;
    }
    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }
    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }
</style>

<div class="tab-pane" id="ui" role="tabpanel" aria-labelledby="ui-tab">
    <div class="row">
        @if(session('error'))
       <script type="text/javascript">
        $.toast({
                heading: 'warning',
                text: '{{ session("error") }}',
                position: 'bottom-right',
                stack: false,
                icon: 'success'
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

        <div class="col-12 col-lg-12">
            <div class="tab-content border-0 p-0 content-bg rounded-3" id="v-pills-tabContent">
                <div class="tab-pane {{ request()->query('tab') == 1 || !request()->query('tab') ? ' show active' : '' }}" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                    
                    <div>
                        <div class="p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                @if(hasPermission(1))
                                <div>
                                    <label class="mb-0 d-flex align-items-center font-weight-bold @if(Request::get('menu')=='') active @endif"><i class="fa-solid fa-plus headings-icon"></i>Add User</label>
                                </div>
                                @endif @if(isset($request->id)) @if(hasPermission(7))
                                <div>
                                    <label class="mb-0 d-flex align-items-center @if(Request::get('menu')=='1') active @endif"><i class="fa-solid fa-plus headings-icon"></i>Assign Courses</label>
                                </div>
                                @endif @endif
                                <div>
                                    <a href="{{url('users?tab=2')}}" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Users</a>
                                </div>
                            </div>
                        </div>
                            
                        <!-- <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                @if(hasPermission(1))
                                <button class="nav-link @if(Request::get('menu')=='') active @endif" id="ad-tab" data-bs-toggle="tab" data-bs-target="#ad" type="button" role="tab" aria-controls="ad" aria-selected="true"><i class="fa-solid fa-user-plus menuu-icon"></i> <span class="menuu-text">Add User</span></button>
                                @endif @if(isset($request->id)) @if(hasPermission(7))
                                <button class="nav-link @if(Request::get('menu')=='1') active @endif" id="vu-tab" data-bs-toggle="tab" data-bs-target="#vu" type="button" role="tab" aria-controls="vu" aria-selected="true">
                                    Assign Courses
                                </button>
                                @endif @endif
                            </div>
                        </nav> -->
                      
                        <div class="tab-content border-0 p-0" id="myTabContent">
                            @if(hasPermission(1))
                            <div class="tab-pane card-border border-top-0 fade @if(Request::get('menu')=='') show active @endif" id="ad" role="tabpanel" aria-labelledby="addc-tab">
                                <div class="card border-0 shadow-none border-radius-none">
                                    <div class="row mx-0">
                                        <div class="col-12 col-lg-7 px-2">
                                            <form class="p-2 rounded-3" id="user_add_form" action="{{url('user_registrations_store')}}" method="post" enctype="multipart/form-data" id="form">
                                                <div class="row">
                                                    @csrf

                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" id="add_email" class="form-control" name="email" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="first_name" class="col-sm-3 col-form-label">First name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="add_first_name" name="first_name" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3 col-form-label">Last name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="last_name"  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="emp_id" class="col-sm-3 col-form-label">EMP ID</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="add_emp_id" name="emp_id" required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control mb-2" rows="4" name="description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="add_username" name="username" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control" name="password" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="profile_image" class="col-sm-3 col-form-label">Profile Image</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" class="form-control" name="profile_image"  accept=".jpg,.png,.jpeg" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">User type</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control multiple_select user_type" id="user_type" name="roles[]" multiple>
                                                                    @foreach($roles_lists as $roles_list)
                                                                    <option value="{{ $roles_list->id}}" @if(in_array($roles_list->id, request()->input('roles', []))) selected @endif>
                                                                        {{$roles_list->role}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                       
                                             


                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Designation</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="designation" id="add_designation">
                                                                    @foreach($designations as $designation)
                                                                    <option value="{{ $designation->id }}">{{ $designation->designation_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Department</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="department" id="add_department">
                                                                    @foreach($departments as $department)
                                                                    <option value="{{ $department->id }}">{{ $department->department_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Team Lead</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single form-control" name="team_lead" id="add_team_lead">
                                                                    <option value="">Select Team Lead</option>
                                                                    @foreach($team_leads as $team_lead)
                                                                    <option value="{{$team_lead->emp_id??''}}">{{ $team_lead->first_name??'' }} {{ $team_lead->last_name??'' }}- {{ $team_lead->emp_id??'' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Reporting Manager-1</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single form-control" name="reporting_manager1" id="add_reporting_manager1">
                                                                    <option value="">Select Reporting Manager-1</option>
                                                                    @foreach($manager1_users as $manager1_user)
                                                                     <option value="{{$manager1_user->emp_id??''}}">{{ $manager1_user->first_name??'' }} {{ $manager1_user->last_name??'' }}- {{ $manager1_user->emp_id ??''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Reporting Manager-2</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single form-control" name="reporting_manager2" id="add_reporting_manager2">
                                                                    <option value="">Select Reporting Manager-2</option>
                                                                    @foreach($manager2_users as $manager2_user)
                                                                    <option value="{{$manager2_user->emp_id??''}}">{{ $manager2_user->first_name??'' }} {{ $manager2_user->last_name??'' }}- {{ $manager2_user->emp_id ??''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Trainer Manager</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single form-control training_manager" name="training_manager" id="training_manager">
                                                                    <option value="">Select Trainer Manager</option>
                                                                    @foreach($training_managers as $training_manager)
                                                                    <option value="{{$training_manager->emp_id??''}}">{{ $training_manager->first_name??'' }} - {{ $training_manager->emp_id ??''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Senior Trainer</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single form-control senior_training_manager" name="senior_training_manager" id="senior_training_manager">
                                                                    <option value="">Select Senior Trainer</option>
                                                                    @foreach($senior_training_managers as $senior_training_manager)
                                                                    <option value="{{$senior_training_manager->emp_id??''}}">{{ $senior_training_manager->first_name??'' }} - {{ $senior_training_manager->emp_id ??''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="form-group row px-2">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="active" value="0">
                                                                    <label class="form-check-label"> <input type="checkbox" name="active" class="form-check-input" checked value="1" /> Active </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn sbmt-btn mr-2">Add User</button>
                                                            <button type="button" class="btn cancel-btn">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-12 col-lg-5 pt2">
                                            <div class="mb-3">
                                                <a href="javascript:;" class="btn web-btn" id="get_data_button">Fetch Data</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
