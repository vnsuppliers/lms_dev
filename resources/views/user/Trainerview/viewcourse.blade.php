<div class="p-2">
    <nav class="d-flex justify-content-between align-items-center border-bottom">
        <div class="nav nav-tabs align-items-center justify-content-between font-smallsize border-0 bg-white rounded-3" id="nav-tab" role="tablist">
            <button class="nav-link d-flex align-items-center active" id="dashboard-tab" data-bs-toggle="pill" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true"><i class="fa-solid fa-home headings-icon"></i> Dashboard</button>
        
            <button class="nav-link d-flex align-items-center" id="courses-tab" data-bs-toggle="pill" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="false"> <i class="fa-solid fa-chalkboard-user headings-icon"></i> Courses</button>
        </div>
    </nav>
</div>

<div class="tab-pane fade {{ request()->query('tab') == 2 || !request()->query('tab') ? 'show active' : '' }}"id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="tab-content content-bg rounded-3 border-0 pt-0 pb-3 mb-2 p-0" id="navtabContent" style="border-top: 1px solid #eeeef0;">
        <div class="tab-pane fade show active" id="dab" role="tabpanel" aria-labelledby="dab-tab">
            <div class="row mx-0">
                <div class="col-12 col-lg-4">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-chalkboard-user"></i>
                                            </div>

                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('trainercourseslist?tab=2')}}" class="text-uppercase">My Training Courses</a>
                                                </div>
                                                <!-- <small><a href="{{url('trainercourseslist?tab=2')}}" class="web-text-color">View</a></small> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-info d-flex align-items-center justify-content-center">
                                                {{$trainercoursescount??0}}
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
                                                    <a href="{{url('trainercourseslist')}}" class="text-uppercase">My Assigned users</a>
                                                </div>
                                                <!-- <small><a href="{{url('trainercourseslist?tab=2')}}" class="web-text-color">View</a></small> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-rblue d-flex align-items-center justify-content-center">
                                                {{$assignedUsersCount??0}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="circle-bg d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </div>

                                            <div class="pl-3">
                                                <div class="mb-2">
                                                    <a href="{{url('trainercourseslist')}}" class="text-uppercase">My Upcoming Training</a>
                                                </div>
                                                <!-- <small><a href="{{url('trainercourseslist?tab=2')}}" class="web-text-color">View</a></small> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="count-bg bg-danger d-flex align-items-center justify-content-center">
                                                0
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
    </div>
</div>

<div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border shadow-none rounded-0 border-0">
                <div class="card-body px-2 py-0 rounded-0 mx-2">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4 bg-white py-2 rounded-3">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <div>
                                    <form id="courseFilterForm" class="forms-sample" method="get" action="{{ url('trainercourseslist') }}">
                                        @csrf

                                        <button class="btn filterBtn filters-btnn dropdown-toggle" type="button">
                                            <i class="bi bi-filter"></i> Filters @if(!empty(Request::get('category_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')) )<i class="fa-solid fa-circle filters-dot-icon"></i> @endif  
                                        </button>
                                        @if(!empty(Request::get('category_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')))
                                        <a href="{{ url('trainercourseslist') }}" class="btn sbmt-btn ms-2">Reset</a>
                                        @endif
                                        <div class="dropdown-menu filterMenu filters-dropdown-menuu p-3 w-96" style="display: none; top: 7%;">
                                            <div class="form-group row">
                                                <div class="col-sm-6 my-1">
                                                    <select id="categoryFilter" class="js-example-basic-single form-select-control category_filter" name="category_id">
                                                        <option value="">Select a Category</option>
                                                        @foreach($category_list as $category)
                                                        <option value="{{ $category->id }}" @if($request->category_id == $category->id ) selected @endif>{{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 my-1">
                                                    <select id="statusFilter" class="js-example-basic-single form-select-control statusFilter" name="status">
                                                        <option value="" selected>Status</option>
                                                        <option value="0" @if(isset($request) && $request->status == 0 && $request->status != "") selected @endif>Inactive</option>
                                                        <option value="1" @if(isset($request) && $request->status == 1 ) selected @endif>Active</option>
                                                        <option value="2" @if(isset($request) && $request->status == 2 ) selected @endif>Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-2">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn sbmt-btn submitBtn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <form class="forms-sample"  method="get" action="{{url('trainercourseslist')}}">
                                    <!-- <input type="hidden" name="tab" value="2">
                                     <input type="text" class="form-control" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" />
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                       <button type="submit" class="bi bi-search"></i></button>
                                    </div>  -->
                                    <div class="d-flex">
                                        <input type="hidden" name="tab" value="2">
                                        <input type="text" class="form-control rounded-0" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="height: 40px;">
                                                <button type="submit" class="bi bi-search border-0"></button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="height-98vh">
                                <div class="table-responsive">
                                    <table class="table ">
                                    <!-- <thead>
                                        <tr>
                                            <th scope="col" class="">Course Details</th>
                                            @if(hasPermission(3))
                                            <th scope="col" class="text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead> -->
                                    <tbody id="courses_list_div">
                                       <?php $i=1;?>
                                       @foreach($trainers_data as $courses_list)
                                       <tr class="" style="cursor:pointer;" >
                                        <!-- <td class="">{{$i++}}</td> -->
                                            <!-- <td > 
                                                <div class="profile-image-sm">
                                                     @if($courses_list->course_image)
                                                        <img src="{{ url('storage/app/public/' . $courses_list->course_image) }}" class="img-fluid" alt="">
                                                    @else
                                                        <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                                                    @endif
                                                </div>
                                            </td> -->
                                            <td class="">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-image-sm">
                                                        @if($courses_list->course_details->course_image)
                                                        <img src="{{ url('storage/app/public/' . $courses_list->course_details->course_image) }}" class="img-fluid" alt="">
                                                        @else
                                                        <img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="pl-3 ml-1">
                                                        <a href="javascript:;" data-id="{{$courses_list->course_details->id}}" class="pb-1 course-name font-weight-bold trainer_course_click" style="height: 17px;">{{$courses_list->course_details->course_name??''}} @if($courses_list->course_details->active==2) <b>( Draft )</b> @endif</a>
                                                        <!-- <div class="py-1 sub-categories-styles" value="{{$courses_list->course_details->category_details->id??''}}">{{$courses_list->course_details->category_details->category_name??''}}</div> -->

                                                        <div class="py-1 sub-categories-styles" >
                                                            @if($courses_list->course_details->course_type==2) Instructor-led training 
                                                            @else
                                                            Online Training
                                                        @endif</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td class="" value="{{$courses_list->course_details->category_details->id??''}}">{{$courses_list->course_details->category_details->category_name??''}}</td>
                                                <td class="" value="{{$courses_list->course_details->category_details->Subcategory_details->id??''}}">{{$courses_list->course_details->category_details->Subcategory_details->subcategory_name??''}}</td> -->
                                                <!-- <td class="">{{$courses_list->course_details->updated_at ? \Carbon\Carbon::parse($courses_list->course_details->updated_at)->format('d-m-Y') : ''}}</td> -->
                                                @if(hasPermission(3))                             
                                                <td class="">
                                                    <div class="dropdown text-center">
                                                        <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu vm-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="{{url('coursecatalog?tab=1')}}&id={{$courses_list->course_details->id}}&edit=1"><i class="fa-solid fa-pen-to-square pr-2"></i> Edit</a></li> 
                                                            <!-- onclick="openSidepop()" -->
                                                            <li><a class="dropdown-item" href="{{url('delete_admin_courses')}}?id={{$courses_list->course_details->id}}" title="{{__('Delete')}}" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>@endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 ajax_html_div">
                            <div class="py-5">
                                <div class="py-4 mt-5">
                                    <img src="{{ url('public/images/file.png') }}" class="img-fluid mx-auto d-block" alt="">
                                </div>
                                <div class="d-flex align-items-center justify-content-center text-muted fs-5">---- ---- Please select a course ---- ----</div>
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


<!-- <div id="mySidepop" class="sidepop">
  <a href="javascript:void(0)" class="closebtn ml-0" onclick="closePop()">&times;</a>
  <div class="col-12">
      <div class="row">
          <div>
              
          </div>
      </div>
  </div>
</div> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(document).ready(function() {

        $('body').on('change','.assessment_path',function(){
           var id = $(this).data('id');
           var path = $(this).val();
           $.ajax({
            url: "{{url('add_assessment_path_to_user')}}?id=" + id+"&path="+path,
            type: 'GET',
            success: function(response) {

                $.toast({
                    heading: 'Success',
                    text: 'Updated Successfully.',
                    position: 'bottom-right',
                    stack: false,
                    icon: 'success'
                });
            }
        });
       });

        $('body').on('click','.user_filter_button',function(){

         $('.course_user_search_data').val('');  
   // var formData = new FormData($('body').find('#user_list_filter'));
         var formData = $('body').find('#user_list_filter').serialize();
         $.ajax({
            type: 'get',
            url: "{{url('trainer_get_user_based_on_filters')}}",
            data: formData,
            contentType: false,
            processData: false,
            dataType:'html',
            success: function (response) {
                $('body').find('#user_filters_body').html(response);
                var filtersApplied = false;
                $('body').find('.user_filter').each(function() {
                    if ($(this).val() !== '') {
                        filtersApplied = true;
                        return false; 
                    }
                });

                if (filtersApplied) {
                  $('.reset_filter_button').show();
                  $('#filtersButton').addClass('filters-active');
                  $('#filtersIndicator').css('display', 'inline-block');
              } else {
                $('#filtersButton').removeClass('filters-active');
                $('#filtersIndicator').css('display', 'none');
            }
        }
    });
     });

        $('body').on('click','.search_course_to_user_button',function(){

   // var formData = new FormData($('body').find('#user_list_filter'));
           var search_query = $('.course_user_search_data').val();
           var course_id = $('#hiddencourse_id').val();
   // alert(search_query);

           $.ajax({
            type: 'get',
            url: "{{url('trainer_get_user_based_on_filters')}}",
            data: {
                search_query: search_query,
                course_id: course_id
            },
            dataType:'html',
            success: function (response) {
                $('body').find('#user_filters_body').html(response);

                var filtersApplied = false;
                $('body').find('.course_user_search_data').each(function() {
                    if ($('.course_user_search_data').val() !== '') {
                        filtersApplied = true;
                        return false; 
                    }
                });

                if (filtersApplied) {
                   $('.reset_filter_button').show();
                   $('#filtersButton').addClass('filters-active');
                   $('#filtersIndicator').css('display', 'inline-block');
               } else {
                $('#filtersButton').removeClass('filters-active');
                $('#filtersIndicator').css('display', 'none');
            }
        }
    });
       });

        $('body').on('click', '.reset_filter_button', function () {
            $('#user_list_filter')[0].reset();
            $('.user_filter_button').trigger('click');
        });


        $('.trainer_course_click').on('click', function() {

            $(this).parents('#courses_list_div').find('tr').removeClass('course-active');
            $(this).parents('tr').addClass('course-active');
            var course_id = $(this).data('id');
        //alert(course_id);
            $.ajax({
                url: "{{url('fetch_trainer_course_details')}}?course_id=" + course_id,
                type: 'GET',
                dataType: 'html',
                success: function(response) {

                    $('.ajax_html_div').html(response);
                }
            });
        });
        $('body').on('submit','#upload_feedback_form',function(e){
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{url('upload_feedback_document')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var link ="{{url('storage/app/public/')}}"+response.files.document_path;
                    $('body').find('.active_admin_upload_list').append('<a href="'+link+'" download class="btn btn-sm btn-outline-primary text-muted text-nowrap">'+response.files.document_name+'</a>');
                    $('body').find('#excel_upload .close').click();
                    $.toast({
                        heading: 'Success',
                        text: 'Updated Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
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
        $('body').on('change','.user_single_check_ajax', function() {

            var courseId = $(this).data('course_id');
            var category_id = $(this).data('category_id');

            var userid = $(this).data('user_id');
            var isChecked = $(this).prop('checked');
                            // console.log(courseId,assignedUserId,userid);
            if (isChecked) {
                var status =1;
            }else{
                var status =0;
            }
            $.ajax({
                url: "{{url('fetch_signleCourse_userData')}}",
                method: 'get',
                data: {
                    courseid: courseId,
                    category_id:category_id,
                    userid: userid,
                    status:status
                },
                success: function(response) {
                    if(status==1){
                        $.toast({
                            heading: 'Success',
                            text: 'Course Assigned Successfully.',
                            position: 'bottom-right',
                            stack: false,
                            icon: 'success'
                        });
                    }else{
                        $.toast({
                            heading: 'warning',
                            text: 'Course Removed Successfully.',
                            position: 'bottom-right',
                            stack: false,
                            icon: 'warning'
                        });
                    }
                },
                error: function(xhr, status, error) {

                }
            });


        }); 


        $('body').on('change','.group_check_ajax', function() {

            var courseId = $(this).data('course_id');
            var category_id = $(this).data('category_id');

            var groupid = $(this).data('group_id');
            var isChecked = $(this).prop('checked');
                            // console.log(courseId,assignedUserId,groupid);
            if (isChecked) {
                var status =1;
            }else{
                var status =0;
            }
            $.ajax({
                url: "{{url('fetch_Course_groupData')}}",
                method: 'get',
                data: {
                    courseid: courseId,
                    category_id:category_id,
                    groupid: groupid,
                    status:status
                },
                success: function(response) {
                    if(status==1){
                        $.toast({
                            heading: 'Success',
                            text: 'All users in group Assigned Successfully.',
                            position: 'bottom-right',
                            stack: false,
                            icon: 'success'
                        });
                    }else{
                        $.toast({
                            heading: 'warning',
                            text: 'All users course Removed Successfully.',
                            position: 'bottom-right',
                            stack: false,
                            icon: 'warning'
                        });
                    }
                },
                error: function(xhr, status, error) {

                }

            });


        }); 




 // $('.category_filter,.statusFilter').on('change', function() {


 //     $('#courseFilterForm').submit();


 // });


    });

</script>
<script>
    function openSidepop() {
      document.getElementById("mySidepop").style.width = "80%";
  }

  function closePop() {
      document.getElementById("mySidepop").style.width = "0";
  }
</script>    

