@include('layouts.user.header')
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/charts/chart-2/assets/css/chart-2.css">

<div class="container-fluid">
    <div class="row m-0">

        <div class="col-12 px-0">
            <div class="res-main-headings mb-3"> <i class="fa-solid fa-user me-2 menu-icon2"></i> <span class="text-blue font-weight-500">My Profile </span> </div>
        </div>
        <div class="col-12 shadow rounded bg-white p-2 p-lg-3 mb-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="border p-2 p-lg-3 rounded">
                        <div class="row">
                             <div class="col-12 d-block d-md-none">
                                <div class="text-right mb-2">
                                    <a class="btn btn-sm btn-outline-primary p-2" data-bs-toggle="modal" href="#profileModalToggle" role="button">Edit Picture <i class="fa-regular fa-pen-to-square ml-2"></i></a>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 my-md-auto">
                                <div class="profile-imagee">
                                    @if(!empty($user->profile_image))
                                        <img src="{{ asset('storage/app/public/' . $user->profile_image) }}" alt="profile" class="rounded-circle" width="100%" data-bs-toggle="modal" data-bs-target="#profileModalToggle">
                                    @else
                                        <img src="{{ asset('public/images/face12.jpg') }}" alt="profile" class="rounded-circle" width="100%" data-bs-toggle="modal" data-bs-target="#profileModalToggle">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-7 mt-2 my-md-auto">
                                <div class="text-center text-md-left">
                                    <h4>{{$user->first_name??''}} {{$user->last_name??''}}</h4>
                                    <p>{{$user->email}}</p>
                                    <p>{{$user->emp_id}}</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 my-md-auto d-none d-md-block">
								<div class="text-right">
									<a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" href="#profileModalToggle" role="button">Edit Picture <i class="fa-regular fa-pen-to-square ml-2"></i></a>
								</div>
							</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">Personal Information</h5>
                                <div class="form-group row">
                                    <div class="col-md-7 mb-4">
                                        <label class="mb-2">First Name</label>
                                        <div class="font-weight-bold">{{$user->first_name??''}}</div>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label class="mb-2">Last Name</label>
                                        <div class="font-weight-bold">{{$user->last_name??''}}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 mb-4">
                                        <label class="mb-2">Email</label>
                                        <div class="font-weight-bold">{{$user->email??''}}</div>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label class="mb-2">Mobile Number</label>
                                        <div class="font-weight-bold"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 mb-4">
                                        <label class="mb-2">Designation</label>
                                        <div class="font-weight-bold">{{$user->designationdetails->designation_name??'Not Assigned'}}</div>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label class="mb-2">Department</label>
                                        <div class="font-weight-bold">{{$user->departmentdetails->department_name??'Not Assigned'}}</div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-md-7 mb-4">
                                        <label class="mb-2">Employee ID</label>
                                        <div class="font-weight-bold">{{$user->emp_id}}</div>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label class="mb-2">Team Lead</label>
                                        <div class="font-weight-bold">{{$user->team_lead_details->username??'Not Assigned'}}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7 mb-4">
                                        <label class="mb-2">Manager1</label>
                                        <div class="font-weight-bold">{{$user->manager1_details->username??'Not Assigned'}}</div>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label class="mb-2">Manager2</label>
                                        <div class="font-weight-bold">{{$user->manager2_details->username??'Not Assigned'}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 mt-2 mt-md-0">
                    <div class="border p-2 p-lg-3 rounded">
                        <div class="row mb-3">
                            <div class="col-12 col-md-10 my-md-auto">
                                <h5 class="mb-0">Progress</h5>
                            </div>
                            <!-- <div class="col-12 col-md-2 my-md-auto">
								<div class="text-right">
									<div class="btn btn-sm btn-outline-primary">
										Edit <i class="fa-regular fa-pen-to-square ml-2"></i>
									</div>
								</div>
							</div> -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                               <!--  <div class="form-group row">
                                    <div class="col-md-6 mb-4">
                                        <label class="mb-2">Country</label>
                                        <div class="font-weight-bold">United States of America</div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="mb-2">State</label>
                                        <div class="font-weight-bold">NY</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 mb-4">
                                        <label class="mb-2">City</label>
                                        <div class="font-weight-bold">New York City</div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="mb-2">Postal Code</label>
                                        <div class="font-weight-bold">100111</div>
                                    </div>
                                </div> -->
                                <div class="table-responsive">
                                <table class="table">
                                <thead>
                                <tr>
                                    <th>Assigned Courses</th>
                                    <th>Completed</th>
                                    <th>In-Progress</th>
                                    <th>Pending</th>
                                    <th>Instructor Led</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$total_courses}}</td>
                                        <td>{{$completed_course}}</td>
                                        <td>{{$inprogress_count}}</td>
                                        <td>{{$pending_count}}</td>
                                        <td>{{$instructor_lead}}</td>
                                       
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                            </div>
                            <div class="col-12 offset-0 col-md-8 offset-md-2 mt-3 mt-md-0">
                                <div id="bsb-chart-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="profileModalToggle" aria-hidden="true" aria-labelledby="profileModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered my-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalToggleLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form action="{{ route('my_profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                        <label for="profile_image" class="col-md-12 col-form-label mb-0">Profile Image</label>

                        <div class="col-md-12">
                            <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" required accept=".jpg,.jpeg,.png" style="height: 37px !important;">
                            <small class="form-text text-muted py-1">Please upload images of type JPG, JPEG, or PNG, and less than 5MB in size.</small>
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update Profile Image
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script type="text/javascript">
    !(function () {
    var e = {
            460: function () {
                !(function () {
                    const e = {
                        init() {
                            new ApexCharts(document.querySelector("#bsb-chart-2"), {
                                series: [ {{$completed_course}}, {{$inprogress_count}}, {{$pending_count}}, {{$instructor_lead}}],

                                labels: [ "Completed", "In-Progress", "Pending", "Instructor Led"],
                                legend: { position: "bottom" },
                                theme: { palette: "palette1" },
                                chart: { type: "donut" },
                            }).render();
                        },
                    };
                    function t() {
                        e.init();
                    }
                    "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", t) : t(), window.addEventListener("load", function () {}, !1);
                })();
            },
        },
        t = {};
    function n(r) {
        var o = t[r];
        if (void 0 !== o) return o.exports;
        var i = (t[r] = { exports: {} });
        return e[r](i, i.exports, n), i.exports;
    }
    (n.n = function (e) {
        var t =
            e && e.__esModule
                ? function () {
                      return e.default;
                  }
                : function () {
                      return e;
                  };
        return n.d(t, { a: t }), t;
    }),
        (n.d = function (e, t) {
            for (var r in t) n.o(t, r) && !n.o(e, r) && Object.defineProperty(e, r, { enumerable: !0, get: t[r] });
        }),
        (n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (function () {
            "use strict";
            n(460);
        })();
})();

</script>




@include('layouts.user.footer')