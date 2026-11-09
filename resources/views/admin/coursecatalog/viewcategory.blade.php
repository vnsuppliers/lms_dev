<style>
  .filter-dropdown-hite {
    height: auto;
  }
  .admin-course-det-height{
    height: 66.2vh !important;
  }
  #course_ajax_pop>.admin-course-det-height{
    height: 65.2vh !important;
  }
</style>

<div class="tab-pane fade {{ request()->query('tab') == 4 ? 'show active' : '' }}" id="v-vi-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
  <!-- <div class="col-12 col-lg-4 pe-0">
      <div class="py-2 mx-0">
          <div class="d-flex justify-content-between align-items-center">
              <div>
                  <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye menuu-icon"></i>View Categories</label>

                  <select id="view-category-select" class="form-control">
                     <option value="view-courses-category">View by categorywise</option>
        <option value="view-courses">View by coursewise</option>
       
    </select>

              </div>
              @if(hasPermission(5))
              <div>
                  <a href="{{url('coursecatalog?tab=3')}}" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add Category</a>
              </div>
              @endif
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
                <div class="mr-3">

                    <!-- Dropdown Menu -->
                    <select id="view-category-select" class="form-control trans-select-dropdown">
                        <option value="view-courses-category">View by categorywise</option>
                        <option value="view-courses">View Courses </option>
                    </select>
                </div>
                 @if(hasPermission(5))
                <div>
                    <a href="{{url('coursecatalog?tab=3')}}" class="btn web-btn admin-add-btns"><i class="fa-solid fa-plus"></i></a>
                </div>
                @endif
            </div>
        </div>
    </div>
  <div class="tab-content border-0 mt-0 px-2 pt-0" id="myTabContent">
    <div class="tab-pane fade show active" id="vw-ca" role="tabpanel" aria-labelledby="vw-ca-tab">
      <div class="row">
        <div class="col-12">
          <div class="card card-border shadow-none rounded-0 border-0 border-bottom-0 p-0">
            <div class="card-body px-0 py-0 rounded-3">
              <div class="row mx-0">
                  <div class="col-12 col-lg-4 bg-white py-2 rounded-3 laft-syde-content">
                    <div class="d-flex justify-content-between align-items-center pb-2">
                      <div>
                        <form class="forms-sample" method="get" action="{{url('coursecatalog')}}?tab=4">
                         <input type="hidden" name="tab" value="4">
                            <button class="btn filterBtn filters-btnn dropdown-toggle" type="button">
                            <i class="bi bi-filter"></i> Filters @if( !empty(Request::get('category_created_date')) || !empty(Request::get('status')) || !empty(Request::get('search_name_category')))<i class="fa-solid fa-circle filters-dot-icon"></i> @endif 
                            </button>

                            @if(!empty(Request::get('category_created_date')) || !empty(Request::get('status'))  || !empty(Request::get('search_name_category')))<a href="{{ url('coursecatalog') }}?tab=4" class="btn sbmt-btn ms-2">Reset</a>
                            @endif
                            <div class="dropdown-menu filters-dropdown-menuu filterMenu p-3 w-96 filter-dropdown-hite" style="display: none;top: 7%;">
                              <div class="form-group row">
                                <div class="col-sm-12 col-md-6">
                                  <label class="form-check-label ms-0 mb-0">Status</label>
                                   <select class="js-example-basic-single form-select-control " name="status">
                                      <option value="" >Status</option>
                                      <option value="0" @if(isset($request) && $request->status == 0) selected @endif>Inactive</option>
                                      <option value="1"@if(!isset($request) || $request->status == 1 || $request->status == "") selected @endif>Active</option>
                                  </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                  <label class="form-check-label ms-0 mb-0">Course Created Date</label>
                                    <select id="category_created_date" class="js-example-basic-single form-select-control category_created_date" name="category_created_date">
                                        <option value="" @if(request()->input('category_created_date') == '') selected @endif>Course Created Date</option>
                                        <option value="1" @if(request()->input('category_created_date') == '1') selected @endif>Today</option>
                                        <option value="2" @if(request()->input('category_created_date') == '2') selected @endif>Yesterday</option>
                                        <option value="3" @if(request()->input('category_created_date') == '3') selected @endif>Last week</option>
                                        <option value="4" @if(request()->input('category_created_date') == '4') selected @endif>This month</option>
                                        <option value="5" @if(request()->input('category_created_date') == '5') selected @endif>Custom Range</option>
                                    </select>
                                </div>

                                 <div class="col-sm-12 col-lg-12 my-1">
                                <div id="custom-range-category" class="form-group row" style="display: none;">
                                    <div class="col-sm-6 my-1">
                                        <label for="from_date_category">From Date:</label>
                                        <input type="date" id="from_date_category" name="from_date" class="form-control" value="{{ request()->input('from_date') }}">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label for="from_date_category">To Date:</label>
                                        <input type="date" id="from_date_category" name="to_date" class="form-control" value="{{ request()->input('to_date') }}">
                                    </div>
                                </div>
                               </div>

                                <div class="col-sm-12 my-3">
                                    <label class="form-check-label ms-0 mb-0">By Department Name</label>
                                    <select class="form-control multiple_select category_filter" id="category_department_filter" name="category_department_filter[]" multiple>
                                      @foreach($departments as $department)
                                          <option value="{{$department->id}}" @if(in_array($department->id, request()->input('category_department_filter', []))) selected @endif>
                                              {{$department->department_name}}
                                          </option>
                                      @endforeach
                                    </select>
                                </div>


                                <div class="col-sm-12">
                                  <div class="text-right">
                                    <button type="button" class="btn filterBtn cancel-btn mr-2">Cancel</button>
                                    <button type="submit" class="btn sbmt-btn submitBtn">Submit</button>
                                  </div>
                                </div>
                              </div>
                            </div>  
                        </form>
                      </div>

                        <form class="forms-sample"  method="get" action="{{url('coursecatalog')}}">
                          <div class="d-flex">
                              <input type="hidden" name="tab" value="4">
                              <input type="text" class="form-control rounded-0" name="search_name_category" value="{{Request::get('search_name_category')}}" placeholder="Search" />
                              <div class="input-group-append">
                                <span class="input-group-text" style="height: 40px;">
                                  <button type="submit" class="bi bi-search border-0"></button>
                                 </span>
                              </div>
                          </div>
                        </form>
                    </div>
                    <div class="height-78vh">
                      <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Category Name</th>
                            <th class="text-center">Status</th>
                            @if(hasPermission(5))
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($category_list as $dta)
                          <tr class="category_check" data-id="{{$dta->id}}"  data-image="{{ !empty($dta->image) ?url('storage/app/public/' . $dta->image): 'public/images/course.jpg' }}" data-cat_name="{{$dta->category_name}}" data-description="{{$dta->description}}" style="cursor:pointer;">
                            <!-- <td>{{$loop->iteration}}</td> -->
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="course-image-sm">
                                    @if($dta->image)
                                    <img src="{{ url('storage/app/public/' . $dta->image) }}" class="img-fluid w-100 rounded-3" alt="">
                                    @else
                                        <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" alt="">
                                    @endif
                                </div>
                                <div class="ps-3">
                                  <div class="course-name font-weight-bold pb-1">{{$dta->category_name}}</div>
                                  <div class="sub-text py-1">
                                     {{$dta->active_courses_count??'0'}} active courses
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="text-center"> @if(isset($dta))
                              @if($dta->status == 1)
                              Active
                              @else
                              Inactive
                              @endif
                            @endif</td>
                        
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>

                        <div class="col-12 col-md-12 col-lg-8 p-0 border-left-15 image_file_view rite-syde-content">
                            <div class="py-5 please_select_document_catg">
                                <div class="py-4 mt-5">
                                    <img src="{{ url('public/images/file.png') }}" class="img-fluid mx-auto d-block opacity-10" alt="">
                                </div>
                                <div class="d-flex align-items-center justify-content-center text-dark fs-5 opacity-10">---- ---- Please select a Category ---- ----</div>
                            </div>
                          <div class="py-5">
                            <div id="loader_catg" style="display:none;"><img src="{{ url('public/images/loading.gif') }}" class="img-fluid mx-auto d-block opacity-10" alt=""></div>
                        </div>
                        </div>
                  <div class="col-12 col-md-12 col-lg-8 p-0 border-left-15 category_image_show rite-syde-content">
                    
                  <div class="rounded-0 p-2 mt-1 bg-white">

                    <div class="row my-2">
                        <div class="col-4 col-lg-11">
                          <div class="d-flex align-items-center">
                            <div class="view-course-imagee view-categories-imagee">
                              <img src="{{ url('public/images/course.jpg') }}" class="img-fluid " alt="course-image">
                            </div>
                            <div class="ps-3">
                                <div class="course-name font-weight-bold view-categories-name"></div>
                                <div class="category-des-text view-categories-description"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-1">
                            @if(hasPermission(5))
                            <div class="dropdown d-flex justify-content-end">
                              <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                <ul class="dropdown-menu vm-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" id="edit_category_link"  href="{{url('coursecatalog')}}?id="><i class="fa-solid fa-pen-to-square pr-2"></i> Edit</a></li> 
                                    <li><a class="dropdown-item" id="add_category_id" href="{{url('coursecatalog')}}?tab=1&add_category_id="><i class="fa-solid fa-plus pr-2 mr-1"></i>Add Course</a></li>
                                    <!--<li><a class="dropdown-item" id="delete_category_link" href="{{url('category_destroy') }}?id=" title="{{__('Delete')}}" class=""><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a></li>-->
                                </ul>
                            </div>
                           @endif
                        </div>
                    </div>
                      <!-- <div class=" d-flex justify-content-between align-items-center content-bg rounded-3 mb-2 p-2" id="nav-tab" role="tablist">
                        <div>
                          <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-list menuu-icon"></i>Courses list</label>
                        </div>
                        
                      </div> -->
                  <nav class="mt-3">
                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">



                        <button class="nav-link nav-linkk active" id="courses-list-tab" data-bs-toggle="tab" data-bs-target="#courses-list" type="button" role="tab" aria-controls="courses-list" aria-selected="true">Courses List</button>
                        <!-- <button class="nav-link nav-linkk" id="audits-tab" data-bs-toggle="tab" data-bs-target="#audits" type="button" role="tab" aria-controls="audits" aria-selected="true">Audits</button> -->

                    </div> 
                  </nav>

                <div class="tab-content border-0 mt-0 pl-0 py-0 pr-2 admin-course-det-height" id="myTabContent">
                    <div class="tab-pane fade show active card-border border-top-0" id="courses-list" role="tabpanel" aria-labelledby="courses-list-tab">
                      <div class="row">
                        <div class="col-12">
                          <div class="card card-border border-0 shadow-none rounded-3 p-0">
                            <div class="card-body p-2 ">
                              <div class="row">
                                <div class="col-12 col-lg-8">
                                    <form class="forms-sample" id="category_list_filter">
                                      <input type="hidden" id="hiddencategory_id" name="hiddencategory_id" value="">
                                  <div class="dropdown mb-2">
                                    <button id="filterscategoryButton" class="btn filterBtn filters-btnn dropdown-toggle" type="button" ><i class="bi bi-filter"></i>
                                        Filters <span id="filterscategoryIndicator" class="filters-indicator"></span>
                                    </button>
                                        <button type="button" class="btn sbmt-btn ms-2 reset_category_filters_button" style="display: none;">Reset</button>

                                    <div class="dropdown-menu filterMenu filters-dropdown-menuu p-3 w-100" style="display: none;">
                                        <div class="form-group row">
                                           <div class="col-sm-6 col-md-6 col-md-4">
                                              <select  class="js-example-basic-single form-select-control course_filter" name="status_category">
                                                <option value="" selected>Status</option>
                                                <option value="0" @if(isset($request) && $request->status_category == 0 && $request->status_category !="") selected @endif>Inactive</option>
                                                <option value="1" @if(isset($request) && $request->status_category == 1 ) selected @endif>Active</option>
                                                <option value="2" @if(isset($request) && $request->status_category == 2 ) selected @endif>Draft</option>
                                            </select>
                                            </div>
                                      <div class="col-sm-6 col-md-6 col-lg-6 my-auto">

                                           <button type="button" class="btn filterBtn cancel-btn mr-2">Cancel</button>
                                            <button type="button"  class="btn sbmt-btn submitBtn category_filter_button">Submit</button>
                                              
                
                                </div>
                                      </div>
                                    </div>
                                </div>                                               
                                </form>
                                </div>
                                <div class="col-12 col-lg-4">
                                
                                  <div class="d-flex">
                                        <input type="hidden" name="tab" value="2">
                                        <input type="text" class="form-control rounded-0 course_filter search_name_course" name="search_name_course"  placeholder="Search" />
                                        <div class="input-group-append">
                                          <span class="input-group-text" style="height: 40px;">
                                            <button type="submit" class="bi bi-search border-0 search_name_course_button"></button>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div>
                                
                              </div>
                              <div id="assigned_category_courses_container">
                                <div class="height-58vh">
                              <div class="table-responsive">
                              <table class="table mt-1" id="CoursesDetailsContainer">
                                <tbody id="category_filters_body">
                                  
                                </tbody>
                             
                              </table>
                            </div>
                            </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="tab-pane fade border-top" id="audits" role="tabpanel" aria-labelledby="audits-tab">
                    audits
                   </div>
                    <!-- <div class="tab-pane fade" id="t2-rept" role="tabpanel" aria-labelledby="t4-tab">
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                          <div class="work-in-prog">Work In Progress</div>
                        </div>
                      </div>
                    </div> -->
                  </div>
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
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-0">
      <div class="work-in-prog">Work In Progress</div>
    </div>
  </div>
</div>
<div class="tab-pane fade" id="ac" role="tabpanel" aria-labelledby="ac-tab">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-0">
      <div class="work-in-prog">Work In Progress</div>
    </div>
  </div>
</div>
<div class="tab-pane fade" id="co" role="tabpanel" aria-labelledby="co-tab">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-0">
      <div>
        There is no better advertisement campaign that is low cost and also successful at the same time.
      </div>
    </div>
  </div>
</div>
</div>
</div>


<div class="modal fade overflow-y-hidden" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl my-3"> <!-- Add modal-lg class for larger modal -->
        <div class="modal-content">
            <div class="modal-header py-2 d-flex align-items-center">
                <h5 class="modal-title" id="courseModalLabel">Course Details</h5>
                <button type="button" class="btn-close fs-7" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-2">
                <div class="ajax_html_catg">
                    <!-- Course details will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
      $("#category_add_form").validate();
       $(".category_image_show").hide();
        $(".image_file_view").show();
       
      
    $(document).ready(function() {
        $('.category_check').on('click', function() {
          $(".category_image_show").show();
           $(".image_file_view").hide();
            $('.category_check').removeClass('green-background');
            $(this).addClass('green-background');

            var CategoryId = $(this).data('id');
            //alert(CategoryId);

            var imageUrl = $(this).data('image');
             var catName = $(this).data('cat_name');
              var catdescription = $(this).data('description');
              $('.please_select_document_catg').hide();
              $('#loader_catg').show();
              //alert(catdescription);
    $('.view-categories-imagee img').attr('src', imageUrl);
    $('.view-categories-name').text(catName); //alert();
    $('.view-categories-description').text(catdescription);
   $('#category_list_filter #hiddencategory_id').val(CategoryId);



            $('#edit_category_link').attr('href', '{{url('coursecatalog')}}?id=' + CategoryId + '&tab=3');
            $('#delete_category_link').attr('href', '{{url('category_destroy')}}?id=' + CategoryId);
            $('#add_category_id').attr('href', '{{url('coursecatalog')}}?add_category_id=' + CategoryId + '&tab=1');
            
            $.ajax({
                url: "{{ url('fetchCategoryData') }}?CategoryId=" + CategoryId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
        
                    var userDetailsContainer = $('#CoursesDetailsContainer tbody');
                    userDetailsContainer.empty(); // Clear existing data
                    
                    response.courses.forEach(function(course) {
                        var rowHtml = `
                            <tr>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <div class="course-image-sm">
                                         <img src="${course.course_image}" class="img-fluid w-100 rounded-3" alt="">
                                    </div>
                                    <div class="ps-3">
                                      <div class="pb-1 course-name font-weight-bold">${course.course_name}</div>
                                    </div>
                                  </div>
                                </td>

                                <td> <button class="btn btn-primary view-course-details btn-sm" data-id="${course.course_id}" data-name="${course.course_name}" data-description="${course.course_description}" data-image="${course.course_image}">
                                    Manage
                                </button></td>
                                
                            </tr>
                        `;
                        userDetailsContainer.append(rowHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

         $('body').on('click','.category_filter_button',function(){
          $('.search_name_course').val('');
   
   // var formData = new FormData($('body').find('#course_list_filter'));
    var formData = $('body').find('#category_list_filter').serialize();

    //alert(formData);
    $.ajax({
    type: 'get',
    url: "{{url('get_category_courses_based_on_filters')}}",
    data: formData,
    contentType: false,
    processData: false,
    dataType:'html',
    success: function (response) {
        $('body').find('#category_filters_body').html(response);

            var filtersApplied = false;
            $('body').find('.course_filter').each(function() {
                if ($(this).val()) { 
                    filtersApplied = true;
                    return false; 
                }
            });

            if (filtersApplied) {
                $('.reset_category_filters_button').show();
                $('#filterscategoryButton').addClass('filters-active');
                $('#filterscategoryIndicator').css('display', 'inline-block');
            } else {
                $('.reset_category_filters_button').hide();
                $('#filterscategoryButton').removeClass('filters-active');
                $('#filterscategoryIndicator').css('display', 'none');
            }
    }
    });
}); 

         $('body').on('click', '.search_name_course_button', function() {
    var search_name_course = $('body').find('.search_name_course').val();
    var hiddencategory_id = $('#hiddencategory_id').val();
    
    $.ajax({
        type: 'GET',
        url: "{{ url('get_category_courses_based_on_filters') }}",
        data: {
            search_name_course: search_name_course,
            hiddencategory_id: hiddencategory_id
        },
        dataType: 'html',
        success: function(response) {
          
            $('body').find('#category_filters_body').html(response);

            var filtersApplied = false;
            $('body').find('.course_filter').each(function() {
                if ($(this).val()) { 
                    filtersApplied = true;
                    return false; 
                }
            });

            if (filtersApplied) {
                $('.reset_category_filters_button').show();
                $('#filterscategoryButton').addClass('filters-active');
                $('#filterscategoryIndicator').css('display', 'inline-block');
            } else {
                $('.reset_category_filters_button').hide();
                $('#filterscategoryButton').removeClass('filters-active');
                $('#filterscategoryIndicator').css('display', 'none');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});
         $('body').on('click', '.reset_category_filters_button', function () {
    $('#category_list_filter')[0].reset();
    $('.category_filter_button').trigger('click');
});

         $('#view-category-select').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'view-courses-category') {
                window.location.href = '{{ url('coursecatalog') }}?tab=4';
            } else if (selectedValue === 'view-courses') {
                 window.location.href = '{{ url('coursecatalog') }}?tab=2';
               
            }
        });

          function updatecategoryCustomRangeVisibility() {
        var selectedValue = $('#category_created_date').val();
        if (selectedValue === '5') {
            $('#custom-range-category').show();
        } else {
            $('#custom-range-category').hide();
            $('#from_date_category').val('');
            $('#to_date_category').val('');
        }
    }

    // Initialize visibility on page load
    updatecategoryCustomRangeVisibility();

    // Update visibility on dropdown change
    $('#category_created_date').change(function() {
        updatecategoryCustomRangeVisibility();
    });


    $(document).on('click', '.view-course-details', function() {
        var course_id = $(this).data('id');
        var dep = $(this).data('dep');

        // Show modal with loader immediately
        $('#courseModal').modal('show');
        $('.ajax_html_catg').html('<div class="d-flex flex-column align-items-center justify-content-center py-5 my-5" style="min-height: 300px;"><img src="{{ url("public/images/loading.gif") }}" class="img-fluid opacity-50" style="max-height: 80px;" alt="Loading..."><div class="mt-2 text-muted fw-semibold font-smallsize">Loading course details...</div></div>');

        // Perform AJAX request to fetch the course details
        $.ajax({
            url: "{{url('fetch_course_details')}}?course_id=" + course_id,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('.ajax_html_catg').html(response);
                if (dep !== "") {
                    $('.reset_filter_button').show();
                    $('#filtersButton').addClass('filters-active');
                    $('#filtersIndicator').css('display', 'inline-block');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching course details: ", error);
                $('.ajax_html_catg').html('<div class="alert alert-danger m-3">Failed to load course details. Please try again.</div>');
            }
        });
    });

    });
</script>
