@include('layouts.admin.header')
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
    .nav-pills .nav-linkk.nav-link:hover {
        color: #364a63;
    }
    .nav-pills .nav-linkk.nav-link.active {
        background-color: #364a63 !important;
        color: #fff !important;
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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-none rounded-0 mb-4">
                <div class="card-body p-0 rounded-0">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                            <div class="d-flex">
                                <div>
                                    <a href="#" class="btn btn-sm btn-primary mr-2">My Courses</a>
                                    <span style="position: relative;">
                                        <a href="#" class="btn btn-sm btn-outline-primary mr-2">In Progress</a>
                                        <span class="in-progress-btn">34</span>
                                    </span>
                                    <a href="#" class="btn btn-sm btn-outline-primary mr-2">Due Soon</a>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Group By</a>
                                </div>
                                <div class="ml-auto">
                                    <div class="d-flex justify-content-between">
                                        <form class="forms-sample">
                                            <div class="mr-2">
                                                <button class="btn btn-sm btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Filters
                                                </button>
                                                <ul class="dropdown-menu p-3 w-100">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 pr-1">
                                                            <select class="js-example-basic-single form-select-control">
                                                                <option value="AL">Select a Category</option>
                                                                <option value="WY">User-type</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4 px-1">
                                                            <select class="js-example-basic-single form-select-control">
                                                                <option value="AL">Select a Sub Category</option>
                                                                <option value="WY">User-type</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group col-sm-4 pl-1">
                                                            <input type="text" class="form-control" placeholder="Search" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="bi bi-search"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </form>
                                        <ul class="nav nav-pills pb-0" id="pills-tab" role="tablist">
                                            <li class="nav-item mr-0">
                                                <a class="nav-linkk nav-link active btn btn-sm web-transparent-btn mr-2" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">
                                                    <i class="fa-solid fa-list"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item mr-0">
                                                <a class="nav-linkk nav-link btn btn-sm web-transparent-btn mr-2" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="false">
                                                    <i class="fas fa-th-large"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        <div>
                                            <a class="btn btn-sm btn-primary" href="{{url('coursecatalog?tab=1')}}">
                                                Add course
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content border-0 mt-3 view-list pr-2" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                                            <div class="row">
                                                <div class="col-12 pb-2">
                                                    <div class="border p-2 courses_listt">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>

                                                                <!-- <div class="progress list-view-p-bar">
                                                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                                        50%
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <div class="row">
                                                            <div class="col-lg-3 pe-0">
                                                                <div>
                                                                    <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h6 class="text-start mb-0">
                                                                    Code Exercises for Business and Mercantile Occupancies
                                                                </h6>
                                                                <div class="fs-7 py-1 mt-1">
                                                                	<span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                                    <span class="ps-1">Category Name</span>
                                                                </div>
                                                                <div class="mt-1 fs-7 pt-1">
                                                                	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                    <label class="ps-1">Last Visited: </label>
                                                                    <span> 17/06/2024</span>
                                                                </div>
                                                                <div class="mt-1">
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-sm">Resume</a>
                                                                    <span class="pl-3"><i class="fa-solid fa-chevron-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">
                                            <div class="row px-1">
                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <!-- <div class="progress progress list-view-p-bar">
                                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                        </div> -->
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            <div class="mt-1">
                                                                <a href="#" class="btn btn-xs btn-outline-primary btn-sm me-2">Start From Begining</a>
                                                            	<a href="#" class="btn btn-xs btn-outline-primary btn-sm">Resume</a>
                                                            </div>
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
																</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4 my-1 px-3 px-md-1">
                                                    <div class="bg-light">
                                                        <div>
                                                            <img src="{{asset('public/images/course.jpg')}}" class="img-fluid" alt="course" />
                                                        </div>
                                                        <div class="p-2">
                                                            <div class="course-name">Code Exercises for Business and Mercantile Occupancies</div>
                                                            <div class="exp-date">
                                                            	<span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <label class="ps-1 mb-0">Last Visited: </label>
                                                                <span>17/06/2024</span>
                                                            </div>
                                                            
                                                            <hr class="my-2" />
                                                            <div class="d-flex justify-content-between">
                                                                <div class="learning-plan-text">
	                                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
	                                                                <span class="ps-1 pt-1">Category Name</span>
	                                                            </div>
                                                                <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                                                <!-- <div class="dropdown">
																    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
																      <i class="fa-solid fa-ellipsis-vertical"></i>
																    </button>
																    <ul class="dropdown-menu">
																      <li><a class="dropdown-item" href="#">Link 1</a></li>
																      <li><a class="dropdown-item" href="#">Link 2</a></li>
																      <li><a class="dropdown-item" href="#">Link 3</a></li>
																    </ul>
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
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                            <div>
                                <h4 class="mb-1">Code Exercises for Business and Mercantile Occupancies</h4>
                            </div>
                            <div class="tab-content border-0 px-0 pb-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                    <div>
                                        <nav class="">
                                            <div class="nav nav-tabs font-smallsize border-bottom-0" id="nav-tab" role="tablist">
                                                <button class="nav-link nav-linkk active" id="t1-tab" data-bs-toggle="tab" data-bs-target="#t1" type="button" role="tab" aria-controls="t1" aria-selected="true">
                                                    Description
                                                </button>
                                                <button class="nav-link nav-linkk" id="t2-tab" data-bs-toggle="tab" data-bs-target="#t2" type="button" role="tab" aria-controls="t2" aria-selected="true">
                                                    Manage Users Access
                                                </button>
                                                <button class="nav-link nav-linkk" id="t3-tab" data-bs-toggle="tab" data-bs-target="#t3" type="button" role="tab" aria-controls="t3" aria-selected="true">
                                                    Files
                                                </button>
                                                <button class="nav-link nav-linkk" id="t4-tab" data-bs-toggle="tab" data-bs-target="#t4" type="button" role="tab" aria-controls="t4" aria-selected="true">
                                                    Reports
                                                </button>
                                            </div>
                                        </nav>
                                        <div class="tab-content border-0 mt-0 p-0 course-completed-view-list pr-2" id="myTabContent">
                                            <div class="tab-pane fade show active card-border" id="t1" role="tabpanel" aria-labelledby="t1-tab">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-4">
                                                        <div class="form-group row my-3">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Course code</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span>12qw</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-4">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Start date</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <span class="ps-1">31-12-2023</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-4">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Last Visited date</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span class="dashed-border-calender-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                                <span class="ps-1">01-04-2024</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-4">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Certificate</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span>3</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-4">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Level</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span>3</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-4">
                                                            <div class="col-6 col-lg-4 my-auto">
                                                                <label class="mb-0">Course status</label>
                                                            </div>
                                                            <div class="col-6 col-lg-8 my-auto">
                                                                <span>Active</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-3">
                                                            <div class="col-12">
                                                                <label class="mb-2">Description</label>
                                                            </div>
                                                            <div class="col-12 px-0">
                                                                <div class="descrip-border">
                                                                    <p class="">
                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                                                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                                    </p>
                                                                    <p class="">
                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                                                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                                    </p>
                                                                    <p class="">
                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                                                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row my-3">
                                                            <div class="col-12">
                                                                <div class="p-3 border d-flex align-items-center justify-content-between">
                                                                    <div class="d-flex justify-content-start align-items-center">
                                                                        <div>
                                                                            <img src="{{asset('public/images/powerpoint-icon.png')}}" alt="powerpoint-icon" />
                                                                        </div>
                                                                        <div class="pl-3">
                                                                            <h6>V2 UI Details.pptx</h6>
                                                                            <div>Powerpoint slideshow</div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="dropdown">
                                                                            <button class="btn brn-transparent dropdown-toggle drpdw-toggle p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa-solid fa-chevron-down"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                                <li><a class="dropdown-item drpdw-itemm" href="#?">Request Approval</a></li>
                                                                                <li><a class="dropdown-item drpdw-itemm" href="#?">Download Attachment</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="t2" role="tabpanel" aria-labelledby="t2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card card-border border-top-0 shadow-none rounded-0">
                                                            <div class="card-body p-2 rounded-0">
                                                                <!-- <h4 class="card-title mb-3">Users List</h4> -->
                                                                <!-- <p class="card-description">A static table without options</p> -->
                                                                <div>
                                                                    <form class="forms-sample">
                                                                        <div class="dropdown mb-2">
                                                                            <button class="btn btn-sm btn-primary dropdown-toggle rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                Filters
                                                                            </button>
                                                                            <ul class="dropdown-menu px-2 w-100">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-4 pr-1">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Select a Category</option>
                                                                                            <option value="WY">User-type</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-sm-4 px-1">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Select a Sub Category</option>
                                                                                            <option value="WY">User-type</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="input-group col-sm-4 pl-1">
                                                                                        <input type="text" class="form-control" placeholder="Search" />
                                                                                        <div class="input-group-append">
                                                                                            <span class="input-group-text">
                                                                                                <i class="bi bi-search"></i>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </ul>
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

                                                                <div id="assigned_courses_container">
                                                                    <div class="table-responsive">
                                                                        <table class="table" id="userDetailsContainer">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th></th>
                                                                                    <th scope="col">User Details</th>
                                                                                    <!-- <th scope="col">Email</th>
                                                                                    <th scope="col">User Type</th> -->
                                                                                    <th scope="col" class="text-center">Registration</th>
                                                                                    <th scope="col" class="text-center">Last Login</th>
                                                                                    <!-- <th scope="col" class="text-center">Options</th> -->
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade card-border border-top-0" id="t3" role="tabpanel" aria-labelledby="t3-tab">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                        <div>There is no better advertisement campaign that is low cost and also successful at the same times.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade card-border border-top-0" id="t4" role="tabpanel" aria-labelledby="t4-tab">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                        <div>There is no better advertisement campaign that is low cost and also successful at the same timess.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade card-border border-top-0" id="t4" role="tabpanel" aria-labelledby="t4-tab">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                        <div>
                                                            There is no better advertisement campaign that is low cost and also successful at the same time.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills333" role="tabpanel" aria-labelledby="v-pills-tab-three">Course3</div>
                                <div class="tab-pane fade" id="v-pills444" role="tabpanel" aria-labelledby="v-pills-tab-four">Course4</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.admin.footer')
