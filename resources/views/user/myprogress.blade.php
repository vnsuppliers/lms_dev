@include('layouts.user.header')
<style>
    body {
        height: 100vh;
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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-none rounded-0 mb-4 mt-2">
                <div class="card-body p-0 rounded-0 bg-transparent">
                    <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded-3">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <!-- <a href="{{url('mycompleted_courses')}}?menu=my_course&tab_id={{$request->tab_id}}&category_id={{$request->category_id}}" class="btn btn-sm @if(Request::get('menu')=='my_course' || Request::get('menu')=='' ) btn-primary @else btn-outline-primary @endif  mr-2 tab_menus">My Completed Courses</a>      -->
                                        <div href="" class="btn btn-sm btn-active-primaryy-tab tab_menus">My Completed Courses</div>        
                                    </div>
                                    <div class="ml-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="nav nav-pills pb-0" id="pills-tab" role="tablist">
                                                <!-- <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) active @endif  btn btn-sm web-transparent-btn mr-2 tab_menus" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                                                        <i class="fa-solid fa-list"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link btn btn-sm web-transparent-btn mr-2 tab_menus @if(Request::get('tab_id')=='pills-card') active @endif" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false">
                                                        <i class="fas fa-th-large"></i>
                                                    </a>
                                                </li> -->
                                                <!-- <li class="nav-item mr-0">
                                                    <a class="nav-linkk nav-link btn btn-sm web-transparent-btn mr-2 tab_menus @if(Request::get('tab_id')=='pills-gc') active @endif" id="pills-gc-tab " data-toggle="pill" href="#pills-gc" role="tab" aria-controls="pills-gc" aria-selected="false">
                                                        Group By Category
                                                    </a>
                                                </li> -->
                                            </ul>

                                            <form class="forms-sample">
                                                <div class="">
                                                    <button class="btn btn-sm filterBtn filters-btnn dropdown-toggle rounded-2" type="button">
                                                       <i class="bi bi-filter"></i> Filters
                                                    </button>
                                                    <div class="dropdown-menu filters-dropdown-menuu filterMenu user-rite-filter-drpdwn p-3" style="display: none;">
                                                        <form action="" method="get">
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 pr-1">
                                                                <select class="js-example-basic-single form-select-control" name="category_id">
                                                                    <option value="">Select a Category</option>
                                                                    @foreach($category_list as $cat)
                                                                    <option value="{{$cat->id}}" @if(Request::get('category_id')==$cat->id) Selected @endif>{{$cat->category_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <input type="hidden" name="tab_id" id="tab_id" value="{{Request::get('tab_id')??'pills-list'}}">
                                                           
                                                           <!--  <div class="input-group col-sm-4 pl-1">
                                                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{Request::get('search')}}" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="bi bi-search"></i>
                                                                    </span>
                                                                </div>
                                                            </div> -->
                                                             <div class="input-group col-sm-6 pl-1">
                                                                <button type="submit" class="btn btn-sm submitBtn btn-primary">Search</button>
                                                             </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content border-0 mt-2 height-82p5vh pr-2" id="pills-tabContent">
                                            <div class="tab-pane fade @if(Request::get('tab_id')=='pills-list' || Request::get('tab_id')=='' ) show active @endif" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                                                <div class="row">
                                                    <div class="col-12 pb-2">
                                                        @if(empty($list->toArray()))
                                                       <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                                                          <div class="no-data-found-text">No data found</div>
                                                        @endif
                                                        @foreach($list as $data)
                                                        <div class="p-2 courses_listt">
                                                            <div class="row">
                                                                <div class="col-lg-11">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="courses-image-div">
                                                                            <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                             @if($data->course_details->course_image)
                                                                                <img src="{{ url('storage/app/public/' . $data->course_details->course_image) }}" class="img-fluid" alt="">
                                                                            @else
                                                                                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="" >
                                                                            @endif
                                                                            </a>
                                                                        </div>
                                                                            <!-- <div class="progress list-view-p-bar">
                                                                                <div class="progress-bar progress-bar-striped bg-pink text-white border-bottom-0" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                                    50%
                                                                                </div>
                                                                            </div> -->
                                                                        <div class="pl-3 ml-1">
                                                                             <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}">
                                                                                <h6 class="text-start course-name mb-0 font-weight-bold" style="line-height: 20px;">
                                                                                   {{$data->course_details->course_name??''}}
                                                                                </h6>
                                                                            </a>
                                                                            <div class="fs-7 my-course-categori-name py-1">
                                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                                <span class="ps-1">{{$data->category_details->category_name??''}}</span>
                                                                            </div>
                                                                            <div class="fs-7 my-course-date py-1">
                                                                                <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                                <label class="ps-1 mb-0">Completed On: </label>
                                                                                <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($data->completed_on))->diffForHumans() ?> </span>
                                                                            </div>
                                                                             <div class="my-1">
                                                                                 <a href="{{url('start_course')}}?id={{$data->id}}" class="btn btn-sm btn-outline-primary btn-smm me-2"> Restart</a>
                                                                                 @if(!empty($data->course_details->certificate))
                                                                                  <a href="#" data-id="{{$data->id}}" class="btn btn-primary btn-sm get_certificates" data-bs-toggle="modal" data-bs-target="#certificateView"><i class="fa-solid fa-eye pr-1"></i> View Certificate</a> @endif
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
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
                                            <div class="tab-pane fade @if(Request::get('tab_id')=='pills-card'  ) show active @endif" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">

                                                <div class="row px-1">
                                                    @foreach($list as $data)
                                                    <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1 assigned_courses" data-assign_id="{{$data->id}}">
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
                                                                <div class="course-name h-auto">
                                                                <a href="javascript:;" class="assigned_courses" data-assign_id="{{$data->id}}"> {{$data->course_details->course_name??''}} </a></div>
                                                                <div class="exp-date">
                                                                    <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Completed On: </label>
                                                                        <span> 1 day ago</span>
                                                                </div>
                                                                 <div class="mt-1">
                                                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-sm me-2">View certificate</a>
                                                                    <a href="#" class="btn btn-xs btn-outline-primary btn-sm">Resume</a>
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
                                            <div class="tab-pane fade @if(Request::get('tab_id')=='pills-gc'  ) show active @endif" id="pills-gc" role="tabpanel" aria-labelledby="pills-gc-tab">
                                                <div class="row px-1">
                                                    @foreach($category_view as $cview)
                                                    <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                        <a href="{{url('category_courses')}}?id={{$cview->id}}" class="text-decoration-none">
                                                            <div class="bg-light ">
                                                                <div  class="courses-image-div">
                                                                    @if(!empty($cview->image))

                                                                    <img src="{{ url('storage/app/public/' . $cview->image) }}" class="img-fluid card-list-course-img" alt="course" />
                                                                    @else
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid card-list-course-img" alt="course" />
                                                                    @endif
                                                                </div>
                                                                <div class="p-2">
                                                                    <div class="course-name h-auto">{{$cview->category_name}}</div>
                                                                    <div class="pt-1">
                                                                        <span>{{count($cview->category_assigned_cousers)}} Courses </span>
                                                                    </div>
                                                                    <hr class="my-2" />
                                                                    <div class="d-flex justify-content-between">
                                                                        <!-- <div class="learning-plan-text">
                                                                            0 Courses Completed
                                                                        </div> -->
                                                                    </div>
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

                            <div class="col-12 col-md-6 col-lg-6 mt-2 course_details" @if(empty($courses_data)) style="display: none;" @endif @if(Request::get('tab_id') !='pills-list') style="display: none;" @endif>
                              
                               
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
                        <h5 class="modal-title" id="certificateViewLabel">Course completion certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body certificate_html">
                            
                      </div>
                      
                    </div>
                  </div>
                </div>
@include('layouts.user.footer')

<script type="text/javascript">
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
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });
    });
    $('.assigned_courses').click(function(){

        var  assign_id = $(this).data('assign_id');
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

    $('body').on('click','.get_certificates',function(){
        var  assign_id = $(this).data('id');
         $.ajax({
            type: "GET",
            url: "{{ url('get_certificate') }}",
            data: {
                assign_id: assign_id
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
    
</script>
