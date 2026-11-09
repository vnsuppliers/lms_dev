<div class="tab-pane fade {{ request()->query('tab') == 4 ? 'show active' : '' }}" id="v-pills-groups" role="tabpanel" aria-labelledby="v-pills-tab-threes">
    <div>
        <!-- <div class="col-12 col-lg-4 pe-0">
            <div class="py-2 mx-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <label class="mb-0 d-flex align-items-center font-weight-bold"><span class="togyle-btn" onclick="togglePanel()"><i class="fa-solid fa-bars-staggered"></i></span><i class="fa-solid fa-eye menuu-icon"></i>View Groups</label>
                    </div>

                    <div>
                        <a href="{{url('users?tab=3')}}" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add Group</a>
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
                        <i class="fa-solid fa-users headings-icon text-blue"></i>View Groups </label>
                    </div>
                    <div>
                        <a href="{{url('users?tab=3')}}" class="btn web-btn admin-add-btns"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content border-0 mt-0 px-0 pt-0 pb-2" id="myTabContent">
                <div class="tab-pane fade show active" id="vg" role="tabpanel" aria-labelledby="vg-tab">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="card card-border border-top-0 shadow-none rounded-0 pb-2">
                                <div class="card-body px-2 py-0 rounded-0">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-4 bg-white py-2 rounded-3 laft-syde-content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <form class="forms-sample pb-2">
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="dropdown mb-2 d-flex justify-content-between">
                                                                    <div>
                                                                        <button class="btn btn-sm btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: none;">
                                                                            Filters
                                                                        </button>
                                                                    </div>

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
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>S.NO</th> -->

                                                                <th scope="col">Group Name</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1;?>
                                                            @foreach($groups_lists as $groups_list)
                                                            <tr class="group_list_data" style="cursor: pointer;" data-id="{{$groups_list->id}}">
                                                                <!-- <td>{{$i++}}</td> -->

                                                                <td scope="row">
                                                                    <div class="pl-2">
                                                                        <div class="py-1">{{$groups_list->name??''}} </div>
                                                                    </div>
                                                                </td>
                                                                <td> {{ isset($groups_list->status) && $groups_list->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                                <td>
                                                                    <a class="mr-2" href="{{url('users')}}?id={{$groups_list->id}}&tab=3"><i class="bi bi-pen font-16 text-primary" style="font-weight: bold !important;"></i></a>
                                                                    <a href="{{url('group_destroy') }}?id={{$groups_list->id}}" title="{{__('Delete')}}" class=""><i class="bi bi-trash text-danger font-16"></i></a>

                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 rite-syde-content">
                                            <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active p-2" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                    <h3 class="font-weight-normal pt-2 mb-1">User Details</h3>
                                                    <div>
                                                        <nav class="pt-2">
                                                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Users</button>
                                                            </div>
                                                        </nav>

                                                        <div class="tab-content border-0 mt-0 p-0" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="in-tab">
                                                                <div class="card card-border border-top-0 shadow-none border-radius-none">

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

                                                                    <div class="table-responsive">
                                                                        <table class="table" id="groupuserDetailsContainer">
                                                                            <thead>
                                                                                <tr>
                                                                                    
                                                                                    <th scope="col">User Name</th>
                                                                                    <th scope="col" class="text-center">Email</th>
                                                                                    <th scope="col" class="text-center">Emp Id</th>
                                                                                    <th scope="col" class="text-center">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="group_users_data">

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="t1-course" role="tabpanel" aria-labelledby="t1-tab">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                            <div class="card-body p-2 rounded-0 p-0">
                                                                                <div>
                                                                                    <form class="forms-sample pt-1">
                                                                                        <div class="dropdown mb-2">
                                                                                            <button class="btn btn-sm btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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

                                                                                    <div class="table-responsive">
                                                                                        <table class="table">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th></th>
                                                                                                    <th scope="col">Course Details</th>
                                                                                                    <th scope="col">Category</th>
                                                                                                    <th scope="col" class="text-center">Last Updated On</th>
                                                                                                    <!-- <th scope="col" class="text-center">Options</th> -->
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane card-border border-top-0 fade" id="t2-reports" role="tabpanel" aria-labelledby="t2-tab">
                                                                <div class="row mx-0">
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-2">
                                                                        <div class="work-in-prog">Work In Progess</div>
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


</div>
</div>
</div>
</div>
</div>
</div>