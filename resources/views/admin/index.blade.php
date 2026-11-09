<?php include 'header.php'; ?>
<!-- partial -->
    <div class="container-fluid page-body-wrapper tv-div ">
      <div class="main-panel">
        <div class="content-wrappe m-2 m-md-3 m-lg-3">
          <div class="row">
            <div class="col-12">
              <div class="card shadow-none">
                <div class="card-body p-2 mx-0">
                    <div class="row mx-0">
                        <div class="card-border d-flex m-0 px-0">
                        <div class="col-lg-2 pl-0 pr-0">
                        <div class=" text-center py-4">
                            <img src="images/face12.jpg" alt="profile" class="img-lg rounded-circle mb-4"/>
                            <div class="web-lytblue">Arun</div>
                            <div class="small-font">Admin</div>
                        </div>
                        
                        </div>
                        <div class="col-lg-10 pl-md-1 pl-lg-1 p-1">
                            <div class="mt-0 py-0 ">
                                <nav>
                                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">My Dashboard</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Notifications</button>
                                    </div>
                                </nav>
                                <div class="tab-content p-4" id="nav-tabContent">
                                    <div class="tab-pane fade  show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-6 col-md-3 col-lg-3  font-size-lg text-center">
                                                <div class="bg-lyt-green py-3 px-2">
                                                    <span>Training Time</span>    
                                                    <div class="green">9h 47m</div> 
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3  font-size-lg text-center">
                                               <div class="bg-pink py-3 px-2">
                                                    <span>Badgets</span>
                                                    <div class="primary">4</div>
                                               </div>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3  font-size-lg text-center">
                                                <div class="bg-gold-yellow py-3 px-2">
                                                    <span>Points</span>
                                                    <div class="text-warning">3825</div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3  font-size-lg text-center">
                                                <div class="bg-red py-3 px-2">
                                                    <span>Level</span>
                                                    <div class="text-red">2nd</div>
                                                </div>
                                            </div>
                                        </div>                                         
                                    </div>
                                   
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div class="row">
                                              <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 p-0">
                                                <div> There is no better advertisement campaign that is low cost and also successful at the same time.</div>
                                              </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                  <div class="row">
                    <div class="col-12 px-2">
                      <div class="tab-content pt-1 border-0" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills1" role="tabpanel" aria-labelledby="v-pills-tab-one">
                            <div>
                                <!-- <ul class="nav nav-tabs background-lytblue horizontal-scroll border-bottom justify-content-start" id="myTab1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 pl-lg-4 py-1 active" id="db-tab" data-toggle="tab" href="#db" role="tab" aria-controls="db" aria-selected="true">Course Catalog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="wd-tab" data-toggle="tab" href="#wd" role="tab" aria-controls="wd" aria-selected="false">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="sc-tab" data-toggle="tab" href="#sc" role="tab" aria-controls="sc" aria-selected="false">Sub Categoriess</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="ui-tab" data-toggle="tab" href="#ui" role="tab" aria-controls="ui" aria-selected="false">Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="fm-tab" data-toggle="tab" href="#fm" role="tab" aria-controls="fm" aria-selected="false">Reports</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="br-tab" data-toggle="tab" href="#br" role="tab" aria-controls="br" aria-selected="false">Roles & Permissions</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="fi-tab" data-toggle="tab" href="#fi" role="tab" aria-controls="fi" aria-selected="false">Import & Export</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="gp-tab" data-toggle="tab" href="#gp" role="tab" aria-controls="gp" aria-selected="false">Groups</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link mr-md-4 mr-lg-5 px-3 pl-md-4 px-lg-0 py-1" id="st-tab" data-toggle="tab" href="#st" role="tab" aria-controls="st" aria-selected="false">Settings</a>
                                  </li>
                                </ul> -->
                                <nav>
                                    <div class="nav nav-tabs horizontal-scroll font-smallsize " id="nav-tab" role="tablist">
                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="dab-tab" data-bs-toggle="tab" data-bs-target="#dab" type="button" role="tab" aria-controls="dab" aria-selected="true">Organization Dashboard</button>
                                        <button class="nav-link " style="border-bottom: 0px !important;" id="db-tab" data-bs-toggle="tab" data-bs-target="#db" type="button" role="tab" aria-controls="db" aria-selected="true">Course Catalog</button>
                                        
                                        <button class="nav-link" id="ui-tab" data-bs-toggle="tab" data-bs-target="#ui" type="button" role="tab" aria-controls="ui" aria-selected="false">User Management</button>
                                        <button class="nav-link" id="fm-tab" data-bs-toggle="tab" data-bs-target="#fm" type="button" role="tab" aria-controls="fm" aria-selected="false">Reports</button>
                                        <button class="nav-link" id="ut-tab" data-bs-toggle="tab" data-bs-target="#ut" type="button" role="tab" aria-controls="ut" aria-selected="false">User Types</button>
                                        <button class="nav-link" id="fi-tab" data-bs-toggle="tab" data-bs-target="#fi" type="button" role="tab" aria-controls="fi" aria-selected="false">Import & Export</button>
                                        <button class="nav-link" id="au-tab" data-bs-toggle="tab" data-bs-target="#au" type="button" role="tab" aria-controls="au" aria-selected="false">Automation</button>
                                        <button class="nav-link " id="st-tab" data-bs-toggle="tab" data-bs-target="#st" type="button" role="tab" aria-controls="st" aria-selected="false">Settings</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">My Profile</button>
                                        <button class="nav-link " id="ds-tab" data-bs-toggle="tab" data-bs-target="#ds" type="button" role="tab" aria-controls="ds" aria-selected="false">Discussions</button>
                                        <button class="nav-link " id="msgs-tab" data-bs-toggle="tab" data-bs-target="#msgs" type="button" role="tab" aria-controls="msgs" aria-selected="false">Messages</button>
                                    </div>
                                </nav>
                                <div class="tab-content px-0 py-0" id="navtabContent">
                                    <div class="tab-pane fade show active" id="dab" role="tabpanel" aria-labelledby="dab-tab">
                                        <div class="row p-3">
                                            <div class="col">
                                            <div class="card border-start shadow-none">
                                                <div class="card-body px-3 py-4">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                    <div class="color-card">
                                                        <div class="d-flex justify-content-between ">
                                                            <div class="circle-bg bg-warning d-flex align-items-center justify-content-center px-3">
                                                            <i class="bi bi-journal-text"></i>
                                                            </div>
                                                            <div class="px-3">
                                                            <h4 class="mb-3 font-smallsize font-weight-normal">Total Catagories</h4>
                                                            <h2 class="">20
                                                            </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                            <div class="card border-start-info shadow-none">
                                                <div class="card-body px-3 py-4">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                    <div class="color-card">
                                                        <div class="d-flex justify-content-between ">
                                                            <div class="circle-bg  bg-info d-flex align-items-center justify-content-center px-3">
                                                            <i class="bi bi-journals"></i>
                                                            </div>
                                                            <div class="pl-3">
                                                            <h4 class="mb-3  font-smallsize font-weight-normal">Total Sub Catagories</h4>
                                                            <h2 class="">20
                                                            </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                            <div class="card border-start-primary shadow-none">
                                                <div class="card-body px-3 py-4">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                    <div class="color-card">
                                                        <div class="d-flex justify-content-between ">
                                                            <div class="circle-bg bg-primary  d-flex align-items-center justify-content-center px-3">
                                                            <i class="bi bi-journal-album"></i>
                                                            </div>
                                                            <div class="px-3">
                                                            <h4 class="mb-3  font-smallsize font-weight-normal">Total Courses</h4>
                                                            <h2 class="">20
                                                            </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                            <div class="card border-start-success shadow-none">
                                                <div class="card-body px-3 py-4">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                    <div class="color-card">
                                                        <div class="d-flex justify-content-between ">
                                                            <div class="circle-bg bg-success d-flex align-items-center justify-content-center px-3">
                                                            <i class="bi bi-check-lg"></i>
                                                            </div>
                                                            <div class="px-3">
                                                            <h4 class="mb-3  font-smallsize font-weight-normal">Active Courses</h4>
                                                            <h2 class="">20
                                                            </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                            <div class="card border-start-danger shadow-none">
                                                <div class="card-body px-3 py-4">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                    <div class="color-card">
                                                        <div class="d-flex justify-content-between ">
                                                            <div class="circle-bg bg-danger d-flex align-items-center justify-content-center px-3">
                                                            <i class="bi bi-journal-check"></i>
                                                            </div>
                                                            <div class="px-3">
                                                            <h4 class="mb-3  font-smallsize font-weight-normal">Assigned Courses</h4>
                                                            <h2 class="">20
                                                            </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="p-3">Learning Progress</h3>
                                            <div class="row px-3 pb-3">
                                            <div class="col-4">
                                            <div class="card bg-lytpink shadow-none">
                                                <div class="card-body px-3 py-4">
                                                   <div class="row px-3 align-items-center">
                                                    <div class="col-7">
                                                    <h4 class="text-white font-smallsize mb-0 font-weight-normal">Assigned Courses</h4>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                    <h4 class=" text-white">10</h4>
                                                    </div>

                                                    <div class="col-7">
                                                    <h4 class="text-white font-smallsize mb-0 font-weight-normal">Inprogress</h4>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                    <h4 class=" text-white">20</h4>
                                                    </div>

                                                    <div class="col-7">
                                                    <h4 class="text-white font-smallsize mb-0 font-weight-normal">Completed</h4>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                    <h4 class=" text-white">30</h4>
                                                    </div>
                                                   </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                            <div class="card bg-gold shadow-none">
                                                <div class="card-body px-3 py-4">
                                                   <div class="row px-3 align-items-center">
                                                    <div class="col-7">
                                                    <h4 class="text-white font-smallsize mb-0 font-weight-normal">Inprogress</h4>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                    <h4 class=" text-white">20</h4>
                                                    </div>
                                                   </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                            <div class="card bg-skyblue shadow-none">
                                                <div class="card-body px-3 py-4">
                                                   <div class="row px-3 align-items-center">
                                                    <div class="col-7">
                                                    <h4 class="text-white font-smallsize mb-0 font-weight-normal">Completed</h4>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                    <h4 class=" text-white">30</h4>
                                                    </div>
                                                   </div>
                                                </div>
                                                </div>
                                            </div>
                                                
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row px-3">
                                            <div class="col-xl-4 col-sm-4">
                                            <div class="mt-4 ">
                                                <h3>Login History</h3>
                                                </div>
                                                    <div class="card">
                                                    <div class="card-body px-0 overflow-auto">
                                                        <div class="table-responsive px-3">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="1" class="border-right"></th>
                                                                <th class="border-right">No. of Logins</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="bordered">
                                                                <td>Today</td>
                                                                <td>5</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>Yesterday</td>
                                                                <td>3</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>This Week</td>
                                                                <td>10</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>This Month</td>
                                                                <td>20</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4">
                                                <div class="mt-4">
                                                <h3>Courses Assigned</h3>
                                                </div>
                                                    <div class="card">
                                                    <div class="card-body px-0 overflow-auto">
                                                        <div class="table-responsive px-3">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                            <th colspan="1" class="border-right"></th>
                                                                <th class="border-right">Count</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="bordered">
                                                                <td>Today</td>
                                                                <td>15</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>Yesterday</td>
                                                                <td>10</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>This Week</td>
                                                                <td>30</td>
                                                            </tr>
                                                            <tr class="bordered">
                                                                <td>This Month</td>
                                                                <td>50</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-xl-4 col-sm-4">
                                                <div class="mt-4">
                                                <h3>Eligibility Criteria <span class="font-span">(Regular)</span></h3>
                                                </div>
                                                    <div class="card">
                                                    <div class="card-body px-0 overflow-auto">
                                                        <div class="table-responsive px-3">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                            <th colspan="1" class="border-right"> Department Name</th>
                                                                <th class="border-right">No. of Employees</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="bordered">
                                                                <td>Ceco</td>
                                                                <td>5</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="db" role="tabpanel" aria-labelledby="db-tab">
                                        <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-pills1111" role="tab" aria-controls="v-pills1111" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Add Course</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-pills2222" role="tab" aria-controls="v-pills2222" aria-selected="false">
                                                        <img src="images/icons/view-courses.jpg" alt="">
                                                            <span>View Courses</span>
                                                        </a>

                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-add-ca-1" role="tab" aria-controls="v-add-ca-1" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Add Category</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-vi-ca-1" role="tab" aria-controls="v-vi-ca-1" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>View Category</span>
                                                        </a>

                                                        <a class="nav-link nav-s sidenav sidemenu  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-add-sub-ca-1" role="tab" aria-controls="v-add-sub-ca-1" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Add sub Category</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-vi-sub-ca-1" role="tab" aria-controls="v-vi-sub-ca-1" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>View sub Category</span>
                                                        </a>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1 p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-pills1111" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="addc-tab" data-bs-toggle="tab" data-bs-target="#addc" type="button" role="tab" aria-controls="addc" aria-selected="true">Add Course</button>
                                                                    <button class="nav-link" id="addcont-tab" data-bs-toggle="tab" data-bs-target="#addcont" type="button" role="tab" aria-controls="addcont" aria-selected="false">Add Content</button>
                                                                    <button class="nav-link" id="assign-users-tab" data-bs-toggle="tab" data-bs-target="#assign-users" type="button" role="tab" aria-controls="assign-users" aria-selected="false">Assign Users</button>
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
                                                                <div class="tab-pane fade show active" id="addc" role="tabpanel" aria-labelledby="addc-tab">
                                                                <div class="card card-border mb-1 shadow-none border-radius-none border-top-0 border-right-0">
                                                                    <div class="m-1 border-lyt">
                                                                    <div class="row pl-3 pr-5 justify-content-between">
                                                                                        <div class="col-7">
                                                                                            <form class="forms-sample pt-3 ">
                                                                                                <div class="form-group row">
                                                                                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Course name</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="e.g. Introduction to Accounting">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group row">
                                                                                                <label class="col-sm-4 col-form-label">Category</label>
                                                                                                <div class="col-sm-8">
                                                                                                <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL">Select or create a Category</option>
                                                                                                <option value="WY">User-type</option>
                                                                                                </select>
                                                                                                </div>
                                                                                                </div>

                                                                                                <div class="form-group row">
                                                                                                <label class="col-sm-4 col-form-label">Sub Category</label>
                                                                                                <div class="col-sm-8">
                                                                                                <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL">Select or create a Sub Category</option>
                                                                                                <option value="WY">User-type</option>
                                                                                                </select>
                                                                                                </div>
                                                                                                </div>

                                                                                                <div class="form-group row align-items-center">
                                                                                                <label for="exampleTextarea1"  class="col-sm-4 col-form-label">Description</label>
                                                                                                <div class="col-sm-8 ">
                                                                                                <textarea class="form-control" id="exampleTextarea1"  placeholder="Add a course description up to 5000 characters " rows="6"></textarea>
                                                                                                </div>
                                                                                                </div>
                                                                                           
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="col-3 px-5 my-3 d-flex justify-content-center text-center">
                                                                                            <div class="row text-center">
                                                                                                <div class="small-12 medium-2 large-2 columns">
                                                                                                    <div class="circle">
                                                                                                    <img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                                                                                                    <div class="select-img">Select Image</div>
                                                                                                    </div>
                                                                                                    <!-- <div class="p-image">
                                                                                                    <i class="bi bi-camera"></i>
                                                                                                        <input class="file-upload" type="file" accept="image/*"/>
                                                                                                    </div> -->
                                                                                                    
                                                                                                </div>
                                                                                                
                                                                                                </div>
                                                                                            </div>
                                                                                        <!-- <div class="col-9">
                                                                                            <form class="forms-sample ">
                                                                                            
                                                                                            </form>
                                                                                        </div> -->

                                                                                        <div class="col-8">   
                                                                                            <div class="form-group row px-0">
                                                                                                    <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible mb-0">Password</label>
                                                                                                    <div class="form-check col-sm-3 ">
                                                                                                        <label class="form-check-label">
                                                                                                        <input type="checkbox" class="form-check-input">
                                                                                                        Active
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="form-check col-sm-5">
                                                                                                        <label class="form-check-label"  for="flexCheckDefault" >
                                                                                                        <input type="checkbox" class="form-check-input" id="flexCheckDefault" checked enable>
                                                                                                        Hide from course catalog
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-7">
                                                                                            <form class="forms-sample ">
                                                                                            <div class="form-group row">
                                                                                                    <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Course Code</label>
                                                                                                    <div class="col-sm-8">
                                                                                                    <div class="input-group mb-0">
                                                                                                        <input type="text" class="form-control" placeholder="e.g. CS10" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text" id="basic-addon2">20</span>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Intro Video</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="btn-group " role="group" aria-label="Basic example">
                                                                                                        <button type="button" class="btn btn-secondary customized-btn active shadow-none">Use YouTube</button>
                                                                                                        <button type="button" class="btn btn-secondary customized-btn shadow-none ">Use a video</button>
                                                                                                        </div>
                                                                                                            <div class="input-group my-2">
                                                                                                            <input type="text" class="form-control" placeholder="https://www.youtube.com/watch?v=xyz" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                                                            <div class="input-group-append">
                                                                                                                <span class="input-group-text" id="basic-addon2">255</span>
                                                                                                            </div>
                                                                                                            </div>
                                                                                                    </div>
                                                                                            </div>  
                                                                                            <div class="form-group row align-items-center">
                                                                                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label mb-0">Capacity</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Unlimited">
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class="form-group row align-items-center">
                                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label mb-0">Time options</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="btn-group " role="group" aria-label="Basic example">
                                                                                                        <button type="button" class="btn btn-secondary customized-btn active shadow-none">Duration</button>
                                                                                                        <button type="button" class="btn btn-secondary customized-btn shadow-none ">Time limit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            </div>  
                                                                                            <div class="form-group row">
                                                                                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Start date</label>
                                                                                                    <div class="col-sm-5">
                                                                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Date">
                                                                                                    </div>
                                                                                                    <div class="col-sm-1 d-flex align-items-center px-0 justify-content-center">
                                                                                                        at
                                                                                                    </div>
                                                                                                    <div class="col-sm-2 pr-2">
                                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="11:00">
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Expiration date</label>
                                                                                                    <div class="col-sm-5">
                                                                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Date">
                                                                                                    </div>
                                                                                                    <div class="col-sm-1 d-flex align-items-center px-0 justify-content-center">
                                                                                                        at
                                                                                                    </div>
                                                                                                    <div class="col-sm-2 pr-2">
                                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="11:00">
                                                                                                    </div>
                                                                                            </div>
                                                                                            </form>
                                                                                        </div>

                                                                                        <div class="col-9">
                                                                                            <div class="form-group row pl-4 pr-5 ml-2">
                                                                                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label invisible mb-0 py-1">Password</label>
                                                                                                        <div class="form-check col-sm-9 mt-0">
                                                                                                            <label class="form-check-label ">
                                                                                                            <input type="checkbox" class="form-check-input">
                                                                                                            Retain access for users who have completed the course
                                                                                                            </label>
                                                                                                        </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-7">
                                                                                        <div class="form-group row">
                                                                                                <label class="col-sm-4 col-form-label">Certificate</label>
                                                                                                <div class="col-sm-8">
                                                                                                <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL">Select a cerificate</option>
                                                                                                <option value="WY">Certificate -1</option>
                                                                                                <option value="CE">Certificate -2</option>
                                                                                                <option value="CA">Certificate -3</option>
                                                                                                </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-4 col-form-label">Level</label>
                                                                                                <div class="col-sm-8">
                                                                                                <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL">Select Level</option>
                                                                                                <option value="WY">1</option>
                                                                                                <option value="CE">2</option>
                                                                                                <option value="CA">3</option>
                                                                                                </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>                                                                                   
                                                                                        <hr>                                                                           
                                                                                        <div class="col-7">
                                                                                    
                                                                                        <div class="mb-5">
                                                                                        <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                        <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                                        <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>

                                                                                        </div>
                                                                                        </div>

                                                                                        </div>
                                                                    </div>                    
                                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade " id="addcont" role="tabpanel" aria-labelledby="addcont-tab">
                                                                <div class="card card-border mb-1 shadow-none border-right-0 border-top-0 border-radius-none">
                                                                    <div class="m-1 border-lyt">
                                                                    <div class="row px-3 pt-3">
                                                                        <!-- <div class="dropdown">
                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                Select Content type
                                                                            </button>               
                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="#">content</a>
                                                                            <a class="dropdown-item" href="#">Web content</a>
                                                                            <a class="dropdown-item" href="#">Video</a>
                                                                            <a class="dropdown-item" href="#"> Audio</a>
                                                                            <a class="dropdown-item" href="#">Presentation | Document </a>
                                                                            <a class="dropdown-item" href="#">SCORM | xAPI | cmi5 </a>
                                                                            <a class="dropdown-item" href="#"> iFrame </a>
                                                                            <a class="dropdown-item" href="#"> Test </a>
                                                                            <a class="dropdown-item" href="#"> Survey </a>
                                                                            <a class="dropdown-item" href="#"> Assignment </a>
                                                                            <a class="dropdown-item" href="#"> Instructor-led training </a>
                                                                            <a class="dropdown-item" href="#"> Section </a>
                                                                            <a class="dropdown-item" href="#"> Clone from another course </a>
                                                                            <a class="dropdown-item" href="#"> Link from another course </a>

                                                                            </div>
                                                                            </div>                -->
                                                                            <div class="col-12">
                                                                                <div class="form-sample">
                                                                                    <div class="form-group row">
                                                                                    <label class="col-sm-2 col-form-label mb-0">Select Content type</label>
                                                                                        <div class="col-sm-10">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Select Content type</option>
                                                                                            <option value="WY">Content</option>
                                                                                            <option value="WY">Web content</option>
                                                                                            <option value="WY">Video</option>
                                                                                            <option value="WY">Audio</option>
                                                                                            <option value="WY">Presentation | Document</option>
                                                                                            <option value="WY">SCORM | xAPI | cmi5</option>
                                                                                            <option value="WY">iFrame</option>
                                                                                            <option value="WY">Test</option>
                                                                                            <option value="WY">Survey</option>
                                                                                            <option value="WY">Assignment</option>
                                                                                            <option value="WY">Instructor-led training</option>
                                                                                            <option value="WY">Section</option>
                                                                                            <option value="WY">Clone from another course</option>
                                                                                            <option value="WY">Link from another course</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>      
                                                                    <div class="row px-4 py-3">
                                                                            <div class="p-5 text-center dashed-border">
                                                                                <!-- <button type="button" class="btn btn-primary customized-btn m-2">Revoke</button> -->
                                                                                <button type="button" class="btn btn-outline-danger btn-icon-text customized-btn">
                                                                                    <i class="mdi mdi-upload btn-icon-prepend"></i>                                                    
                                                                                    Upload
                                                                                </button>
                                                                                <h4 class="pt-3">Add content to your course</h4>
                                                                            </div>   
                                                                            <div class="">
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                                <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                            </div>  
                                                                    </div>  
                                                                    </div>           
                                                                </div>
                                                                </div>
                                                               
                                                                <div class="tab-pane fade " id="assign-users" role="tabpanel" aria-labelledby="assign-users-tab">
                                                                <div class="row">
                                                                            <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
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
                                                                                                    <table class="table table-striped">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                            <th scope="col">User Name</th>
                                                                                                            <th scope="col">Email</th>
                                                                                                            <th scope="col">User Type</th>
                                                                                                            <th scope="col" class="text-center">Registration</th>
                                                                                                            <th scope="col" class="text-center">Last Login</th>
                                                                                                            <th scope="col" class="text-center">Options</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
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
                                                    
                                                    <div class="tab-pane fade" id="v-pills2222" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="viewc-tab" data-bs-toggle="tab" data-bs-target="#viewc" type="button" role="tab" aria-controls="viewc" aria-selected="true">View Courses</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue" id="myTab1" role="tablist">
                                                            
                                                                <li class="nav-item">
                                                                    <a class="nav-link nav-s active mr-4 px-3 py-1" id="viewc-tab" data-toggle="tab" href="#viewc" role="tab" aria-controls="viewc" aria-selected="false">View Courses</a>
                                                                </li>
                                                            </ul> -->
                                                                    <div class="row mb-1">
                                                            
                                                                            <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
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
                                                                                <table class="table table-striped">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                        <th scope="col">Course Name</th>
                                                                                                        <th scope="col">Category</th>
                                                                                                        <th scope="col"  class="text-center">Sub Category</th>
                                                                                                        <th scope="col" class="text-center">Last Updated On</th>
                                                                                                        <th scope="col" class="text-center">Options</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td scope="row">Advanced English Test</td>
                                                                                                        <td>Ceco</td>
                                                                                                        <td class="text-center">Ceco-1</td>
                                                                                                        <td class="text-center">11/10/2023</td>
                                                                                                        <td class="text-center">...</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                </table>

                                                                                <div class="tab-content border-0 px-0 py-0 pt-4" id="v-pills-tabContent">
                                                                            <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                                                <div>
                                                                                    <nav>
                                                                                        <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                                            <button class="nav-link active" style="border-bottom: 0px !important;" id="t1-tab" data-bs-toggle="tab" data-bs-target="#t1" type="button" role="tab" aria-controls="t1" aria-selected="true">Assigned Users</button>
                                                                                            <button class="nav-link " style="border-bottom: 0px !important;" id="t2-tab" data-bs-toggle="tab" data-bs-target="#t2" type="button" role="tab" aria-controls="t2" aria-selected="true">Reports</button>
                                                                                            <button class="nav-link " style="border-bottom: 0px !important;" id="t3-tab" data-bs-toggle="tab" data-bs-target="#t3" type="button" role="tab" aria-controls="t3" aria-selected="true">Feedback</button>
                                                                                        </div> 
                                                                                        </nav>
                                                                                    <!-- <ul class="nav nav-tabs background-lytblue border " id="myTab1" role="tablist">
                                                                                    
                                                                                        <li class="nav-item ">
                                                                                            <a class="nav-link mr-5 px-3 py-1" id="t1-tab" data-toggle="tab" href="#t1" role="tab" aria-controls="t1" aria-selected="true">Assigned Users</a>
                                                                                        </li>
                                                                                        <li class="nav-item ">
                                                                                            <a class="nav-link  px-0 py-1" id="t2-tab" data-toggle="tab" href="#t2" role="tab" aria-controls="t2" aria-selected="false">Reports</a>
                                                                                        </li>
                                                                                        
                                                                                    </ul> -->
                                                                                    <div class="tab-content border-0 mt-0 p-0" id="myTabContent">
                                                                            
                                                                                        <div class="tab-pane fade show active " id="t1" role="tabpanel" aria-labelledby="t1-tab">
                                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
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
                                                                                                    <table class="table table-striped">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                            <th scope="col">User Name</th>
                                                                                                            <th scope="col">Email</th>
                                                                                                            <th scope="col">User Type</th>
                                                                                                            <th scope="col" class="text-center">Registration</th>
                                                                                                            <th scope="col" class="text-center">Last Login</th>
                                                                                                            <th scope="col" class="text-center">Options</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                              <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                              <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                              <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">A.SK</td>
                                                                                                            <td>ask@gmail.com</td>
                                                                                                            <td>Learner-Type</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                              <td class="text-center">      
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    
                                                                                                    </div>
                                                                                                </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="tab-pane fade card-border border-top-0" id="t2" role="tabpanel" aria-labelledby="t2-tab">
                                                                                            <div class="row">
                                                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                                                    <div class="work-in-prog">Work In Progress</div>
                                                                                                </div>   
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="tab-pane fade" id="t3" role="tabpanel" aria-labelledby="t3-tab">
                                                                                            <div class="row">
                                                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                                                    <div class="work-in-prog">Work In Progress</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="tab-pane fade" id="t4" role="tabpanel" aria-labelledby="t4-tab">
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
                                                    <div class="tab-pane fade" id="v-add-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="ad-ca-tab" data-bs-toggle="tab" data-bs-target="#ad-ca" type="button" role="tab" aria-controls="ad-ca" aria-selected="true">Add Category</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="ad-ca-tab" data-toggle="tab" href="#ad-ca" role="tab" aria-controls="ad-ca" aria-selected="true">Add Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="ad-ca" role="tabpanel" aria-labelledby="ad-ca-tab">
                                                                   <div class=" border-lyt">
                                                                   <div class="col-7">
                                                                        <form class="forms-sample px-2 pt-3">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Category name</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Add input field" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Status</label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="js-example-basic-single form-select-control">
                                                                                        <option value="AL">Active</option>
                                                                                        <option value="WY">Active</option>
                                                                                        <option value="WY">Inactive</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                    <hr />
                                                                    <div class="col-7">
                                                                        <div class="mb-5 pl-2">
                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                            <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                        </div>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-vi-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="vw-ca-tab" data-bs-toggle="tab" data-bs-target="#vw-ca" type="button" role="tab" aria-controls="vw-ca" aria-selected="true">View Category</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="vw-ca-tab" data-toggle="tab" href="#vw-ca" role="tab" aria-controls="vw-ca" aria-selected="true">View Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="vw-ca" role="tabpanel" aria-labelledby="vw-ca-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
                                                                                <div>
                                                                                <form class="forms-sample p-1 ">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Select a Category</option>
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
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">Category Name</th>
                                                                                                <th scope="col" class="text-center">Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Inactive</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td class="text-center">Inactive</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="tab-content border-0 pt-4 px-0 py-0" id="v-pills-tabContent">
                                                                                    <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                                                        <div>
                                                                                            <nav>
                                                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                                                    <button class="nav-link active" id="t1-au-tab" data-bs-toggle="tab" data-bs-target="#t1-au" type="button" role="tab" aria-controls="t1-au" aria-selected="true">Assigned Users</button>
                                                                                                    <button class="nav-link " id="t2-rept-tab" data-bs-toggle="tab" data-bs-target="#t2-rept" type="button" role="tab" aria-controls="t2-rept" aria-selected="true">Reports</button>
                                                                                                </div>
                                                                                            </nav>
                                                                                            <!-- <ul class="nav nav-tabs background-lytblue border" id="myTab1" role="tablist">
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link mr-5 px-3 py-1" id="t1-au-tab" data-toggle="tab" href="#t1-au" role="tab" aria-controls="t1-au-course" aria-selected="true">Assigned Users</a>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link px-0 py-1" id="t2-rept-tab" data-toggle="tab" href="#t2-rept" role="tab" aria-controls="t2-rept-reports" aria-selected="false">Reports</a>
                                                                                                </li>
                                                                                            </ul> -->
                                                                                            <div class="tab-content card-border border-top-0 mt-0 p-0" id="myTabContent">
                                                                                                <div class="tab-pane fade show active" id="t1-au" role="tabpanel" aria-labelledby="t1-au-tab">
                                                                                                <div class="row">
                                                                                                <div class="col-12">
                                                                                                <div class="card card-border border-top-0 shadow-none rounded-0">
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
                                                                                                                        <table class="table table-striped">
                                                                                                                            <thead>
                                                                                                                                <tr>
                                                                                                                                <th scope="col">User Name</th>
                                                                                                                                <th scope="col">Email</th>
                                                                                                                                <th scope="col">User Type</th>
                                                                                                                                <th scope="col" class="text-center">Registration</th>
                                                                                                                                <th scope="col" class="text-center">Last Login</th>
                                                                                                                                <th scope="col" class="text-center">Options</th>
                                                                                                                                </tr>
                                                                                                                            </thead>
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">      
                                                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">      
                                                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                  <td class="text-center">      
                                                                                                                                        <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                   </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                  <td class="text-center">      
                                                                                                                                        <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                   </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                  <td class="text-center">      
                                                                                                                                        <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                   </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                <td scope="row">A.SK</td>
                                                                                                                                <td>ask@gmail.com</td>
                                                                                                                                <td>Learner-Type</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                <td class="text-center">11/10/2023</td>
                                                                                                                                  <td class="text-center">      
                                                                                                                                        <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                   </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                        
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                                </div>
                                                                                                <div class="tab-pane fade" id="t2-rept" role="tabpanel" aria-labelledby="t4-tab">
                                                                                                    <div class="row">
                                                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
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
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-add-sub-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="ad-su-ca-tab" data-bs-toggle="tab" data-bs-target="#ad-su-ca" type="button" role="tab" aria-controls="ad-su-ca" aria-selected="true">Add Sub Category</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="ad-su-ca-tab" data-toggle="tab" href="#ad-su-ca" role="tab" aria-controls="ad-ca" aria-selected="true">Add Sub Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="ad-su-ca" role="tabpanel" aria-labelledby="ad-su-ca-tab">
                                                                        <div class="border-lyt">
                                                                            <div class="col-7">
                                                                                <form class="forms-sample pt-3 ">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-4 col-form-label">Select Category</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Advanced English Test</option>
                                                                                            <option value="WY">Ceco</option>
                                                                                            </select>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Sub category</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Sub category">
                                                                                    </div>
                                                                                </div>
                                                                                    <div class="form-group row">
                                                                                    <label class="col-sm-4 col-form-label">Status</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Active</option>
                                                                                            <option value="WY">Active</option>
                                                                                            <option value="WY">Inactive</option>
                                                                                            </select>
                                                                                        </div>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                            <hr/>
                                                                            <div class="col-7">
                                                                                <div class="mb-5 pl-2">
                                                                                    <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                    <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                                    <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade mb-1" id="v-vi-sub-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="vw-su-ca-tab" data-bs-toggle="tab" data-bs-target="#vw-su-ca" type="button" role="tab" aria-controls="vw-su-ca" aria-selected="true">View Sub Category</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="vw-su-ca-tab" data-toggle="tab" href="#vw-su-ca" role="tab" aria-controls="vw-ca" aria-selected="true">View Sub Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="vw-su-ca" role="tabpanel" aria-labelledby="vw-su-ca-tab">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
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
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">Category Name</th>
                                                                                                <th scope="col">Sub Category</th>
                                                                                                <th scope="col" class="text-center">Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Active</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Inactive</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Advanced English Test</td>
                                                                                                <td>Ceco</td>
                                                                                                <td class="text-center">Inactive</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="tab-content border-0 pt-4 px-0 py-0" id="v-pills-tabContent">
                                                                                        <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                                                            <div>
                                                                                                <nav>
                                                                                                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                                                        <button class="nav-link active" id="t1-au1-tab" data-bs-toggle="tab" data-bs-target="#t1-au1" type="button" role="tab" aria-controls="t1-au1" aria-selected="true">Assigned Users</button>
                                                                                                        <button class="nav-link" id="t2-rept1-tab" data-bs-toggle="tab" data-bs-target="#t2-rept1" type="button" role="tab" aria-controls="t2-rept1" aria-selected="true">Reports</button>
                                                                                                    </div>
                                                                                                </nav>
                                                                                                <!-- <ul class="nav nav-tabs background-lytblue border" id="myTab1" role="tablist">
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link mr-5 px-3 py-1" id="t1-au1-tab" data-toggle="tab" href="#t1-au1" role="tab" aria-controls="t1-au1-course" aria-selected="true">Assigned Users</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link px-0 py-1" id="t2-rept1-tab" data-toggle="tab" href="#t2-rept1" role="tab" aria-controls="t2-rept1-reports" aria-selected="false">Reports</a>
                                                                                                    </li>
                                                                                                </ul> -->
                                                                                                <div class="tab-content border-0  mt-0 p-0" id="myTabContent">
                                                                                                    <div class="tab-pane card-border border-top-0 fade show active" id="t1-au1" role="tabpanel" aria-labelledby="t1-au1-tab">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12">
                                                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
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
                                                                                                                                    <table class="table table-striped">
                                                                                                                                        <thead>
                                                                                                                                            <tr>
                                                                                                                                            <th scope="col">User Name</th>
                                                                                                                                            <th scope="col">Email</th>
                                                                                                                                            <th scope="col">User Type</th>
                                                                                                                                            <th scope="col" class="text-center">Registration</th>
                                                                                                                                            <th scope="col" class="text-center">Last Login</th>
                                                                                                                                            <th scope="col" class="text-center">Options</th>
                                                                                                                                            </tr>
                                                                                                                                        </thead>
                                                                                                                                        <tbody>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">      
                                                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                            </td>       
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">      
                                                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                            </td>
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                              <td class="text-center">      
                                                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                            </td>
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                              <td class="text-center">      
                                                                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                               </td>
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                              <td class="text-center">      
                                                                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                               </td>
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                                            <td>Learner-Type</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                                                              <td class="text-center">      
                                                                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
                                                                                                                                               </td>
                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                    
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="t2-rept1" role="tabpanel" aria-labelledby="t4-tab">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
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

                                                                <div class="tab-pane fade" id="ex" role="tabpanel" aria-labelledby="ex-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="ac" role="tabpanel" aria-labelledby="ac-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="co" role="tabpanel" aria-labelledby="co-tab">
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3">
                                                                            <div class="work-in-prog">Work In Progress</div>
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
                                    <div class="tab-pane fade" id="ui" role="tabpanel" aria-labelledby="ui-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                            <div>
                                                <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                    <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                                                    <img src="images/icons/add-courses.jpg" alt="">
                                                        <span>Add User</span>
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-pills-user1" role="tab" aria-controls="v-pills-user1" aria-selected="false">
                                                    <img src="images/icons/View-courses.jpg" alt="">
                                                        <span>View User</span>
                                                    </a>
                                                 
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                            <div class="tab-content  pt-1 pr-1 mb-1 border-0 p-0" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                    <div>
                                                        <nav>
                                                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                            <button class="nav-link active" id="ad-tab" data-bs-toggle="tab" data-bs-target="#ad" type="button" role="tab" aria-controls="ad" aria-selected="true">Add Users</button>
                                                            <button class="nav-link" id="vu-tab" data-bs-toggle="tab" data-bs-target="#vu" type="button" role="tab" aria-controls="vu" aria-selected="true">Assign Courses</button>
                                                            <button class="nav-link" id="fil-tab" data-bs-toggle="tab" data-bs-target="#fil" type="button" role="tab" aria-controls="fil" aria-selected="true">Files</button>
                                                            </div>
                                                        </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="ad-tab" data-toggle="tab" href="#ad" role="tab" aria-controls="ad" aria-selected="true">Add User</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1" id="vu-tab" data-toggle="tab" href="#vu" role="tab" aria-controls="vu" aria-selected="false">Assign Courses</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1" id="fil-tab" data-toggle="tab" href="#fil" role="tab" aria-controls="fil" aria-selected="false">Files</a>
                                                                </li>
                                                            </ul> -->
                                                        <div class="tab-content border-0 p-0" id="myTabContent">
                                                            <div class="tab-pane  p-1 card-border border-top-0 fade show active" id="ad" role="tabpanel" aria-labelledby="addc-tab">
                                                            <div class="card mb-2 shadow-none border-radius-none">
                                                                        <div class="row px-5">
                                                                          <div class="col-7">
                                                                          <form class="forms-sample pt-3 ">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">First name</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="e.g. John">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Last name</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="email" class="form-control" id="exampleInputUsername2" placeholder="e.g. Doe">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Email Address</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="e.g. jdoe@example.com">
                                                                                </div>
                                                                            </div>
                                                                           </form>
                                                                          </div>
                                                                          <hr>
                                                                          <div class="col-7">
                                                                             <form class="forms-sample ">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Username</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername2" placeholder="e.g. jdoe">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Password</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Blank for random password">
                                                                                </div>
                                                                            </div>               
                                                                             </form>
                                                                           </div>
                                                                           <hr>
                                                                           <div class="col-9">
                                                                             <form class="forms-sample ">
                                                                             <div class="form-group row">
                                                                                <label for="exampleTextarea1"  class="col-sm-3 col-form-label">Description</label>
                                                                                  <div class="col-sm-9 px-3">
                                                                                  <textarea class="form-control mb-2" id="exampleTextarea1" rows="4"></textarea>
                                                                                  </div>
                                                                             </div>
                                                                             </form>
                                                                           </div>

                                                                           <div class="col-7">
                                                                             <form class="forms-sample ">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Username</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername2" placeholder="e.g. jdoe">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Password</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Blank for random password">
                                                                                </div>
                                                                            </div>               
                                                                             </form>
                                                                           </div>

                                                                           <div class="col-7">
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">User type</label>
                                                                                <div class="col-sm-8">
                                                                                <select class="js-example-basic-single form-select-control">
                                                                                <option value="AL">Admin-Type</option>
                                                                                <option value="WY">User-type</option>
                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Time Zone</label>
                                                                                <div class="col-sm-8">
                                                                                <select class="js-example-basic-single form-select-control">
                                                                                <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                                                                                <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                                                                <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                                                                                <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                                                                                <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                                                                <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                                                                <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                                                                                <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                                                <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                                                                <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                                                                                <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                                                                <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                                                <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                                                                                <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                                                <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                                                                <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                                                                                <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                                                                <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                                                                                <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                                                                                <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                                                                                <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                                                                                <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                                                                                <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                                                                                <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                                                                                <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                                                                                <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                                                                                <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                                                                                <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                                                                                <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                                                <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                                                <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                                                <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                                                <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                                                <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                                                <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                                                                                <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                                                                                <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                                                <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                                                                                <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                                                                                <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                                                                                <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                                                <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                                                                                <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                                                                                <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                                                                                <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                                                <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                                                <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                                                                                <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                                                                                <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                                                                                <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                                                <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                                                                                <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                                                                                <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                                                                                <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                                                                                <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                                                <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                                                                                <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                                                <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                                                                                <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                                                                                <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                                                                                <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                                                                                <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                                                <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                                                                                <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                                                <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                                                <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                                                <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                                                                                <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                                                                                <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                                                <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                                                                                <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                                                                                <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                                                                                <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                                                                                <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                                                                                <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                                                <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                                                                                <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                                                                                <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                                                                                <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                                                <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                                                                                <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                                                <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>

                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                                <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Language</label>
                                                                                <div class="col-sm-8 ">
                                                                                <select class="js-example-basic-single form-select-control">
                                                                                <option value="AF">Afrikaans</option>
                                                                                <option value="SQ">Albanian</option>
                                                                                <option value="AR">Arabic</option>
                                                                                <option value="HY">Armenian</option>
                                                                                <option value="EU">Basque</option>
                                                                                <option value="BN">Bengali</option>
                                                                                <option value="BG">Bulgarian</option>
                                                                                <option value="CA">Catalan</option>
                                                                                <option value="KM">Cambodian</option>
                                                                                <option value="ZH">Chinese (Mandarin)</option>
                                                                                <option value="HR">Croatian</option>
                                                                                <option value="CS">Czech</option>
                                                                                <option value="DA">Danish</option>
                                                                                <option value="NL">Dutch</option>
                                                                                <option value="EN">English</option>
                                                                                <option value="ET">Estonian</option>
                                                                                <option value="FJ">Fiji</option>
                                                                                <option value="FI">Finnish</option>
                                                                                <option value="FR">French</option>
                                                                                <option value="KA">Georgian</option>
                                                                                <option value="DE">German</option>
                                                                                <option value="EL">Greek</option>
                                                                                <option value="GU">Gujarati</option>
                                                                                <option value="HE">Hebrew</option>
                                                                                <option value="HI">Hindi</option>
                                                                                <option value="HU">Hungarian</option>
                                                                                <option value="IS">Icelandic</option>
                                                                                <option value="ID">Indonesian</option>
                                                                                <option value="GA">Irish</option>
                                                                                <option value="IT">Italian</option>
                                                                                <option value="JA">Japanese</option>
                                                                                <option value="JW">Javanese</option>
                                                                                <option value="KO">Korean</option>
                                                                                <option value="LA">Latin</option>
                                                                                <option value="LV">Latvian</option>
                                                                                <option value="LT">Lithuanian</option>
                                                                                <option value="MK">Macedonian</option>
                                                                                <option value="MS">Malay</option>
                                                                                <option value="ML">Malayalam</option>
                                                                                <option value="MT">Maltese</option>
                                                                                <option value="MI">Maori</option>
                                                                                <option value="MR">Marathi</option>
                                                                                <option value="MN">Mongolian</option>
                                                                                <option value="NE">Nepali</option>
                                                                                <option value="NO">Norwegian</option>
                                                                                <option value="FA">Persian</option>
                                                                                <option value="PL">Polish</option>
                                                                                <option value="PT">Portuguese</option>
                                                                                <option value="PA">Punjabi</option>
                                                                                <option value="QU">Quechua</option>
                                                                                <option value="RO">Romanian</option>
                                                                                <option value="RU">Russian</option>
                                                                                <option value="SM">Samoan</option>
                                                                                <option value="SR">Serbian</option>
                                                                                <option value="SK">Slovak</option>
                                                                                <option value="SL">Slovenian</option>
                                                                                <option value="ES">Spanish</option>
                                                                                <option value="SW">Swahili</option>
                                                                                <option value="SV">Swedish </option>
                                                                                <option value="TA">Tamil</option>
                                                                                <option value="TT">Tatar</option>
                                                                                <option value="TE">Telugu</option>
                                                                                <option value="TH">Thai</option>
                                                                                <option value="BO">Tibetan</option>
                                                                                <option value="TO">Tonga</option>
                                                                                <option value="TR">Turkish</option>
                                                                                <option value="UK">Ukrainian</option>
                                                                                <option value="UR">Urdu</option>
                                                                                <option value="UZ">Uzbek</option>
                                                                                <option value="VI">Vietnamese</option>
                                                                                <option value="CY">Welsh</option>
                                                                                <option value="XH">Xhosa</option>

                                                                                </select>
                                                                                </div>                                                         
                                                                                </div>
                                                                           </div>
                                                                           <hr>
                                                                           <div class="col-7">   
                                                                           <div class="form-group row px-4">
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                 <div class="form-check col-sm-8 ">
                                                                                    <label class="form-check-label">
                                                                                    <input type="checkbox" class="form-check-input">
                                                                                    Active
                                                                                    </label>
                                                                                </div>
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                <div class="form-check col-sm-8">
                                                                                    <label class="form-check-label">
                                                                                    <input type="checkbox" class="form-check-input" checked>
                                                                                    Deactivate at..
                                                                                    </label>
                                                                                </div>
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                <div class="form-check col-sm-8">
                                                                                    <label class="form-check-label">
                                                                                    <input type="checkbox" class="form-check-input" disabled>
                                                                                    Exclude from emails
                                                                                    </label>
                                                                                </div>
                                                                                </div>
                                                                           </div>
                                                                           <hr>

                                                                           <div class="col-7">
                                                                                <div class="mb-5">
                                                                                    <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                    <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Add User</button>
                                                                                    <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                                </div>
                                                                            </div>               

                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="tab-pane card-border border-top-0 fade" id="vu" role="tabpanel" aria-labelledby="vu-tab">
                                                                <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                    <div class="card-body p-1 p-0 rounded-0">
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
                                                                                    <table class="table table-striped">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                            <th scope="col">Course Name</th>
                                                                                                            <th scope="col">Category</th>
                                                                                                            <th scope="col" class="text-center">Last Updated On</th>
                                                                                                            <th scope="col" class="text-center">Options</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Advanced English Test</td>
                                                                                                            <td>Ceco</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">
                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                    </table>
                                                                                    </div>
                                                                </div>
                                                                </div>
                                                             
                                                                <div class="tab-pane  card-border border-top-0 fade" id="fil" role="tabpanel" aria-labelledby="fil-tab">
                                                                <div class="card card-border mb-1 shadow-none border-right-0 border-top-0 border-radius-none">
                                                                    <div class="m-1">
                                                                    <div class="row px-3 pt-3">
                                                                </div>
                                                                <div class="col-12">
                                                                                <div class="form-sample">
                                                                                    <div class="form-group row">
                                                                                    <label class="col-sm-2 col-form-label mb-0">Select File type</label>
                                                                                        <div class="col-sm-10">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Select Content type</option>
                                                                                            <option value="WY">Content</option>
                                                                                            <option value="WY">Web content</option>
                                                                                            <option value="WY">Video</option>
                                                                                            <option value="WY">Audio</option>
                                                                                            <option value="WY">Presentation | Document</option>
                                                                                            <option value="WY">SCORM | xAPI | cmi5</option>
                                                                                            <option value="WY">iFrame</option>
                                                                                            <option value="WY">Test</option>
                                                                                            <option value="WY">Survey</option>
                                                                                            <option value="WY">Assignment</option>
                                                                                            <option value="WY">Instructor-led training</option>
                                                                                            <option value="WY">Section</option>
                                                                                            <option value="WY">Clone from another course</option>
                                                                                            <option value="WY">Link from another course</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>      
                                                                    <div class="row px-4 py-3">
                                                                            <div class="p-5 text-center dashed-border">
                                                                                <!-- <button type="button" class="btn btn-primary customized-btn m-2">Revoke</button> -->
                                                                                <button type="button" class="btn btn-outline-danger btn-icon-text customized-btn">
                                                                                    <i class="mdi mdi-upload btn-icon-prepend"></i>                                                    
                                                                                    Upload
                                                                                </button>
                                                                                <h4 class="pt-3">Add File</h4>
                                                                            </div>   
                                                                            <div class="">
                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                                <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                            </div>  
                                                                    </div>  
                                                                    </div>           
                                                                </div>
                                                            <div class="tab-pane fade " id="addcont" role="tabpanel" aria-labelledby="addcont-tab">
                                                            <div class="card mb-2 shadow-none border-0 border-radius-none">
                                                                 <div class="row px-0 p-3">
                                                                     <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            Select Content type
                                                                        </button>               
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item" href="#">content</a>
                                                                        <a class="dropdown-item" href="#">Web content</a>
                                                                        <a class="dropdown-item" href="#">Video</a>
                                                                        <a class="dropdown-item" href="#"> Audio</a>
                                                                        <a class="dropdown-item" href="#">Presentation | Document </a>
                                                                        <a class="dropdown-item" href="#">SCORM | xAPI | cmi5 </a>
                                                                        <a class="dropdown-item" href="#"> iFrame </a>
                                                                        <a class="dropdown-item" href="#"> Test </a>
                                                                        <a class="dropdown-item" href="#"> Survey </a>
                                                                        <a class="dropdown-item" href="#"> Assignment </a>
                                                                        <a class="dropdown-item" href="#"> Instructor-led training </a>
                                                                        <a class="dropdown-item" href="#"> Section </a>
                                                                        <a class="dropdown-item" href="#"> Clone from another course </a>
                                                                        <a class="dropdown-item" href="#"> Link from another course </a>

                                                                        </div>
                                                                        </div>               
                                                                     
                                                                  </div>      
                                                                  <div class="row m-5 p-5">
                                                                          <div class="p-5 text-center dashed-border">
                                                                             <!-- <button type="button" class="btn btn-primary customized-btn m-2">Revoke</button> -->
                                                                             <button type="button" class="btn btn-outline-danger btn-icon-text customized-btn">
                                                                                <i class="mdi mdi-upload btn-icon-prepend"></i>                                                    
                                                                                Upload
                                                                             </button>
                                                                             <h4 class="pt-3">Add content to your course</h4>
                                                                          </div>     
                                                                  </div>                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-user1" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                    <div>
                                                        <nav>
                                                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                            <button class="nav-link active" id="vw-tab" data-bs-toggle="tab" data-bs-target="#vw" type="button" role="tab" aria-controls="vw" aria-selected="true">Users List</button>
                                                            </div>
                                                        </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="vw-tab" data-toggle="tab" href="#vw" role="tab" aria-controls="vw" aria-selected="true">Users List</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="vw" role="tabpanel" aria-labelledby="vw-tab">
                                                                <div class="row">
                                                                        <div class="col-12">
                                                                        <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                            <div class="card-body p-1 rounded-0 p-0">
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
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">User</th>
                                                                                    <th scope="col">Email</th>
                                                                                    <th scope="col">User Type</th>
                                                                                    <th scope="col" class="text-center">Registration</th>
                                                                                    <th scope="col" class="text-center">Last Login</th>
                                                                                    <th scope="col" class="text-center">Options</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td scope="row">A.SK</td>
                                                                                    <td>ask@gmail.com</td>
                                                                                    <td>Learner-Type</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">11/10/2023</td>
                                                                                    <td class="text-center">...</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <div class="tab-content pt-4 border-0 px-0 py-0" id="v-pills-tabContent">
                                                                        <div class="tab-pane fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                                            <div>
                                                                                <nav>
                                                                                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Info</button>
                                                                                    <button class="nav-link" id="t1-course-tab" data-bs-toggle="tab" data-bs-target="#t1-course" type="button" role="tab" aria-controls="t1-course" aria-selected="true">Assigned Courses</button>
                                                                                    <button class="nav-link" id="t2-reports-tab" data-bs-toggle="tab" data-bs-target="#t2-reports" type="button" role="tab" aria-controls="t2-reports" aria-selected="true">Reports</button>
                                                                                    </div>
                                                                                </nav>
                                                                                <!-- <ul class="nav nav-tabs background-lytblue border " id="myTab1" role="tablist">
                                                                                    <li class="nav-item ">
                                                                                        <a class="nav-link mr-5 px-3 py-1 active" id="in-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
                                                                                    </li>
                                                                                    <li class="nav-item ">
                                                                                        <a class="nav-link mr-5 px-3 py-1" id="t1-tab" data-toggle="tab" href="#t1-course" role="tab" aria-controls="t1-course" aria-selected="true">Assigned Courses</a>
                                                                                    </li>
                                                                                    <li class="nav-item ">
                                                                                        <a class="nav-link  px-0 py-1" id="t2-tab" data-toggle="tab" href="#t2-reports" role="tab" aria-controls="t2-reports" aria-selected="false">Reports</a>
                                                                                    </li>
                                                                                </ul> -->
                                                                                <div class="tab-content border-0 mt-0 p-0" id="myTabContent">
                                                                                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="in-tab">
                                                                                <div class="card card-border border-top-0 shadow-none border-radius-none">
                                                                                    <div class="row px-5">
                                                                                    <div class="col-7">
                                                                                        <form class="forms-sample pt-3 ">
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">First name</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="e.g. John">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Last name</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="email" class="form-control" id="exampleInputUsername2" placeholder="e.g. Doe">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Email Address</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="e.g. jdoe@example.com">
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="col-7">
                                                                                        <form class="forms-sample ">
                                                                                        <div class="form-group row">
                                                                                            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Username</label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="text" class="form-control" id="exampleInputUsername2" placeholder="e.g. jdoe">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Password</label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Blank for random password">
                                                                                            </div>
                                                                                        </div>               
                                                                                        </form>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="col-9">
                                                                                        <form class="forms-sample ">
                                                                                        <div class="form-group row">
                                                                                            <label for="exampleTextarea1"  class="col-sm-3 col-form-label">Description</label>
                                                                                            <div class="col-sm-9 px-3">
                                                                                            <textarea class="form-control mb-2" id="exampleTextarea1" rows="4"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>

                                                                                    <div class="col-7">
                                                                                        <form class="forms-sample ">
                                                                                        <div class="form-group row">
                                                                                            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Username</label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="text" class="form-control" id="exampleInputUsername2" placeholder="e.g. jdoe">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Password</label>
                                                                                            <div class="col-sm-8">
                                                                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Blank for random password">
                                                                                            </div>
                                                                                        </div>               
                                                                                        </form>
                                                                                    </div>

                                                                                    <div class="col-7">
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-4 col-form-label">User type</label>
                                                                                            <div class="col-sm-8">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Admin-Type</option>
                                                                                            <option value="WY">User-type</option>
                                                                                            </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-4 col-form-label">Time Zone</label>
                                                                                            <div class="col-sm-8">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                                                                                            <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                                                                            <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                                                                                            <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                                                                                            <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                                                                            <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                                                                            <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                                                                                            <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                                                            <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                                                                            <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                                                                                            <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                                                                            <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                                                            <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                                                                                            <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                                                            <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                                                                            <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                                                                                            <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                                                                            <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                                                                                            <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                                                                                            <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                                                                                            <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                                                                                            <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                                                                                            <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                                                                                            <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                                                                                            <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                                                                                            <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                                                                                            <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                                                                                            <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                                                                                            <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                                                            <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                                                            <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                                                            <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                                                            <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                                                            <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                                                            <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                                                                                            <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                                                                                            <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                                                            <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                                                                                            <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                                                                                            <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                                                                                            <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                                                            <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                                                                                            <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                                                                                            <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                                                                                            <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                                                            <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                                                            <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                                                                                            <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                                                                                            <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                                                                                            <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                                                            <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                                                                                            <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                                                                                            <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                                                                                            <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                                                                                            <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                                                            <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                                                                                            <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                                                            <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                                                                                            <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                                                                                            <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                                                                                            <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                                                                                            <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                                                            <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                                                                                            <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                                                            <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                                                            <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                                                            <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                                                                                            <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                                                                                            <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                                                            <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                                                                                            <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                                                                                            <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                                                                                            <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                                                                                            <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                                                                                            <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                                                            <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                                                                                            <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                                                                                            <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                                                                                            <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                                                            <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                                                                                            <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                                                            <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>

                                                                                            </select>
                                                                                            </div>
                                                                                        </div>
                                                                                            <div class="form-group row">
                                                                                            <label class="col-sm-4 col-form-label">Language</label>
                                                                                            <div class="col-sm-8 ">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AF">Afrikaans</option>
                                                                                            <option value="SQ">Albanian</option>
                                                                                            <option value="AR">Arabic</option>
                                                                                            <option value="HY">Armenian</option>
                                                                                            <option value="EU">Basque</option>
                                                                                            <option value="BN">Bengali</option>
                                                                                            <option value="BG">Bulgarian</option>
                                                                                            <option value="CA">Catalan</option>
                                                                                            <option value="KM">Cambodian</option>
                                                                                            <option value="ZH">Chinese (Mandarin)</option>
                                                                                            <option value="HR">Croatian</option>
                                                                                            <option value="CS">Czech</option>
                                                                                            <option value="DA">Danish</option>
                                                                                            <option value="NL">Dutch</option>
                                                                                            <option value="EN">English</option>
                                                                                            <option value="ET">Estonian</option>
                                                                                            <option value="FJ">Fiji</option>
                                                                                            <option value="FI">Finnish</option>
                                                                                            <option value="FR">French</option>
                                                                                            <option value="KA">Georgian</option>
                                                                                            <option value="DE">German</option>
                                                                                            <option value="EL">Greek</option>
                                                                                            <option value="GU">Gujarati</option>
                                                                                            <option value="HE">Hebrew</option>
                                                                                            <option value="HI">Hindi</option>
                                                                                            <option value="HU">Hungarian</option>
                                                                                            <option value="IS">Icelandic</option>
                                                                                            <option value="ID">Indonesian</option>
                                                                                            <option value="GA">Irish</option>
                                                                                            <option value="IT">Italian</option>
                                                                                            <option value="JA">Japanese</option>
                                                                                            <option value="JW">Javanese</option>
                                                                                            <option value="KO">Korean</option>
                                                                                            <option value="LA">Latin</option>
                                                                                            <option value="LV">Latvian</option>
                                                                                            <option value="LT">Lithuanian</option>
                                                                                            <option value="MK">Macedonian</option>
                                                                                            <option value="MS">Malay</option>
                                                                                            <option value="ML">Malayalam</option>
                                                                                            <option value="MT">Maltese</option>
                                                                                            <option value="MI">Maori</option>
                                                                                            <option value="MR">Marathi</option>
                                                                                            <option value="MN">Mongolian</option>
                                                                                            <option value="NE">Nepali</option>
                                                                                            <option value="NO">Norwegian</option>
                                                                                            <option value="FA">Persian</option>
                                                                                            <option value="PL">Polish</option>
                                                                                            <option value="PT">Portuguese</option>
                                                                                            <option value="PA">Punjabi</option>
                                                                                            <option value="QU">Quechua</option>
                                                                                            <option value="RO">Romanian</option>
                                                                                            <option value="RU">Russian</option>
                                                                                            <option value="SM">Samoan</option>
                                                                                            <option value="SR">Serbian</option>
                                                                                            <option value="SK">Slovak</option>
                                                                                            <option value="SL">Slovenian</option>
                                                                                            <option value="ES">Spanish</option>
                                                                                            <option value="SW">Swahili</option>
                                                                                            <option value="SV">Swedish </option>
                                                                                            <option value="TA">Tamil</option>
                                                                                            <option value="TT">Tatar</option>
                                                                                            <option value="TE">Telugu</option>
                                                                                            <option value="TH">Thai</option>
                                                                                            <option value="BO">Tibetan</option>
                                                                                            <option value="TO">Tonga</option>
                                                                                            <option value="TR">Turkish</option>
                                                                                            <option value="UK">Ukrainian</option>
                                                                                            <option value="UR">Urdu</option>
                                                                                            <option value="UZ">Uzbek</option>
                                                                                            <option value="VI">Vietnamese</option>
                                                                                            <option value="CY">Welsh</option>
                                                                                            <option value="XH">Xhosa</option>

                                                                                            </select>
                                                                                            </div>                                                         
                                                                                            </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="col-7">   
                                                                                    <div class="form-group row px-4">
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                            <div class="form-check col-sm-8 ">
                                                                                                <label class="form-check-label">
                                                                                                <input type="checkbox" class="form-check-input">
                                                                                                Active
                                                                                                </label>
                                                                                            </div>
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                            <div class="form-check col-sm-8">
                                                                                                <label class="form-check-label">
                                                                                                <input type="checkbox" class="form-check-input" checked>
                                                                                                Deactivate at..
                                                                                                </label>
                                                                                            </div>
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                            <div class="form-check col-sm-8">
                                                                                                <label class="form-check-label">
                                                                                                <input type="checkbox" class="form-check-input" disabled>
                                                                                                Exclude from emails
                                                                                                </label>
                                                                                            </div>
                                                                                            </div>
                                                                                    </div>
                                                                                    <hr>

                                                                                    <div class="col-7">
                                                                                        <div class="mb-5">
                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                            <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Add User</button>
                                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
                                                                                        </div>
                                                                                    </div>

                                                                                    </div>
                                                                                </div>
                                                                                </div>
                                                                                    <div class="tab-pane fade " id="t1-course" role="tabpanel" aria-labelledby="t1-tab">
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                        <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                            <div class="card-body p-1 rounded-0 p-0">
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
                                                                                            
                                                                                            <table class="table table-striped">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                    <th scope="col">Course</th>
                                                                                                    <th scope="col">Category</th>
                                                                                                    <th scope="col" class="text-center">Last Updated On</th>
                                                                                                    <th scope="col" class="text-center">Options</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                    <td scope="row">Advanced English Test</td>
                                                                                                    <td>Ceco</td>
                                                                                                    <td class="text-center">11/10/2023</td>
                                                                                                    <td class="text-center">
                                                                                                    <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="tab-pane card-border border-top-0  fade" id="t2-reports" role="tabpanel" aria-labelledby="t2-tab">
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
                                                </div>
                                                <div class="tab-pane fade" id="v-pills3333" role="tabpanel" aria-labelledby="v-pills-tab-three">Aircraft & Aerospace</div>
                                                <div class="tab-pane fade" id="v-pills4444" role="tabpanel" aria-labelledby="v-pills-tab-four">Customized Engineering services</div>
                                        </div>
                                    </div>
                                    </div> 
                                    </div>
                                    <div class="tab-pane fade" id="fm" role="tabpanel" aria-labelledby="fm-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                            <div>
                                                <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                    <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-user-report" role="tab" aria-controls="v-user-report" aria-selected="true">
                                                    <img src="images/icons/user-reports.jpg" alt="">
                                                        <span>Users Reports</span>
                                                
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-course-report" role="tab" aria-controls="v-course-report" aria-selected="false">
                                                    <img src="images/icons/courses-reports.jpg" alt="">
                                                        <span>Courses Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-branches-report" role="tab" aria-controls="v-branches-report" aria-selected="true">
                                                    <img src="images/icons/branches-reports.jpg" alt="">
                                                        <span>Branches Reports</span>
                                                
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-groups-report" role="tab" aria-controls="v-groups-report" aria-selected="false">
                                                    <img src="images/icons/grp-reports.jpg" alt="">
                                                        <span>Groups Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-scorm-report" role="tab" aria-controls="v-scorm-report" aria-selected="true">
                                                    <img src="images/icons/scorm-reports.jpg" alt="">
                                                        <span>Scorm Reports</span>
                                                
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-tests-report" role="tab" aria-controls="v-tests-report" aria-selected="false">
                                                    <img src="images/icons/test-reports.jpg" alt="">
                                                        <span>Tests Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-survey-report" role="tab" aria-controls="v-survey-report" aria-selected="true">
                                                    <img src="images/icons/survey-reports.jpg" alt="">
                                                        <span>Survey Reports</span>
                                                
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-assigmnets-rep" role="tab" aria-controls="v-assigmnets-rep" aria-selected="false">
                                                    <img src="images/icons/assignment-reports.jpg" alt="">
                                                        <span>Assignments Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-ilts-rep" role="tab" aria-controls="v-ilts-rep" aria-selected="true">
                                                    <img src="images/icons/ilts-reports.jpg" alt="">
                                                        <span>ILTs Reports</span>
                                                
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-info-rep" role="tab" aria-controls="v-info-rep" aria-selected="false">
                                                    <img src="images/icons/infographic.jpg" alt="">
                                                        <span>Infographics Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-training-rep" role="tab" aria-controls="v-training-rep" aria-selected="false">
                                                    <img src="images/icons/traininig-matrix-reports.jpg" alt="">
                                                        <span>Training matrix Reports</span>
                                                    </a>
                                                    <a class="nav-link nav-s  border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-timeline-rep" role="tab" aria-controls="v-timeline-rep" aria-selected="true">
                                                    <img src="images/icons/time-line-reports.jpg" alt="">
                                                        <span>Timeline Reports</span>
                                                
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                            <div class="tab-content border-0 p-0" id="v-pills-tabContent">
                                                
                                                <div class="tab-pane py-1 pr-1 fade show active" id="v-user-report" role="tabpanel" aria-labelledby="v-user-report">
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
                                                                        <div class="card  card-border border-top-0 shadow-none rounded-0">
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                                                                            <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
                                                                        <div class="tab-pane pt-4 fade show active" id="v-pills111" role="tabpanel" aria-labelledby="v-pills-tab-one">
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
                                                                                                <div class="card-body p-1 rounded-0 p-0">
                                                                                            
                                                                                                                    <table class="table table-striped">
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
                                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Assign</button> 
                                                                                                                            </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                            <td scope="row">A.SK</td>
                                                                                                                            <td>ask@gmail.com</td>
                                                                                                                            <td>Learner-Type</td>
                                                                                                                            <td>11/10/2023</td>
                                                                                                                            <td>11/10/2023</td>
                                                                                                                            <td class="text-center">      
                                                                                                                                <button type="button" class="btn btn-primary customized-btn1 mx-2">Revoke</button>
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

                                                <div class="tab-pane py-1 pr-1 fade show" id="v-course-report" role="tabpanel" aria-labelledby="v-course-report">
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
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                                <div class="tab-pane py-1 pr-1 fade show" id="v-branches-report" role="tabpanel" aria-labelledby="v-branches-report">
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
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                                <div class="tab-pane fade  py-1 pr-1" id="v-groups-report" role="tabpanel" aria-labelledby="v-groups-report">
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
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                                <div class="tab-pane fade  py-1 pr-1" id="v-tests-report" role="tabpanel" aria-labelledby="v-tests-report">
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
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                                <div class="tab-pane fade  py-1 pr-1" id="v-assigmnets-rep" role="tabpanel" aria-labelledby="v-assigmnets-rep">
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
                                                                            <div class="card-body p-1 rounded-0">
                                                                            <table class="table table-striped">
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
                                    <div class="tab-pane fade" id="ut" role="tabpanel" aria-labelledby="ut-tab">
                                    <div class="row">
                                        <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                            <div>
                                                <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                    <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                                                    <img src="images/icons/add-courses.jpg" alt="">
                                                        <span>Add User Types</span>
                                                    </a>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1 p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-pills1111" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="add-ut-tab" data-bs-toggle="tab" data-bs-target="#addc" type="button" role="tab" aria-controls="addc" aria-selected="true">Add User Types</button>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content border-left-0 border-bottom-0 p-0" id="navtabContent">
                                                                <div class="tab-pane fade show active" id="add-ut" role="tabpanel" aria-labelledby="addc-tab">
                                                                <div class="card card-border mb-1 shadow-none border-radius-none border-top-0 border-right-0">
                                                                    <div class="m-1 border-lyt">
                                                                    <div class="row pl-3 pr-5 justify-content-between">
                                                                                        <div class="col-7">
                                                                                            <form class="forms-sample pt-3 ">
                                                                                                <div class="form-group row">
                                                                                                        <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Course Code</label>
                                                                                                        <div class="col-sm-8">
                                                                                                        <div class="input-group mb-0">
                                                                                                            <input type="text" class="form-control" placeholder="e.g. manager" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Administrator
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Users
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Courses
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Groups
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Categories
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Branches
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>
                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Events engine
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Import - Export
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               User types
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Account & Settings
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Reports
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Instructor
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>                       

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Courses
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Groups
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Reports
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Conferences
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                              Discussions
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Learner
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>                       

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Course
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Course Catalog
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                            Conferences
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                              Discussions
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Calendar
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                        <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                             Progress
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                        <div class="form-check col-10 mt-0  pl-4 ml-2">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Gamification
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center">
                                                                                                       <div class="col-2 mt-1">
                                                                                                       <i class="bi bi-caret-right-fill"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-1">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               General
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>         

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                              Messages
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                       <div class="col-2 mt-0">
                                                                                                       <i class="bi bi-caret-right"></i>
                                                                                                       </div>
                                                                                                        <div class="form-check col-10 mt-0">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Profile
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                        <div class="form-check col-10 mt-0 pl-4 ml-2">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                             Help
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="row d-flex align-items-center pl-4 ml-1">
                                                                                                        <div class="form-check col-10 mt-0  pl-4 ml-2">
                                                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                                            <label class="form-check-label ml-0 mb-0 mt-1" for="flexCheckDefault">
                                                                                                               Timeline
                                                                                                            </label>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>

                                                                                        <hr>                                                                           
                                                                                        <div class="col-7">
                                                                                    
                                                                                        <div class="mb-5">
                                                                                        <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                        <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Save</button>
                                                                                        <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>

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
                                    <div class="tab-pane fade" id="fi" role="tabpanel" aria-labelledby="fi-tab">
                                    <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#import" role="tab" aria-controls="import" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Import</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#export" role="tab" aria-controls="export" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>Export</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1  p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="import" role="tabpanel" aria-labelledby="import">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="imp-data-tab" data-bs-toggle="tab" data-bs-target="#imp-data" type="button" role="tab" aria-controls="imp-data" aria-selected="true">Import Data</button>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="imp-data" role="tabpanel" aria-labelledby="imp-data-tab">
                                                                   <div class=" border-lyt">
                                                                   <div class="d-flex justify-content-end pt-2 px-3">
                                                                   <button class="btn"><i class="bi bi-download"></i> Download file</button>
                                                                    </div>
                                                                   <div class="row px-4 py-3">
                                                                            <div class="p-4 text-center dashed-border">
                                                                              
                                                                                <!-- <button type="button" class="btn btn-outline-danger btn-icon-text customized-btn">
                                                                                    <i class="mdi mdi-upload btn-icon-prepend"></i>                                                    
                                                                                    Upload
                                                                                </button> -->
                                                                                <div class="input-group my-3 col-sm-4 mx-auto">
                                                                            
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                </div>
                                                                                </div>
                                                                                    <h4 class="pt-3">Drop a csv or excel file here or browse </h4>
                                                                                </div> 
                                                                    </div>

                                                                    <div class="form-group row align-items-center">
                                                                        <label for="exampleTextarea1" class="col-form-label pb-0 px-4">Import description. (Note that you can copy/paste data from Excel directly)</label>
                                                                        <div class="px-4 pb-3 ">
                                                                        <textarea class="form-control" id="exampleTextarea1" placeholder="" rows="25"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="col-7">
                                                                       
                                                                            <div class="btn-group mr-3 mb-3">
                                                                            <button class="btn btn-secondary btn-sm customized-btn-green px-5 py-2 "  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                           Import 
                                                                            </button>
                                                                            </div>
                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2 mb-3">Cancel</button>
                                                                    </div>
                                                                  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="export" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="exp-data-tab" data-bs-toggle="tab" data-bs-target="#exp-data" type="button" role="tab" aria-controls="exp-data" aria-selected="true">Export Data</button>
                                                                </div>
                                                            </nav>
                                                           
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="exp-data" role="tabpanel" aria-labelledby="exp-data-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
                                                                                    <div class="col-7">

                                                                                        <form class="forms-sample px-2 pt-3">
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Export type</label>
                                                                                                <div class="col-sm-8 pl-1">
                                                                                                    <select class="form-select-control">
                                                                                                        <option value="">Export Basic</option>
                                                                                                        <option value="all">Export All</option>
                                                                                                        <option value="selected">Export Selected</option>
                                                                                                        <option value="">CSV</option>
                                                                                                        <option value="">MS-Excel</option>
                                                                                                        <option value="">XML</option>

                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                
                                                                                    <hr>

                                                                                    <div class="col-7">
                                                                                        <label for="exampleInputPassword2" class="col-sm-4 pt-0 col-form-label invisible">Password</label>
                                                                                            <div class="btn-group mr-3 mb-3">
                                                                                            <button class="btn btn-secondary btn-sm customized-btn-green px-5 py-2 "  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            Export
                                                                                            </button>
                                                                                            </div>
                                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2 mb-3">Cancel</button>
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
                                    <div class="tab-pane fade" id="au" role="tabpanel" aria-labelledby="au-tab">
                                    <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#v-add-au" role="tab" aria-controls="v-add-au" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Add Automation</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#v-vi-au" role="tab" aria-controls="v-vi-au" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>View Automation</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1  p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-add-au" role="tabpanel" aria-labelledby="v-add-au">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="ad-au-tab" data-bs-toggle="tab" data-bs-target="#ad-au" type="button" role="tab" aria-controls="ad-au" aria-selected="true">Add Automation</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="ad-ca-tab" data-toggle="tab" href="#ad-ca" role="tab" aria-controls="ad-ca" aria-selected="true">Add Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="ad-au" role="tabpanel" aria-labelledby="ad-au-tab">
                                                                   <div class=" border-lyt">
                                                                   <div class="col-7">
                                                                        <form class="forms-sample px-2 pt-3">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Name</label>
                                                                                <div class="col-sm-8 pl-1">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Assign course (24hours)" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Status</label>
                                                                                <div class="col-sm-8 pl-1">
                                                                                    <select class="js-example-basic-single form-select-control">
                                                                                        <option value="AL">Select an automation</option>
                                                                                        <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                        <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                        <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                        <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                        <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                        <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                        <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>                             
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-12 pl-4">
                                                                           <div class="row align-items-center">
                                                                           <label for="exampleInputPassword2" class="col-sm-2 col-form-label ">Action</label>
                                                                            <div class="col-sm-10 pl-4 pr-2">
                                                                               <div class="card">
                                                                               <div class="row align-items-center px-4 pt-4">
                                                                               <div class="col-sm-5 pl-3 pr-0">
                                                                                    <div class="row align-items-center">
                                                                                    <input type="text" class="col-sm-2 form-control" id="exampleInputUsername1" /> 
                                                                                    <div class="col-sm-10 pr-0 ">
                                                                                    hours after the course completion
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-7 pl-0">
                                                                                    <div class="row">
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Category</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Sub Category</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Course</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                               </div>
                                                                               <div class="pl-4 pt-3">
                                                                                On completion
                                                                               </div>
                                                                               <div class="col-sm-12 pl-4 pt-3 pb-4">
                                                                                    <div class="row align-items-center">
                                                                                    
                                                                                    <div class="col-sm-2 pr-0 ">
                                                                                    Assign Course
                                                                                    </div>
                                                                                    <div class="col-sm-10 pl-0">
                                                                                    <div class="row">
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Category</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Sub Category</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                        <div class="col-4 pl-0">
                                                                                        <select class="js-example-basic-single form-select-control">
                                                                                            <option value="AL">Course</option>
                                                                                            <option value="WY">Z hours after course X assignment, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X completion, with a score between K and L, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X failure, assign course(s) Y</option>
                                                                                            <option value="WY">Z hours after course X certification expiration, reset and assign course(s) Y</option>
                                                                                            <option value="WY">Z hours before course X expiration, assign course(s) Y</option>
                                                                                        </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                               </div>
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <hr />
                                                                    <div class="col-7">
                                                                        <label for="exampleInputPassword2" class="col-sm-4 pt-0 col-form-label invisible">Password</label>
                                                                            <div class="btn-group mr-3 mb-3">
                                                                            <button class="btn btn-secondary btn-sm customized-btn-green dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                               Add Automation
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                ...
                                                                            </div>
                                                                            </div>

                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2 mb-3">Cancel</button>
<!-- 
                                                                            <div class="mb-5">
                                                                                        <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                        <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Submit</button>
                                                                                        <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>

                                                                                        </div> -->
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-vi-au" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="vw-au-tab" data-bs-toggle="tab" data-bs-target="#vw-au" type="button" role="tab" aria-controls="vw-au" aria-selected="true">View Automation</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="vw-au-tab" data-toggle="tab" href="#vw-au" role="tab" aria-controls="vw-au" aria-selected="true">View Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="vw-au" role="tabpanel" aria-labelledby="vw-au-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">Name</th>
                                                                                                <th scope="col">Automations</th>
                                                                                                <th scope="col" class="text-center">Operations</th>

                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td scope="row">Assign a course 1hr after another one is completed</td>
                                                                                                <td >Z hours after course X completion, assign course(s) Y</td>
                                                                                                <td class="text-center">...</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">Assign course (24hours)</td>
                                                                                                <td >Z hours after course X completion, assign course(s) Y</td>
                                                                                                <td class="text-center">...</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td scope="row">When a certificate expires reset and assign the course</td>
                                                                                                <td >Z hours before course X certification expiration, reset and  assign course(s) Y</td>
                                                                                                <td class="text-center">...</td>
                                                                                            </tr>
                                                                                       
                                                                                        </tbody>
                                                                                    </table>
                                           
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
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-pills3333" role="tabpanel" aria-labelledby="v-pills-tab-three">Aircraft & Aerospace</div>
                                                    <div class="tab-pane fade" id="v-pills4444" role="tabpanel" aria-labelledby="v-pills-tab-four">Customized Engineering services</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="st" role="tabpanel" aria-labelledby="st-tab">
                                    <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#logo-app" role="tab" aria-controls="logo-app" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Logo & Application Name</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#d-t-c-st" role="tab" aria-controls="d-t-c-st" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>Date & Time Currency Settings</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#conf" role="tab" aria-controls="conf" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>Conferences</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1  p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="logo-app" role="tabpanel" aria-labelledby="logo-app">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="ad-au-tab" data-bs-toggle="tab" data-bs-target="#ad-au" type="button" role="tab" aria-controls="ad-au" aria-selected="true">Logo & Application Name</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="ad-ca-tab" data-toggle="tab" href="#ad-ca" role="tab" aria-controls="ad-ca" aria-selected="true">Add Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="ad-au" role="tabpanel" aria-labelledby="ad-au-tab">
                                                                   <div class=" border-lyt">
                                                                   <div class="col-7">
                                                                        <form class="forms-sample px-2 pt-3">
                                                                            <div class="form-group row">
                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Site Name</label>
                                                                                <div class="col-sm-8 pl-1">
                                                                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Site name" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row align-items-center">
                                                                                <label for="exampleTextarea1" class="col-sm-4 col-form-label">Site Description</label>
                                                                                <div class="col-sm-8 pl-1 ">
                                                                                <textarea class="form-control" id="exampleTextarea1" placeholder="Add a Site description up to 500 characters " rows="3"></textarea>
                                                                                </div>
                                                                            </div>       
                                                                            
                                                                            <div class="input-group my-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text p-2">Upload</span>
                                                                            </div>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                            </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="d-t-c-st" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="vw-au-tab" data-bs-toggle="tab" data-bs-target="#vw-au" type="button" role="tab" aria-controls="vw-au" aria-selected="true">Date & Time Currency Settings</button>
                                                                </div>
                                                            </nav>
                                                            <!-- <ul class="nav nav-tabs background-lytblue border-bottom" id="myTab1" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link mr-5 px-3 py-1 active" id="vw-au-tab" data-toggle="tab" href="#vw-au" role="tab" aria-controls="vw-au" aria-selected="true">View Category</a>
                                                                </li>
                                                            </ul> -->
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="vw-au" role="tabpanel" aria-labelledby="vw-au-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
                                                                                    <div class="col-7">
                                                                                    <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Language</label>
                                                                                <div class="col-sm-8 ">
                                                                                <select class="js-example-basic-single form-select-control">
                                                                                <option value="AF">Afrikaans</option>
                                                                                <option value="SQ">Albanian</option>
                                                                                <option value="AR">Arabic</option>
                                                                                <option value="HY">Armenian</option>
                                                                                <option value="EU">Basque</option>
                                                                                <option value="BN">Bengali</option>
                                                                                <option value="BG">Bulgarian</option>
                                                                                <option value="CA">Catalan</option>
                                                                                <option value="KM">Cambodian</option>
                                                                                <option value="ZH">Chinese (Mandarin)</option>
                                                                                <option value="HR">Croatian</option>
                                                                                <option value="CS">Czech</option>
                                                                                <option value="DA">Danish</option>
                                                                                <option value="NL">Dutch</option>
                                                                                <option value="EN" selected>English</option>
                                                                                <option value="ET">Estonian</option>
                                                                                <option value="FJ">Fiji</option>
                                                                                <option value="FI">Finnish</option>
                                                                                <option value="FR">French</option>
                                                                                <option value="KA">Georgian</option>
                                                                                <option value="DE">German</option>
                                                                                <option value="EL">Greek</option>
                                                                                <option value="GU">Gujarati</option>
                                                                                <option value="HE">Hebrew</option>
                                                                                <option value="HI">Hindi</option>
                                                                                <option value="HU">Hungarian</option>
                                                                                <option value="IS">Icelandic</option>
                                                                                <option value="ID">Indonesian</option>
                                                                                <option value="GA">Irish</option>
                                                                                <option value="IT">Italian</option>
                                                                                <option value="JA">Japanese</option>
                                                                                <option value="JW">Javanese</option>
                                                                                <option value="KO">Korean</option>
                                                                                <option value="LA">Latin</option>
                                                                                <option value="LV">Latvian</option>
                                                                                <option value="LT">Lithuanian</option>
                                                                                <option value="MK">Macedonian</option>
                                                                                <option value="MS">Malay</option>
                                                                                <option value="ML">Malayalam</option>
                                                                                <option value="MT">Maltese</option>
                                                                                <option value="MI">Maori</option>
                                                                                <option value="MR">Marathi</option>
                                                                                <option value="MN">Mongolian</option>
                                                                                <option value="NE">Nepali</option>
                                                                                <option value="NO">Norwegian</option>
                                                                                <option value="FA">Persian</option>
                                                                                <option value="PL">Polish</option>
                                                                                <option value="PT">Portuguese</option>
                                                                                <option value="PA">Punjabi</option>
                                                                                <option value="QU">Quechua</option>
                                                                                <option value="RO">Romanian</option>
                                                                                <option value="RU">Russian</option>
                                                                                <option value="SM">Samoan</option>
                                                                                <option value="SR">Serbian</option>
                                                                                <option value="SK">Slovak</option>
                                                                                <option value="SL">Slovenian</option>
                                                                                <option value="ES">Spanish</option>
                                                                                <option value="SW">Swahili</option>
                                                                                <option value="SV">Swedish </option>
                                                                                <option value="TA">Tamil</option>
                                                                                <option value="TT">Tatar</option>
                                                                                <option value="TE">Telugu</option>
                                                                                <option value="TH">Thai</option>
                                                                                <option value="BO">Tibetan</option>
                                                                                <option value="TO">Tonga</option>
                                                                                <option value="TR">Turkish</option>
                                                                                <option value="UK">Ukrainian</option>
                                                                                <option value="UR">Urdu</option>
                                                                                <option value="UZ">Uzbek</option>
                                                                                <option value="VI">Vietnamese</option>
                                                                                <option value="CY">Welsh</option>
                                                                                <option value="XH">Xhosa</option>

                                                                                </select>
                                                                                </div>                                                         
                                                                                </div>
                                                                                    <div class="form-group row">
                                                                                <label class="col-sm-4 col-form-label">Default Time Zone</label>
                                                                                <div class="col-sm-8">
                                                                                <select class="js-example-basic-single form-select-control">
                                                                                <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                                                                                <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                                                                <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                                                                                <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                                                                                <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                                                                <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                                                                <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                                                                                <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                                                <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                                                                <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                                                                                <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                                                                <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                                                <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                                                                                <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                                                <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                                                                <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                                                                                <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                                                                <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                                                                                <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                                                                                <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                                                                                <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                                                                                <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                                                                                <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                                                                                <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                                                                                <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                                                                                <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                                                                                <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                                                                                <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                                                                                <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                                                <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                                                <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                                                <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                                                <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                                                <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                                                <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                                                                                <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                                                                                <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                                                <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                                                                                <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                                                                                <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                                                                                <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                                                <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                                                                                <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                                                                                <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                                                                                <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                                                <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                                                <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                                                                                <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                                                                                <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                                                                                <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                                                <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                                                                                <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                                                                                <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                                                                                <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                                                                                <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                                                <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                                                                                <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5" selected>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                                                <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                                                                                <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                                                                                <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                                                                                <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                                                                                <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                                                <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                                                                                <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                                                <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                                                <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                                                <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                                                                                <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                                                                                <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                                                <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                                                                                <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                                                                                <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                                                                                <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                                                                                <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                                                                                <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                                                <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                                                                                <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                                                                                <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                                                                                <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                                                <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                                                                                <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                                                <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>

                                                                                </select>
                                                                                </div>
                                                                                    </div>
                                                                                    <!-- <label for="Date Format"> 
                                                                                            Date Format: 
                                                                                        <input type="date" name="date"> 
                                                                                    </label> 
                                                                                    </div> -->

                                                                                    <div class="form-group row">
                                                                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label">  Date Format</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="date" class="form-control"  name="date" id="exampleInputUsername1">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label for="time" class="col-sm-4 col-form-label">  Time Format</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="time" class="form-control" id="time" name="time">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                                <label class="col-sm-4 col-form-label">Currency</label>
                                                                                                <div class="col-sm-8">
                                                                                                <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL" selected>US Dollar</option>
                                                                                                <option value="WY">Rupee</option>
                                                                                                </select>
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
                                                                            <div class="work-in-prog">Work In Progress</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                  
                                                    </div>
                                                    <div class="tab-pane fade" id="conf" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="conference-tab" data-bs-toggle="tab" data-bs-target="#conference"
                                                                        type="button" role="tab" aria-controls="conference" aria-selected="true">Conferences</button>
                                                                </div>
                                                            </nav>
                                                    
                                                        <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="conference" role="tabpanel" aria-labelledby="conference-tab">
                                                                <div class="row ">
                                                                    <div class="col-12">
                                                                        <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                            <div class="card-body p-1 p-0 rounded-0">
                                                                                <div class="col-7">

                                                                                    <div class="form-group row pt-3">
                                                                                        <label class="col-sm-4 col-form-label">Currency</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                                <option value="AL" selected>Integrated video conference</option>
                                                                                                <option value="WY">Rupee</option>
                                                                                            </select>
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
                                                    <div class="tab-pane fade" id="v-pills3333" role="tabpanel" aria-labelledby="v-pills-tab-three">Aircraft & Aerospace</div>
                                                    <div class="tab-pane fade" id="v-pills4444" role="tabpanel" aria-labelledby="v-pills-tab-four">Customized Engineering services</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#view-profile" role="tab" aria-controls="view-profile" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>View Profile</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1 p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="view-profile" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="view-p-tab" data-bs-toggle="tab" data-bs-target="#view-p" type="button" role="tab" aria-controls="view-p" aria-selected="true">View Profile</button>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content border-left-0 border-bottom-0 p-0" id="navtabContent">
                                                                <div class="tab-pane fade show active" id="view-p" role="tabpanel" aria-labelledby="view-p-tab">
                                                                    <div class="card mb-2 shadow-none border-radius-none">
                                                                                                    <div class="row px-5">
                                                                                                    <div class="col-7">
                                                                                                    <form class="forms-sample pt-3 ">
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleInputUsername1" class="col-sm-4 col-form-label">First name</label>
                                                                                                            <div class="col-sm-8">
                                                                                                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="e.g. John">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Last name</label>
                                                                                                            <div class="col-sm-8">
                                                                                                                <input type="email" class="form-control" id="exampleInputUsername2" placeholder="e.g. Doe">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Email Address</label>
                                                                                                            <div class="col-sm-8">
                                                                                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="e.g. jdoe@example.com">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                    </div>
                                                                                                    <hr>
                                                                                                    <div class="col-7">
                                                                                                        <form class="forms-sample ">
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Username</label>
                                                                                                            <div class="col-sm-8">
                                                                                                                <input type="text" class="form-control" id="exampleInputUsername2" placeholder="e.g. jdoe">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Password</label>
                                                                                                            <div class="col-sm-8">
                                                                                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Blank for random password">
                                                                                                            </div>
                                                                                                        </div>               
                                                                                                        </form>
                                                                                                    </div>
                                                                                                    <hr>
                                                                                                    <div class="col-9">
                                                                                                        <form class="forms-sample ">
                                                                                                        <div class="form-group row">
                                                                                                            <label for="exampleTextarea1"  class="col-sm-3 col-form-label">Description</label>
                                                                                                            <div class="col-sm-9 px-3">
                                                                                                            <textarea class="form-control mb-2" id="exampleTextarea1" rows="4"></textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        </form>
                                                                                                    </div>

                                                                                                    

                                                                                                    <div class="col-7">
                                                                                                        <div class="form-group row">
                                                                                                            <label class="col-sm-4 col-form-label">User type</label>
                                                                                                            <div class="col-sm-8">
                                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                                            <option value="AL">Admin-Type</option>
                                                                                                            <option value="WY">User-type</option>
                                                                                                            </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <label class="col-sm-4 col-form-label">Time Zone</label>
                                                                                                            <div class="col-sm-8">
                                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                                            <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                                                                                                            <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                                                                                            <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                                                                                                            <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                                                                                                            <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                                                                                            <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                                                                                            <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                                                                                                            <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                                                                            <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                                                                                            <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                                                                                                            <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                                                                                            <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                                                                            <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                                                                                                            <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                                                                            <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                                                                                            <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                                                                                                            <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                                                                                            <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                                                                                                            <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                                                                                                            <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                                                                                                            <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                                                                                                            <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                                                                                                            <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                                                                                                            <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                                                                                                            <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                                                                                                            <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                                                                                                            <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                                                                                                            <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                                                                                                            <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                                                                            <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                                                                            <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                                                                            <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                                                                            <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                                                                            <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                                                                            <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                                                                                                            <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                                                                                                            <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                                                                            <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                                                                                                            <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                                                                                                            <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                                                                                                            <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                                                                            <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                                                                                                            <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                                                                                                            <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                                                                                                            <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                                                                            <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                                                                            <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                                                                                                            <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                                                                                                            <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                                                                                                            <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                                                                            <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                                                                                                            <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                                                                                                            <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                                                                                                            <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                                                                                                            <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                                                                            <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                                                                                                            <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                                                                            <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                                                                                                            <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                                                                                                            <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                                                                                                            <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                                                                                                            <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                                                                            <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                                                                                                            <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                                                                            <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                                                                            <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                                                                            <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                                                                                                            <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                                                                                                            <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                                                                            <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                                                                                                            <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                                                                                                            <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                                                                                                            <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                                                                                                            <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                                                                                                            <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                                                                            <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                                                                                                            <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                                                                                                            <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                                                                                                            <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                                                                            <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                                                                                                            <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                                                                            <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>

                                                                                                            </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                            <div class="form-group row">
                                                                                                            <label class="col-sm-4 col-form-label">Language</label>
                                                                                                            <div class="col-sm-8 ">
                                                                                                            <select class="js-example-basic-single form-select-control">
                                                                                                            <option value="AF">Afrikaans</option>
                                                                                                            <option value="SQ">Albanian</option>
                                                                                                            <option value="AR">Arabic</option>
                                                                                                            <option value="HY">Armenian</option>
                                                                                                            <option value="EU">Basque</option>
                                                                                                            <option value="BN">Bengali</option>
                                                                                                            <option value="BG">Bulgarian</option>
                                                                                                            <option value="CA">Catalan</option>
                                                                                                            <option value="KM">Cambodian</option>
                                                                                                            <option value="ZH">Chinese (Mandarin)</option>
                                                                                                            <option value="HR">Croatian</option>
                                                                                                            <option value="CS">Czech</option>
                                                                                                            <option value="DA">Danish</option>
                                                                                                            <option value="NL">Dutch</option>
                                                                                                            <option value="EN">English</option>
                                                                                                            <option value="ET">Estonian</option>
                                                                                                            <option value="FJ">Fiji</option>
                                                                                                            <option value="FI">Finnish</option>
                                                                                                            <option value="FR">French</option>
                                                                                                            <option value="KA">Georgian</option>
                                                                                                            <option value="DE">German</option>
                                                                                                            <option value="EL">Greek</option>
                                                                                                            <option value="GU">Gujarati</option>
                                                                                                            <option value="HE">Hebrew</option>
                                                                                                            <option value="HI">Hindi</option>
                                                                                                            <option value="HU">Hungarian</option>
                                                                                                            <option value="IS">Icelandic</option>
                                                                                                            <option value="ID">Indonesian</option>
                                                                                                            <option value="GA">Irish</option>
                                                                                                            <option value="IT">Italian</option>
                                                                                                            <option value="JA">Japanese</option>
                                                                                                            <option value="JW">Javanese</option>
                                                                                                            <option value="KO">Korean</option>
                                                                                                            <option value="LA">Latin</option>
                                                                                                            <option value="LV">Latvian</option>
                                                                                                            <option value="LT">Lithuanian</option>
                                                                                                            <option value="MK">Macedonian</option>
                                                                                                            <option value="MS">Malay</option>
                                                                                                            <option value="ML">Malayalam</option>
                                                                                                            <option value="MT">Maltese</option>
                                                                                                            <option value="MI">Maori</option>
                                                                                                            <option value="MR">Marathi</option>
                                                                                                            <option value="MN">Mongolian</option>
                                                                                                            <option value="NE">Nepali</option>
                                                                                                            <option value="NO">Norwegian</option>
                                                                                                            <option value="FA">Persian</option>
                                                                                                            <option value="PL">Polish</option>
                                                                                                            <option value="PT">Portuguese</option>
                                                                                                            <option value="PA">Punjabi</option>
                                                                                                            <option value="QU">Quechua</option>
                                                                                                            <option value="RO">Romanian</option>
                                                                                                            <option value="RU">Russian</option>
                                                                                                            <option value="SM">Samoan</option>
                                                                                                            <option value="SR">Serbian</option>
                                                                                                            <option value="SK">Slovak</option>
                                                                                                            <option value="SL">Slovenian</option>
                                                                                                            <option value="ES">Spanish</option>
                                                                                                            <option value="SW">Swahili</option>
                                                                                                            <option value="SV">Swedish </option>
                                                                                                            <option value="TA">Tamil</option>
                                                                                                            <option value="TT">Tatar</option>
                                                                                                            <option value="TE">Telugu</option>
                                                                                                            <option value="TH">Thai</option>
                                                                                                            <option value="BO">Tibetan</option>
                                                                                                            <option value="TO">Tonga</option>
                                                                                                            <option value="TR">Turkish</option>
                                                                                                            <option value="UK">Ukrainian</option>
                                                                                                            <option value="UR">Urdu</option>
                                                                                                            <option value="UZ">Uzbek</option>
                                                                                                            <option value="VI">Vietnamese</option>
                                                                                                            <option value="CY">Welsh</option>
                                                                                                            <option value="XH">Xhosa</option>

                                                                                                            </select>
                                                                                                            </div>                                                         
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    <hr>
                                                                                                    <div class="col-7">   
                                                                                                    <div class="form-group row px-4">
                                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                                            <div class="form-check col-sm-8 ">
                                                                                                                <label class="form-check-label">
                                                                                                                <input type="checkbox" class="form-check-input">
                                                                                                                Active
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                                            <div class="form-check col-sm-8">
                                                                                                                <label class="form-check-label">
                                                                                                                <input type="checkbox" class="form-check-input" checked>
                                                                                                                Deactivate at..
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                                            <div class="form-check col-sm-8">
                                                                                                                <label class="form-check-label">
                                                                                                                <input type="checkbox" class="form-check-input" disabled>
                                                                                                                Exclude from emails
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    <hr>

                                                                                                    <div class="col-7">
                                                                                                            <div class="mb-5">
                                                                                                                <label for="exampleInputPassword2" class="col-sm-4 col-form-label invisible">Password</label>
                                                                                                                <button type="button" class="btn btn-primary customized-btn-green px-5 py-2 mr-3">Add User</button>
                                                                                                                <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2">Cancel</button>
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
                                    <div class="tab-pane fade" id="ds" role="tabpanel" aria-labelledby="ds-tab">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-3 px-3 py-0">
                                                <div> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus, inventore.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="msgs" role="tabpanel" aria-labelledby="msgs-tab">
                                    <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2 col-lg-2 pr-0">
                                                <div>
                                                    <div class="nav sidenav sidemenu flex-column nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                                                        <a class="nav-link nav-s active border-0 d-flex align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#inbox" role="tab" aria-controls="inbox" aria-selected="true">
                                                        <img src="images/icons/add-courses.jpg" alt="">
                                                            <span>Inbox</span>
                                                        </a>
                                                        <a class="nav-link nav-s sidenav sidemenu border-0 d-flex align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#sent" role="tab" aria-controls="sent" aria-selected="false">
                                                        <img src="images/icons/View-courses.jpg" alt="">
                                                            <span>Sent</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-0">
                                                <div class="tab-content border-0 pt-1 pr-1  p-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" style="border-bottom: 0px !important;" id="inbox-data-tab" data-bs-toggle="tab" data-bs-target="#inbox-data" type="button" role="tab" aria-controls="inbox-data" aria-selected="true">Inbox</button>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content border-0 p-0 mb-1" id="myTabContent">
                                                                <div class="tab-pane p-1 card-border border-top-0 fade show active" id="inbox-data" role="tabpanel" aria-labelledby="inbox-data-tab">
                                                                <table class="table table-striped">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                            <th scope="col">From</th>
                                                                                                            <th scope="col">Subject</th>
                                                                                                            <th scope="col" class="text-center">Date</th>
                                                                                                            <th scope="col" class="text-center">options</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                            <td scope="row">Arun</td>
                                                                                                            <td>send a mail</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Arun</td>
                                                                                                            <td>send a mail</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Arun</td>
                                                                                                            <td>send a mail</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <td scope="row">Arun</td>
                                                                                                            <td>send a mail</td>
                                                                                                            <td class="text-center">11/10/2023</td>
                                                                                                            <td class="text-center">...</td>
                                                                                                            </tr>
                                                                                                            
                                                                                                        </tbody>
                                                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="v-pills-tab-twos">
                                                        <div>
                                                            <nav>
                                                                <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                                                    <button class="nav-link active" id="send-msg-tab" data-bs-toggle="tab" data-bs-target="#send-msg" type="button" role="tab" aria-controls="send-msg" aria-selected="true">Send Message</button>
                                                                </div>
                                                            </nav>
                                                           
                                                            <div class="tab-content border-0 mt-0 px-0 pt-0" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="send-msg" role="tabpanel" aria-labelledby="send-msg-tab">
                                                                    <div class="row ">
                                                                        <div class="col-12">
                                                                            <div class="card card-border border-top-0 shadow-none rounded-0">
                                                                                <div class="card-body p-1 p-0 rounded-0">
                                                                                    <div class="col-7">

                                                                                        <form class="forms-sample px-2 pt-3">
                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Recipients</label>
                                                                                                <div class="col-sm-8 pl-1">
                                                                                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="start typing to select the recipients...">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Subject</label>
                                                                                                <div class="col-sm-8 pl-1">
                                                                                                <input type="text" class="form-control" id="exampleInputUsername1" >
                                                                                                </div>
                                                                                            </div>                                                  
                                                                                        </form>
                                                                                    </div>

                                                                                    <div class="form-group row align-items-center">
                                                                                        <label for="exampleTextarea1" class="col-form-label pb-0 px-4">Body</label>
                                                                                        <div class="px-4 pb-3 ">
                                                                                        <textarea class="form-control" id="exampleTextarea1" placeholder="" rows="25"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                
                                                                                    <hr>

                                                                                    <div class="col-7">
                                                                                       
                                                                                            <div class="btn-group mr-3 mb-3">
                                                                                            <button class="btn btn-secondary btn-sm customized-btn-green px-5 py-2 "  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                           Send Message
                                                                                            </button>
                                                                                            </div>
                                                                                            <button type="button" class="btn btn-primary customized-btn-blue px-5 py-2 mb-3">Cancel</button>
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

          <?php include 'footer.php'; ?>