@include('layouts.admin.header')

<style>
    .table > thead > tr > th {
        font-weight: 500;
        font-size: 16px;
        color: #28313c !important;
        font-weight: 600 !important;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <div class="tab-content content-bg rounded-3 border-0 pt-0 pb-2 p-0 mb-2" id="navtabContent" style="border-top: 1px solid #eeeef0;">
        <div class="tab-pane fade show active pt-2" id="dab" role="tabpanel" aria-labelledby="dab-tab">
            <div class="row px-3">

                <div class="col-12 col-lg-4 py-2">
                    <div class="row">
                        <div class="col-12 col-lg-4 my-auto py-3">
                            <div>
                                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-chalkboard-user headings-icon"></i>Total Courses </label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 my-auto py-3">
                            <div class="d-flex justify-content-end align-items-center">
                                <i class="bi bi-filter"></i>
                                <select id="category_id" class="dasboard-filters-drpdwn filters">
                                    <option value="">All Catergories</option>
                                    @foreach($category_list as $cat)
                                    <option value="{{$cat->id}}" @if($request->category_id==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card cardd1 mb-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="font-weight-bold">Total</div>
                                <div class="pt-5">
                                    <h2 class="mb-0">200</h2>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="coursePieChart" class="" style="width:100%;height: auto;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-lg-3">
                                <div class="text-center">
                                    <div class="fs-7 text-muted">Completed</div>
                                    <div class="pt-2 d-flex align-items-center justify-content-center">
                                        <span class="cardd-chat-circle bg-primary"></span>
                                        <span class="font-weight-bold">287</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="text-center">
                                    <div class="fs-7 text-muted">Pending</div>
                                    <div class="pt-2 d-flex align-items-center justify-content-center">
                                        <span class="cardd-chat-circle bg-warning"></span>
                                        <span class="font-weight-bold">97</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="text-center">
                                    <div class="fs-7 text-muted">In-progress</div>
                                    <div class="pt-2 d-flex align-items-center justify-content-center">
                                        <span class="cardd-chat-circle bg-success"></span>
                                        <span class="font-weight-bold">28</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="text-center">
                                    <div class="fs-7 text-muted">Completed</div>
                                    <div class="pt-2 d-flex align-items-center justify-content-center">
                                        <span class="cardd-chat-circle bg-info"></span>
                                        <span class="font-weight-bold">7</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-2">
                        <label>Filter By</label>
                        <select id="category_id" class="border border-grey py-1 px-2 ms-2 rounded-1 filters">
                            <option value="">All Catergories</option>
                            @foreach($category_list as $cat)
                            <option value="{{$cat->id}}" @if($request->category_id==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>Course Catalog</th>
                                <th width="100" class="text-center">Count</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-chalkboard-user"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <!-- <div class="text-uppercase mb-2">Courses</div>
                                                <small class="d-flex justify-content-center align-items-center"><a href="#" class="web-text-color">Add Course</a><i class="bi bi-dot pl-2 fs-4"></i> <span>19 May, 2024</span></small> -->
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=1')}}" class="web-text-color">Add Course</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                               {{$courses_count??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-regular fa-circle-check"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Active Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-danger d-flex align-items-center justify-content-center">
                                               {{$active_courses_count??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-user-check"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Assigned Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-rblue d-flex align-items-center justify-content-center">
                                               {{$assigned_courses_count??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                               <!--  <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="bi bi-diagram-3"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Completed Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-green d-flex align-items-center justify-content-center">
                                               {{$expire_courses_count??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-spinner"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Inprogress Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-maroon d-flex align-items-center justify-content-center">
                                               {{$inprogress_courses_count}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-hourglass"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog?tab=2')}}" class="text-uppercase">Courses Not Started </a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                               {{$assigned_courses_count-$inprogress_courses_count}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-file-circle-exclamation"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog??tab=2')}}" class="text-uppercase">Expired Courses</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=2')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-success d-flex align-items-center justify-content-center">
                                               {{$expire_courses_count??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-folder-tree"></i>
                                            </div>
                                            
                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('coursecatalog??tab=4')}}" class="text-uppercase">Catergories</a>
                                                </div>
                                                <small><a href="{{url('coursecatalog?tab=4')}}" class="web-text-color">View</a></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-success d-flex align-items-center justify-content-center">
                                               {{count($category_list)}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-lg-8 ">
                    <div class="row">
                        <div class="col-12 col-lg-6 py-2" style="display:none;">
                            <div class="shadow-sm borderr">
                                <div class="graphs-heading-styles">Courses Report</div>
                                <canvas id="coursePieChart" class="p-2 bg-white" style="width:100%;max-width:600px; height: 236px;"></canvas>
                            </div>
                        </div>

                         <div class="col-12 col-lg-6 py-2">
                            <div class="text-end mb-2">
                                <label>Filter By</label>
                                <select id="course_category_id" class="border border-grey py-1 px-2 ms-2 rounded-1 filters">
                                    <option value="">All Catergories</option>
                                    @foreach($category_list as $cat)
                                    <option value="{{$cat->id}}" @if($request->course_category_id==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="shadow-sm borderr">
                                <div class="graphs-heading-styles">Courses Assigned</div>
                                <canvas id="userbarChart" class="p-2 bg-white" style="width:100%;max-width:600px; height: 236px;"></canvas>
                            </div>
                        </div> 
                         <div class="col-12 col-lg-6 py-2">
                            <div class="text-end mb-2">
                                <label>Filter By</label>
                                <input type="date" class="border border-grey py-1 px-2 ms-2 rounded-1 filters" name="">
                            </div>
                            <div class="shadow-sm borderr">
                                <div class="graphs-heading-styles">Login History (Last 7 Days)</div>
                                <canvas id="coursebarChart" class="p-2 bg-white" style="width:100%;max-width:600px; height: 236px;"></canvas>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 py-2 mt-2">
                            <div class="text-start my-2">
                                <h4 class="mb-2 pb-1">Highest Performing Courses</h4>
                            </div>
                            <div class="table-responsive shadow-sm mt-2">
                                <table class="table-bordered table">
                                    <thead>
                                        <th width="100">Courses</th>
                                        <th width="100">Assigned Users Count</th>
                                        <th width="100" class="text-center">Completed</th>
                                    </thead>
                                    <tbody>
                                        @foreach($topCourses as $topcourse)
                                        @php
                                        $percentage = round($topcourse->completion_percentage) ?? 0;
                                        $color = '';
                                        if ($percentage >= 80) {
                                            $color = 'green'; 
                                        } elseif ($percentage >= 50) {
                                            $color = 'yellow'; 
                                        } else {
                                            $color = 'orange'; 
                                        }
                                        @endphp
                                        <tr>
                                            <td>{{ $topcourse->course_name ?? '' }}</td>
                                            <td>{{ $topcourse->total_users ?? '' }}</td>
                                            <td style="background-color: {{ $color }}; color: white !important;">{{ $percentage }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <div class="col-12 col-lg-6 py-2 mt-2">
                            <div class="text-start my-2">
                                <h4 class="mb-2 pb-1">Lowest Performing Courses</h4>
                            </div>
                            <div class="table-responsive shadow-sm mt-2">
                                <table class="table-bordered table">
                                    <thead>
                                        <th width="100">Courses</th>
                                        <th width="100">Assigned Users Count</th>
                                        <th width="100" class="text-center">Progress</th>
                                    </thead>
                                    <tbody>
                                        @foreach($leastCompletedCourses as $leastcourse)
                                        @php
                                        $percentage = round($leastcourse->completion_percentage) ?? 0;
                                        $color = '';
                                        if ($percentage <= 100) {
                                            $color = 'red'; 
                                        }
                                        @endphp
                                        <tr>
                                            <td>{{ $leastcourse->course_name ?? '' }}</td>
                                            <td>{{ $leastcourse->total_users ?? '' }}</td>
                                            <td style="background-color: {{ $color }}; color: white !important;">{{ $percentage }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        




                       <!--  <div class="col-12 col-lg-6 py-2">
                            <div class="shadow-sm borderr">
                                <div class="bg-grey" style="padding: 14px;">User Report</div>
                                <canvas id="userPieChart" class="p-2 bg-white" style="width:100%;max-width:600px; height: 236px;"></canvas>
                            </div>
                        </div> -->


                    </div>

                  






                </div>
           
                
            </div>


            <div class="row px-3"> 
                <div class="col-12 col-lg-4 py-2 mt-3">
                    <div class="text-end mb-2">
                        <label>Filter By</label>
                        <select id="cat_id" class="border border-grey py-1 px-2 ms-2 rounded-1 filters">
                            <option value="">All Catergories</option>
                            @foreach($category_list as $cat)
                            <option value="{{$cat->id}}" @if($request->cat_id==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th class="">Courses</th>
                                <th width="100" class="text-center">Users Assigned</th>
                                <th width="100" class="text-center">Pending </th>
                                <th width="100" class="text-center">Inprogress </th>
                                <th width="100" class="text-center">Completed </th>
                            </thead>
                            <tbody>
                                @foreach($categoriesCounts as $category_count)
                                <tr>
                                    <td>
                                        {{$category_count->course_name??''}}
                                    </td>
                                    <td>{{$category_count->user_count??''}}</td>
                                    <td>{{$category_count->pending_status_count??''}}</td>

                                    <td>{{$category_count->inprocess_status_count??''}}</td>
                                    <td>{{$category_count->completed_status_count??''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4 py-2 mt-3">
                    <div class="table-responsive shadow-sm">
                        <div class="table-responsive shadow-sm">
                            <table class="table-bordered table">
                                <thead>
                                    <th class="">Users</th>
                                    <th width="100" class="text-center">Count</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="circle-bg d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>

                                                <div class="pl-3">
                                                     <div class="mb-2">
                                                        <a href="{{url('users?tab=2')}}" class="text-uppercase">Users</a>
                                                    </div>
                                                    <small><a href="{{url('users')}}" class="web-text-color">Add User</a></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="count-bg bg-warning d-flex align-items-center justify-content-center">
                                                   {{$user_count??0}}
                                               </div>
                                           </div>
                                       </td>
                                   </tr>                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3" style="display:none;">
                <div class="col-12 col-lg-4 py-2">
                    <div class="text-end mb-2">
                        <label>Filter By</label>
                        <select class="border border-grey py-1 px-2 rounded-1">
                            <option>Deparment</option>
                            <option>----</option>
                            <option>----</option>
                        </select>
                    </div>
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>score</th>
                                <th class="text-center">No. of Users</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>50% - 70%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                               10
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>70% - 90%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                               10
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>90% Above</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                               10
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-lg-4 py-2" style="display:none;">
                    <div class="text-end mb-2">
                        <!-- <label>Filter By</label> -->
                        <select class="border border-grey py-1 px-2 rounded-1">
                            <option>Today</option>
                            <option>Last Week</option>
                            <option>Last Month</option>
                        </select>
                    </div>
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                No. of Login Users
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="">
                                               {{$user_today_logins??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="col-12 col-lg-4 py-2" style="display:none;">
                    <div class="text-end mb-2">
                        <!-- <label>Filter By</label> -->
                        <select class="border border-grey py-1 px-2 rounded-1">
                            <option>Today</option>
                            <option>Tomorrow</option>
                            <option>Next Week</option>
                        </select>
                    </div>
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                Average Spent Time
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="">
                                               3 hours
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="row px-3">
                <div class="col-12 col-lg-4 py-2">
                    <div class="table-responsive shadow-sm">
                        <div class="table-responsive shadow-sm">
                            <table class="table-bordered table">
                                <thead>
                                    <th>Users</th>
                                    <th width="100" class="text-center">Count</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="circle-bg d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                                
                                                <div class="pl-3">
                                                     <div class="mb-2">
                                                    <a href="{{url('users?tab=2')}}" class="text-uppercase">Users</a>
                                                </div>
                                                <small><a href="{{url('users')}}" class="web-text-color">Add Add User</a></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="count-bg bg-warning d-flex align-items-center justify-content-center">
                                                   {{$user_count??0}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="circle-bg d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-lines-fill"></i>
                                                </div>
                                                
                                                <div class="pl-3">
                                                    <div class="text-uppercase mb-2">User Type</div>
                                                    <small class="d-flex justify-content-center align-items-center"><a href="#" class="web-text-color">Add User Type</a><i class="bi bi-dot pl-2 fs-4"></i> <span>17 May, 2024</span></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="count-bg bg-primary d-flex align-items-center justify-content-center">
                                                   30
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="circle-bg d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                
                                                <div class="pl-3">
                                                    <div class="text-uppercase mb-2">Groups</div>
                                                    <small class="d-flex justify-content-center align-items-center"><a href="#" class="web-text-color">Add Group</a><i class="bi bi-dot pl-2 fs-4"></i> <span>19 May, 2024</span></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="count-bg bg-secondary d-flex align-items-center justify-content-center">
                                                   100
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 py-2">
                    <div class="shadow-sm borderr">
                        <div class="bg-grey" style="padding: 14px;">User Report</div>
                        <canvas id="userPieChart" class="p-2 bg-white" style="width:100%;max-width:600px; height: 224px;"></canvas>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script>
var xValues = [];
var yValues = [30, 20, 50];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("coursePieChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  }
});
</script>
<script>
var xValues = ["Pending", "In-Progress", "Completed"];
var yValues = [20, 50, 30];
var barColors = [
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("userPieChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  }
});
</script>
<?php $dataset=[]; $colors = ["red", "green","blue","orange","brown", "yellow", "purple"];
for ($i=0; $i <count($loginyvalues) ; $i++) { 
    $r['label']=$xvalues[$i];
    $r['backgroundColor']=$colors[$i];
    $ylist =[];
    for($j=0;$j<7;$j++){
        if($j==$i){
       $ylist[]= $loginyvalues[$i];  
        }else{
          $ylist[]=null;  
        }
    }
    $r['data']=$ylist;
    $dataset[]=$r;
} ?>
<script>
var xValues = <?php echo json_encode($xvalues); ?>;
new Chart("coursebarChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: <?php echo json_encode($dataset); ?>,
    options: {
        scales: {
            xAxes: [{
                barThickness: 12,  // number (pixels) or 'flex'
                maxBarThickness: 8 // number (pixels)
            }]
        }
    }
  }
});

</script>
<script>
var xValues = <?php echo json_encode($xvalues); ?>;
var yValues = <?php echo json_encode($assignedyvalues); ?>;
var barColors = ["orange","brown","red", "green","blue","yellow", "purple"];

new Chart("userbarChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
        label:'Today',
      backgroundColor: barColors,
      data: yValues
    }],
     options: {
        plugins: {
            legend: {
                display: false
                
            }
        }
    }
  }
});
</script>
    @include('layouts.admin.footer')

    <script type="text/javascript">
        $('.filters').change(function(){
            var category_id = $('#category_id').val();
            var course_category_id = $('#course_category_id').val();
             var cat_id = $('#cat_id').val();
            window.location.href="{{url('organizationdashboard')}}?category_id="+category_id+'&course_category_id='+course_category_id+'&cat_id='+cat_id;
        });
    </script>