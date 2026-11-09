@include('layouts.admin.header')
<div class="tab-pane" id="fm" role="tabpanel" aria-labelledby="reports-tab">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-3 col-lg-1p5 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills pt-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <a class="nav-link nav-s active border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-user-report" role="tab" aria-controls="v-user-report" aria-selected="true">
                        <div><img src="images/icons/user-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Users Reports</span>
                        </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-course-report" role="tab" aria-controls="v-course-report" aria-selected="false">
                        <div><img src="images/icons/courses-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Courses Reports</span>
                    </a>
                    <a class="nav-link nav-s  border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-branches-report" role="tab" aria-controls="v-branches-report" aria-selected="true">
                        <div><img src="images/icons/branches-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                        <span>Branches Reports</span>
                    </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-groups-report" role="tab" aria-controls="v-groups-report" aria-selected="false">
                        <div><img src="images/icons/grp-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Groups Reports</span>
                    </a>
                    <a class="nav-link nav-s  border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-scorm-report" role="tab" aria-controls="v-scorm-report" aria-selected="true">
                        <div><img src="images/icons/scorm-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Scorm Reports</span>
                    </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-tests-report" role="tab" aria-controls="v-tests-report" aria-selected="false">
                        <div><img src="images/icons/test-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Tests Reports</span>
                    </a>
                    <a class="nav-link nav-s  border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-survey-report" role="tab" aria-controls="v-survey-report" aria-selected="true">
                        <div><img src="images/icons/survey-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Survey Reports</span>
                    </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-assigmnets-rep" role="tab" aria-controls="v-assigmnets-rep" aria-selected="false">
                        <div><img src="images/icons/assignment-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Assignments Reports</span>
                    </a>
                    <a class="nav-link nav-s  border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-ilts-rep" role="tab" aria-controls="v-ilts-rep" aria-selected="true">
                        <div><img src="images/icons/ilts-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>ILTs Reports</span>
                    </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-info-rep" role="tab" aria-controls="v-info-rep" aria-selected="false">
                        <div><img src="images/icons/infographic.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Infographics Reports</span>
                    </a>
                    <a class="nav-link nav-s sidenav sidemenu border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-training-rep" role="tab" aria-controls="v-training-rep" aria-selected="false">
                        <div><img src="images/icons/traininig-matrix-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Training matrix Reports</span>
                    </a>
                    <a class="nav-link nav-s  border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-timeline-rep" role="tab" aria-controls="v-timeline-rep" aria-selected="true">
                        <div><img src="images/icons/time-line-reports.jpg" class="mx-auto d-block mb-2" alt=""></div>
                            <span>Timeline Reports</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10p5">
            <div class="tab-content border-0 p-0" id="v-pills-tabContent">

                <div class="tab-pane py-2 fade show active" id="v-user-report" role="tabpanel" aria-labelledby="v-user-report">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="viewc-tab" data-bs-toggle="tab" data-bs-target="#viewc" type="button" role="tab" aria-controls="viewc" aria-selected="true">Users Reports</button>
                            </div>
                        </nav>
                        <!-- <ul class="nav nav-tabs background-lytblue" id="myTab1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link nav-s active mr-4 px-3 py-1" id="viewc-tab" data-toggle="tab" href="#viewc" role="tab" aria-controls="viewc" aria-selected="false">Reports</a>
                                </li>
                            </ul> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-border border-top-0 shadow-none rounded-0">
                                    <div class="card-body p-2 rounded-0">
                                        <div class="row">
                                            <div class="col-12 col-lg-7">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">User</th>
                                                                <th scope="col">User Type</th>
                                                                <th scope="col">Last Login</th>
                                                                <th scope="col" class="text-center">Assigned Courses</th>
                                                                <th scope="col" class="text-center">Completed Courses</th>
                                                                <th scope="col" class="text-center">Points</th>
                                                                <th scope="col" class="text-center">Badges</th>
                                                                <th scope="col" class="text-center">Level</th>
                                                                <th scope="col" class="text-center">Options</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Learner Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Admin Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Learner Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Admin Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Learner Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row">Adavi</td>
                                                                <td>Admin Type</td>
                                                                <td>11/10/2023</td>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">6235</td>
                                                                <td class="text-center">11</td>
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">...</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-5 border-left">
                                                <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="progress-t1-tab" data-bs-toggle="tab" data-bs-target="#progress-t1" type="button" role="tab" aria-controls="progress-t1" aria-selected="true">Progress</button>
                                                                    <button class="nav-link" id="assessment-t2-tab" data-bs-toggle="tab" data-bs-target="#assessment-t2" type="button" role="tab" aria-controls="assessment-t2" aria-selected="true">Assessment Test</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border " id="myTab1" role="tablist">
                                                                                            <li class="nav-item ">
                                                                                                <a class="nav-link mr-5 px-3 py-1" id="t1-tab" data-toggle="tab" href="#progress-t1" role="tab" aria-controls="progress-t1" aria-selected="true">Progress</a>
                                                                                            </li>
                                                                                            <li class="nav-item ">
                                                                                                <a class="nav-link  px-0 py-1" id="t2-tab" data-toggle="tab" href="#assessment-t2" role="tab" aria-controls="assessment-t2" aria-selected="false">Assessment Test</a>
                                                                                            </li>
                                                                                        </ul> -->
                                                            <div class="tab-content border-0 mt-0 p-0" id="myTabContent">

                                                                <div class="tab-pane fade show active " id="progress-t1" role="tabpanel" aria-labelledby="t1-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-2 rounded-0">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">User</th>
                                                                                                    <th scope="col">Email</th>
                                                                                                    <th scope="col">User Type</th>
                                                                                                    <th scope="col">Registration</th>
                                                                                                    <th scope="col">Last Login</th>
                                                                                                    <th scope="col" class="text-center">Options</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                        <button type="button" class="btn btn-primary btn-sm customized-btn1">Assign</button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                        <button type="button" class="btn btn-primary btn-sm customized-btn1">Revoke</button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">...</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">...</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">...</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td scope="row">A.SK</td>
                                                                                                    <td>ask@gmail.com</td>
                                                                                                    <td>Learner-Type</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td>11/10/2023</td>
                                                                                                    <td class="text-center">...</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane card-border border-top-0 fade" id="assessment-t2" role="tabpanel" aria-labelledby="t2-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="t3" role="tabpanel" aria-labelledby="t3-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-0">
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="t4" role="tabpanel" aria-labelledby="t4-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-0">
                                                                            <div class="work-in-prog">Work In Progress</div>
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
                </div>

                <div class="tab-pane py-2 fade show" id="v-course-report" role="tabpanel" aria-labelledby="v-course-report">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="viewc-tab" data-bs-toggle="tab" data-bs-target="#viewc" type="button" role="tab" aria-controls="viewc" aria-selected="true">Courses Reports</button>
                            </div>
                        </nav>
                        <!-- <ul class="nav nav-tabs background-lytblue" id="myTab1" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link nav-s active mr-4 px-3 py-1" id="viewc-tab" data-toggle="tab" href="#viewc" role="tab" aria-controls="viewc" aria-selected="false">Reports</a>
                                                            </li>
                                                        </ul> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card  card-border border-top-0 shadow-none rounded-0">
                                    <div class="card-body p-2 rounded-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col" class="text-center">Assigned Learners</th>
                                                    <th scope="col" class="text-center">Completed Learners</th>
                                                    <th scope="col" class="text-center">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Curries</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Ceco</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Curries</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Ceco</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Curries</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Added by Arun</td>
                                                    <td>Ceco</td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane py-2 fade show" id="v-branches-report" role="tabpanel" aria-labelledby="v-branches-report">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="viewb-tab" data-bs-toggle="tab" data-bs-target="#viewb" type="button" role="tab" aria-controls="viewb" aria-selected="true">Branches Reports</button>
                            </div>
                        </nav>

                        <div class="tab-pane fade show" id="viewb" role="tabpanel" aria-labelledby="viewb">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card  card-border border-top-0 shadow-none rounded-0">
                                        <div class="card-body p-2 rounded-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col" class="text-center">Assigned Users</th>
                                                        <th scope="col" class="text-center">Completion Rate</th>
                                                        <th scope="col" class="text-center">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">curries</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">doorgroup</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">doorgroupengineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">dsscanada</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">emtek</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">hardwaregroup</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade py-2" id="v-groups-report" role="tabpanel" aria-labelledby="v-groups-report">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="viewg-tab" data-bs-toggle="tab" data-bs-target="#viewg" type="button" role="tab" aria-controls="viewg" aria-selected="true">Group Reports</button>
                            </div>
                        </nav>

                        <div class="tab-pane fade show" id="viewg" role="tabpanel" aria-labelledby="viewg">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card  card-border border-top-0 shadow-none rounded-0">
                                        <div class="card-body p-2 rounded-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col" class="text-center">Assigned Users</th>
                                                        <th scope="col" class="text-center">Completion Rate</th>
                                                        <th scope="col" class="text-center">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Door Group</td>
                                                        <td class="text-center">2</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Hardware Group</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">0.00%</td>
                                                        <td class="text-center">...</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade py-2" id="v-tests-report" role="tabpanel" aria-labelledby="v-tests-report">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="viewt-tab" data-bs-toggle="tab" data-bs-target="#viewt" type="button" role="tab" aria-controls="viewt" aria-selected="true">Test Reports</button>
                            </div>
                        </nav>

                        <div class="tab-pane fade show" id="viewt" role="tabpanel" aria-labelledby="viewt">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card  card-border border-top-0 shadow-none rounded-0">
                                        <div class="card-body p-2 rounded-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Test</th>
                                                        <th scope="col">Course</th>
                                                        <th scope="col" class="text-center">Completed</th>
                                                        <th scope="col" class="text-center">Passed</th>
                                                        <th scope="col" class="text-center">Average Score</th>
                                                        <th scope="col" class="text-center">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Test On Custom Strikes</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Door Edges</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Door Pulls</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Kick Plates</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Norton,Rixson & Routing</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Push Plates</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade py-2" id="v-assigmnets-rep" role="tabpanel" aria-labelledby="v-assigmnets-rep">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="view-asg-tab" data-bs-toggle="tab" data-bs-target="#view-asg" type="button" role="tab" aria-controls="view-asg" aria-selected="true">Assignment Reports</button>
                            </div>
                        </nav>

                        <div class="tab-pane fade show" id="view-asg" role="tabpanel" aria-labelledby="view-asg">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card  card-border border-top-0 shadow-none rounded-0">
                                        <div class="card-body p-2 rounded-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Assignment</th>
                                                        <th scope="col">Course</th>
                                                        <th scope="col" class="text-center">Submissions</th>
                                                        <th scope="col" class="text-center">Passed</th>
                                                        <th scope="col" class="text-center">Average Grade</th>
                                                        <th scope="col" class="text-center">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Overview On SKI Processing Norton product</td>
                                                        <td>DSS Monroe</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Overview On SKI Processing product</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Overview On SKI Processing Rixson product</td>
                                                        <td>DSS Monroe</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Kick Plates</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Norton,Rixson & Routing</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Test On Push Plates</td>
                                                        <td>Rockwood Engineering</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">...</td>
                                                    </tr>
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
        </div>
    </div>
</div>
</div>
@include('layouts.admin.footer')