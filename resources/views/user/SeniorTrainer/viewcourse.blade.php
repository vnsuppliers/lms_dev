<div class="p-2">
    <nav class="d-flex justify-content-between align-items-center border-bottom">
        <div class="nav nav-tabs align-items-center justify-content-between font-smallsize border-0 bg-white rounded-3" id="nav-tab" role="tablist">
            <button class="nav-link d-flex align-items-center @if(Request::get('tab')=='') active @endif" id="dashboard-tab" data-bs-toggle="pill" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true"><i class="fa-solid fa-home headings-icon"></i> Dashboard</button>
        
            <button class="nav-link d-flex align-items-center @if(Request::get('tab')=='2') active @endif" id="courses-tab" data-bs-toggle="pill" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="false"> <i class="fa-solid fa-chalkboard-user headings-icon"></i> Trainers</button>
        </div>
    </nav>
</div>

<div class="tab-pane fade show @if(Request::get('tab')=='') show active @endif"id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
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
                                                    <a href="{{url('seniortrainer_trainerslist?tab=2')}}" class="text-uppercase">Total Trainers</a>
                                                </div>
                                                <!-- <small><a href="{{url('seniortrainer_trainerslist?tab=2')}}" class="web-text-color">View</a></small> -->
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade @if(Request::get('tab')=='2') show active @endif" id="courses" role="tabpanel" aria-labelledby="courses-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border shadow-none rounded-0 border-0">
                <div class="card-body px-2 py-0 rounded-0 mx-2">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4 bg-white py-2 rounded-3">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <div>
                                    <form id="courseFilterForm" class="forms-sample" method="get" action="{{ url('seniortrainer_trainerslist') }}">
                                        @csrf
                                        <input type="hidden" name="tab" value="2">

                                        <button class="btn filters-btnn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-filter"></i> Filters @if(!empty(Request::get('department_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')) )<i class="fa-solid fa-circle filters-dot-icon"></i> @endif  
                                        </button>
                                        @if(!empty(Request::get('department_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')))
                                        <a href="{{ url('seniortrainer_trainerslist') }}" class="btn sbmt-btn ms-2">Reset</a>
                                        @endif
                                        <ul class="dropdown-menu filters-dropdown-menuu p-3 w-96">
                                            <div class="form-group row">
                                                <div class="col-sm-4 my-1">
                                                   <select id="categoryFilter" class="js-example-basic-single form-select-control department_filter" name="department_id">
                                                        <option value="">Select a department</option>
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" @if($request->department_id == $department->id ) selected @endif>{{ $department->department_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 my-1">
                                                    <select id="categoryFilter" class="js-example-basic-single form-select-control designation_filter" name="designation_id">
                                                        <option value="">Select a designation</option>
                                                        @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}" @if($request->designation_id == $designation->id ) selected @endif>{{ $designation->designation_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 my-1">
                                                    <select id="statusFilter" class="js-example-basic-single form-select-control statusFilter" name="status">
                                                        <option value="" selected>Status</option>
                                                        <option value="0" @if(isset($request) && $request->status == 0 && $request->status != "") selected @endif>Inactive</option>
                                                        <option value="1" @if(isset($request) && $request->status == 1 ) selected @endif>Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-2">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn sbmt-btn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                    </form>
                                </div>
                                <form class="forms-sample"  method="get" action="{{url('seniortrainer_trainerslist')}}">
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
                            <div class="height-100vh">
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
                                    <tbody id="trainiers_list_div">
                                       <?php $i=1;?>
                                      @foreach($trainers_data as $users_list)
                                       <tr class="" style="cursor:pointer;" >
                                            <td class="">
                                                <div class="row">
                                                    <div class="col-lg-3 pe-0">
                                                        <div class="course-image-sm">
                                                            @if($users_list->profile_image)
                                                            <img src="{{ url('storage/app/public/' . $users_list->profile_image) }}" class="img-fluid" alt="">
                                                            @else
                                                            <img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <a href="javascript:;" data-id="{{$users_list->id??''}}" class="pb-1 course-name font-weight-bold trainer_click">{{$users_list->first_name??''}} {{$users_list->last_name??''}} 
                                                    </div> 
                                                   
                                                      
                                                </div>
                                            </td>
                                            <td>{{$users_list->departmentdetails->department_name??''}}</td>
                                            <td>{{$users_list->designationdetails->designation_name??''}}</td>
                                                @if(hasPermission(3))                             
                                                <td class="">
                                                    <div class="dropdown text-center">
                                                        <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu vm-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="{{url('coursecatalog?tab=1')}}&id={{$users_list->course_details->id}}&edit=1"><i class="fa-solid fa-pen-to-square pr-2"></i> Edit</a></li> 
                                                            <!-- onclick="openSidepop()" -->
                                                            <li><a class="dropdown-item" href="{{url('delete_admin_courses')}}?id={{$users_list->course_details->id}}" title="{{__('Delete')}}" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>
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
                                <div class="d-flex alig-items-center justify-content-center text-muted fs-5">---- ---- Please select a course ---- ----</div>
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
            url: "{{url('senior_trainer_get_user_based_on_filters')}}",
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
            url: "{{url('senior_trainer_get_user_based_on_filters')}}",
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


        $('.trainer_click').on('click', function() {

            $(this).parents('#trainiers_list_div').find('tr').removeClass('course-active');
            $(this).parents('tr').addClass('course-active');
            var userid = $(this).data('id');
        //alert(userid);
            $.ajax({
                url: "{{url('fetch_trainer_details')}}?userid=" + userid,
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

