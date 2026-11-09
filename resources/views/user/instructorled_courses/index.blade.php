@include('layouts.user.header')
<style>
    body {
/*        height: 100vh;*/
        overflow-y: hidden;
    }
    .exp-date {
        font-size: 13px;
        padding-top: 5px;
        padding-bottom: 5px;
        color: rgb(54 74 99 / 95%) !important;
    }
    .exp-time {
        font-size: 13px;
        color: rgb(54 74 99 / 95%) !important;
    }
    .learning-plan-text {
        font-size: 13px;
    }
    .in-progress-btn {
        position: absolute;
        top: -12px;
        left: 84px;
        background: white;
        color: #364a63;
        border-radius: 30px;
        font-size: 10px;
        padding: 3px;
        border: 1px solid;
    }
    li label{
        vertical-align: baseline !important;
        margin-left: 5px;
        margin-bottom: 0px;
    }

    .toggle-btn {
        background-color: #f0f0f0;
        border: none;
        padding: 7px 15px;
        cursor: pointer;
        border-radius: 5px;
        z-index: 0;
    }

.toggle-btn.active {
    background-color: #28a745; /* Green for attended */
    color: white;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-block d-lg-none px-1 px-md-2">
            <div class="res-main-headings"> <i class="fa-solid fa-circle-check me-2 menu-icon3"></i><span class="text-blue font-weight-500"> My Instructor-led Courses</span> </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-none rounded-0 mb-4">
                <div class="card-body p-0 rounded-0 bg-transparent">
                    <div class="row">
                        <div class="col-12">
                            
                        </div>
                        <div class="" id="main" style="width: 100%;">
                            
                            <div class="row">
                                <div class="col-12 offset-0 col-lg-10 offset-lg-1 main_subdiv px-2" id="main_subdiv">
                                     <div class="p-2 bg-white rounded-3">
                                        <div class="horizontal-tabs-div">
                                            <div class="d-flex horizontal-tabs" style="border-bottom: 1px solid #ccc;width: auto;">
                                                <a href="{{url('myinstructorled_courses')}}?menu=my_course&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}" class="btn btn-sm @if(Request::get('menu')=='my_course' || Request::get('menu')=='' ) btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">All Courses</a>
                                                <a href="{{url('myinstructorled_courses')}}?menu=Offline&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&status=2&assign_status=0" class="btn btn-sm @if(Request::get('menu')=='Offline') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">Not Started</a>
                                                <a href="{{url('myinstructorled_courses')}}?menu=progress&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}" class="btn btn-sm @if(Request::get('menu')=='progress') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">In-progress</a>
                                                <a href="{{url('myinstructorled_courses')}}?menu=bookmark&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&assign_status=3" class="btn btn-sm @if(Request::get('menu')=='bookmark') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">Completed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-12 offset-0 col-lg-10 offset-lg-1 main_subdiv px-2">
                                    <div class="d-flex justify-content-between align-items-center my-auto py-2">
                                        <form class="forms-sample bg-transparent me-3">
                                            <div class="">
                                                <button class="btn filters-btnn dropdown-toggle drpdwn-wo-toggle  rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-filter"></i>
                                                    Filters @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')))<i class="fa-solid fa-circle filters-dot-icon"></i> @endif
                                                </button>
                                                   
                                                @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')))
                                                <button type="button" class="btn btn-sm sbmt-btn ml-2 reset_course">Reset</button>@endif
                                                <ul class="dropdown-menu filters-dropdown-menuu p-3">
                                                    <form action="" id="learning_category_form" method="get">
                                                    <div class="form-group row">
                                                        <div class="col-12 my-1">
                                                            <input
                                                                type="text"
                                                                id="auto_search_input"
                                                                class="form-control"
                                                                name="auto_search_input"
                                                                placeholder="Search categories name..."
                                                            />
                                                            <div id="search_results" class="list-group" style="position: absolute; z-index: 1000; width: 100%;"></div>
                                                        </div>
                                                        <div class="col-sm-6 my-auto">
                                                            <select class="js-example-basic-single form-select-control" id="category_id" name="category_id">
                                                                <option value="">Select a Category</option>
                                                                @foreach($category_list as $cat)
                                                                <option value="{{$cat->id}}" @if(Request::get('category_id')==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 my-auto">
                                                            <select class="js-example-basic-single form-select-control" id="due_by" name="due_by">
                                                                <option value="">Due By</option>
                                                               <option value="1" @if(Request::get('due_by')=='1') Selected @endif>Today</option>
                                                               <option value="2" @if(Request::get('due_by')=='2') Selected @endif>Tomorrow</option>
                                                               
                                                               <option value="7" @if(Request::get('due_by')=='7') Selected @endif>This Week</option>
                                                               <option value="30" @if(Request::get('due_by')=='30') Selected @endif>This Month</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="menu" id="menu" value="{{Request::get('menu')??''}}">

                                                        <input type="hidden" name="tab_id" id="tab_id" value="{{Request::get('tab_id')??''}}">

                                                        <input type="hidden" name="expire" id="expire" value="{{Request::get('expire')??''}}">
                                                       
                                                     
                                                         <div class="col-sm-12 mt-2">
                                                            <div class="text-end">
                                                                <button type="button" class="btn filterBtn cancel-btn mr-2">Cancel</button>
                                                                <button type="submit" class="btn sbmt-btn learning_category_submit">Search</button>
                                                                
                                                            </div>
                                                         </div>
                                                    </div>
                                                </form>
                                                </ul>
                                            </div>
                                        </form>
                                        <div class="d-none d-md-block">
                                            <ul class="nav nav-pills pb-0" id="pills-tab" role="tablist">
                                                <!--  <li class="nav-item mr-0">
                                                <a class="nav-linkk nav-link btn btn-sm web-transparent-btn mr-2 tab_menus @if(Request::get('tab_id')=='pills-gc') active @endif" id="pills-gc-tab " data-toggle="pill" href="#pills-gc" role="tab" aria-controls="pills-gc" aria-selected="false">
                                                    Group By Category
                                                </a>
                                            </li> -->
                                                <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) active @endif  btn btn-sm web-transparent-btn mr-0 mr-md-2 tab_menus my-courses-nav-btns" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                                                        <i class="fa-solid fa-list"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link btn btn-sm web-transparent-btn tab_menus my-courses-nav-btns @if(Request::get('tab_id')=='pills-card') active @endif" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false">
                                                        <i class="fas fa-th-large"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-1 pb-2 main_subdiv px-2">
                                    <div class="tab-content border-top mt-0 view-list" id="pills-tabContent">
                                        <div class="tab-pane fade @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) show active @endif" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    @if(empty($list->toArray()))
                                                     <div class="bg-white pb-5">
                                                         <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                      <div class="no-data-found-text">No data found</div>
                                                     </div>
                                                    @endif
                                                    @foreach($list as $data)
                                                    <div class="courses_list courses_listt">
                                                        <div class="row">
                                                            <div class="col-11 col-lg-11">
                                                                <div class="d-flex d-sm-flex align-items-center">
                                                                    <div class="">
                                                                        <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                            <div class="courses-image-div">
                                                                                @if($data->course_details->course_image)
                                                                                    <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid user-courses-listing-view-image" alt="">
                                                                                @else
                                                                                    <img src="{{ url('public/images/course.jpg') }}" class="img-fluid user-courses-listing-view-image" alt="">
                                                                                @endif
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="pl-0 ml-2 pl-lg-3 ml-lg-1">
                                                                        <div>
                                                                            <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                                <div class="text-start course-name font-weight-bold mb-0" style="cursor:pointer" onclick="openData()">
                                                                                   {{$data->course_details->course_name??''}}
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="d-flex flex-wrap align-items-center text-muted">
                                                                            <span class="d-flex align-items-center pe-3 text-muted fs-7 py-1">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <label class="ps-1 mb-0 text-muted">Assigned : </label>
                                                                                <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at))->diffForHumans() ?></span>
                                                                            </span>
                                                                            <span class="d-flex align-items-center pe-3 text-muted fs-7 py-1">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <span>
                                                                                    @if($data->course_details->course_type==1)
                                                                                    <label class="ps-1 mb-0 text-muted">Due : </label>
                                                                                   
                                                                                    <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                                    @else
                                                                                    <label class="ps-1 mb-0 text-muted">Training Date : </label>
                                                                                   
                                                                                    <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                                    @endif

                                                                                </span>
                                                                            </span>

                                                                            <!-- <span class="d-flex align-items-center pe-3 text-muted fs-7  py-1">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <span class="ps-1">
                                                                                    Instructor-led training
                                                                                </span>
                                                                            </span> -->
                                                                        </div>
                                                                        <div class="fs-7 my-course-categori-name py-1">
                                                                            <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                            <span class="ps-1">{{$data->category_details->category_name??''}}</span>
                                                                        </div>
                                                                        <!-- <div class="fs-7 my-course-date py-1">
                                                                            <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                            @if($data->course_details->course_type==1)
                                                                            <label class="ps-1 mb-0">Due : </label>
                                                                           
                                                                            <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                            @else
                                                                            <label class="ps-1">Training Date : </label>
                                                                           
                                                                            <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                            @endif
                                                                        </div> -->
                                                                        <div class="attended_div">
                                                                           <!--  <p class="attended_status mb-0">
                                                                                @if($data->course_details->course_type==2)
                                                                                @if($data->status==1) Attended @elseif($data->status==2) Not Attended @endif @endif</p> -->
                                                                            @if($data->course_details->course_type==1)
                                                                            <span class="d-flex align-items-center">
                                                                                <i class="fa fa-circle text-light-green fs10 pe-2"></i>
                                                                                <span class="sub-text pe-3">Completed On 22 </span>
                                                                            
                                                                             <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-sm me-2"> Start from Beginning </a>
                                                                            @if(!empty($data->scorm_details))

                                                                           
                                                                            <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary bottom-butun-in-card1 btn-sm me-2">Resume</a>

                                                                            @endif

                                                                            @else

                                                                            <span class="d-flex align-items-center mt-2">
                                                                                <button class="toggle-btn {{ $data->status == 1 ? 'active' : '' }}" data-id="{{$data->id}}">
                                                                                    {{ $data->status == 1 ? 'Attended' : 'Not Attended' }}
                                                                                </button>
                                                                            </span>


                                                                            <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a> -->

                                                                            @endif
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-1 col-lg-1 pl-0 pl-lg-2">
                                                                <div class="text-right">
                                                                    @if(!empty($data->bookmark_data))
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-solid fa-star"></i></a>
                                                                    @else
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-regular fa-star"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane bg-white fade @if(Request::get('tab_id')=='pills-card'  ) show active @endif" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">

                                            <div class="row px-1 mx-0">
                                                <div class="col-12 pb-2">
                                                 @if(empty($list->toArray()))
                                                     <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                      <div class="no-data-found-text">No data found</div>
                                                    @endif
                                                </div>
                                                @foreach($list as $data)
                                                <div class="col-12 col-md-6 col-lg-3 card-list-div my-1 px-3 px-md-1 assigned_courses courses_list" data-assign_id="{{$data->id}}">
                                                    <div class="bg-light">
                                                        <div class="card-view-fav-icon">
                                                             @if(!empty($data->bookmark_data))
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-solid fa-star"></i></a>
                                                                    @else
                                                                    <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course">
                                                                    <i class="fa-regular fa-star"></i></a>
                                                                    @endif
                                                        </div>
                                                        <div class="courses-image-div">
                                                            <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                            @if($data->course_details->course_image)
                                                                <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid" alt="" style="height: auto !important;">
                                                            @else
                                                                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="" style="height: auto !important;">
                                                            @endif
                                                        </a>
                                                        </div>
                                                        <!-- <div class="progress progress list-view-p-bar">
                                                            <div class="progress-bar progress-bar-striped bg-pink text-white border-bottom-0" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                        </div> -->
                                                        <div class="p-2">
                                                            <div class="">
                                                            <!-- <a href="javascript:;" class="assigned_courses course-name" data-assign_id="{{$data->id}}"> {{$data->course_details->course_name??''}} </a> -->
                                                            <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                <h6 class="text-start course-name mb-0" style="cursor:pointer" onclick="openData()">
                                                                   {{$data->course_details->course_name??''}}
                                                                </h6>
                                                            </a>
                                                        </div>

                                                            <div class="exp-date">
                                                                <span class="dashed-border-calender-icon">
                                                                    <i class="fa-solid fa-calendar-days"></i></span>
                                                                    @if($data->course_details->course_type==1)
                                                                 <label class="ps-1">Due : </label>
                                                                   
                                                                    <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                    @else
                                                                    <label class="ps-1 mb-0 text-muted">Training Date : </label>
                                                                   
                                                                    <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                    @endif
                                                            </div>
                                                            <div class="mt-1 attended_div">
                                                                 <p class="attended_status">
                                                                     @if($data->course_details->course_type==2)
                                                                     @if($data->status==1) Attended @elseif($data->status==2) Not Attended @endif @endif</p>
                                                                    @if($data->course_details->course_type==1)
                                                                    
                                                                     <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-smm me-2"> Start from Beginning </a>
                                                                    @if(!empty($data->scorm_details))

                                                                   
                                                                    <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary bottom-butun-in-card1 btn-smm">Resume</a>

                                                                    @endif

                                                                    @else


                                                                     
                                                                    <span class="d-flex align-items-center">
                                                                        <button class="ins-attend-btn {{ $data->status == 1 ? 'active' : '' }}" data-id="{{$data->id}}">
                                                                            {{ $data->status == 1 ? 'Attended' : 'Not Attended' }}
                                                                        </button>
                                                                    </span>


                                                                  <!--   <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a> -->

                                                                    @endif
                                                               
                                                            </div>
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
                                                                    <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1 pt-1">{{$data->category_details->category_name??''}}</span>
                                                                </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="tab-pane bg-white fade @if(Request::get('tab_id')=='pills-gc'  ) show active @endif" id="pills-gc" role="tabpanel" aria-labelledby="pills-gc-tab">
                                            <div class="row px-1">
                                                <div class="col-12 pb-2">
                                                 @if(empty($category_view->toArray()))
                                                     <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                      <div class="no-data-found-text">No data found</div>
                                                    @endif
                                                </div>
                                                @foreach($category_view as $cview)
                                                <div class="col-12 col-md-6 col-lg-3 card-list-div my-2 px-3 px-md-2 courses_list">
                                                    <a href="{{url('category_courses')}}?id={{$cview->id}}" class="text-decoration-none">
                                                        <div class="bg-light ">
                                                            <div  class="courses-image-div">
                                                                @if(!empty($cview->image))

                                                                <img src="{{ url('storage/app/public/' . $cview->image) }}" class="img-fluid" alt="course" style="height: auto !important;">
                                                                @else
                                                                <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" style="height: auto !important;">
                                                                @endif
                                                            </div>
                                                            <div class="p-2">
                                                                <div class="course-name">{{$cview->category_name}}</div>
                                                                <div class="pt-1">
                                                                    <span>{{count($cview->category_assigned_cousers)}} Courses </span>
                                                                </div>
                                                                <!-- <hr class="my-2" />
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="learning-plan-text">
                                                                        0 Courses Completed
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidepop pr-0 pr-md-2" id="dataOverlay">
                            <div class="course_details" @if(empty($courses_data)) style="display: none;" @endif @if(Request::get('tab_id') !='pills-list') style="display: none;" @endif></div>
                            <div><a href="javascript:void(0)" class="closebtn" onclick="closeData()">&times;</a></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.user.footer')

<script>
    function openData() {
        if (window.screen.availWidth <= 991) {
            document.getElementById("dataOverlay").style.width = "100%";
        }
        else{
          document.getElementById("dataOverlay").style.width = "60%";
        }
        if (window.screen.availWidth <= 991) {
            document.getElementById("main").style.width = "100%";
        }
        else{
            document.getElementById("main").style.width = "40%";
        }
      // document.getElementById("main").style.marginRight = "40%";
      document.getElementById("dataOverlay").style.right = "0px";
      $('.main_subdiv').removeClass('col-lg-10 offset-lg-1');
      $('.card-list-div').removeClass('col-lg-3')
    }

    function closeData() {
      document.getElementById("dataOverlay").style.width = "0";
      document.getElementById("main").style.width = "100%";
      document.getElementById("main").style.marginRight= "0";
      document.getElementById("dataOverlay").style.marginRight= "0";
      document.getElementById("dataOverlay").style.right = "-25px";
      $('.main_subdiv').addClass('col-lg-10 offset-lg-1');
      $('.card-list-div').addClass('col-lg-3')
    }

    //Start for category search purpose
    document.getElementById("auto_search_input").addEventListener("keyup", function () {
    let query = this.value;

    if (query.length > 0) {
    fetch(`{{ url('search-categories') }}?query=${query}`)
        .then((response) => response.json())
            .then((data) => {
                let resultsDiv = document.getElementById("search_results");
                resultsDiv.innerHTML = ""; // Clear previous results

                if (data.length > 0) {
                    data.forEach((item) => {
                        let resultItem = document.createElement("a");
                        resultItem.classList.add("list-group-item", "list-group-item-action");
                        resultItem.textContent = item.name; // Replace with your field
                        resultItem.href = `?category_id=${item.id}`; // Add appropriate link
                        resultsDiv.appendChild(resultItem);
                    });
                } else {
                    resultsDiv.innerHTML = `<div class="list-group-item">No results found</div>`;
                }
            })
            .catch((error) => console.error("Error fetching search results:", error));
    } else {
        document.getElementById("search_results").innerHTML = "";
    }
});
//End category search purpose 
</script>
<script type="text/javascript">
    $('.reset_course').on('click',function(){ 
        $('#category_id').val('');
        $('#due_by').val('');
        $('.learning_category_submit').click();

    });
$('.toggle-btn').click(function() {
    var assign_id = $(this).data('id');
    var isActive = $(this).hasClass('active');
    var status = isActive ? 2 : 1; // 1 for attended, 2 for not attended
    var button = $(this);

    $.ajax({
        type: "GET",
        url: "{{ url('accept_course') }}",
        data: {
            assign_id: assign_id,
            status: status
        },
        dataType: "json",
        success: function(response) {
            // Toggle the button's active class
            button.toggleClass('active');

            var statusText = response.status == 1 ? 'Attended' : 'Not Attended';
            button.text(statusText); // Update the button text

            $.toast({
                heading: 'Success',
                text: statusText + ' Successfully.',
                position: 'bottom-right',
                stack: false,
                icon: 'success'
            });
        },
        error: function(xhr, status, error) {
            console.error("Error updating status:", error);
        }
    });
});



    $('.bookmark_course').click(function(){
        var  assign_id = $(this).data('id');
        var class_name =$(this);
         $.ajax({
            type: "GET",
            url: "{{ url('add_remove_bookmark') }}",
            data: {
                assign_id: assign_id
            },
            dataType:"json",
            success: function(response) {
               class_name.html(response.html);
               if(response.status==0){
                   $.toast({
                        heading: 'Success',
                        text: 'Bookmark Removed Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
               }else{
                $.toast({
                        heading: 'Success',
                        text: 'Bookmark Added Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
               }
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    });
    $('.assigned_courses').click(function(){
        $('.courses_list').removeClass('course-active');
        $(this).parents('.courses_list').addClass('course-active');

        var  assign_id = $(this).data('assign_id');
        var openTab = $(this).data('open-tab');
        if (typeof openData === 'function') {
            openData();
        }
         $.ajax({
            type: "GET",
            url: "{{ url('get_assign_course_data') }}",
            data: {
                assign_id: assign_id
            },
            dataType:"html",
            success: function(response) {
               $('.course_details').html(response);
               $('.course_details').show();
               if (openTab === 'assessment') {
                   var assessmentTab = document.getElementById('assessment-tab');
                   if (assessmentTab) {
                       assessmentTab.click();
                   }
               }
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    });
    $('.tab_menus').click(function(){

        $('#tab_id').val($(this).attr('aria-controls'));
        $('.course_details').hide();
    });

    $('body').on('submit','#upload_feedback_form',function(e){
        e.preventDefault();
       
        var formData = new FormData(this);
        $.ajax({
        type: 'POST',
        url: "{{url('user_upload_feedback_document')}}",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            var link ="{{url('storage/app/public/')}}"+response.files.document_path;
            // $('body').find('.active_admin_upload_list').append('<a href="'+link+'" download class="btn btn-sm btn-outline-primary text-muted text-nowrap">'+response.files.document_name+'</a>');
            $('body').find('#excel_upload .close').click();
                 $.toast({
                heading: 'Success',
                text: 'Updated Successfully.',
                position: 'bottom-right',
                stack: false,
                icon: 'success'
            });
                 location.reload();
        }
        });
    });
    $('body').on('click','.excel_upload',function(){
        var assigned_id = $(this).data('id');
        var course_id = $(this).data('course_id');
        $('body').find('#assined_id').val(assigned_id);
        $('body').find('#course_id').val(course_id);
        $('body').find('.admin_upload_list').removeClass('active_admin_upload_list');
        $(this).parents('tr').find('.admin_upload_list').addClass('active_admin_upload_list');
    });
    $('body').on('click','.take_exam',function(){
        var link=$(this).data('link');
        Swal.fire({
              title: "Please click `Yes` if you are ready to take the exam, Otherwise click cancel?",
              text: "",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes"
            }).then((result) => {
              if (result.isConfirmed) {
                var popup = window.open(link,"popupWindow", "width=1200, height=800, scrollbars=yes");
                    var checkPopupURL = setInterval(function() {
                        if (!popup || popup.closed) {
                            clearInterval(checkPopupURL);
                             location.reload();
                        } else {
                            try {
                                
                                
                            } catch (e) {
                                console.log('Cannot access popup URL due to cross-origin restrictions.');
                            }
                        }
                    }, 1000); // Check every 1 second
              }
            });
        
    });

    $(document).ready(function () {
        var urlParams = new URLSearchParams(window.location.search);
        var autoAssignId = urlParams.get('assign_id');
        var autoOpenTab = urlParams.get('open_tab');
        if (autoAssignId) {
            var targetCourse = $('.assigned_courses[data-assign_id="' + autoAssignId + '"]').first();
            if (targetCourse.length) {
                $('.courses_list').removeClass('course-active');
                targetCourse.parents('.courses_list').addClass('course-active');
            }
            if (typeof openData === 'function') {
                openData();
            }
            $.ajax({
                type: "GET",
                url: "{{ url('get_assign_course_data') }}",
                data: {
                    assign_id: autoAssignId
                },
                dataType: "html",
                success: function(response) {
                    $('.course_details').html(response);
                    $('.course_details').show();
                    if (autoOpenTab === 'assessment' || !autoOpenTab) {
                        var assessmentTab = document.getElementById('assessment-tab');
                        if (assessmentTab) {
                            assessmentTab.click();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading assigned course data:", error);
                }
            });
        }
    });
</script>
