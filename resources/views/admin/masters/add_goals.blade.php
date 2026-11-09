<div class="" id="roless" role="tabpanel" aria-labelledby="masters-tab">
    <div class="row">
        <div class="col-12 mt-2">
            <nav class="d-flex justify-content-between align-items-center border-bottom">
                <div class="nav nav-tabs bg-white mx-2 rounded-3" id="nav-tab" role="tablist">
                    <button class="nav-link {{ request()->query('tab') == 1 || !request()->query('tab') ? 'active' : '' }}" id="goals-tab" data-bs-toggle="tab" data-bs-target="#goals" type="button" role="tab" aria-controls="goals" aria-selected="true"><i class="fa-solid fa-bullseye headings-icon"></i> <span class="menuu-text">Goals</span> </button>
                    <button class="nav-link" id="levels-tab" data-bs-toggle="tab" data-bs-target="#levels" type="button" role="tab" aria-controls="levels" aria-selected="true"><i class="fa-solid fa-chart-line headings-icon"></i><span class="menuu-text">Levels</span> </button>
                    <button class="nav-link" id="certificate-tab" data-bs-toggle="tab" data-bs-target="#certificate" type="button" role="tab" aria-controls="certificate" aria-selected="true"><i class="fa-solid fa-certificate headings-icon"></i><span class="menuu-text">Certificate</span> </button>
                     {{-- <button class="nav-link" id="singature-tab" data-bs-toggle="tab" data-bs-target="#singature" type="button" role="tab" aria-controls="singature" aria-selected="true"><i class="fa-solid fa-certificate headings-icon"></i><span class="menuu-text">Add Signature</span> </button> --}}
                     <button class="nav-link {{ request()->query('tab') == 8 ? 'active' : '' }}" id="ratings-feedback-tab" data-bs-toggle="tab" data-bs-target="#ratings-feedback" type="button" role="tab" aria-controls="ratings-feedback" aria-selected="true"><i class="fa-solid fa-certificate headings-icon"></i><span class="menuu-text">Ratings & Feedback</span> </button>
                </div>
            </nav>
        </div>
        <div class="col-12 col-sm-4 col-md-2">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills py-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <!-- <a class="nav-link nav-s {{ request()->query('tab') == 1  || !request()->query('tab') ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#roles" role="tab" aria-controls="roles" aria-selected="true">
                        <div><img src="images/icons/add-courses.jpg" class="mx-auto d-block" alt=""></div>
                        <span>Goals</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 2 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-viewrole-tab" data-toggle="pill" href="#view_roles" role="tab" aria-controls="viewRoles" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>View Goals</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 3 ? 'active' : '' }}  border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">
                        <div><img src="images/icons/add-courses.jpg" class="mx-auto d-block" alt=""></div>
                        <span>Levels</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 4 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#view_permissions" role="tab" aria-controls="viewPermissions" aria-selected="true">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>View Levels</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 5 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#certificates" role="tab" aria-controls="certificates" aria-selected="true">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>Certificate</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 6 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#view_certificates" role="tab" aria-controls="viewCertificates" aria-selected="true">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>View Certificate</span>
                    </a> --> 
                    <!--  <a class="nav-link nav-s {{ request()->query('tab') == 7 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#add_templates" role="tab" aria-controls="addtemplates" aria-selected="true">
                        <div></div>
                        
                        <span>Add Certificate Templates</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 8 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#viewtemplates" role="tab" aria-controls="viewtemplates" aria-selected="true">
                        <div></div>
                        <span>View Certificate Templates</span>
                    </a> -->
                    
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="tab-content border-0 pt-0 pb-2" id="v-pills-tabContent">
                 
                <div class="tab-pane border border-top-0  fade {{ request()->query('tab') == 1  || !request()->query('tab') ? 'show active' : '' }}" id="goals" role="tabpanel" aria-labelledby="goals">
                    
                     <div class="row">
                        
                    <div class="col-12 col-lg-7 ">
                        <div class="py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Goals </label>
                            </div>

                            <div>
                                <a href="{{url('masters?tab=2')}}" class="btn web-btn {{ request()->query('tab') == 2 ? 'active' : '' }}"><i class="fa-solid fa-eye btnn-icon"></i>View Goals</a>
                            </div>
                        </div>
                    </div>
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
                        <div class="bg-white p-2 rounded-3">
                            <form action="{{ url('storegoal') }}" method="POST" class="forms-sample">
                                @csrf
                                <!-- Add CSRF protection -->
                                <input type="hidden" name="id" value="{{ $goal_id->id ?? '' }}" />
                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Goal name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="" value="{{ $goal_id->name ?? '' }}" required />
                                    </div>
                                </div>
                              

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" name="status">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="status" name="status" required>
                                            @if(!isset($goal_id))
                                                <option value="">-- select --</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            @endif
                                            <option value="1" @if(isset($goal_id) && $goal_id->status == 1) selected @endif>Active</option>
                                            <option value="0" @if(isset($goal_id) && $goal_id->status == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn sbmt-btn mr-2">Submit</button>
                                        <button type="button" class="btn cancel-btn">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


<script>
    $(document).ready(function () {
       

        $('#role_type').trigger('change');
    });
</script>                
