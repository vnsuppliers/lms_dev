<div class="tab-pane fade {{ request()->query('tab') == 6 ? 'show active' : '' }} mb-1" id="v-vi-sub-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
    <div>
         <nav>
            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                <button class="nav-link active" style="border-bottom: 0px !important;" id="view-sub-category-tab" data-bs-toggle="tab" data-bs-target="#view-sub-category" type="button" role="tab" aria-controls="view-sub-category" aria-selected="true">View Sub Category</button>
            </div>
        </nav>
    </div>
    <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
        <div class="tab-pane fade show active" id="vw-su-ca" role="tabpanel" aria-labelledby="vw-su-ca-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card card-border shadow-none rounded-0">
                        <div class="card-body p-2 rounded-0">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-7">
                                    <div>
                                        <form class="forms-sample">
                                            <div class="dropdown mb-2 d-flex justify-content-between">
                                                <div>
                                                <button class="btn btn-sm btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Filters
                                                </button>
                                            </div>
                                            <div>
                                                 <a class="btn btn-sm btn-primary" href="{{url('coursecatalog?tab=5')}}">
                                                 Add  Subategory
                                                 </a>
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
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <!-- <th scope="col">S.No</th> -->
                                                    <th scope="col">Category Name</th>
                                                    <th scope="col">Sub Category</th>
                                                    <th scope="col" class="text-center">Status</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1;?>
                                                @foreach($sub_data as $s)

                                                <tr>
                                                    <!-- <td>{{$i++}}</td> -->
                                                    <td scope="row">{{$s->cat->category_name??''}}</td>
                                                    <td>{{$s->subcategory_name??''}}</td>
                                                    <td class="text-center">@if(isset($s))
                                                        @if($s->status == 1)
                                                        Active
                                                        @else
                                                        Inactive
                                                        @endif
                                                    @endif</td>
                                                    <td>
                                                       <!-- <a class="btn btn-primary btn-sm" href="{{url('coursecatalog')}}?id={{$s->id}}&tab=5">Edit</a> &nbsp;&nbsp;
                                                       <a class="btn btn-danger btn-sm" href="{{url('subcategory_destroy')}}?id={{$s->id}}">Delete</a> -->
                                                       <a class="mr-2" href="{{url('coursecatalog')}}?id={{$s->id}}&tab=5" ><i class="bi bi-pen font-16 text-primary" style="font-weight: bold !important;"></i></a>
                                                        <a href="{{url('subcategory_destroy')}}?id={{$s->id}}" title="{{__('Delete')}}" class=""><i class="bi bi-trash text-danger font-16"></i></a>
                                                   </td>
                                               </tr>
                                               @endforeach
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-5 border-left">
                                    <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                            <div>
                                                <nav>
                                                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                        <button class="nav-link active" id="t1-au1-tab" data-bs-toggle="tab" data-bs-target="#t1-au1" type="button" role="tab" aria-controls="t1-au1" aria-selected="true">Courses list</button>
                                                        <!-- <button class="nav-link" id="t2-rept1-tab" data-bs-toggle="tab" data-bs-target="#t2-rept1" type="button" role="tab" aria-controls="t2-rept1" aria-selected="true">Reports</button> -->
                                                    </div>
                                                </nav>
                                                <!-- <ul class="nav nav-tabs background-lytblue border" id="myTab1" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link mr-5 px-3 py-1" id="t1-au1-tab" data-toggle="tab" href="#t1-au1" role="tab" aria-controls="t1-au1-course" aria-selected="true">Assigned Users</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link px-0 py-1" id="t2-rept1-tab" data-toggle="tab" href="#t2-rept1" role="tab" aria-controls="t2-rept1-reports" aria-selected="false">Reports</a>
                                                </li>
                                                </ul> -->
                                                <div class="tab-content border-0  mt-0 p-0" id="myTabContent">
                                                    <div class="tab-pane card-border border-top-0 fade show active" id="t1-au1" role="tabpanel" aria-labelledby="t1-au1-tab">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                    <div class="card-body p-2 rounded-0">
                                                                        <!-- <h4 class="card-title mb-3">Users List</h4> -->
                                                                        <!-- <p class="card-description">A static table without options</p> -->
                                                                        <div>
                                                                            <form class="forms-sample">
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
                                                                        <div class="table-responsive">
                                                                            <table class="table ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">User Details</th>
                                                                                        <!-- <th scope="col">Email</th> -->
                                                                                        <!-- <th scope="col">User Type</th> -->
                                                                                        <th scope="col" class="text-center">Registration</th>
                                                                                        <th scope="col" class="text-center">Last Login</th>
                                                                                        <th scope="col" class="text-center">Options</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>       
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-flex">
                                                                                                <div class="profile-image-sm">
                                                                                                    <img src="{{asset('public/images/face12.jpg')}}" class="img-fluid" alt="">
                                                                                                </div>
                                                                                                <div class="pl-2">
                                                                                                    <div class="py-1">A.SK</div>
                                                                                                    <div class="py-1 sub-categories-styles">ask@gmail.com</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">11/10/2023</td>
                                                                                        <td class="text-center">      
                                                                                            <button type="button" class="btn btn-primary btn-sm mx-2">Revoke</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table> 
                                                                        </div>                               
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="t2-rept1" role="tabpanel" aria-labelledby="t4-tab">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="card-body card-border p-2 rounded-0">
                                                                    <div class="work-in-prog">Work In Progress</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills333" role="tabpanel" aria-labelledby="v-pills-tab-three">Course3</div>
                                        <div class="tab-pane fade" id="v-pills444" role="tabpanel" aria-labelledby="v-pills-tab-four">Course4</div>
                                    </div>
                                </div>
                            </div>
                            
                           
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="ex" role="tabpanel" aria-labelledby="ex-tab">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card-body card-border p-2 rounded-0">
                    <div class="work-in-prog">Work In Progress</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="ac" role="tabpanel" aria-labelledby="ac-tab">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card-body card-border p-2 rounded-0">
                    <div class="work-in-prog">Work In Progress</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="co" role="tabpanel" aria-labelledby="co-tab">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                <div>
                    There is no better advertisement campaign that is low cost and also successful at the same time.
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
