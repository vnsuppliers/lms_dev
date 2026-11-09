@include('layouts.admin.header')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 shadow rounded bg-white p-3 mb-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="border p-3 rounded">
                        <div class="row">
                            <div class="col-12 col-md-2 my-md-auto">
                                <div class="profile-imagee">
                                    @if(!empty($user->profile_image))
                                        <img src="{{ asset('storage/app/public/' . $user->profile_image) }}" alt="profile" class="rounded-circle" width="100%" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                                    @else
                                        <img src="{{ asset('public/images/face12.jpg') }}" alt="profile" class="rounded-circle" width="100%" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8 my-md-auto">
                                <h4>{{$user->first_name??''}} {{$user->last_name??''}}</h4>
                            </div>
                            <div class="col-12 col-md-2 my-md-auto">
								<div class="text-right">
									<a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Edit <i class="fa-regular fa-pen-to-square ml-2"></i></a>
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

                                        <div class="font-weight-bold">{{$user->emp_id??""}}</div>

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

                <div class="col-12 col-md-6 col-lg-6" style="display:none;">
                    <div class="border p-3 rounded">
                        <div class="row mb-3">
                            <div class="col-12 col-md-10 my-md-auto">
                                <h5 class="mb-0">Address</h5>
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
                                <div class="form-group row">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered my-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form action="{{ route('admin-profile.update') }}" method="POST" enctype="multipart/form-data">
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


@include('layouts.admin.footer')