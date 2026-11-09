<style type="text/css">
    .hidden {
        display: none;
    }
    .form-check-input {
        position: relative;
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 10px;
    }
    .green-background {
        background-color: #c6e4ff !important;
    }
    .cat-checkbox {
        position: relative;
        left: 3%;
        top: 3px;
    }
    .child-cat-checkbox {
        position: relative;
        left: 3%;
        top: 2px;
    }
    .cat-text {
        line-height: 15px !important;
    }
    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        height: 250px;
    }
    #progressBar {
        width: 100%;
        background-color: #f3f3f3;
        border: 1px solid #ccc;
        margin-top: 10px;
        display: none;
    }
    #progressBar div {
        height: 20px;
        width: 0;
        background-color: #4caf50;
        text-align: center;
        line-height: 20px;
        color: white;
    }
    #progressBar.red div {
        background-color: #f44336;
    }
    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }
    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }
    .filters-indicator {
        display: none;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        position: relative;
        top: -8px;
        right: -5px;
    }
    .filter-dropdown-hite {
        height: 61vh;
        overflow-y: auto;
        left: 2%;
        overflow-x: hidden;
    }
    .select-users-filter{
         top: 13.5%;
         left: 0.5%;
         height: 45vh !important;
    }
    .course-name, .exam-name{
        height: 18px;
    }

   /* .page-body, .content-bg {
    background: #373c5a;
}
.card {
    background-color: #373c5a;
    background-clip: border-box;
    border: 1px solid #e7eaed;
    border-radius: 10px;
    color: #4d4f5c !important;
}
.courses_listt {
    border-top: 6px solid #edf3ff !important;
    padding: 0.5rem;
    background: linear-gradient(178deg, rgb(72 79 116) 0%, rgb(59 64 95) 35%);
    border-radius: 10px;
    border: 3px solid #c8ab97 !important;
    margin-top: 10px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}
.bottom-butun-in-card {
    position: relative;
    top: 7px;
}
.course-name, .exam-name, .text-muted, .preview-list .preview-item .preview-item-content p .content-category, .email-wrapper .mail-sidebar .menu-bar .profile-list-item a .user .u-designation, .email-wrapper .mail-list-container .mail-list .content .message_text, .email-wrapper .mail-list-container .mail-list .details .date, .my-course-categori-name span:last-child{
    color: #d0d0d0;
}*/
</style>

<div class="tab-pane fade show" id="db" role="tabpanel" aria-labelledby="db-tab">
    <div class="row">
        @if(session('error'))
        <script type="text/javascript">
                $.toast({
                        heading: 'warning',
                        text: '{{ session("error") }}',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
        </script>
        @endif
        @if(session('success'))
        <script type="text/javascript">
                $.toast({
                        heading: 'Success',
                        text: '{{ session("success") }}',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
        </script>
        @endif


<div class="col-12">
    <div class="tab-content content-bg rounded-3 border-0 pt-0 pb-2 p-0 mb-2" id="v-pills-tabContent">
        <div class="tab-pane fade {{ request()->query('tab') == 1  ? ' show active' : '' }}" id="add-course" role="tabpanel" aria-labelledby="v-pills-add-course">
            <div class="col-12 col-lg-6 pl-2 pl-lg-1">
                <div class="py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Courses </label>
                        </div>

                        <div>
                            <a href="{{url('coursecatalog')}}?tab=2" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Courses</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <nav class="border-bottom mb-2">
                <div class="nav nav-tabs align-items-center font-smallsize border-0 bg-white mx-2 rounded-3"
                    id="nav-tab"
                    role="tablist">

                    @if(hasPermission(3))

                        <button class="nav-link @if(Request::get('menu')=='') active @endif"
                                id="addCourse-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#addCourse"
                                type="button"
                                role="tab"
                                aria-controls="addCourse"
                                aria-selected="true">

                            @if(Request::get('edit') > 0)
                                <i class="fa-solid fa-pen-to-square menuu-icon"></i>
                                <span class="menuu-text">Edit</span>
                            @else
                                <i class="fa-solid fa-info menuu-icon"></i>
                                <span class="menuu-text">Course</span>
                            @endif

                            <span class="menuu-text">Details</span>

                        </button>

                    @endif


                    @if($request->id && isset($courses_id) && $courses_id->active==1)

                        @if(hasPermission(3))

                            <button class="nav-link @if(Request::get('menu')=='1') active @endif"
                                    id="content-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#add_content"
                                    type="button"
                                    role="tab"
                                    aria-controls="add_content"
                                    aria-selected="false">

                                <i class="fa-solid fa-plus menuu-icon"></i>
                                <span class="menuu-text">Add Content</span>

                            </button>

                        @endif


                        <button class="nav-link @if(Request::get('menu')=='2') active @endif"
                                id="assign-users-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#assign-users"
                                type="button"
                                role="tab"
                                aria-controls="assign-users"
                                aria-selected="false">

                            <i class="fa-solid fa-user menuu-icon"></i>
                            <span class="menuu-text">Assign Users</span>

                        </button>

                    @else

                        <button class="nav-link disabled"
                                id="addcont-tab"
                                type="button"
                                role="tab"
                                aria-controls="addcont"
                                aria-selected="false">

                            <i class="fa-solid fa-plus menuu-icon"></i>
                            <span class="menuu-text">Add Content</span>

                        </button>

                        <button class="nav-link disabled"
                                id="assign-users-tab"
                                type="button"
                                role="tab"
                                aria-controls="assign-users"
                                aria-selected="false">

                            <i class="fa-solid fa-user menuu-icon"></i>
                            <span class="menuu-text">Assign Users</span>

                        </button>

                    @endif


                    {{-- COURSE SETTINGS --}}

                    @if(isset($courses_id))
                        <button class="nav-link @if(Request::get('menu') == '3') active @endif"
                                id="course-settings-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#course-settings"
                                type="button"
                                role="tab"
                                aria-controls="course-settings"
                                aria-selected="{{ Request::get('menu') == '3' ? 'true' : 'false' }}">

                            <i class="fa-solid fa-sliders menuu-icon"></i>
                            <span class="menuu-text">Course Settings</span>

                        </button>
                    @endif

                </div>

            </nav>

                <div class="tab-content border-0 p-0 px-2" id="navtabContent">
                    <div class="tab-pane border-0 px-2 fade @if(Request::get('menu')=='') show active @endif" id="addCourse" role="tabpanel" aria-labelledby="addCourse-tab">
                        <div class="card shadow-none border-radius-none border-0 border-bottom-0 p-0">
                            <div class="">
                                <div class="row justify-content-between">
                                    <form action="{{url('add_coursecatalog')}}" class="px-0 bg-transparent rounded-3" method="post" enctype="multipart/form-data" id="add_course">
                                        <div class="col-12 rounded-3">
                                            @csrf

                                            <!-- <input type="hidden" name="id" value="{{ $courses_id->id ?? '' }}" /> -->
                                              <input type="hidden" name="id" value="{{ Request::get('clone_course') ? '' : ($courses_id->id ?? '') }}" />

                                            <input type="hidden" name="save_as_draft" id="save_as_draft" value="0">

                                            <div class="row">
                                                <div class="col-12 col-lg-6 pl-2 pl-lg-1">
                                                    <div class="bg-white pt-0 px-2 pb-2 rounded-3">
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <label>Course Name</label>
                                                                <input type="text" class="form-control" id="course_name"  name="course_name" value="{{$courses_id->course_name??''}}" placeholder="e.g. Introduction to Accounting" maxlength="100" required>
                                                            </div>
     
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <label>Course Code</label>
                                                                <div class="input-group mb-0">
                                                                    <input type="text" name="course_code" id="course_code" class="form-control" placeholder="e.g. CS10" aria-label="Recipient's username" value="{{$courses_id->course_code??''}}" aria-describedby="basic-addon2" maxlength="50" required >
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text" id="basic-addon2">20</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-10 my-2" style="display:none;">
                                                                <label for="start_date" >Start Date</label>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <input type="date"   value="{{ isset($courses_id) && $courses_id->start_date !='1970-01-01 00:00:00' ? date('Y-m-d', strtotime($courses_id->start_date)) : '' }}"  class="form-control" id="start_date" name="start_date" placeholder="Date">
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <label for="expiration_date">Due Date</label>
                                                                {{-- <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <input type="date" class="form-control" value="{{ isset($courses_id) && $courses_id->expiration_date !='1970-01-01 00:00:00' ? date('Y-m-d', strtotime($courses_id->expiration_date)) : '' }}"  id="expiration_date" name="expiration_date" placeholder="Date" required>
                                                                    </div>
                                                                   
                                                                </div> --}}
                                                                <div class="row">
        <div class="col-sm-12">
            <input type="date" class="form-control" value="{{ isset($courses_id) && $courses_id->expiration_date !='1970-01-01 00:00:00' ? date('Y-m-d', strtotime($courses_id->expiration_date)) : '' }}" id="expiration_date" name="expiration_date" placeholder="Date" required>
        </div>
    </div>
                                                            </div>
                                                             <div class="form-group col-12 col-lg-10 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    <label>Capacity </label>
                                                                    <a href="#" flow="right" tooltip="Please enter Capacity value"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                                                </div>
                                                                 <input type="text" class="form-control" value="{{ $courses_id->capacity ??'' }}"  id="capacity" name="capacity" placeholder="Unlimited">
                                                            </div>
                                                            
                                                             <div class="form-group col-12 col-lg-10 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    <label>Points</label>
                                                                    <a href="#" flow="right" tooltip="Please enter Points"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                                                </div>
                                                                <input type="number" class="form-control" min="0" step="1" value="{{ $courses_id->points ??'' }}"  id="points" name="points" placeholder="points">
                                                            </div>
                                                           <div class="form-group col-12 col-lg-10 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    <label for="level">Level</label>
                                                                    <a href="#" flow="right" tooltip="Please select Level"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                                                </div>
                                                                <select class="js-example-basic-single form-select-control" name="level" id="level">
                                                                    <option value="">Select Level</option>
                                                                    @foreach($levels as $level)
                                                                        <option value="{{ $level->name }}" @if(isset($courses_id) && $courses_id->level == $level->name) selected @endif>{{ $level->name??'' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                           
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    <label>Goal</label>
                                                                    <a href="#" flow="right" tooltip="Please select Goal"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                                                </div>
                                                                <select class="js-example-basic-single form-select-control" name="goal" id="goal">
                                                                    <option value="">Select Goal</option>
                                                                    @foreach($goals as $goal)
                                                                        <option value="{{ $goal->id }}" @if(isset($courses_id) && $courses_id->goal == $goal->id) selected @endif>{{ $goal->name??'' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    <label>Certificate</label>
                                                                    <a href="#" flow="right" tooltip="Please select Certificate"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                                                </div>
                                                                <select class="js-example-basic-single form-select-control" name="certificate" id="certifiacte">
                                                                    <option value="">Select Certificate</option>
                                                                    @foreach($certificates as $cert)
                                                                        <option value="{{ $cert->id }}"
                                                                            data-category-id="{{ $cert->category_id }}"
                                                                            data-parent-id="{{ $cert->parent_id }}"
                                                                            @if(isset($courses_id) && $courses_id->certificate == $cert->id) selected @endif>{{ $cert->certificate_name??'' }}
                                                                        </option>
                                                                    @endforeach
                                                                   
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-10 my-3">
                                                                <label>Course Image</label>
                                                                <div class="input-group mb-0">
                                                                    <input type="file" name="course_image" id="course_image" class="form-control py-2 pl-3" placeholder="e.g. CS10" accept=".jpg,.jpeg,.png" aria-label="Course Image" value=""  @if(!isset($courses_id)) required @endif style="line-height: 22px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-10 my-2">
                                                                <label>Status</label>
                                                                <select class="js-example-basic-single form-select-control" name="active" id="active">
                                                                    
                                                                    <option value="1" @if((isset($courses_id) && $courses_id->active == 1) || old('active', 1) == 1) selected @endif>Active</option>
                                                                    <option value="0" @if(isset($courses_id) && $courses_id->active == 0) selected @endif>In-Active</option>
                                                                </select>
                                                            </div>

   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 pr-2 pr-lg-1">
                                                    <div class="bg-white pt-0 px-2 pb-2 rounded-3">
                                                        <div class="row">
                                                        <div class="form-group col-12 col-lg-10 my-3">
                                                            <label>Description</label>
                                                            <textarea id="editor1" name="description">{{$courses_id->description??''}}</textarea>
                                                        </div>
                                                        <div class="col-12 col-lg-10">
                                                            <div class="form-group pt-3">
                                                                <label for="parent_category" class="">Select Category</label>
                                                                <div class="col-12 border px-0" style="height: 64.7vh; overflow-y:auto;">
                                                                    <ul class="list-unstyled pl-3 mt-2">
                                                                         @foreach($category_list as $category)
                    @if($category->parent_id === null)
                        <li>
                            <i class="fas fa-folder"></i>
                            <input class="cat-radio-btn" type="radio" name="category_id" id="parent_id_{{ $category->id }}" value="{{ $category->id }}"
                                @if((isset($courses_id) && $courses_id->category_id == $category->id) || request()->input('add_category_id') == $category->id || request()->input('category_id') == $category->id || request()->input('parent_id') == $category->id) checked @endif
                                @if(request()->input('add_category_id') && request()->input('add_category_id') != $category->id) disabled @endif>
                            <label class="cat-tree-label" for="parent_id_{{ $category->id }}">{{ $category->category_name }}</label>
                            @include('partials.coursesubcategories', ['coursesubcategories' => $category_list, 'parent_id' => $category->id, 'selected_parent_id' => $courses_id->parent_id ?? ''])
                        </li>
                    @endif
                @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                 <div class="col-12 my-3">
                                                    <div class="text-center">
                                                        @if(isset($courses_id))
                                                        @if($courses_id->active != 1)
                                                        <button type="button" class="btn sbmt-btn mr-2 save_as_draft">Save as draft </button>
                                                         @endif
                                                        @else
                                                        <button type="button" class="btn sbmt-btn mr-2 save_as_draft">Save as draft </button>
                                                        @endif
                                                        <button type="submit" class="btn sbmt-btn mr-2 form_submit">Submit & Add Content</button>
                                                        <a href="{{url('coursecatalog')}}" class="btn cancel-btn">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                                               
                    <div class="tab-pane border-0 border-bottom-0 fade @if(Request::get('menu')=='1') show active @endif" id="add_content" role="tabpanel" aria-labelledby="addc-tab">

                        @if(isset($courses_id))

                        <form  class="rounded-3 bg-transparent" method="post" enctype="multipart/form-data" id="add_content_type_form">
                            @csrf

                            <input type="hidden" name="id" value="{{ $courses_id->id ?? '' }}" />
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <!-- <div class="my-2">
                                        <label class="mb-0 pt-2 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Content </label>
                                    </div> -->
                                    <div class="bg-white p-2 rounded-3">
                                        <div class="form-row" style="display:none;">
                                            <div class="form-group col-12 col-lg-10 my-3">
                                                <div><label>Intro Video</label></div>
                                                <div class="form-control border-0 pt-1 pl-0">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" id="video_links" class="btn btn-primary btn-sm video-link active shadow-none">Use YouTube</button>
                                                        <button type="button" id="video_upload" class="btn btn-primary btn-sm video-link shadow-none ml-2">Use a video</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="all_files">
                                                <div class="row files_list">
                                                    <div class="col-lg-10 bg-white">
                                                        <div class="form-row">
                                                            <div class="form-group col-12 col-lg-12 my-2">
                                                                <label>Select Content type</label>
                                                                <select name="content_type" class="js-example-basic-single form-select-control content_type" @if(!isset($courses_id)) required @endif>
                                                                    <option value="">Select Content type</option>
                                                                    <option value="1" >Amazon View URL</option>
                                                                    <option value="2" >Youtube URL</option>
                                                                    <option value="3" >Local Upload</option>
                                                                    <option value="4" >Scorm Upload</option>
                                                                    <option value="5" >Attachments</option>
                                                                    <option value="6" >Assessment</option>
                                                                    <option value="7" >Assignmemt exam</option>
                                                                   
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12 my-2">
                                                                <label>Upload</label>
                                                                <div class="p-4 text-center dashed-border input-group file_paths" id="file_paths">
                                                                     

                                                                </div>
                                                               
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="input-group my-2" id="video_upload_input" style="display:none;">
                                                    <input type="file" class="form-control form-control py-2 pl-3" name="intro_video_file" id="intro_video_file" accept="video/*" style="line-height: 22px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white p-2 rounded-3">
                                        <div class="all_files">
                                            <div class="row files_list">
                                                <div class="col-lg-10">
                                                    <div class="form-row">
                                                        <div class="form-group col-12 col-lg-12 my-2">

                                                    <label>Select Content type</label>
                                                    <select name="content_type" class="js-example-basic-single form-select-control content_type" @if(!isset($courses_id)) required @endif>
                                                        <option value="">Select Content type</option>
                                                        <option value="1" >Amazon View URL</option>
                                                        <option value="2" >Youtube URL</option>
                                                        <option value="3" >Local Upload</option>
                                                        <option value="4" >Scorm Upload</option>
                                                        <option value="5" >Attachments</option>
                                                        <option value="6" >Assessment</option>
                                                        <option value="7" >Assignment exam</option>
                                                       
                                                    </select>
                                                                         

                                                        </div>
                                                        <div class="form-group col-12 col-lg-12 my-2">
                                                            <label>Upload</label>
                                                            <div class="p-4 text-center dashed-border input-group file_paths" id="file_paths">
                                                                 

                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-row">
                                                <div class="form-group col-12 col-lg-12 my-2">
                                                    <p id="upload_file_name"></p>
                                                    <div id="progressBar"><div></div> </div><span  style="display:none;"><a href="javascript:;" id="cancel_upload_file"><i class="fa fa-close" style="font-size:24px"></i></a></span>
                                                    <div id="file_upload_status"></div>
                                                   
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
    <div class="my-2 add_content_header_list" @if($courses_id->documents_details->where('is_delete','==','0')->isEmpty()) style="display:none;" @endif>
        <label class="mb-0 pt-3 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-file-import headings-icon"></i>Uploaded Files </label>
    </div>
    <div class="bg-white rounded-3 p-2 add_content_list" @if($courses_id->documents_details->where('is_delete','==','0')->isEmpty()) style="display:none;" @endif>
        <div class="row">
            <div class="col-12 col-lg-12 mb-3">
                <div class="height-100vh">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Link / File</th>
                                    <!-- <th>Action</th> -->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="upload_files_list">
                                @if(isset($courses_id->documents_details))
                                    @foreach($courses_id->documents_details->filter(function($doc) {
                                        return $doc->is_delete == 0;
                                    }) as $doc)
                                        <tr data-id="{{ $doc->id }}">
                                            <td>
                                                @if($doc->type == 1) Amazon Link
                                                @elseif($doc->type == 2) Youtube Link
                                                @elseif($doc->type == 3) Local Video
                                                @elseif($doc->type == 4) Scorm Video
                                                @elseif($doc->type == 5) Attachments
                                                @elseif($doc->type == 6) Assessment
                                                @elseif($doc->type == 7) Assignment
                                                @endif
                                            </td>
                                            <td>
                                                @if($doc->type == 3 || $doc->type == 4 || $doc->type == 5) 
                                                    {{ basename($doc->file_path) }}
                                                @else 
                                                    {{ $doc->file_path }}
                                                @endif
                                            </td>
                                           <!--  <td>
                                                <a href="{{ url('delete_document') }}?id={{ $doc->id }}" class="btn btn-danger buttonn-danger content_delete">Delete</a>
                                            </td> -->
<td>
                                                                                                                
   <div class="custom-control custom-switch">
     <input type="checkbox" class="custom-control-input toggle-classdocument document-toggle"
           id="toggle-document-{{ $doc->id }}"
           data-document_id="{{ $doc->id }}"
           @if($doc->is_active) checked @endif>
    <label class="custom-control-label" for="toggle-document-{{ $doc->id }}"></label>
   </div>
</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </form>
                        @endif
                    </div>

                    <div class="tab-pane fade @if(Request::get('menu')=='2') show active @endif" id="assign-users" role="tabpanel" aria-labelledby="assign-users-tab">
                        <div class="row">
                            <div class="col-12 rounded-3">
                                <div class="card card-border shadow-none rounded-3 border-0">
                                    <div class="card-body bg-transparent p-0 rounded-3">
                                        <!-- <div class="d-flex align-items-center my-2"><i class="fa-solid fa-circle-info headings-icon"></i><h4 class="mb-0">Course Type Details</h4>
                                        </div> -->
                                        <div class="my-2">
                                            <label class="mb-0 pt-2 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-circle-info headings-icon"></i>Course Type </label>
                                        </div>
                                        <div>
                                            <?php $value=1; ?>
                                            @if(isset($courses_id))  @if($courses_id->course_type==2)
                                            @if(empty($courses_id->training_details->toArray()))
                                            <?php $value=0; ?> @endif
                                            @endif @endif
                                            <input type="hidden" id="new_trainer_data"  value="{{$value}}" >
                                            <form class="forms-sample p-2 rounded-3" id="course_type_details">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{Request::get('id')}}">
                                                <div class="form-group row mb-2">
                                                    <div class="col-sm-3 my-2">
                                                        <label>Course Type</label>
                                                        <select name="course_type" class="course_type js-example-basic-single form-select-control">
                                                            <option value="1" @if(isset($courses_id)) @if($courses_id->course_type==1) Selected @endif @endif>Online</option>
                                                            <option value="2" @if(isset($courses_id)) @if($courses_id->course_type==2) Selected @endif @endif>Instructor-led training</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="offline_data" @if(isset($courses_id)) @if($courses_id->course_type==1) style="display:none;" @endif @endif>

                                                     <div class="my-2">
                                            <label class="mb-0 pt-3 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-circle-info headings-icon"></i>Select Trainers </label>
                                        </div>


                                                    <div class="form-group row">
                                                        <div class="col-sm-4 my-2">
                                                            <label>Trainer Name</label>
                                                            <select name="trainer_id" class="trainer_id js-example-basic-single form-select-control trainer_data">
                                                                <option value="">Select Trainer Name</option>
                                                                @foreach($trainers_data as $tdata)
                                                                    <option value="{{$tdata->id??''}}" @if(isset($courses_id)) @if($courses_id->course_type==1) Selected @endif @endif>{{$tdata->first_name??''}} {{$tdata->last_name??''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4 my-2">
                                                            <label>Training Date</label>
                                                            <input type="text" name="training_date" class="training_date trainer_data datepicker js-example-basic-single form-control"  required>
                                                        </div>
                                                        <div class="col-sm-4 my-2">
                                                            <label>Timing - From</label>
                                                            <input type="text" name="training_time_from" class="training_time_from trainer_data timepicker js-example-basic-single form-control" readonly required>
                                                        </div>
                                                        <div class="col-sm-4 my-2">
                                                            <label>Timing - To</label>
                                                            <input type="text" name="training_time_to" class="training_time_to trainer_data timepicker js-example-basic-single form-control"  readonly required>
                                                        </div>
                                                        <div class="col-sm-4 my-2">
                                                            <label>Duration</label>
                                                            <input type="text" name="training_duration" class="training_duration trainer_data  js-example-basic-single form-control" readonly required>
                                                        </div>
                                                        <div class="col-sm-4 my-2">
                                                            <label>Location</label>
                                                            <input type="text" name="training_location" class="training_location trainer_data  js-example-basic-single form-control"  required>
                                                        </div>
                                                       
                                                        <div class="col-sm-12 my-2">
                                                            <div class="text-end">
                                                                <button class="btn sbmt-btn btn-primary" type="submit">Add Trainer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="my-2 pt-2 selected_trainer_heading"        @if(isset($courses_id) && $courses_id->training_details->isEmpty()) style="display:none;"  @endif>
                                            <label class="mb-0 pt-3 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-user-check headings-icon"></i>Selected Trainers List</label>
                                        </div>
                                        <div class="col-12 p-2 rounded-3 bg-white trainer_data_table" @if(isset($courses_id)  && $courses_id->training_details->isEmpty()) style="display:none;" @endif >
                                             <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Trainer Name</th>
                                                            <th>Training Date</th>
                                                            <th>Timing - From</th>
                                                            <th>Timing - To</th>
                                                            <th>Duration</th>
                                                            <th>Location</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="trainer_details_list">
                                                        @if(isset($courses_id))
                                                        @foreach($courses_id->training_details as $train)
                                                        <tr>
                                                            <td>{{$train->userdetails->first_name??''}}</td>
                                                            <td>{{$train->training_date}}</td>
                                                            <td>{{$train->training_time_from}}</td>
                                                            <td>{{$train->training_time_to}}</td>
                                                            <td>{{$train->training_duration}}</td>
                                                            <td>{{$train->training_location}}</td>
                                                            <td>
                                                                <a href="javascript:;" data-id="{{$train->id}}" class="btn btn-danger buttonn delete_trainer">Delete</a>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 px-0">
                                            <div class="my-2 pt-2">
                                                <label class="mb-0 pt-3 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-list-check headings-icon"></i>Select Users </label>
                                            </div>
                                           <!--  <div class="align-items-center rounded-3 border-bottom">
                                                <ul class="nav nav-tabs mb-2 " id="myTab" role="tablist">
                                                  <li class="nav-item bg-white rounded-left" role="presentation">
                                                    <button class="nav-link active" id="assign-users-sub-tab" data-bs-toggle="pill" data-bs-target="#assign-users-sub" type="button" role="tab" aria-controls="assign-users-sub" aria-selected="true"><i class="fa-solid fa-user menuu-icon"></i><span class="menuu-text">Assign Users</span></button>
                                                  </li>
                                                </ul>
                                            </div> -->

                                            <div class="tab-content border-0  bg-white rounded-3" id="tabContent">
                                                <div class="tab-pane active" id="assign-users-sub" role="tabpanel" aria-labelledby="assign-users-sub-tab">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <form class="forms-sample p-2 rounded-3" id="departments_designation_form"  method="get" action="{{url('coursecatalog')}}">
                                                                <input type="hidden" name="tab" value="1">
                                                                <input type="hidden" name="id" value="{{Request::get('id')}}">
                                                                <input type="hidden" name="menu" value="2">
                                                                <button class="btn filterBtn filters-btnn dropdown-toggle" type="button">
                                                                    <i class="bi bi-filter"></i> Filters
                                                                    @if(!empty(Request::get('department')) || !empty(Request::get('designation')) || !empty(Request::get('add_course_user_search_data')) || !empty($category_department) && empty(request()->input('department_check')))
                                                                    <i class="fa-solid fa-circle filters-dot-icon"></i>
                                                                    @endif
                                                                </button>
                                                                <ul class="dropdown-menu filterMenu filters-dropdown-menuu pt-2 px-3 pb-3 w-96 filter-dropdown-hite mt-n1 select-users-filter" style="display: none;">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-3 my-2">
                                                                            <label class="form-check-label ms-0 mb-2">Designation</label>
                                                     

                                                            <select class="form-control multiple_select designation_filter" name="designation[]" id="designation" multiple>

                                                            @foreach($designations as $designation)
                                                                <option value="{{$designation->id}}" @if(in_array($designation->id, request()->input('designation', []))) selected @endif>
                                                                    {{$designation->designation_name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                       </div>
                                                       <input type="hidden" id="department_check" name="department_check" value="0">
                                                        <!-- <div class="col-sm-3 my-2">
                                                                <label class="form-check-label ms-0 mb-2">Department</label>
                                                                

                                                                     <select class="form-control multiple_select department_filter" name="department[]" id="department" multiple>

                                                                    @foreach($departments as $department)
                                                                        <option value="{{ $department->id }}" 
                                            @if(in_array($department->id, request()->input('department', [])) || ($department->id == $category_department && empty(request()->input('department_check')))) selected @endif
                                                                          >
                                                                            {{ $department->department_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div> -->
                                                            <div class="col-sm-3 my-2">
                                                                <label class="form-check-label ms-0 mb-2">Assigned status</label>
                                                                <select class="js-example-basic-single form-select-control users_filter" name="add_course_assigned_status">
                                                                    <option value="2" @if(!isset($request->add_course_assigned_status) || $request->add_course_assigned_status == "" || isset($request->add_course_assigned_status) && $request->add_course_assigned_status == "2") selected @endif>All</option>
                                                                    <option value="0" @if(isset($request->add_course_assigned_status) && $request->add_course_assigned_status == 0) selected @endif>Unassigned</option>
                                                                    <option value="1" @if(isset($request->add_course_assigned_status) && $request->add_course_assigned_status == 1) selected @endif>Assigned</option>
                                                                </select>
                                                            </div>
                                                                        <div class="col-sm-3 my-2 pt-4">
                                                                            <div class="">
                                                                               <button type="submit" class="btn submitBtn sbmt-btn me-2">Submit</button>
                                                                               @if(!empty(Request::get('department')) || !empty(Request::get('designation')) || !empty(Request::get('add_course_user_search_data')) ||  !empty($category_department) && empty(request()->input('department_check') ))
                                                                               <a href="{{url('coursecatalog')}}?tab=1&menu=2&id={{Request::get('id')}}" class="btn btn-sm btn-primary">Reset</a>
                                                                               @endif
                                                                           </div>
                                                                        </div>
                                                                    </div>
                                                                </ul> 
                                                            </form>
                                                            <!-- <div class="pt2 mt-1">
                                                               <button class="btn btn-sm btn-primary all_users_assign_btn" data-id="{{Request::get('id')}}">Assign to all User</button>
                                                            </div> -->
                                                        </div>
                                                        <div>
                                                            <form class="forms-sample p-2"  method="get" action="{{url('coursecatalog')}}">
                                                                <input type="hidden" name="tab" value="1">
                                                                <input type="hidden" name="id" value="{{Request::get('id')}}">
                                                                <input type="hidden" name="menu" value="2">
                                                                <input type="hidden" id="department_check" name="department_check" value="1">
                                                                <!-- <div class="d-flex">
                                                                    <input type="hidden" name="tab" value="2">
                                                                    <input type="text" class="form-control rounded-0" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" />
                                                                    <div class="input-group-append">
                                                                      <span class="input-group-text" style="height: 40px;">
                                                                        <button type="submit" class="bi bi-search border-0"></button>
                                                                       </span>
                                                                    </div>
                                                                </div> -->
                                                                <div class="d-flex">
                                                                    <input type="text" class="form-control rounded-0 add_course_user_search_data" name="add_course_user_search_data" value="{{Request::get('add_course_user_search_data')}}" placeholder="Search">
                                                                    <div class="input-group-append">
                                                                          <span class="input-group-text" style="height: 40px;">
                                                                            <button type="submit" class="bi bi-search border-0 add_course_user_search_data"></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                          
                                                    <div class="row mx-0">
                                                        <div class="col-12">
                                                            <div class="height-100vh mb-2">
                                                                <div class="table-responsive">
                                                                    <table class="table mb-2" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                              <th style="width: 400px;">User Details</th>
                                                                              <th>Designation</th>
                                                                              <th>Department</th>
                                                                              <th>User Type</th>
                                                                              <th class="">Assign To User</th>

                                                                          </tr>
                                                                      </thead>
                                                                        <tbody>

                                                                            <?php $i=1;?>
                                                                            @foreach($users_lists as $user)

                                                                            <tr>
                                                                                <td style="width: 400px;">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1p5 pe-0">
                                                                                            <div class="profile-image-sm">
                                                                                                @if($user->profile_image)
                                                                                                    <img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="">
                                                                                                @else
                                                                                                   
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-lg-10p5 my-auto">
                                                                                            <div class="py-1 web-text-color text-truncate font-weight-bold">{{$user->first_name??''}} {{$user->last_name??''}}</div>
                                                                                            <div class="py-1 text-truncate">
                                                                                                {{$user->email??''}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                   
                                                                                </td>
                                                                                <!-- <td>{{$user->emp_id??''}}</td> -->
                                                                                <td>{{$user->designationdetails->designation_name??''}}</td>
                                                                                <td>{{$user->departmentdetails->department_name??''}}</td>
                                                                                <td> @if(!empty($user->role_names))
                    {{ implode(', ', $user->role_names) }}
                @else
                    No Roles
                @endif</td>
                                                                                <td>

                                                                                     <div class="custom-control custom-switch">
                                                                                        <input type="checkbox" class="custom-control-input toggle-classss"
                                                                                         id="toggle-{{ $user->id }}"
                                                                                         data-user_id="{{ $user->id }}"
                                                                                         data-course_id="{{ Request::get('id') }}"
                                                                                         data-onstyle="1"  
                                                                                         data-offstyle="0"  
                                                                                         @if(!empty($user->assigned_users)) checked @endif>
                                                                                         <label class="custom-control-label" for="toggle-{{ $user->id }}"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
     </table>

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

                    <div class="tab-pane border-0 border-bottom-0 fade" id="course-settings" role="tabpanel" aria-labelledby="course-settings-tab"></div>

                </div>
            </div>
        </div>
<div style="display:none;" class="content_type_url">
    <input type="text"  name="documents_link" class="form-control documents_link" placeholder="https://www.youtube.com/watch?v=xyz" required>
</div>
<div style="display:none;" class="content_type_local">
    <input type="file"  name="content_type_upload" class="form-control content_type_upload" accept="video/*" required>
</div>
<div style="display:none;" class="content_type_scorm"> 
    <input type="file"  name="content_type_upload" class="form-control content_type_upload"  accept=".zip,application/octet-stream" required>
</div>
<div style="display:none;" class="content_type_attachment" required>
    <input type="text" name="file_name" class="form-control document_file_name" placeholder="Enter File Name" >
    </br>
    <input type="file"  name="content_type_upload" class="form-control content_type_upload" accept="application/pdf" required>
</div>
<div style="display:none;" class="content_type_assessment" required>
    <input type="text" name="file_name" class="form-control document_file_name" placeholder="Enter Assessment Name" >
    <br>
    <input type="text"  name="documents_link" class="form-control documents_link" placeholder="Enter Assessment Link"  required>
</div>

<div style="display:none;" class="content_type_assignment_exam">
    <input type="text"  name="documents_link" class="form-control documents_link" placeholder="exam code" required>
</div>

<div class="files_append_html" style="display: none;">
    <div class="row files_list">
        <div class="col-lg-10">
            <div class="form-row">
                <div class="form-group col-12 col-lg-12 my-2">
                    <label>Select Content type</label>
                    <select name="content_type[]" class="js-example-basic-single form-select-control content_type" required>
                        <option value="">Select Content type</option>
                        <option value="1" >Amazon View URL</option>
                        <option value="2" >Youtube URL</option>
                        <option value="3" >Local Upload</option>
                        <option value="4" >Scorm Upload</option>
                        <option value="5" >Attachments</option>
                        <option value="7" >Assignment exam</option>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-12 my-2">
                    <label>Upload</label>
                    <div class="p-4 text-center dashed-border input-group file_paths" id="file_paths">

                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <link href="path/to/bootstrap-switch.min.css" rel="stylesheet">
<script src="path/to/bootstrap-switch.min.js"></script> -->



<script>
     $("#add_course").validate();

$(document).ready(function() {
    // Initialize timepicker
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        scrollbar: true,
        change: tmTotalHrsOnSite // Set function to call on change
    });

    // Initialize datepicker
    $(".datepicker").datepicker();

    // Function to calculate and display duration
    function tmTotalHrsOnSite() {
        // Check if both time fields have values
        if ($(".training_time_from").val() && $(".training_time_to").val()) {
            var startTime = moment($(".training_time_from").val(), "HH:mm");
            var endTime = moment($(".training_time_to").val(), "HH:mm");
            var duration = moment.duration(endTime.diff(startTime));                  
            $(".training_duration").val(duration.asMinutes().toFixed(2) + " mins");
        }
    }
});
$(document).ready(function() {
$('.course_type').change(function(){ 
course_data_form_changes();   
});


function course_data_form_changes() {
var status= false;
if($('.course_type').val()==1){
$('.offline_data').hide();
$('.trainer_data_table').hide();
status= true;
}else if($('.course_type').val()==2){
 $('.offline_data').show();
 $('.trainer_data_table').show();
 status= true;
 var data = $('body').find('#new_trainer_data').val(); //alert(data);
    if(data !="1"){
        status= false;
    }
}
    if(status){
        $('#course_type_details').submit();
    }
}
$('#course_type_details').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type: 'POST',
    url: "{{url('add_course_type_details')}}",
    data: formData,
    contentType: false,
    processData: false,
    dataType:'html',
    success: function (response) {
        $('body').find('#trainer_details_list').append(response);
        $('body').find('#new_trainer_data').val('1');
        $('.selected_trainer_heading').show();
       $('.trainer_data_table').show();
        $('.trainer_data').val('');
             $.toast({
            heading: 'Success',
            text: 'Course Details Updated Successfully.',
            position: 'bottom-right',
            stack: false,
            icon: 'success'
        });
    }
    });
});
// $('body').on('click','.delete_trainer',function(){
//     var id= $(this).data('id');
//     $(this).parents('tr').remove();
//     $.ajax({
//     type: 'Get',
//     url: "{{url('delete_trainer_details')}}",
//     data: {id:id},
//     success: function (response) {
       
//        $('body').find('#new_trainer_data').val(response.status);
//              $.toast({
//             heading: 'Success',
//             text: 'Trainer Deleted Successfully.',
//             position: 'bottom-right',
//             stack: false,
//             icon: 'success'
//         });
//     }
//     });
// });


$('body').on('click', '.delete_trainer', function() {
    var id = $(this).data('id');
    var $row = $(this).parents('tr'); 

    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: "{{ url('delete_trainer_details') }}",
                data: { id: id },
                success: function(response) {
                    $row.remove();
                    $('body').find('#new_trainer_data').val(response.status);
                    $.toast({
                        heading: 'Success',
                        text: 'Trainer Deleted Successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
                },
                error: function(xhr, status, error) {
                    $.toast({
                        heading: 'Error',
                        text: 'An error occurred while deleting the trainer.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'error'
                    });
                }
            });
        }
    });
});
var xhr ="";

$('body').on('change',"input[type='file']" , function () { 
$('#add_content_type_form').submit();
// if(this.files[0].size > 50000000) {
//   alert("Please upload file less than 50MB. Thanks!!");
//   $(this).val('');
// }else{
//    $('#add_content_type_form').submit();
// }
});


$('body').on('change',".documents_link" , function () {
    $('#add_content_type_form').submit(); 
});
$('#cancel_upload_file').click(function(){
xhr.abort();
});

$('#add_content_type_form').on('submit', function (e) {
$('#progressBar').show();
$('#progressBar').removeClass('red');
e.preventDefault();

var formData = new FormData(this);
var file = $('body').find('.content_type_upload')[0].files[0];
$('#upload_file_name').text($('body').find('.content_type_upload').val().replace(/C:\\fakepath\\/i, ''));
$('#cancel_upload_file').show();

if (file) {
$.ajax({
xhr: function () {
     xhr = new XMLHttpRequest();
    xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) {
            var percentComplete = Math.round((e.loaded / e.total) * 100);
            $('#progressBar div').width(percentComplete + '%');
            $('#progressBar div').html(percentComplete + '%');
        }
    }, false);
    return xhr;
},
type: 'POST',
url: "{{url('add_content_type')}}",
data: formData,
contentType: false,
processData: false,
success: function (response) {
    $('#file_upload_status').html(response.message);
    
    $('body').find('.content_type_upload').val('');
    $('body').find('.document_file_name').val('');
    $('#cancel_upload_file').hide();
    upload_file_html(response.files);
},
        error: function (xhr) {
            if (xhr.status === 413) {
                 $('body').find('.content_type_upload').val('');
                $('#progressBar').addClass('red');
                $('#progressBar div').width('100%').html('File too large!');
            }
            $('#file_upload_status').html('File too large!');
        }
});
}else{
$('#progressBar div').width('100%');
$.ajax({               
type: 'POST',
url: "{{url('add_content_type')}}",
data: formData,
 contentType: false,
processData: false,
success: function (response) {
    $('#file_upload_status').html(response.message);
    //$('#progressBar div').width('0%').html('0%');
    $('body').find('.documents_link').val('');
    $('body').find('.document_file_name').val('');
    $('#cancel_upload_file').hide();
    upload_file_html(response.files);
    $('.add_content_header_list').show();
    $('.add_content_list').show();


}
});

}
});
function upload_file_html(data) {
if (data.id) {
    // Determine the type based on the data type
    var type = "Local Video";
    if (data.type == 1) {
        type = "Amazon Link";
    } else if (data.type == 2) {
        type = "Youtube Link";
    } else if (data.type == 4) {
        type = "Scorm Video";
    } else if (data.type == 5) {
        type = "Attachments";
    } else if (data.type == 6) {
        type = "Assessment";
    } else if (data.type == 7) {
        type = "Assignment";
    }

    // URL and confirmation message for deletion
    var href = "{{ url('delete_document') }}?id=" + data.id;
    var onclick = "Are you sure?";

    // Determine the display file path
    var displayFilePath = data.file_path;
    if (data.type == 3 || data.type == 4 || data.type == 5) {
        var filePathParts = data.file_path.split('/');
        displayFilePath = filePathParts[filePathParts.length - 1]; // Get the file name
    }

    // Construct the HTML for the new row
    html = "<tr>" +
               "<td>" + type + "</td>" +
               "<td>" + displayFilePath + "</td>" +
               // "<td>" +
               //     "<a href='" + href + "' onclick='return confirm(\"" + onclick + "\")' class='btn btn-danger buttonn-danger'>Delete</a>" +
               // "</td>" +
               "<td>" +
                   "<div class='custom-control custom-switch'>" +
                       "<input type='checkbox' class='custom-control-input document-toggle' " +
                           "id='toggle-document-" + data.id + "' " +
                           "data-document_id='" + data.id + "' " +
                           "checked" + ">" + // Check if document is active
                       "<label class='custom-control-label' for='toggle-document-" + data.id + "'></label>" +
                   "</div>" +
               "</td>" +
           "</tr>";

    // Append the new row to the table
    $('#upload_files_list').append(html);
}

}
$('.save_as_draft').click(function(){
$('#add_course').find('input').each(function(){
$(this).removeAttr('required');
});
$('#add_course').find('select').each(function(){
$(this).removeAttr('required');
});
$('#add_course').find('#course_name').attr('required','required');
$('#add_course').find('#save_as_draft').val('1');
$('.form_submit').click();
});

$('.cont-type-upl').click(function(){
$('.all_files').append($('.files_append_html').html());
});

$("#video_links").click(function() {
$("#youtube_input").show(); 
$("#video_upload_input").hide();
$("#video_links").addClass("active btn btn-primary");
$("#video_upload").removeClass("active btn btn-primary"); 
});

$("#video_upload").click(function() {
$("#video_upload_input").show(); 
$("#youtube_input").hide(); 
$("#video_upload").addClass("active btn btn-primary");
$("#video_links").removeClass("active btn btn-primary");
});

var introVideoLink = "{{ $courses_id->intro_video_link ?? '' }}";

if (introVideoLink.startsWith('http')) {
$('#video_links').addClass('active');
$('#youtube_input').show();
$('#video_upload_input').hide();
} else {
$("#video_links").removeClass("active");
$('#video_upload').addClass('active');
$('#youtube_input').hide();
$('#video_upload_input').show();
}




$('body').on('change','.content_type', function() {
if ($(this).val() == "1" || $(this).val() == "2") {

$(this).parents('.files_list').find('.file_paths').html($('.content_type_url').html());

} else if ($(this).val() == "3" ) {
$(this).parents('.files_list').find('.file_paths').html($('.content_type_local').html());
} else if ($(this).val() == "4" ) {
$(this).parents('.files_list').find('.file_paths').html($('.content_type_scorm').html());
}else if ($(this).val() == "6" ) {
$(this).parents('.files_list').find('.file_paths').html($('.content_type_assessment').html());
}else if ($(this).val() == "7" ) {
$(this).parents('.files_list').find('.file_paths').html($('.content_type_assignment_exam').html());
} else {
$(this).parents('.files_list').find('.file_paths').html($('.content_type_attachment').html());
}
});

$('.toggle-classss').change(function() {
     // alert('hi');
status= true;
if($('.course_type').val()==2){
    if($('body').find('#new_trainer_data').val() !="1"){
        status= false;
    }
}
if(status){
var userid = $(this).data('user_id');
var courseid = $(this).data('course_id');
var isChecked = $(this).prop('checked');
var status = isChecked ? 1 : 0; // Simplified the status determination
 
$.ajax({
url: "{{url('fetch_signleCourse_userData')}}",
method: 'GET',
data: {
    userid: userid,
    status: status,
    courseid:courseid
},
success: function(response) {
    if(status == 1){
        $.toast({
        heading: 'Success',
        text: 'Added Course to user successfully',
        position: 'bottom-right',
        stack: false,
        icon: 'success'
    });
    
    }else{
         $.toast({
        heading: 'warning',
        text: 'Removed Course to user  successfully.',
        position: 'bottom-right',
        stack: false,
        icon: 'warning'
    });
    }
},
error: function(xhr, status, error) {
    // Handle error here if needed
}
});
}else{
    $(this).prop('checked',false);
$.toast({
        heading: 'warning',
        text: 'Please Add Trainer Data. Then Course Assign to User',
        position: 'bottom-right',
        stack: false,
        icon: 'warning'
    });
}
});

$('#category_id').change(function() {
var categoryId = $(this).val();
$.ajax({
url: '{{url("getSubcategories")}}', 
method: 'GET',
data: { categoryId: categoryId },
success: function(response) {
    $('#subcategory_id').empty(); 
    $('#subcategory_id').append($('<option>').text('Select or create a Sub Category').attr('value', ''));
    $.each(response.subcategories, function(index, subcategory) {
        $('#subcategory_id').append($('<option>').text(subcategory.subcategory_name).attr('value', subcategory.id));
    });
},
error: function(xhr, status, error) {
    console.error('Error:', error);
}
});
});

$('body').on('click','.all_users_assign_btn',function(){
    var courseid= $(this).data('id');
    $(this).parents('tr').remove();
    $.ajax({
    type: 'Get',
    url: "{{url('assign_course_to_all_users')}}",
    data: {courseid:courseid},
    success: function (response) {
       
            $.toast({
            heading: 'Success',
            text: 'Assigned Successfully.',
            position: 'bottom-right',
            stack: false,
            icon: 'success'
        });
    }
    });
});

function updateDepartmentCheck() {
        if ($('#department').find('option:selected').length > 0) {
            $('#department_check').val('0');
        } else {
            $('#department_check').val('1'); 
        }
    }

    updateDepartmentCheck();

    $('#department').on('change', function() {
        updateDepartmentCheck();
    });

});

$(document).on('change', '.document-toggle', function() {
    var checkbox = $(this);
    var documentId = checkbox.data('document_id');
    var isActive = checkbox.is(':checked'); // Check if the toggle is on or off
    var action = isActive ? 'Active' : 'Inactive'; // Determine action based on state
    var row = checkbox.closest('tr'); // Get the corresponding row

    // AJAX call to update the document status on the server
    $.ajax({
        url: "{{ url('toggle_document_status') }}", // Your URL here
        method: 'POST',
        data: {
            id: documentId,
            action: action,
            _token: '{{ csrf_token() }}' // CSRF token for security
        },
        success: function(response) {
            if (!response.success) {
                $.toast({
                    heading: 'Warning',
                    text: 'Status change failed.',
                    position: 'bottom-right',
                    stack: false,
                    icon: 'warning'
                });
                // Revert checkbox state in case of failure
                checkbox.prop('checked', !isActive);
            } else {
                // Show or hide the row based on new status
                if (isActive) {
                    row.removeClass('inactive').addClass('active'); // Update row class
                    row.show(); // Show the row
                } else {
                    row.removeClass('active').addClass('inactive'); // Update row class
                    // Only hide if the checkbox for showing inactive is unchecked
                    if (!$('#toggleInactive').is(':checked')) {
                        row.hide(); // Hide the row if inactive
                    }
                }

                $.toast({
                    heading: 'Success',
                    text: 'Status changed successfully.',
                    position: 'bottom-right',
                    stack: false,
                    icon: 'success'
                });
            }
        },
        error: function() {
            alert('An error occurred while processing the request.');
        }
    });
});




</script> 
<script>
document.addEventListener('DOMContentLoaded', function () {
    const certificateSelect = $('#certifiacte');
    const categoryParentIds = @json($category_list->pluck('parent_id', 'id'));

    function selectCertificateForCategory(clearWhenNotFound) {
        const selectedCategory = document.querySelector('input[name="category_id"]:checked');

        if (!selectedCategory || !certificateSelect.length) {
            return;
        }

        const selectedCategoryId = String(selectedCategory.value);
        const categoryHierarchy = [];
        let currentCategoryId = selectedCategoryId;

        // Include the checked category and walk through all of its parents.
        while (currentCategoryId && !categoryHierarchy.includes(currentCategoryId)) {
            categoryHierarchy.push(currentCategoryId);

            const parentId = categoryParentIds[currentCategoryId];
            currentCategoryId = parentId === null || parentId === undefined || parentId === ''
                ? ''
                : String(parentId);
        }

        let matchingCertificate = $();

        // Match the checked category (or nearest ancestor)
        categoryHierarchy.some(function (categoryId) {
            // 1. Match certificate directly by category_id
            matchingCertificate = certificateSelect.find('option').filter(function () {
                const certificateCategoryId = String($(this).data('category-id') || '');
                return certificateCategoryId === categoryId;
            }).first();

            // 2. If not found, match by parent_id
            if (!matchingCertificate.length) {
                matchingCertificate = certificateSelect.find('option').filter(function () {
                    const certificateParentId = String($(this).data('parent-id') || '');
                    return certificateParentId === categoryId;
                }).first();
            }

            return matchingCertificate.length > 0;
        });

        if (matchingCertificate.length && matchingCertificate.val()) {
            certificateSelect.val(matchingCertificate.val()).trigger('change');
        } else if (clearWhenNotFound) {
            certificateSelect.val('').trigger('change');
        }
    }

    $(document).on('change', 'input[name="category_id"]', function () {
        selectCertificateForCategory(true);
    });

    // Auto-select on page load if a category is checked
    if (!certificateSelect.val()) {
        selectCertificateForCategory(false);
    }
});
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('course-form');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            const categorySelected = document.querySelector('#course-form input[name="category_id"]:checked');
            const errorMessage = document.getElementById('category-error');
            
            errorMessage.textContent = ''; // Clear previous error message

            if (!categorySelected) {
                event.preventDefault(); // Prevent form submission
                errorMessage.textContent = 'Please select a category.'; // Show error message
            }
        });
    } else {
        console.error("Form with ID 'course-form' not found.");
    }
});


</script>

<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/plugins/ckfinder/ckfinder.js')}}"></script>

<script>
    CKEDITOR.replace('editor1');
</script>  

<script>
$(document).on('click', '#course-settings-tab', function () {

    $.ajax({
        url: "{{ url('course_settings') }}",
        type: "GET",
        data: { course_id: "{{ Request::get('id') }}" },

        success: function (response) {
            $('#course-settings').html(response.html);
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            $('#course-settings').html(
                '<div class="alert alert-danger">Unable to load course settings.</div>'
            );
        }
    });

});
</script>
