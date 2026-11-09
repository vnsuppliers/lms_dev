<div class="" id="roless" role="tabpanel" aria-labelledby="role-tab">
    <div class="row">
        <div class="col-12 mt-2">
            <nav class="d-flex justify-content-between align-items-center border-bottom">
                <div class="nav nav-tabs bg-white mx-2 rounded-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="true"><i class="fa-solid fa-user-gear headings-icon"></i> <span class="menuu-text">Roles</span> </button>
                    <button class="nav-link" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab" aria-controls="permissions" aria-selected="true"><i class="fa-solid fa-user-lock headings-icon"></i><span class="menuu-text">Permissions</span> </button>
                </div>
            </nav>
        </div>
       <!--  <div class="col-12 col-sm-4 col-md-3 col-lg-1p5 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills py-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <a class="nav-link nav-s {{ request()->query('tab') == 1  || !request()->query('tab') ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#roles" role="tab" aria-controls="roles" aria-selected="true">
                        <div><img src="images/icons/add-courses.jpg" class="mx-auto d-block" alt=""></div>
                        <span>Roles</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 2 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-viewrole-tab" data-toggle="pill" href="#view_roles" role="tab" aria-controls="viewRoles" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>View Roles</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 3 ? 'active' : '' }}  border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">
                        <div><img src="images/icons/add-courses.jpg" class="mx-auto d-block" alt=""></div>
                        <span>Permissions</span>
                    </a>
                    <a class="nav-link nav-s {{ request()->query('tab') == 4 ? 'active' : '' }} border-0 text-center align-items-center icon-img" id="v-pills-view-per-tab" data-toggle="pill" href="#view_permissions" role="tab" aria-controls="viewPermissions" aria-selected="true">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block" alt=""></div>
                        
                        <span>View Permissions</span>
                    </a>
                    
                </div>
            </div>
        </div> -->
        <div class="col-12 col-lg-12">
            <div class="tab-content border-0" id="v-pills-tabContent">
                <div class="tab-pane border border-0  fade {{ request()->query('tab') == 1  || !request()->query('tab') ? 'show active' : '' }}" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                    
                     <div class="row mx-0">
                       
                    <div class="col-12 col-lg-7 px-2">
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div>
                                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Roles </label>
                            </div>

                            <div>
                                <a href="{{url('roles?tab=2')}}" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Roles</a>
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
                                <form action="{{ url('storerole') }}" method="POST" class="forms-sample">
                                    @csrf
                                    <!-- Add CSRF protection -->
                                    <input type="hidden" name="id" value="{{ $list_id->id ?? '' }}" />

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Role name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="exampleInputUsername1" name="role" placeholder="" value="{{ $list_id->role ?? '' }}" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Role Type</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="role_type" name="role_type" required>
                                                <option value="">-- select --</option>
                                                <option value="0" @if(isset($list_id) && $list_id->role_type == 0) selected @endif>User</option>
                                                <option value="1" @if(isset($list_id) && $list_id->role_type == 1) selected @endif>Admin</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row admin-permissions" style="@if(isset($list_id) && $list_id->role_type == 1) display: block; @else display: none; @endif">
                                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label pt-2">Permissions :</label>
                                        <div class="col-sm-9">
                                             @foreach($permission_data->where('main_menu_type','!=','User Side')->groupBy('main_menu_type') as $mainMenuType => $permissions)
                                            <label class="col-form-label pt-2 pb-0 mb-0">{{ $mainMenuType }}</label>
                                             @foreach($permissions as $permission)
                                            <div class="form-check pl-3 ml-2 align-items-center d-flex">
                                               
                                                     @php
                                                       $permissionType = strtolower(substr($permission->permission, 0, 3));

                                                    @endphp
                                                 <input class="form-check-input" type="checkbox" name="permission_id[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                                           @if(isset($list_id) && in_array($permission->id, json_decode($list_id->permission_id))) checked @endif
                                                           data-main-menu="{{ $mainMenuType }}"
                                                           data-permission="{{ $permission->id }}"
                                                           data-type="{{ $permissionType }}" >
                                                <label class="form-check-label ml-2 mb-0 mt-1" for="permission_{{ $permission->id }}">{{ $permission->permission }}<i class="input-helper"></i><i class="input-helper"></i></label>
                                                
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group row user-permissions" style="@if(isset($list_id) && $list_id->role_type == 0) display: block; @else display: none; @endif">
                                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label pt-2">Permissions :</label>
                                        <div class="col-sm-9">
                                             @foreach($permission_data->where('main_menu_type','=','User Side')->groupBy('main_menu_type') as $mainMenuType => $permissions)
                                            <label class="col-form-label pt-2 pb-0 mb-0">{{ $mainMenuType }}</label>
                                             @foreach($permissions as $permission)
                                            <div class="form-check pl-3 ml-2 align-items-center d-flex">
                                               
                                                     @php
                                                       $permissionType = strtolower(substr($permission->permission, 0, 3));

                                                    @endphp
                                                 <input class="form-check-input" type="checkbox" name="permission_id[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                                           @if(isset($list_id) && in_array($permission->id, json_decode($list_id->permission_id))) checked @endif
                                                           data-main-menu="{{ $mainMenuType }}"
                                                           data-permission="{{ $permission->id }}"
                                                           data-type="{{ $permissionType }}" >
                                                <label class="form-check-label ml-2 mb-0 mt-1" for="permission_{{ $permission->id }}">{{ $permission->permission }}<i class="input-helper"></i><i class="input-helper"></i></label>
                                                
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="status" name="status" required>
                                                @if(!isset($list_id))
                                                    <option value="">-- select --</option>
                                                @endif
                                                <option value="1" @if(isset($list_id) && $list_id->status == 1) selected @endif>Active</option>
                                                <option value="0" @if(isset($list_id) && $list_id->status == 0) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn sbmt-btn py-2 mr-2">Submit</button>
                                            <button type="button" class="btn cancel-btn py-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            var isChecked = $(this).prop('checked');
            var mainMenuType = $(this).data('main-menu');
            var permissionId = $(this).data('permission');
            var permissionType = $(this).data('type');

            if (permissionType === 'add') {
              
                var viewCheckbox = $('input[type="checkbox"][data-main-menu="' + mainMenuType + '"][data-type="vie"]');
                
            
                if (isChecked) {
                    viewCheckbox.prop('checked', true);
                } else {
                  
                    viewCheckbox.prop('checked', false);
                }
            } else if (permissionType === 'view') {
                
                var addCheckbox = $('input[type="checkbox"][data-main-menu="' + mainMenuType + '"][data-type="add"]');
                if (!isChecked) {
                    addCheckbox.prop('checked', false);
                }
            }
        });

          $('#role_type').change(function () {
            var selectedRoleType = $(this).val();
            if (selectedRoleType == '1') { // Admin role
                $('.admin-permissions').show();
                $('.user-permissions').hide();
            } else if (selectedRoleType == '0') { // User role
                $('.admin-permissions').hide();
                $('.user-permissions').show();
            } else {
                $('.admin-permissions').hide();
                $('.user-permissions').hide();
            }
        });

        $('#role_type').trigger('change');
    });
</script>                