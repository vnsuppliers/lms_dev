
@if(hasPermission(4))
<style>
    /* Ensure course name and details are completely shown with full text (no ellipsis ...) */
    #courses_list_div .course-name,
    #course_catalog_left_panel .course-name,
    .laft-syde-content .course-name,
    a.course-name {
        display: block !important;
        height: auto !important;
        min-height: 20px !important;
        max-height: none !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow: visible !important;
        text-overflow: clip !important;
        -webkit-line-clamp: unset !important;
        line-clamp: unset !important;
        -webkit-box-orient: unset !important;
        box-orient: unset !important;
        line-height: 1.4 !important;
    }

    #courses_list_div .course-title-container {
        min-width: 0 !important;
        flex: 1 1 auto !important;
        overflow: visible !important;
    }

    /* Course search autocomplete dropdown */
    .course-search-results-dropdown {
        width: max-content !important;
        min-width: 380px !important;
        max-width: 540px !important;
        right: 0 !important;
        left: auto !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
    }
    .course-search-item {
        transition: background-color 0.15s ease-in-out;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
    }
    .course-search-item:last-child {
        border-bottom: none;
    }
    .course-search-item:hover,
    .course-search-item.active-item {
        background-color: #f1f8f7;
    }
    .course-badge-dept {
        background-color: #e6f4f2;
        color: #005452;
        border: 1px solid #b2dfdb;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 4px;
        white-space: nowrap;
        display: inline-block;
        flex-shrink: 0;
    }

    /* Left panel styling: allows dragging wide to the right without being capped by col-lg-4 */
    #course_catalog_left_panel {
        max-width: none !important;
        overflow: visible !important;
        z-index: 10 !important;
    }

    /* Draggable Splitter Handle attached to the right edge of the Course List */
    .course-split-divider {
        position: absolute;
        top: 0;
        bottom: 0;
        right: -9px;
        width: 18px;
        z-index: 105;
        cursor: col-resize;
        display: flex;
        align-items: center;
        justify-content: center;
        touch-action: none;
        user-select: none;
        -webkit-user-select: none;
    }

    .course-split-divider::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 8px;
        width: 2px;
        background-color: #b2dfdb;
        transition: background-color 0.2s ease;
    }

    .course-split-divider:hover::before,
    .course-split-divider.active::before {
        background-color: #005452;
    }

    .course-drag-grip {
        width: 18px;
        height: 54px;
        background: #005452;
        color: #ffffff;
        border: 1px solid #003e3d;
        border-radius: 9px;
        box-shadow: 0 2px 8px rgba(0, 84, 82, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: col-resize;
        transition: transform 0.15s ease, background-color 0.15s ease;
        z-index: 2;
    }

    .course-drag-grip i {
        font-size: 11px;
        color: #ffffff;
    }

    .course-split-divider:hover .course-drag-grip,
    .course-split-divider.active .course-drag-grip {
        background-color: #007a77;
        box-shadow: 0 4px 14px rgba(0, 84, 82, 0.65);
        transform: scale(1.12);
    }

    /* While actively dragging */
    body.course-split-resizing {
        cursor: col-resize !important;
        user-select: none !important;
        -webkit-user-select: none !important;
    }

    body.course-split-resizing * {
        user-select: none !important;
        -webkit-user-select: none !important;
    }

    body.course-split-resizing #course_catalog_left_panel,
    body.course-split-resizing #course_catalog_right_panel,
    body.course-split-resizing #course_catalog_drag_handle {
        transition: none !important;
    }

    /* Hidden when left panel is closed/collapsed */
    .laft-syde-content.closed #course_catalog_drag_handle,
    .laft-syde-content.closed ~ #course_catalog_drag_handle {
        display: none !important;
    }

    .laft-syde-content.closed ~ #course_catalog_right_panel {
        margin-left: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
        flex: 0 0 100% !important;
    }

    @media (max-width: 991px) {
        .course-split-divider {
            display: none !important;
        }
        #course_catalog_left_panel,
        #course_catalog_right_panel {
            width: 100% !important;
            max-width: 100% !important;
            margin-left: 0 !important;
            position: static !important;
            flex: 0 0 100% !important;
        }
    }
</style>
<div class="tab-pane fade {{ request()->query('tab') == 2 || !request()->query('tab') ? 'show active' : '' }}" id="" role="tabpanel" aria-labelledby="v-pills-tab-twos">
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
                    <select id="view-course-select" class="form-control trans-select-dropdown">
                        <option value="view-courses">View Courses </option>
                        <option value="view-courses-category">View by categorywise</option>
                    </select>
                </div>

                <div>
                    <a href="{{url('coursecatalog?tab=1')}}" class="btn web-btn admin-add-btns"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-border shadow-none rounded-0 border-0 p-0">
                <div class="card-body px-0 py-0 rounded-0 mx-2">
                    <div class="row mx-0 position-relative" id="course_catalog_split_container">
                        <div class="col-12 col-md-12 col-lg-4 bg-white py-2 laft-syde-content" id="course_catalog_left_panel">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <div>
                                    <form id="courseFilterForm" class="forms-sample" method="get" action="{{ url('coursecatalog') }}">
                                        @csrf
                                       
                                        <button id="" class="btn filterBtn filters-btnn dropdown-toggle" type="button">
                                            <i class="bi bi-filter"></i> Filters @if(!empty(Request::get('category_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')) || !empty(Request::get('course_created_date')) || !empty(Request::get('assessment_filter')))<i class="fa-solid fa-circle filters-dot-icon"></i> @endif  
                                        </button>
                                        @if(!empty(Request::get('category_id')) || !empty(Request::get('status')) || !empty(Request::get('search_name')) || !empty(Request::get('course_created_date')) || !empty(Request::get('assessment_filter')))
                                        <a href="{{ url('coursecatalog') }}?tab=2" class="btn sbmt-btn ms-2">Reset</a>
                                        @endif
                                        <div id="" class="dropdown-menu filters-dropdown-menuu filterMenu pt-2 px-2 pb-3 w-96 filter-dropdown-hite" style="display: none; top: 7%; height: 61vh;">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="form-check-label ms-0 mb-0">Course Filters</h4>
                                                <button type="button" id="closeDropdownBtn" class="close-dropdown" style="border: none; background: none; font-size: 24px; cursor: pointer;">
                                                &times;
                                                </button>
                                            </div>

                                            <div class="form-group row">
                                               <div class="col-sm-12 my-1">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-check-label ms-0 mb-2">By Category Name</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <select class="form-control multiple_select category_filter" id="category_id" name="category_id[]" multiple>
                                                                @foreach($category_all_list as $category)
                                                                    <option value="{{$category->id}}" @if(in_array($category->id, request()->input('category_id', []))) selected @endif>
                                                                        {{$category->category_name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6 my-2">
                                                    <div>
                                                        <label class="form-check-label ms-0 mb-2">Status</label>
                                                    </div>
                                                    <select id="statusFilter" class="js-example-basic-single form-select-control statusFilter" name="status">
                                                        <option value="">Status</option>
                                                        <option value="" @if(!isset($request) ||  $request->status == "") selected @endif>All</option>
                                                        <option value="0" @if($request->status == '0') selected @endif>Inactive</option>
                                                        <option value="1" @if($request->status == '1' ) selected @endif>Active</option>
                                                        <option value="2" @if($request->status == '2') selected @endif>Draft</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div>
                                                        <label class="form-check-label ms-0 mb-2">Course Created Date</label>
                                                    </div>
                                                    <select id="course_created_date" class="js-example-basic-single form-select-control course_created_date" name="course_created_date">
                                                        <option value="" @if(request()->input('course_created_date') == '') selected @endif>Course Created Date</option>
                                                        <option value="1" @if(request()->input('course_created_date') == '1') selected @endif>Today</option>
                                                        <option value="2" @if(request()->input('course_created_date') == '2') selected @endif>Yesterday</option>
                                                        <option value="3" @if(request()->input('course_created_date') == '3') selected @endif>Last week</option>
                                                        <option value="4" @if(request()->input('course_created_date') == '4') selected @endif>This month</option>
                                                        <option value="5" @if(request()->input('course_created_date') == '5') selected @endif>Custom Range</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row"> 
                                                <div id="custom-range" class="form-group row" style="display: none;">
                                                    <div class="col-sm-6 my-2">
                                                        <label for="from_date">From Date:</label>
                                                        <input type="date" id="from_date" name="from_date" class="form-control" value="{{ request()->input('from_date') }}">
                                                    </div>
                                                    <div class="col-sm-6 my-2">
                                                        <label for="to_date">To Date:</label>
                                                        <input type="date" id="to_date" name="to_date" class="form-control" value="{{ request()->input('to_date') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                 <div class="col-sm-6 my-3">
                                                     <div class="form-check mt-0">
                                                        <input class="form-check-input ms-0" type="checkbox" id="assessment_filter" name="assessment_filter" @if(request()->input('assessment_filter')) checked @endif>
                                                        <label class="form-check-label ms-0" for="assessment_filter">
                                                           Has Assessments
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <h6 class="form-check-label ms-0 mb-2">Sort By</h6>

                                            <div class="form-group row">
                                                <div class="col-sm-6 my-3">
                                                    <div>
                                                        <label class="form-check-label ms-0 mb-2">Course name</label>
                                                    </div>
                                                    <select id="course_name_sort" class="js-example-basic-single form-select-control course_name_sort" name="course_name_sort">
                                                        <option value="" @if(request()->input('course_name_sort') == '') selected @endif>Select sort by</option>
                                                        <option value="1" @if(request()->input('course_name_sort') == '1') selected @endif>A to Z</option>
                                                        <option value="2" @if(request()->input('course_name_sort') == '2') selected @endif>Z to A</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 my-3">
                                                    <div>
                                                        <label class="form-check-label ms-0 mb-2">Created Date</label>
                                                    </div>
                                                    <select id="course_name_sort" class="js-example-basic-single form-select-control created_at_sort" name="created_at_sort">
                                                        <option value="" @if(request()->input('created_at_sort') == '') selected @endif>Select sort by</option>
                                                        <option value="1" @if(request()->input('created_at_sort') == '1') selected @endif>Assending</option>
                                                        <option value="2" @if(request()->input('created_at_sort') == '2') selected @endif>Descending</option>
                                                    </select>
                                                </div>
                                            </div>

                                             <!--  <div class="form-group row">
                                                <div class="col-12 mt-2">
                                                    <div id="selected-categories" class="d-flex flex-wrap">
                                                        @if(request()->input('category_id'))
                                                            @foreach(request()->input('category_id') as $catId)
                                                                @php
                                                                    $category = $category_list->where('id', $catId)->first();
                                                                @endphp
                                                                @if($category)
                                                                    <div class="selected-category badge bg-primary text-light me-2 mb-2">
                                                                        {{ $category->category_name }}
                                                                        <span class="remove-category" data-id="{{ $category->id }}" style="cursor: pointer; margin-left: 5px;">&times;</span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="form-group row align-items-center justify-content-center">
                                                <div class="col-12">
                                                    <div class="text-right">
                                                        <button type="button" class="btn filterBtn cancel-btn mr-2">Cancel</button>
                                                        <button type="submit" class="btn sbmt-btn submitBtn">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <form class="forms-sample pb-2" method="get" action="{{url('coursecatalog')}}" id="course_search_form">
                                    <div class="d-flex position-relative">
                                        <input type="hidden" name="tab" value="2">
                                        @if(Request::filled('status'))
                                            <input type="hidden" name="status" value="{{ Request::get('status') }}">
                                        @endif
                                        @if(Request::has('category_id'))
                                            @foreach((array)Request::get('category_id') as $cat)
                                                <input type="hidden" name="category_id[]" value="{{ $cat }}">
                                            @endforeach
                                        @endif
                                        <div class="position-relative flex-grow-1">
                                            <input type="text" class="form-control rounded-0" id="course_search_input" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" autocomplete="off" />
                                            <div id="course_search_dropdown" class="course-search-results-dropdown shadow bg-white border rounded-bottom" style="display: none; position: absolute; top: 100%; right: 0; min-width: 380px; z-index: 1050; max-height: 280px; overflow-y: auto;">
                                            </div>
                                        </div>
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

                                            @if($courses_lists->count() > 0)

                                            @foreach($courses_lists as $courses_list)
                                            <tr class="" style="cursor:pointer;" >
                                                <!-- <td class="">{{$i++}}</td> -->
                                                <td class="pl-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-image-sm">
                                                            @if($courses_list->course_image)
                                                                <img src="{{ url('storage/app/public/' . $courses_list->course_image) }}" class="img-fluid w-100 rounded-3" alt="">
                                                            @else
                                                                <img src="{{ url('public/images/course.jpg') }}" class="img-fluid w-100 rounded-3" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="ps-3 flex-grow-1 course-title-container" style="min-width: 0;">
                                                            <a href="javascript:;" data-dep="{{$courses_list->category_details->department_id}}" data-id="{{$courses_list->id}}" class="pb-1 course-name font-weight-bold user_check" style="display: block !important; height: auto !important; max-height: none !important; white-space: normal !important; word-break: break-word !important; overflow: visible !important; text-overflow: clip !important; -webkit-line-clamp: unset !important; line-clamp: unset !important; -webkit-box-orient: unset !important; line-height: 1.4 !important;">{{$courses_list->course_name??''}} @if($courses_list->active==2) <b>( Draft )</b> @endif</a>

                                                            <div class="py-1 sub-categories-styles" >
                                                                @if($courses_list->course_type==2) Instructor-led training 
                                                                @else
                                                                Online Training
                                                            @endif</div>

                                                            <div class="py-1 sub-text">{{ $courses_list->assigned_usersdetails_count ?? ($courses_list->Assigned_usersdetails ? $courses_list->Assigned_usersdetails->count() : 0) }} users enrolled</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td class="" value="{{$courses_list->category_details->id??''}}">{{$courses_list->category_details->category_name??''}}</td>
                                                <td class="" value="{{$courses_list->category_details->Subcategory_details->id??''}}">{{$courses_list->category_details->Subcategory_details->subcategory_name??''}}</td> -->
                                                <!-- <td class="">{{$courses_list->updated_at ? \Carbon\Carbon::parse($courses_list->updated_at)->format('d-m-Y') : ''}}</td> -->

                                                
                                            </tr>
                                            
                                            @endforeach
                                            @else
                                            <div>
                                                <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block w-40" width="" alt="">
                                                <div class="no-data-found-text">No data found</div>
                                            </div>

                                        @endif           
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- Draggable Splitter Handle attached to the right edge of this Course List Container -->
                            <div id="course_catalog_drag_handle" class="course-split-divider" title="Drag to widen course list">
                                <div class="course-drag-grip">
                                    <i class="fa-solid fa-grip-lines-vertical"></i>
                                </div>
                            </div>
                        </div>
                           
                        <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 rite-syde-content position-relative" id="course_catalog_right_panel">
                            <div id="loader" style="display:none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; min-height: 400px; background: rgba(255, 255, 255, 0.85); z-index: 1050;" class="align-items-center justify-content-center flex-column">
                                <img src="{{ url('public/images/loading.gif') }}" class="img-fluid opacity-50" style="max-height: 80px;" alt="Loading...">
                                <div class="mt-2 text-muted fw-semibold font-smallsize">Loading course details...</div>
                            </div>
                            <div class="ajax_html_div h-100">
                                <div class="py-5 please_select_document">
                                    <div class="py-4 mt-5">
                                        <img src="{{ url('public/images/file.png') }}" class="img-fluid mx-auto d-block opacity-30" alt="">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center text-dark fs-5 opacity-30 ">---- ---- Please select a course ---- ----</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    {{-- Delete Course Modal --}}
     @include('admin.coursecatalog.delete_course_modal')
    {{-- End delete Course Modal --}}
</div>
@endif
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Tippy.js tooltips
        const instance = tippy('.multiselect', {
            content: 'Initial content here',
            maxWidth: 300, // Set max width if needed
            placement: 'top', // Tooltip position
            theme: 'light', // Tooltip theme
            allowHTML: true // Allow HTML content
        });

        function updateTooltipContent(selector, newContent) {
            tippy(selector).forEach(instance => {
                instance.setContent(newContent);
            });
        }

        const dynamicContent = 'Dynamic content goes here, updated based on user interaction.';
        updateTooltipContent('.multiselect', dynamicContent);
    });
</script>

<script>

$(document).ready(function() {
   // alert('hi');
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
   
   $('.course_user_search_da').val('');

   // var formData = new FormData($('body').find('#user_list_filter'));
    var formData = $('body').find('#user_list_filter').serialize();
    $.ajax({
    type: 'get',
    url: "{{url('get_user_based_on_filters')}}",
    data: formData,
    contentType: false,
    processData: false,
    dataType:'html',
    success: function (response) {
        $('body').find('#user_filters_body').html(response);


        var filtersApplied = false;


            $('body').find('.user_filter').each(function() {
                //alert();
                
                if ($(this).val().length > 0) { 
                    filtersApplied = true;
                    return false; 
                }
                if ($(this).attr('type') == "checkbox" && $(this).is(':checked')) {
                    filtersApplied = true;

                }


            });
            
            if (filtersApplied) {
                // alert('hide no');
                  $('.reset_filter_button').show();
                $('#filtersButton').addClass('filters-active');
                $('#filtersIndicator').css('display', 'inline-block');
            } else {
                // alert('hide yes');
                 $('.reset_filter_button').hide();
                $('#filtersButton').removeClass('filters-active');
                $('#filtersIndicator').css('display', 'none');
            }
    }
    });
});

$('body').on('click', '.search_course_to_user_button', function() {
    var search_query = $('.course_user_search_da').val();
    var course_id = $('#hiddencourse_id').val();

    // Serialize the filter form and append search_query and course_id so filters aren't lost
    var formData = $('#user_list_filter').serialize() + '&search_query=' + encodeURIComponent(search_query) + '&course_id=' + course_id;

    $.ajax({
        type: 'GET',
        url: "{{url('get_user_based_on_filters')}}",
        data: formData,
        dataType: 'html',
        success: function (response) {
            $('body').find('#user_filters_body').html(response);

            var filtersApplied = false;
            
            // Check dropdown filters
            $('body').find('.user_filter').each(function() {
                if ($(this).val() && $(this).val().length > 0) { 
                    filtersApplied = true;
                    return false; 
                }
                if ($(this).attr('type') == "checkbox" && $(this).is(':checked')) {
                    filtersApplied = true;
                }
            });

            // Check if search input has text (using your correct input class .course_user_search_da)
            if (search_query !== '') {
                filtersApplied = true;
            }
            
            if (filtersApplied) {
                $('.reset_filter_button').show();
                $('#filtersButton').addClass('filters-active');
                $('#filtersIndicator').css('display', 'inline-block');
            } else {
                $('.reset_filter_button').hide();
                $('#filtersButton').removeClass('filters-active');
                $('#filtersIndicator').css('display', 'none');
            }
        }
    });
});

    $('body').on('click', '.reset_filter_button', function () {
        // alert('test');
    $('body').find('#user_list_filter')[0].reset();
    $('body').find('.user_filter_remove').prop('checked',false);
    $('body').find('.user_filter_button').trigger('click');
    
});


    $('body').on('click', '.user_check', function(e) {
        e.stopPropagation();

        var $row = $(this).parents('td');
        $row.addClass('course-active');
        $('#courses_list_div').find('td').not($row).removeClass('course-active');

        var dep = $(this).data('dep');
        var course_id = $(this).data('id');
        if (!course_id) return;

        $('.please_select_document').hide();
        $('#loader').css('display', 'flex').show();

        $.ajax({
            url: "{{url('fetch_course_details')}}?course_id=" + course_id,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('.ajax_html_div').html(response);
                $('#loader').hide();

                if (dep != "") {
                    $('.reset_filter_button').show();
                    $('#filtersButton').addClass('filters-active');
                    $('#filtersIndicator').css('display', 'inline-block');
                }
            },
            error: function(xhr, status, error) {
                $('#loader').hide();
                console.error("Error fetching course details: ", error);
            }
        });
    });

    $('body').on('click', '#courses_list_div tr', function(e) {
        if ($(e.target).closest('.user_check').length) {
            return;
        }
        var $userCheck = $(this).find('.user_check');
        if ($userCheck.length) {
            $userCheck.trigger('click');
        }
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


    $('body').on('click','.delete-courses-link',function(){
                event.preventDefault(); // Prevent the default link action

                const url = $(this).attr('href'); // Get the URL from the link

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the URL
                        window.location.href = url;
                    }
                });
            });


    $('body').on('click','.content_delete',function(){
                event.preventDefault(); // Prevent the default link action

                const url = $(this).attr('href'); // Get the URL from the link

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the URL
                        window.location.href = url;
                    }
                });
            });

    // $('body').on('change', '.category_filter', function() {
    //     var categoryId = $(this).val();
    //     var categoryName = $(this).siblings('label').text();
        
    //     if ($(this).is(':checked')) {
    //         $('#selected-categories').append(
    //             `<div class="selected-category badge bg-primary text-light me-2 mb-2">
    //                 ${categoryName}
    //                 <span class="remove-category" data-id="${categoryId}" style="cursor: pointer; margin-left: 5px;">&times;</span>
    //             </div>`
    //         );
    //     } else {
    //         $('#selected-categories').find(`.remove-category[data-id="${categoryId}"]`).parent().remove();
    //     }
    // });

    // $('body').on('click', '.remove-category', function() {
    //     var categoryId = $(this).data('id');
    //     $(`input.category_filter[value="${categoryId}"]`).prop('checked', false).trigger('change');
    // });
    });


    function updateCustomRangeVisibility() {
        var selectedValue = $('#course_created_date').val();
        if (selectedValue === '5') {
            $('#custom-range').show();
        } else {
            $('#custom-range').hide();
            $('#from_date').val('');
            $('#to_date').val('');
        }
    }

    // Initialize visibility on page load
    updateCustomRangeVisibility();

    // Update visibility on dropdown change
    $('#course_created_date').change(function() {
        updateCustomRangeVisibility();
    });

    $(document).on('click', '.take_result', function(e){ 
        e.preventDefault();
        var link = $(this).data('link');
        var courseId = $(this).data('course-id') || $('#hiddencourse_id').val();
        if (courseId) {
            sessionStorage.setItem('lms_last_active_course_id', courseId);
            sessionStorage.setItem('lms_last_active_subtab', 'reports');
        }
        if (link) {
            window.location.href = link;
        }
    });

      $('#view-course-select').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'view-courses-category') {
                window.location.href = '{{ url('coursecatalog') }}?tab=4';
            } else if (selectedValue === 'view-courses') {
                   window.location.href = '{{ url('coursecatalog') }}?tab=2';
                
            }
        });

</script>

<script>
    $(document).ready(function () {
        $('#closeDropdownBtn').on('click', function () {
            $('.filterMenu').hide();
        });

        // Properly close the modal backdrop
        $(document).on('click', '[data-dismiss="modal"], .modal', function(e) {
            
            if (e.target === this) {
                $('#deleteCourseModal').modal('hide');
            }
        });

        $('#deleteCourseModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
        });

        // Auto-select course and activate reports sub-tab when returning from Assessment
        var urlParams = new URLSearchParams(window.location.search);
        var activeCourseId = urlParams.get('course_id') || sessionStorage.getItem('lms_last_active_course_id');
        var activeSubTab = urlParams.get('open_tab') || urlParams.get('subtab') || sessionStorage.getItem('lms_last_active_subtab') || 'reports';

        if (sessionStorage.getItem('lms_last_active_course_id')) {
            sessionStorage.removeItem('lms_last_active_course_id');
            sessionStorage.removeItem('lms_last_active_subtab');
        }

        if (activeCourseId) {
            var targetCourse = $('.user_check[data-id="' + activeCourseId + '"]').first();
            if (targetCourse.length) {
                var $row = targetCourse.parents('td');
                $row.addClass('course-active');
                $('#courses_list_div').find('td').not($row).removeClass('course-active');
            }
            $('.please_select_document').hide();
            $('#loader').css('display', 'flex').show();
            $.ajax({
                url: "{{url('fetch_course_details')}}?course_id=" + activeCourseId,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('.ajax_html_div').html(response);
                    $('#loader').hide();

                    if (activeSubTab === 'reports' || !activeSubTab) {
                        $('#course_ajax_pop > nav #nav-tab > button').removeClass('active');
                        var $courseReportsBtn = $('#course_ajax_pop > nav #nav-tab > button[data-bs-target="#reports"]');
                        if ($courseReportsBtn.length) {
                            $courseReportsBtn.addClass('active');
                            $('#course_ajax_pop > .tab-content > .tab-pane').removeClass('show active');
                            $('#reports').addClass('show active');

                            if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                                try {
                                    var bsTab = bootstrap.Tab.getOrCreateInstance ? bootstrap.Tab.getOrCreateInstance($courseReportsBtn[0]) : new bootstrap.Tab($courseReportsBtn[0]);
                                    bsTab.show();
                                } catch(e) {}
                            }

                            // Ensure inner Completed Users tab is also active
                            var $completedUsersBtn = $('#reports #completed-users-tab, #reports button[data-bs-target="#completedUsers"]');
                            if ($completedUsersBtn.length) {
                                $('#reports nav #nav-tab button').removeClass('active');
                                $completedUsersBtn.addClass('active');
                                $('#reports .tab-content .tab-pane').removeClass('show active');
                                $('#completedUsers').addClass('show active');

                                if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                                    try {
                                        var innerBsTab = bootstrap.Tab.getOrCreateInstance ? bootstrap.Tab.getOrCreateInstance($completedUsersBtn[0]) : new bootstrap.Tab($completedUsersBtn[0]);
                                        innerBsTab.show();
                                    } catch(e) {}
                                }
                            }
                        }
                    } else if (activeSubTab) {
                        var targetSelector = activeSubTab.startsWith('#') ? activeSubTab : ('#' + activeSubTab.replace('-tab', ''));
                        var $courseSubtabBtn = $('#course_ajax_pop > nav #nav-tab > button[data-bs-target="' + targetSelector + '"]');
                        if ($courseSubtabBtn.length) {
                            $('#course_ajax_pop > nav #nav-tab > button').removeClass('active');
                            $courseSubtabBtn.addClass('active');
                            $('#course_ajax_pop > .tab-content > .tab-pane').removeClass('show active');
                            $(targetSelector).addClass('show active');

                            if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                                try {
                                    var bsTab = bootstrap.Tab.getOrCreateInstance ? bootstrap.Tab.getOrCreateInstance($courseSubtabBtn[0]) : new bootstrap.Tab($courseSubtabBtn[0]);
                                    bsTab.show();
                                } catch(e) {}
                            }
                        }
                    }
                },
                error: function() {
                    $('#loader').hide();
                }
            });
        }

        // Draggable handle on course list right border to expand/collapse course list
        (function() {
            var $divider = $('#course_catalog_drag_handle');
            var $left = $('#course_catalog_left_panel');
            var $right = $('#course_catalog_right_panel');
            var $container = $('#course_catalog_split_container');
            var isDragging = false;
            var startX = 0;
            var startWidth = 0;
            var containerWidth = 0;

            function applySplit(newWidthPx) {
                if (!$container.length) return;
                containerWidth = $container.width();
                if (!containerWidth || containerWidth <= 0) return;

                var minLeftPx = 300;
                var maxLeftPx = Math.min(containerWidth - 300, containerWidth * 0.80);
                if (maxLeftPx < minLeftPx) {
                    maxLeftPx = minLeftPx;
                }

                var clampedWidth = Math.max(minLeftPx, Math.min(newWidthPx, maxLeftPx));
                var pct = (clampedWidth / containerWidth) * 100;
                var rightPct = 100 - pct;

                $left.css({
                    'width': pct + '%',
                    'max-width': pct + '%'
                });
                $right.css({
                    'margin-left': pct + '%',
                    'width': rightPct + '%',
                    'max-width': rightPct + '%',
                    'flex': '0 0 ' + rightPct + '%'
                });

                try {
                    localStorage.setItem('course_catalog_split_pct', pct.toFixed(2));
                } catch (e) {}
            }

            // Restore saved width from localStorage if available
            try {
                var savedPct = localStorage.getItem('course_catalog_split_pct');
                if (savedPct) {
                    var parsed = parseFloat(savedPct);
                    if (!isNaN(parsed) && parsed >= 20 && parsed <= 80) {
                        setTimeout(function() {
                            var cW = $container.width();
                            if (cW > 0) {
                                applySplit((parsed / 100) * cW);
                            }
                        }, 50);
                    }
                }
            } catch (e) {}

            $divider.on('mousedown touchstart', function(e) {
                if ($(window).width() < 992) return;
                if ($left.hasClass('closed')) return;

                isDragging = true;
                startX = (e.type === 'touchstart') ? e.originalEvent.touches[0].clientX : e.clientX;
                startWidth = $left.outerWidth();
                containerWidth = $container.width();

                $('body').addClass('course-split-resizing');
                $divider.addClass('active');
                e.preventDefault();
                e.stopPropagation();
            });

            $(document).on('mousemove touchmove', function(e) {
                if (!isDragging) return;

                var currentX = (e.type === 'touchmove') ? e.originalEvent.touches[0].clientX : e.clientX;
                var deltaX = currentX - startX;
                var newWidth = startWidth + deltaX;

                applySplit(newWidth);
            });

            $(document).on('mouseup touchend', function() {
                if (!isDragging) return;
                isDragging = false;
                $('body').removeClass('course-split-resizing');
                $divider.removeClass('active');
                window.dispatchEvent(new Event('resize'));
            });

            $(window).on('resize', function() {
                if ($(window).width() >= 992 && !$left.hasClass('closed')) {
                    containerWidth = $container.width();
                    var currentLeftW = $left.outerWidth();
                    if (currentLeftW > 0) {
                        applySplit(currentLeftW);
                    }
                }
            });
        })();

        // Live search autocomplete for courses
        var courseSearchTimer = null;
        var activeCourseSearchIndex = -1;
        var activeCourseSearchXhr = null;
        var isSelectingCourseItem = false;

        function clearAndHideCourseSearchDropdown() {
            clearTimeout(courseSearchTimer);
            if (activeCourseSearchXhr) {
                activeCourseSearchXhr.abort();
                activeCourseSearchXhr = null;
            }
            activeCourseSearchIndex = -1;
            $('#course_search_dropdown').empty().hide();
        }

        function performCourseSearch(term) {
            if (isSelectingCourseItem) {
                clearAndHideCourseSearchDropdown();
                return;
            }

            term = (term || '').trim();
            var currentVal = ($('#course_search_input').val() || '').trim();
            if (term.length === 0 || currentVal.length === 0) {
                clearAndHideCourseSearchDropdown();
                return;
            }

            if (activeCourseSearchXhr) {
                activeCourseSearchXhr.abort();
                activeCourseSearchXhr = null;
            }

            var status = $('#statusFilter').val() || $('select[name="status"]').val() || '';
            var categoryIds = $('#category_id').val() || [];

            activeCourseSearchXhr = $.ajax({
                url: "{{ url('search_courses_ajax') }}",
                type: "GET",
                data: {
                    term: term,
                    status: status,
                    category_id: categoryIds
                },
                dataType: "json",
                success: function(courses) {
                    if (isSelectingCourseItem) {
                        clearAndHideCourseSearchDropdown();
                        return;
                    }

                    var currentInputVal = ($('#course_search_input').val() || '').trim();
                    if (!currentInputVal || currentInputVal.length === 0) {
                        clearAndHideCourseSearchDropdown();
                        return;
                    }

                    var $dropdown = $('#course_search_dropdown');
                    $dropdown.empty();
                    activeCourseSearchIndex = -1;

                    if (!courses || courses.length === 0) {
                        $dropdown.html('<div class="px-3 py-2 text-muted text-center" style="font-size: 12px;">No matching courses found</div>').show();
                        return;
                    }

                    var html = '';
                    $.each(courses, function(i, course) {
                        var badgeText = course.badge ? course.badge : 'Course';
                        var courseNameEscaped = $('<div>').text(course.name).html();
                        var badgeEscaped = $('<div>').text(badgeText).html();
                        var subText = course.course_type + (course.enrolled_count !== undefined ? ' • ' + course.enrolled_count + ' enrolled' : '');
                        var subTextEscaped = $('<div>').text(subText).html();

                        html += '<div class="course-search-item d-flex align-items-center justify-content-between px-3 py-2" data-id="' + course.id + '" data-name="' + course.name.replace(/"/g, '&quot;') + '" data-dep="' + (course.department_id || '') + '">';
                        html += '  <div class="d-flex align-items-center text-truncate pe-2">';
                        html += '    <img src="' + course.image + '" style="width: 38px; height: 28px; object-fit: cover; border-radius: 4px; margin-right: 10px; flex-shrink: 0;" alt="">';
                        html += '    <div class="text-truncate">';
                        html += '      <div class="fw-bold text-dark text-truncate" style="font-size: 13px;">' + courseNameEscaped + (course.active == 2 ? ' <span class="badge bg-secondary ms-1" style="font-size:9px;">Draft</span>' : '') + '</div>';
                        html += '      <div class="text-muted text-truncate" style="font-size: 11px;">' + subTextEscaped + '</div>';
                        html += '    </div>';
                        html += '  </div>';
                        html += '  <div class="ps-2 text-end text-nowrap">';
                        html += '    <span class="course-badge-dept" title="' + badgeEscaped + '">' + badgeEscaped + '</span>';
                        html += '  </div>';
                        html += '</div>';
                    });

                    if (($('#course_search_input').val() || '').trim().length > 0) {
                        $dropdown.html(html).show();
                    } else {
                        clearAndHideCourseSearchDropdown();
                    }
                },
                error: function(err) {
                    if (err.statusText !== 'abort') {
                        console.error('Course search error:', err);
                    }
                },
                complete: function() {
                    activeCourseSearchXhr = null;
                }
            });
        }

        $('#course_search_input').on('input keyup change search cut paste', function() {
            if (isSelectingCourseItem) {
                return;
            }
            var term = ($(this).val() || '').trim();
            if (term.length === 0) {
                clearAndHideCourseSearchDropdown();
                return;
            }
            clearTimeout(courseSearchTimer);
            courseSearchTimer = setTimeout(function() {
                performCourseSearch(term);
            }, 250);
        });

        $('#course_search_input').on('focus', function() {
            if (isSelectingCourseItem) {
                return;
            }
            var term = ($(this).val() || '').trim();
            if (term.length === 0) {
                clearAndHideCourseSearchDropdown();
            } else if ($('#course_search_dropdown').children().length > 0) {
                $('#course_search_dropdown').show();
            }
        });

        // Keyboard navigation (arrows + Enter + Escape)
        $('#course_search_input').on('keydown', function(e) {
            var $dropdown = $('#course_search_dropdown');
            var $items = $dropdown.find('.course-search-item');

            if (!$dropdown.is(':visible') || $items.length === 0) {
                return;
            }

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeCourseSearchIndex = (activeCourseSearchIndex + 1) % $items.length;
                $items.removeClass('active-item');
                $items.eq(activeCourseSearchIndex).addClass('active-item');
                $items.eq(activeCourseSearchIndex)[0].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeCourseSearchIndex = (activeCourseSearchIndex - 1 + $items.length) % $items.length;
                $items.removeClass('active-item');
                $items.eq(activeCourseSearchIndex).addClass('active-item');
                $items.eq(activeCourseSearchIndex)[0].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter') {
                if (activeCourseSearchIndex >= 0 && activeCourseSearchIndex < $items.length) {
                    e.preventDefault();
                    $items.eq(activeCourseSearchIndex).trigger('click');
                }
            } else if (e.key === 'Escape') {
                clearAndHideCourseSearchDropdown();
            }
        });

        // Prevent mousedown on dropdown items from stealing focus or triggering input events
        $(document).on('mousedown', '.course-search-item', function(e) {
            e.preventDefault();
        });

        // Click on a course search item
        $(document).on('click', '.course-search-item', function(e) {
            e.preventDefault();
            e.stopPropagation();

            isSelectingCourseItem = true;
            clearTimeout(courseSearchTimer);
            if (activeCourseSearchXhr) {
                activeCourseSearchXhr.abort();
                activeCourseSearchXhr = null;
            }

            var courseId = $(this).data('id');
            var courseName = $(this).data('name');

            $('#course_search_dropdown').empty().hide();
            $('#course_search_input').val(courseName).blur();

            setTimeout(function() {
                isSelectingCourseItem = false;
            }, 300);

            var $targetRow = $('.user_check[data-id="' + courseId + '"]').first();
            if ($targetRow.length) {
                if ($targetRow[0].scrollIntoView) {
                    $targetRow[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                $targetRow.trigger('click');
            } else {
                var form = $('#course_search_form');
                $('<input>').attr({
                    type: 'hidden',
                    name: 'course_id',
                    value: courseId
                }).appendTo(form);
                form.submit();
            }
        });

        // Click outside closes dropdown
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#course_search_form').length) {
                clearAndHideCourseSearchDropdown();
            }
        });
    });
</script>
