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
    background-color: #efefef;
}
</style>
<div class="tab-pane fade show" id="db" role="tabpanel" aria-labelledby="db-tab">
    <div class="row">
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        <div class="text-danger">{{ $message }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills pt-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    
                    <a class="nav-link nav-s {{ request()->query('tab') == 2  || !request()->query('tab') ? 'active' : '' }}  sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-pills2222" role="tab" aria-controls="v-pills2222" aria-selected="false">
                        <img src="images/icons/view-courses.jpg" alt="">
                        <span>Courses</span>
                    </a>

    <!--                 <a class="nav-link nav-s {{ request()->query('tab') == 3 ? 'active' : '' }} sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-add-ca-1" role="tab" aria-controls="v-add-ca-1" aria-selected="true">
                        <img src="images/icons/add-courses.jpg" alt="">
                        <span>Add Category</span>
                    </a> -->
                    <a class="nav-link nav-s {{ request()->query('tab') == 4 ? 'active' : '' }} sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-vi-ca-1" role="tab" aria-controls="v-vi-ca-1" aria-selected="false">
                        <img src="images/icons/View-courses.jpg" alt="">
                        <span>Category</span>
                    </a>
<!-- 
                    <a class="nav-link nav-s {{ request()->query('tab') == 5 ? 'active' : '' }} sidenav sidemenu  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-add-sub-ca-1" role="tab" aria-controls="v-add-sub-ca-1" aria-selected="true">
                        <img src="images/icons/add-courses.jpg" alt="">
                        <span>Add sub Category</span>
                    </a> -->
                    <a class="nav-link nav-s {{ request()->query('tab') == 6 ? 'active' : '' }} sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-vi-sub-ca-1" role="tab" aria-controls="v-vi-sub-ca-1" aria-selected="false">
                        <img src="images/icons/View-courses.jpg" alt="">
                        <span>Sub Category</span>
                    </a>

                </div>
            </div>
        </div>

        <div class="col-12 col-sm-10 col-md-10 col-lg-10">
            <div class="tab-content border-0 pt-2 p-0" id="v-pills-tabContent">
                <div class="tab-pane fade {{ request()->query('tab') == 1  ? ' show active' : '' }}" id="v-pills1111" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="border-bottom: 0px !important;" id="addc-tab" data-bs-toggle="tab" data-bs-target="#addc" type="button" role="tab" aria-controls="addc" aria-selected="true">Add Course</button>
                            @if(session()->has('admin_course_id'))
                                <button class="nav-link" id="addcont-tab" data-bs-toggle="tab" data-bs-target="#addcont" type="button" role="tab" aria-controls="addcont" aria-selected="false">Add Content</button>
                                <button class="nav-link" id="assign-users-tab" data-bs-toggle="tab" data-bs-target="#assign-users" type="button" role="tab" aria-controls="assign-users" aria-selected="false">Assign Users</button>
                                @elseif($request->id)
                                <button class="nav-link" id="addcont-tab" data-bs-toggle="tab" data-bs-target="#addcont" type="button" role="tab" aria-controls="addcont" aria-selected="false">Add Content</button>
                      
                                @else
    <button class="nav-link disabled" id="addcont-tab" type="button" role="tab" aria-controls="addcont" aria-selected="false">Add Content</button>
    <button class="nav-link disabled" id="assign-users-tab" type="button" role="tab" aria-controls="assign-users" aria-selected="false">Assign Users</button>

    <a class="d-flex align-items-center icon-img btn btn-primary btn-sm" style="position: relative;
    left: 20%;" id="v-pills-tab-twos" data-toggle="pill" href="#v-pills2222" role="tab" aria-controls="v-pills2222" aria-selected="false">
                        <img src="images/icons/view-courses.jpg" alt="">
                        <span>View Courses</span>
                    </a>

                               
                                @endif
                           
                               
                            </div>
                        </nav>

                        <!-- <ul class="nav nav-tabs background-lytblue" id="myTab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link nav-s active mr-4 px-3 py-1" id="addc-tab" data-toggle="tab" href="#addc" role="tab" aria-controls="addc" aria-selected="true">Add Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-s  mr-4 px-3 py-1" id="addcont-tab" data-toggle="tab" href="#addcont" role="tab" aria-controls="addcont" aria-selected="true">Add Content</a>
                            </li>
                        </ul> -->
                        <div class="tab-content border-left-0 border-bottom-0 p-0" id="navtabContent">
                            <div class="tab-pane  fade show active" id="addc" role="tabpanel" aria-labelledby="addc-tab">
                                <div class="card card-border mb-1 shadow-none border-radius-none border-top-0 border-right-0">
                                    <div class="m-2 border-lyt">
                                        <div class="row px-2 justify-content-between">
                                            <form action="{{url('add_coursecatalog')}}" class="px-0 pt-2" method="post" enctype="multipart/form-data">
                                                <div class="col-7">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $courses_id->id ?? '' }}" />

                                                    
                                                    <div class="form-group row">
                                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Course name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="course_name"  name="course_name" value="{{$courses_id->course_name??''}}" placeholder="e.g. Introduction to Accounting" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Category</label>
                                                        <div class="col-sm-8">
                                                            <select class="js-example-basic-single form-select-control" id="category_id" name="category_id" required>
                                                                <option value="">Select or create a Category</option>
                                                                @foreach($category_list ?? [] as $category)
                                                                <option @if(optional($courses_id)->category_id == $category->id) selected @endif value="{{ $category->id ?? '' }}">{{ $category->category_name ?? '' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>                                


                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Sub Category</label>
                                                        <div class="col-sm-8">
                                                            <select class="js-example-basic-single form-select-control" id="subcategory_id" name="subcategory_id" required>
                                                                <option value="">Select or create a Sub Category</option>
                                                                @foreach($sub_category_list as $sub_category)
                                                                <option @if(optional($courses_id)->subcategory_id == $sub_category->id) selected @endif value="{{ $sub_category->id }}">{{ $sub_category->subcategory_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                <div class="form-group row align-items-center">
                                                    <label for="exampleTextarea1"  class="col-sm-4 col-form-label">description</label>
                                                    <div class="col-sm-8 ">
                                                        <textarea class="form-control" id="description" name="description" value="{{ $courses_id->description ??'' }}"  placeholder="Add a course description up to 5000 characters " rows="6"></textarea>
                                                    </div>
                                                </div>


                    <!-- <div class="col-3 px-5 my-3 d-flex justify-content-center text-center">
                        <div class="row text-center">
                            <div class="small-12 medium-2 large-2 columns">
                                <div class="circle">
                                <img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                                <div class="select-img">Select Image</div>
                                </div>
                              <div class="p-image">
                                <i class="bi bi-camera"></i>
                                    <input class="file-upload" type="file" accept="image/*"/>
                                </div>
                                
                            </div>
                            
                            </div>
                        </div> -->
                    <!-- <div class="col-9">
                        <form class="forms-sample ">
                        
                        </form>
                    </div> -->

                    <div class="form-group row align-items-center">
                        <label class="col-sm-4 col-form-label">
                           <input type="checkbox" id="active" name="active" class="form-check-input" value="1" @if(optional($courses_id)->active == 1) checked @endif>
                            Active
                        </label>
                        <div class="col-sm-8" style="line-height: 15px;">
                            <label class="form-check-label mb-0"  for="flexCheckDefault" >
                                <input type="checkbox" class="form-check-input" id="hide_from_catalog" name="hide_from_catalog" value="1" @if(optional($courses_id)->hide_from_catalog == 1) checked @endif>
                                Hide from course catalog
                            </label>
                        </div>
                    </div>
                </div>

             <div class="col-7">


                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Course Code</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-0">
                            <input type="text" name="course_code" id="course_code" class="form-control" placeholder="e.g. CS10" aria-label="Recipient's username" value="{{$courses_id->course_code??''}}" aria-describedby="basic-addon2" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">20</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                  <div class="form-group row">
                    <label for="course_image" class="col-sm-4 col-form-label">Course Image</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-0">
                            <input type="file" name="course_image" id="course_image" class="form-control" placeholder="e.g. CS10" accept=".jpg,.jpeg" aria-label="Course Image" value=""  required>
                        </div>
                    </div>
                </div>
              
<div class="form-group row">
    <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Intro Video</label>
    <div class="col-sm-8">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="video_links" class="btn btn-primary customized-btn active shadow-none" style="border-radius: 4px 0px 0px 4px;">Use YouTube</button>
            <button type="button" id="video_upload" class="btn btn-primary customized-btn shadow-none" style="border-radius: 0px 4px 4px 0px;">Use a video</button>
        </div>
        <div class="input-group my-2" id="youtube_input">
            <input type="text" id="intro_video_link" name="intro_video_link" class="form-control" placeholder="https://www.youtube.com/watch?v=xyz" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ $courses_id->intro_video_link ?? '' }}">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">255</span>
            </div>
        </div>
        <div class="input-group my-2" id="video_upload_input" style="display:none;">
            <input type="file" class="form-control" name="intro_video_file" id="intro_video_file" accept="video/*">
        </div>
    </div>
</div>

 
                <div class="form-group row align-items-center">
                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label mb-0">Capacity</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $courses_id->capacity ??'' }}"  id="capacity" name="capacity" placeholder="Unlimited">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="exampleInputUsername2" class="col-sm-4 col-form-label mb-0">Time options</label>
                    <div class="col-sm-8">
                        <div class="btn-group " role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary customized-btn active shadow-none" style="border-radius: 4px 0px 0px 4px;">Duration</button>
                            <button type="button" class="btn btn-primary customized-btn shadow-none" style="border-radius: 0px 4px 4px 0px;">Time limit</button>
                        </div>
                    </div>
                </div>  
    <div class="form-group row">
    <label for="start_date" class="col-sm-4 col-form-label">Start date</label>
    <div class="col-sm-5">
        <input type="date"   value="{{ isset($courses_id) ? date('Y-m-d', strtotime($courses_id->start_date)) : '' }}"  class="form-control" id="start_date" name="start_date" placeholder="Date">
    </div>
    <div class="col-sm-1 d-flex align-items-center px-0 justify-content-center">
        at
    </div>
    <div class="col-sm-2 pr-2">
        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="11:00">
    </div>
</div>
<div class="form-group row">
    <label for="expiration_date" class="col-sm-4 col-form-label">Due date</label>
    <div class="col-sm-5">
        <input type="date" class="form-control" value="{{ isset($courses_id) ? date('Y-m-d', strtotime($courses_id->expiration_date)) : '' }}"  id="expiration_date" name="expiration_date" placeholder="Date">
    </div>
    <div class="col-sm-1 d-flex align-items-center px-0 justify-content-center">
        at
    </div>
    <div class="col-sm-2 pr-2">
        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="11:00">
    </div>
</div>

            </div>

            <div class="col-9">
                <div class="form-group row pl-4 pr-5 ml-2">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label invisible mb-0 py-1">Password</label>
                    <div class="form-check col-sm-9 mt-2">
                        <label class="form-check-label ">
                             <input type="checkbox" id="retain_access" name="retain_access" class="form-check-input" value="1" @if(optional($courses_id)->retain_access == 1) checked @endif>
                            Retain access for users who have completed the course
                        </label>
                    </div>
                </div>
            </div>

  <div class="col-7">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Certificate</label>
        <div class="col-sm-8">
            <select class="js-example-basic-single form-select-control" id="certificate" name="certificate">
                <option value="">Select a certificate</option>
                <option value="1" @if(optional($courses_id)->certificate == 1) selected @endif>Certificate - 1</option>
                <option value="2" @if(optional($courses_id)->certificate == 2) selected @endif>Certificate - 2</option>
                <option value="3" @if(optional($courses_id)->certificate == 3) selected @endif>Certificate - 3</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label mb-0">Level</label>
        <div class="col-sm-8">
            <select class="js-example-basic-single form-select-control" name="level" id="level">
                <option value="">Select Level</option>
                <option value="1" @if(optional($courses_id)->level == 1) selected @endif>1</option>
                <option value="2" @if(optional($courses_id)->level == 2) selected @endif>2</option>
                <option value="3" @if(optional($courses_id)->level == 3) selected @endif>3</option>
            </select>
        </div>
    </div>
</div>
                                                                                   
            <hr class="my-2">                                                                           
            <div class="col-7">
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary customized-btn-green px-4 py-2 mr-2">Submit</button>
                    <button type="button" class="btn btn-primary customized-btn-blue px-4 py-2">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>                    
</div>
</div>


<div class="tab-pane fade " id="addcont" role="tabpanel" aria-labelledby="addcont-tab">
    <div class="card card-border mb-1 shadow-none border-right-0 border-top-0 border-radius-none">
        <div class="m-1 border-lyt">
            <form action="{{url('add_content_type')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $courses_id->id ?? '' }}" />
                <div class="row px-3 pt-3">
               
                

                    <div class="col-12">
                        <div class="form-sample">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label mb-0">Select Content type</label>
                                <div class="col-sm-10">
                                    <select name="content_type" class="js-example-basic-single form-select-control content_type" required>
                                        <option value="">Select Content type</option>
                                        <option value="Amazon_view_url" @if(optional($courses_id)->content_type == "Amazon_view_url") selected @endif>Amazon view url</option>
                                        <option value="local_url" @if(optional($courses_id)->content_type == "local_url") selected @endif>Local Upload</option>
                                        <!-- <option value="scorm_video">SCORM | xAPI | cmi5</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
                <div class="row px-4 py-3">
                    <div class="p-5 text-center dashed-border input-group" id="amazon_url_input_div">
                        <input type="text" id="content_type_upload" value="{{$courses_id->content_type_upload ??''}}" name="content_type_upload" class="form-control" placeholder="https://www.youtube.com/watch?v=xyz" aria-label="Recipient's username" aria-describedby="basic-addon2"> 

                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">255</span>
                        </div>             
                    </div> 
                     <div class="p-5 text-center dashed-border input-group" id="scorm_video_input_div" style="display:none;">
                    
                        <!-- <input type="file" class="form-control" name="content_type_upload"  accept="video/*"> -->
                        <input type="file" class="form-control" name="content_type_upload" accept=".zip,application/octet-stream">

                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">255</span>
                        </div>             
                    </div>
                    <div class="p-5 text-center dashed-border input-group" id="local_url_input_div" style="display:none;">
                        <input type="file" class="form-control" name="content_type_upload" accept="video/*">            
                    </div>   
                    <div class="">
                        <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                        <button type="submit" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                        <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                    </div>  
                </div> 
            </form> 
        </div>           
    </div>
</div>


<div class="tab-pane fade " id="assign-users" role="tabpanel" aria-labelledby="assign-users-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border shadow-none rounded-0">
                <div class="card-body p-1 p-0 rounded-0">
                    <!-- <h4 class="card-title mb-3">Users List</h4> -->
                    <!-- <p class="card-description">A static table without options</p> -->
                    <div>
                        <form class="forms-sample p-1 ">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <select class="js-example-basic-single form-select-control">
                                        <option value="AL">Select a Category</option>
                                        <option value="WY">User-type</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="js-example-basic-single form-select-control">
                                        <option value="AL">Select a Sub Category</option>
                                        <option value="WY">User-type</option>
                                    </select>
                                </div>
                                <div class="input-group col-sm-4">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                   
             <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p id="successMessage"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">S.NO</th>  
                              <th scope="col" class="text-center">Options</th>
                              <th scope="col">User Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">User Type</th>
                              <th scope="col" class="text-center">Registration</th>
                              <th scope="col" class="text-center">Last Login</th>

                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=1;?>
                          @foreach($users_lists as $user)

                            <tr>
                                <td>{{$i++}}</td>
                                <td class="text-center">
                                <input type="checkbox" class="user_single_check" data-user_id="{{$user->id}}"></td>

                                <td scope="row">{{$user->first_name??''}} {{$user->last_name??''}}</td>
                                <td>{{$user->email??''}}</td>
                                <td>@if($user->user_type == 0)
                                    User
                                    @elseif($user->user_type == 1)
                                    Admin
                                    @else
                                @endif</td>
                                <td class="text-center">{{$user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') : ''}}</td>
                                <td class="text-center">{{$user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d-m-Y') : ''}}</td>
                            </tr>
                            @endforeach
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $("#video_links").click(function() {
            $("#youtube_input").show(); 
            $("#video_upload_input").hide();
            $("#video_links").addClass("active");
            $("#video_upload").removeClass("active"); 
        });

        $("#video_upload").click(function() {
            $("#video_upload_input").show(); 
            $("#youtube_input").hide(); 
            $("#video_upload").addClass("active");
            $("#video_links").removeClass("active");
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



        
$('.content_type').on('change', function() {
    if ($(this).val() === "scorm_video") {
        $("#scorm_video_input_div").show(); 
        $("#amazon_url_input_div").hide();
        $("#local_url_input_div").hide();
    } else if ($(this).val() === "local_url") {
        $("#scorm_video_input_div").hide(); 
        $("#amazon_url_input_div").hide();
        $("#local_url_input_div").show();
    } else {
        $("#scorm_video_input_div").hide();  
        $("#amazon_url_input_div").show();
        $("#local_url_input_div").hide();
    }
});

        $('.user_single_check').on('change', function() {
            var userid = $(this).data('user_id');
            var isChecked = $(this).prop('checked');
            var status = isChecked ? 1 : 0; // Simplified the status determination

            $.ajax({
                url: "{{url('fetch_signleCourse_userData')}}",
                method: 'GET',
                data: {
                    userid: userid,
                    status: status
                },
                success: function(response) {
                     var message = status === 1 ? 'Added Course to user successfully.' : 'Removed Course to user  successfully.';
                                        $('#successMessage').text(message);
                                        // $('#successModal').modal('show'); 
                },
                error: function(xhr, status, error) {
                    // Handle error here if needed
                }
            });
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

    });

</script>                                                               
