@include('layouts.admin.header')
<style>
    i.bi.bi-caret-right,
    i.bi.bi-caret-right-fill {
        position: relative;
        top: -5px !important;
    }
</style>
<div class="tab-pane" id="ut" role="tabpanel" aria-labelledby="ut-tab">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-3 col-lg-1p5 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills pt-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <a class="nav-link nav-s active border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                        <div><img src="{{asset('public/images/icons/course-catalog/add-course.png')}}" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Add User Types</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10p5">
            <div class="tab-content border-0 pt-2 p-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills1111" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="border-bottom: 0px !important;" id="add-ut-tab" data-bs-toggle="tab" data-bs-target="#addc" type="button" role="tab" aria-controls="addc" aria-selected="true">
                                    Add User Types
                                </button>
                            </div>
                        </nav>
                        <div class="tab-content border-left-0 border-bottom-0 p-0" id="navtabContent">
                            <div class="tab-pane fade show active" id="add-ut" role="tabpanel" aria-labelledby="addc-tab">
                                <div class="card card-border mb-2 shadow-none border-radius-none border-top-0 border-right-0">
                                    <div class="">
                                        <div class="row mx-0 justify-content-between">
                                            <div class="col-12 col-md-10 col-lg-7">
                                                <form class="forms-sample pt-2">
                                                    <div class="form-group row">
                                                        <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Course Code</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group mb-0">
                                                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">80</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">User type default role</label>
                                                        <div class="col-sm-8">
                                                            <select class="js-example-basic-single form-select-control">
                                                                <option value="AL">Administrator</option>
                                                                <option value="WY">User-type</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Permissions</label>
                                                        <div class="col-sm-8">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-2 mt-1">
                                                                    <i class="bi bi-caret-right-fill"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-1">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Administrator
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Users
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Courses
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Groups
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Categories
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Branches
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Events engine
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Import - Export
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        User types
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Account & Settings
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Reports
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Files
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-2 mt-1">
                                                                    <i class="bi bi-caret-right-fill"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-1">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Instructor
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Courses
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Groups
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Reports
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Conferences
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Discussions
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Calendar
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-2 mt-1">
                                                                    <i class="bi bi-caret-right-fill"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-1">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Learner
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Course
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Course Catalog
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Conferences
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Discussions
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Calendar
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Progress
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Gamification
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-2 mt-1">
                                                                    <i class="bi bi-caret-right-fill"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-1">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        General
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Messages
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="col-2 mt-0">
                                                                    <i class="bi bi-caret-right"></i>
                                                                </div>
                                                                <div class="form-check col-10 mt-0">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                        Profile
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Help
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row d-flex align-items-center pl-4 ml-2">
                                                                <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                                    <label class="form-check-label ml-2 mb-0 mt-1" for="flexCheckDefault">
                                                                        Timeline
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <hr class="my-0" />
                                            <div class="col-7">
                                                <div class="my-2 text-center">
                                                    <button type="button" class="btn sbmt-btn mr-2">Save</button>
                                                    <button type="button" class="btn cancel-btn">Cancel</button>
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
@include('layouts.admin.footer')
