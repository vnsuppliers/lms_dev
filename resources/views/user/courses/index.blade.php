@include('layouts.user.header')

<style>
    body {
        overflow-y: auto;
    }
    .modal-backdrop{
        z-index: 0 !important;
    }
    .modal-sd{
        z-index: 9999 !important;
        background: rgb(0 0 0 / 15%) !important;
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
    .course-search-form {
        min-width: 220px;
        max-width: 280px;
    }
    .course-search-form .input-group {
        position: relative;
        display: flex;
        align-items: stretch;
    }
    .course-search-form .course-search-input {
        height: 33px;
        border-radius: 6px 0 0 6px !important;
        font-size: 13px;
        border: 1px solid #ced4da;
        border-right: none;
        background-color: #fff;
        padding-left: 12px;
        padding-right: 28px !important;
        transition: all 0.2s ease-in-out;
    }
    .course-search-form .course-search-input:focus {
        border-color: #0d6efd;
        box-shadow: none;
        outline: none;
    }
    .course-search-form .clear-search-btn {
        position: absolute;
        right: 42px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #8094ae;
        font-size: 18px;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        z-index: 5;
        text-decoration: none;
    }
    .course-search-form .clear-search-btn:hover {
        color: #e85347;
    }
    .course-search-form .search-submit-btn {
        height: 33px;
        border-radius: 0 6px 6px 0 !important;
        background: #f8fafc;
        border: 1px solid #ced4da;
        border-left: 1px solid #e2e8f0;
        color: #526484;
        padding: 0 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .course-search-form .search-submit-btn:hover {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .filter-wrapper {
        position: relative;
    }
    .filters-btnn {
        height: 33px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
    }
    .filters-dot-icon {
        font-size: 7px;
        color: #e85347;
        position: absolute;
        top: 4px;
        right: 4px;
    }
    ul.dropdown-menu.filterMenu.filters-dropdown-menuu {
        position: absolute !important;
        right: 0 !important;
        left: auto !important;
        top: 100% !important;
        min-width: 310px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        z-index: 1000;
        margin-top: 4px;
    }
    .sbmt-btn.reset_course {
        height: 33px;
        line-height: 20px;
        display: inline-flex;
        align-items: center;
    }
    .sidepop .closebtn {
        z-index: 1060;
    }
    #pageLoader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 400px;
        background: rgba(255, 255, 255, 0.85);
        z-index: 1050;
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-block d-lg-none px-1 px-md-2">
            <div class="res-main-headings mb-2"> <i class="fa-solid fa-chalkboard-user me-2 menu-icon2"></i> <span class="text-blue font-weight-500">My Online Courses</span> </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-none rounded-0 mb-4">
                <div class="card-body p-0 rounded-0 bg-transparent">
                    <div class="row">
                        <div class="" id="main" style="width: 100%;">
                            <div class="row">
                                <div class="col-12 offset-0 col-lg-10 offset-lg-1 main_subdiv px-2 px-lg-2" id="main_subdiv">
                                    <div class="px-4 pt-4 pb-0">
                                        <div class="horizontal-tabs-div">
                                            <div class="d-flex flex-wrap horizontal-tabs justify-content-between align-items-center gap-2">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <a href="{{url('user_courses')}}?menu=my_course&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&search={{$request->search}}" class="btn btn-sm @if(Request::get('menu')=='my_course' || Request::get('menu')=='' ) btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">My All Courses <span> - {{count($countlist)??''}}</span></a>
                                                    <a href="{{url('user_courses')}}?menu=Offline&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&status=1&assign_status=0&search={{$request->search}}" class="btn btn-sm @if(Request::get('menu')=='Offline') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">Not started <span> - {{count($countlist->where('status','==',0))??''}}</span></a>
                                                    <a href="{{url('user_courses')}}?menu=progress&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&search={{$request->search}}" class="btn btn-sm @if(Request::get('menu')=='progress') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus">In-progress<span> - {{count($countlist->where('status','==',1))??''}}</span></a>
                                                    <a href="{{url('user_courses')}}?menu=bookmark&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}&due_by={{$request->due_by}}&assign_status=3&search={{$request->search}}" class="btn btn-sm @if(Request::get('menu')=='bookmark') btn-active-primaryy-tab @else btn-primaryy-tab @endif tab_menus me-0">Completed<span> - {{count($countlist->where('status','==',3))??''}}</span></a>
                                                </div>

                                                <div class="d-flex align-items-center ms-auto">
                                                    <!-- Course Name Search Form -->
                                                    <form action="{{url('user_courses')}}" method="get" class="course-search-form me-2 d-none d-md-block">
                                                        <div class="input-group">
                                                            <input type="text" name="search" class="form-control course-search-input" placeholder="Search course name..." value="{{ Request::get('search') }}">
                                                            <input type="hidden" name="menu" value="{{ Request::get('menu') }}">
                                                            <input type="hidden" name="tab_id" value="{{ Request::get('tab_id') }}">
                                                            <input type="hidden" name="category_id" value="{{ Request::get('category_id') }}">
                                                            <input type="hidden" name="due_by" value="{{ Request::get('due_by') }}">
                                                            @if(!empty(Request::get('search')))
                                                                <a href="{{url('user_courses')}}?menu={{Request::get('menu')}}&tab_id={{Request::get('tab_id')}}&category_id={{Request::get('category_id')}}&due_by={{Request::get('due_by')}}" class="clear-search-btn" title="Clear search"><i class="bi bi-x"></i></a>
                                                            @endif
                                                            <button type="submit" class="search-submit-btn" title="Search"><i class="bi bi-search"></i></button>
                                                        </div>
                                                    </form>

                                                    <div class="filter-wrapper position-relative me-2">
                                                        <form class="forms-sample bg-transparent m-0 p-0">
                                                            <button class="btn filterBtn filters-btnn dropdown-toggle drpdwn-wo-toggle rounded-2 filter-iconn position-relative" type="button" title="Filters">
                                                                <i class="bi bi-filter pr-0"></i>
                                                                @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')) || !empty(Request::get('search')))
                                                                    <i class="fa-solid fa-circle filters-dot-icon"></i>
                                                                @endif
                                                            </button>
                                                               
                                                            <ul class="dropdown-menu filterMenu filters-dropdown-menuu p-3" style="display: none;">
                                                                <form action="{{url('user_courses')}}" id="learning_category_form" method="get">
                                                                    <div class="form-group row mb-2">
                                                                        <div class="col-12">
                                                                            <label class="form-label small text-muted mb-1 font-weight-500">Search Course Name</label>
                                                                            <input
                                                                                type="text"
                                                                                id="search"
                                                                                class="form-control form-control-sm"
                                                                                name="search"
                                                                                placeholder="Search course name..."
                                                                                value="{{ Request::get('search') }}"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-12 col-sm-6 my-1 my-sm-auto">
                                                                            <label class="form-label small text-muted mb-1 font-weight-500">Category</label>
                                                                            <select class="js-example-basic-single form-select-control" id="category_id" name="category_id">
                                                                                <option value="">All Categories</option>
                                                                                @foreach($category_list as $cat)
                                                                                <option value="{{$cat->id}}" @if(Request::get('category_id')==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 my-1 my-sm-auto">
                                                                            <label class="form-label small text-muted mb-1 font-weight-500">Due Date</label>
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
                                                                        
                                                                        <div class="col-sm-12 mt-3">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')) || !empty(Request::get('search')))
                                                                                    <a href="{{url('user_courses')}}?menu={{Request::get('menu')}}&tab_id={{Request::get('tab_id')}}" class="btn btn-sm btn-link text-danger p-0 reset_course text-decoration-none small">Clear All</a>
                                                                                @else
                                                                                    <span></span>
                                                                                @endif
                                                                                <div>
                                                                                    <button type="button" class="btn filterBtn cancel-btn mr-2">Cancel</button>
                                                                                    <button type="submit" class="btn submitBtn sbmt-btn learning_category_submit">Apply</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </ul>
                                                        </form>
                                                    </div>

                                                    @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')) || !empty(Request::get('search')))
                                                        <a href="{{url('user_courses')}}?menu={{Request::get('menu')}}&tab_id={{Request::get('tab_id')}}" class="btn btn-sm sbmt-btn reset_course me-2" title="Reset all filters">Reset</a>
                                                    @endif

                                                    <div class="d-none d-md-block">
                                                        <ul class="nav nav-pills pb-0 my-auto" id="pills-tab" role="tablist">
                                                            <li class="nav-item mr-0">
                                                                <a class="nav-linkk nav-link bg-white @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) active @endif btn btn-sm web-transparent-btn mr-0 mr-md-2 tab_menus my-courses-nav-btns" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true" title="List View">
                                                                    <i class="fa-solid fa-list"></i>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item mr-0">
                                                                <a class="nav-linkk nav-link btn bg-white btn-sm web-transparent-btn my-courses-nav-btns tab_menus @if(Request::get('tab_id')=='pills-card') active @endif" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false" title="Card View">
                                                                    <i class="fas fa-th-large"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="col-12 offset-0 col-lg-10 offset-lg-1 main_subdiv px-2 px-lg-2">
                                    <div class="d-flex justify-content-between align-items-center my-auto py-2">
                                        <form class="forms-sample bg-transparent me-3">
                                            <div class="">
                                                <button class="btn filterBtn filters-btnn dropdown-toggle drpdwn-wo-toggle rounded-2" type="button"><i class="bi bi-filter"></i>
                                                    Filters @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')))<i class="fa-solid fa-circle filters-dot-icon"></i> @endif
                                                </button>
                                                   
                                                @if(!empty(Request::get('category_id')) || !empty(Request::get('due_by')))
                                                <button type="button" class="btn btn-sm sbmt-btn ml-2 reset_course">Reset</button>@endif
                                                <ul class="dropdown-menu filterMenu filters-dropdown-menuu p-3" style="display: none; left: 1%;">
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
                                                        <div class="col-12 col-sm-6 my-1 my-sm-auto">
                                                            <select class="js-example-basic-single form-select-control" id="category_id" name="category_id">
                                                                <option value="">Select a Category</option>
                                                                @foreach($category_list as $cat)
                                                                <option value="{{$cat->id}}" @if(Request::get('category_id')==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-sm-6 my-1 my-sm-auto">
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
                                                                <button type="submit" class="btn submitBtn sbmt-btn learning_category_submit">Search</button>
                                                            </div>
                                                         </div>
                                                    </div>
                                                </form>
                                                </ul>
                                            </div>
                                        </form>
                                        <div class="d-none d-md-block">
                                            <ul class="nav nav-pills pb-0 my-auto" id="pills-tab" role="tablist">
                                                <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link bg-white @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) active @endif btn btn-sm web-transparent-btn mr-0 mr-md-2 tab_menus my-courses-nav-btns" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                                                        <i class="fa-solid fa-list"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link btn bg-white btn-sm web-transparent-btn  my-courses-nav-btns tab_menus @if(Request::get('tab_id')=='pills-card') active @endif" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false">
                                                        <i class="fas fa-th-large"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-1 pb-2 main_subdiv px-2 p-3 p-lg-4">
                                    <div class="tab-content border-top-0 mt-0 courses-in-user" id="pills-tabContent">
                                        <div class="tab-pane fade @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) show active @endif" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    @if(empty($list->toArray()))
                                                    <div class="bg-white rounded-3">
                                                         <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                          <div class="no-data-found-text pb-5">No data found</div>
                                                      </div>
                                                    @endif
                                                    @foreach($list as $data)
                                                    <div class="courses_list courses_listt">
                                                        <div class="row">
                                                            <div class="col-11 col-lg-11">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="">
                                                                        <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                            <div class="courses-image-div">
                                                                                @if($data->course_details->course_image)
                                                                                    <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid user-courses-listing-view-image" alt="">
                                                                                @else
                                                                                    <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid user-courses-listing-view-image user-course-image-empty" alt="">
                                                                                @endif
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="pl-0 ml-2 pl-lg-3 ml-lg-0">
                                                                        <div>
                                                                            @if($data->course_details->expiration_date < now())
                                                                                <div class="text-start course-name font-weight-bold mb-0" >
                                                                                {{$data->course_details->course_name??''}}
                                                                                </div>
                                                                            @else
                                                                                <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                                    <div class="text-start course-name font-weight-bold mb-0" style="cursor:pointer" onclick="openData()">
                                                                                    {{$data->course_details->course_name??''}}
                                                                                    </div>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                        <div class="d-flex flex-wrap align-items-center text-muted">
                                                                            <span class="d-flex align-items-center pe-3 text-muted fs-7 py-1">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <label class="ps-1 mb-0 text-muted">Assigned : </label>
                                                                                <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at))->format('F j, Y g:i a T') }}"> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at))->diffForHumans() ?></span>
                                                                            </span>
                                                                            <span class="d-flex align-items-center pe-3 text-muted fs-7 py-1">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <span>
                                                                                    @if($data->course_details->course_type==1)
                                                                                    <label class="ps-1 mb-0 text-muted">Due : </label>
                                                                                    <span class="ps-1 cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->format('F j, Y g:i a T') }}"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->course_details->expiration_date))->diffForHumans() ?></span>
                                                                                    @else
                                                                                    <label class="ps-1 mb-0 text-muted">Training Date : </label>
                                                                                   
                                                                                    <span> {{$data->course_details->training_date}} {{$data->course_details->training_time_from}} - {{$data->course_details->training_time_to}}</span>
                                                                                    @endif

                                                                                </span>
                                                                            </span>

                                                                            <span class="d-none d-sm-flex align-items-center text-muted fs-7 pt2">
                                                                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                                                                <span class="ps-1">
                                                                                    Has Assesment
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="fs-7 my-course-categori-name py-0 py-lg-1">
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
<div class="col-1 col-lg-1 pl-0 pl-lg-2">
    @php
        $matchedFeedback = $feedback_ratings
            ->where('category_id', $data->category_id)
            ->where('course_id', $data->course_id)
            ->first();
    @endphp

    <div class="d-flex justify-content-end align-items-center flex-nowrap gap-2">

        {{-- Feedback Category Tag --}}
        @if($matchedFeedback)
            <a href="javascript:;"
               class="assigned_courses text-decoration-none flex-shrink-0"
               data-assign_id="{{ $data->id }}"
               data-open-tab="feedback"
               onclick="openData()">

                <span class=""
                      
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="{{ $data->category_details->category_name ?? '' }}">
                    Feedback & ratings
                </span>

            </a>
        @endif

        {{-- Bookmark --}}
        @if(!empty($data->bookmark_data))
            <a href="javascript:;"
               data-id="{{ $data->id }}"
               class="bookmark_course flex-shrink-0"
               data-bs-toggle="tooltip"
               data-bs-placement="left"
               title="Bookmark this course">

                <i class="fa-solid fa-star"></i>

            </a>
        @else
            <a href="javascript:;"
               data-id="{{ $data->id }}"
               class="bookmark_course flex-shrink-0"
               data-bs-toggle="tooltip"
               data-bs-placement="left"
               title="Bookmark this course">

                <i class="fa-regular fa-star"></i>

            </a>
        @endif

    </div>
</div>


                                                        </div>
                                                        <div class="col-12 px-0 px-lg-2">
                                                            <div class="attended_div pt-2 pt-lg-0">
                                                                <!-- <div class="d-flex align-items-center">
                                                                    @if($data->course_details->course_type!=1)
                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 my-1 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a>
                                                                    @endif
                                                                 </div> -->
                                                                <div class="d-flex align-items-center justify-content-end">
                                                                    <div class=""> 
                                                                        @if ($data->status == 0)
                                                                        <div class="status-textt-in-coursess"><i class="fa-solid fa-circle text-light-red fs10 pe-2"></i>Not Started</div>
                                                                        @elseif ($data->status == 3)
                                                                        <div class="status-textt-in-coursess"><i class="fa-solid fa-circle text-light-green fs10 pe-2"></i>Completed</div>
                                                                        @elseif($data->status == 1)
                                                                        <div class="status-textt-in-coursess"><i class="fa-solid fa-circle text-light-yellow fs10 pe-2"></i>In Progress</div>
                                                                        @else    
                                                                        @endif
                                                                    </div>
                                                                    <div class="pt-0">
                                                                       
                                                                        @if($data->course_details->expiration_date < now())
                                                                        <span class="btn btn-secondary border-radius-top me-1"
                                                                            style="cursor: default; pointer-events: none;">
                                                                            Expired
                                                                        </span>
                                                                        @else
                                                                        @if($data->course_details->course_type==1)
                                                                         <a href="{{url('start_course')}}?id={{$data->id}}" class="btn web-btn bottom-butun-in-card border-radius-top me-1"> Start from Beginning </a>
                                                                        @if(!empty($data->scorm_details))
                                                                        <a href="{{url('start_course')}}?id={{$data->id}}" class="btn web-btn bottom-butun-in-card bottom-butun-in-card1 border-radius-top me-1">Resume</a>

                                                                        @endif
                                                                        @endif
                                                                        @endif
                                                                    </div>
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
                                                    <div class="bg-white rounded-3">
                                                        <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                        <div class="no-data-found-text pb-5">No data found</div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @foreach($list as $data)
                                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 card-list-div my-2 px-3 px-md-2 assigned_courses courses_list" data-assign_id="{{$data->id}}">
                                                    <div class="bg-light border">
                                                        <div class="card-view-fav-icon">
                                                             @if(!empty($data->bookmark_data))
                                                            <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course" data-bs-toggle="tooltip" data-bs-placement="left" title="Bookmark this course">
                                                            <i class="fa-solid fa-star"></i></a>
                                                            @else
                                                            <a href="javascript:;" data-id="{{$data->id}}" class="bookmark_course" data-bs-toggle="tooltip" data-bs-placement="left" title="Bookmark this course">
                                                            <i class="fa-regular fa-star"></i></a>
                                                            @endif
                                                        </div>
                                                        <div class="courses-image-div">
                                                            <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                            @if($data->course_details->course_image)
                                                                <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid card-list-course-img" alt="">
                                                            @else
                                                                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid card-list-course-img" alt="">
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
                                                                <h6 class="text-start course-name mb-0 h-auto" style="cursor:pointer;" onclick="openData()">
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
                                                            <!-- <div class="mt-1 attended_div">
                                                                 <p class="attended_status">
                                                                     @if($data->course_details->course_type==2)
                                                                     @if($data->status==1) Attended @elseif($data->status==2) Not Attended @endif @endif</p>
                                                                    @if($data->course_details->course_type==1)
                                                                    
                                                                     <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-smm me-2"> Start from Beginning </a>
                                                                    @if(!empty($data->scorm_details))

                                                                   
                                                                    <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-smm">Resume</a>

                                                                    @endif

                                                                    @else


                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2 my-1 accept_course" data-id="{{$data->id}}" data-status="1">Attended</a>

                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-danger btn-sm me-2 my-1 accept_course" data-id="{{$data->id}}" data-status="2">Not Attended</a>

                                                                    @endif
                                                               
                                                            </div> -->
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
                                                    <div class="bg-white rounded-3">
                                                     <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                      <div class="no-data-found-text pb-5">No data found</div>
                                                  </div>
                                                    @endif
                                                </div>
                                                @foreach($category_view as $cview)
                                                <div class="col-12 col-md-6 col-lg-3 card-list-div my-2 px-3 px-md-2 courses_list">
                                                    <a href="{{url('category_courses')}}?id={{$cview->id}}" class="text-decoration-none">
                                                        <div class="bg-light ">
                                                            <div  class="courses-image-div">
                                                                @if(!empty($cview->image))

                                                                <img src="{{ url('storage/app/public/' . $cview->image) }}" class="img-fluid card-list-course-img" alt="course">
                                                                @else
                                                                <img src="{{asset('public/images/course.jpg')}}" class="img-fluid card-list-course-img" alt="course">
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

                        <div class="sidepop pr-2" id="dataOverlay">
                            {{-- In-drawer Centered Loader --}}
                            <div id="pageLoader" style="display:none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; min-height: 400px; background: rgba(255, 255, 255, 0.85); z-index: 1050;" class="align-items-center justify-content-center flex-column">
                                <img src="{{ url('public/images/loading.gif') }}" class="img-fluid opacity-50" style="max-height: 80px;" alt="Loading...">
                                <div class="mt-2 text-muted fw-semibold font-smallsize">Loading course details...</div>
                            </div>
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
          document.getElementById("dataOverlay").style.width = "55%";
        }
        if (window.screen.availWidth <= 991) {
            document.getElementById("main").style.width = "100%";
        }
        else{
            document.getElementById("main").style.width = "45%";
        }
      // document.getElementById("main").style.marginRight = "40%";
      document.getElementById("dataOverlay").style.right = "0px";
      $('.main_subdiv').removeClass('col-lg-10 offset-lg-1');
      $('.card-list-div').removeClass('col-lg-3')
    }

    function closeData() {
      $('#pageLoader').hide();
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
    $('.accept_course').click(function(){
        var  assign_id = $(this).data('id');
        var  status = $(this).data('status');
        var class_name = $(this);
        $.ajax({
            type: "GET",
            url: "{{ url('accept_course') }}",
            data: {
                assign_id: assign_id,status:status
            },
            dataType:"json",
            success: function(response) {
              

               if(response.status==1){
                class_name.parent('.attended_div').find('.attended_status').text('Attended');
                   $.toast({
                        heading: 'Success',
                        text: 'Attended Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
               }else{
                class_name.parent('.attended_div').find('.attended_status').text('Not Attended');
                $.toast({
                        heading: 'Success',
                        text: 'Not Attended Successfully.',
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
    $('.assigned_courses').click(function(e){
        e.stopPropagation();
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
            beforeSend: function() {
                $('#pageLoader').css('display', 'flex').show();
                $('.course_details').empty();
            },
            success: function(response) {
               $('.course_details').html(response);
               $('.course_details').show();
               if (openTab === 'feedback') {
                   var feedbackTab = document.getElementById('feedback-ratings-tab');
                   if (feedbackTab) {
                       feedbackTab.click();
                   }
               } else if (openTab === 'assessment') {
                   var assessmentTab = document.getElementById('assessment-tab');
                   if (assessmentTab) {
                       assessmentTab.click();
                   }
               }
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            },
            complete: function() {
                $('#pageLoader').hide();
            }
        });
    });
    $('.tab_menus').click(function(){

        $('#tab_id').val($(this).attr('aria-controls'));
        $('#pageLoader').hide();
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
    $('body').on('click','.take_exam',function(event){
        event.preventDefault();

        if ($(this).hasClass('assessment-locked')) {
            Swal.fire(
                'Assessment locked',
                'Please watch all required course videos completely before taking this exam.',
                'warning'
            );
            return;
        }

        // Assessment links loaded in the right-side course panel are handled
        // by its protected launch request, not by this legacy popup handler.
        if ($(this).data('assessment-id')) {
            return;
        }

        var link=$(this).data('link');
        if (!link) {
            Swal.fire('Unable to open assessment', 'The assessment link is not available.', 'warning');
            return;
        }

        var attemptsCount = parseInt($(this).data('attempts-count')) || 0;
        var attemptsRemaining = parseInt($(this).data('attempts-remaining')) || 0;
        var modalHtml = "";
        if (attemptsCount > 0) {
            modalHtml = '<div style="color: #dc3545; font-weight: 600; font-size: 15px; margin-top: 10px; text-align: center;">' +
                        '<i class="fa-solid fa-circle-exclamation" style="margin-right: 5px;"></i>' +
                        attemptsRemaining + (attemptsRemaining === 1 ? ' Attempt' : ' Attempts') + ' remaining.' +
                        '</div>';
        }

        Swal.fire({
              title: "Please click `Yes` if you are ready to take the exam, Otherwise click cancel?",
              html: modalHtml,
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel"
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
    
</script>

<script>
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
                beforeSend: function() {
                    $('#pageLoader').css('display', 'flex').show();
                    $('.course_details').empty();
                },
                success: function(response) {
                    $('.course_details').html(response);
                    $('.course_details').show();
                    if (autoOpenTab === 'feedback') {
                        var feedbackTab = document.getElementById('feedback-ratings-tab');
                        if (feedbackTab) {
                            feedbackTab.click();
                        }
                    } else if (autoOpenTab === 'assessment' || !autoOpenTab) {
                        var assessmentTab = document.getElementById('assessment-tab');
                        if (assessmentTab) {
                            assessmentTab.click();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading assigned course data:", error);
                },
                complete: function() {
                    $('#pageLoader').hide();
                }
            });
        }

        // Initialize tooltips for both the filled (solid) and outline (regular) icons
        $('[data-bs-toggle="tooltip"]').tooltip({
            trigger: 'hover focus touch' // Trigger tooltip on hover, focus, or touch
        });

        // Click event to toggle bookmark and show tooltip
        $('.bookmark_course').on('click', function () {
            var $this = $(this);
            var icon = $this.find('i');
            var tooltipText = $this.attr('title'); // Current tooltip text

            // Toggle between solid and regular star icons
            if (icon.hasClass('fa-regular')) {
                // Bookmark the course (solid star)
                icon.removeClass('fa-regular').addClass('fa-solid');
                $this.attr('title', 'Remove bookmark'); // Update tooltip text
            } else {
                // Unbookmark the course (outline star)
                icon.removeClass('fa-solid').addClass('fa-regular');
                $this.attr('title', 'Bookmark this course'); // Update tooltip text
            }

            // Dispose and reinitialize the tooltip after the change
            $this.tooltip('dispose').tooltip();

            // Manually show the tooltip after the change (on click)
            $this.tooltip('show');
        });
    });
</script>

{{-- Browser Back History Guard for All Courses page --}}
<script>
    (function () {
        function guardUserCoursesHistory() {
            if (window.history && window.history.pushState) {
                window.history.pushState({ lms_home: true }, document.title, window.location.href);
            }
        }

        guardUserCoursesHistory();
        window.addEventListener('pageshow', guardUserCoursesHistory);
        window.addEventListener('popstate', function (event) {
            guardUserCoursesHistory();
        });
    })();
</script>
