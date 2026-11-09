<div class="" id="st" role="tabpanel" aria-labelledby="st-tab">
    <div class="row">
        <div class="col-12 mt-1">
            <div>
                <nav class="d-flex justify-content-between align-items-center border-bottom mb-1">
                    <div class="nav nav-tabs align-items-center justify-content-between font-smallsize border-0 bg-white mx-2 rounded-3" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="logo-app-tab" data-bs-toggle="tab" data-bs-target="#logo-app" type="button" role="tab" aria-controls="logo-app" aria-selected="true">
                            <i class="fa-solid fa-info menuu-icon menuu-icon-sm"></i>
                            <span class="menuu-text">Logo & Application Name</span>
                        </button>
                        <button class="nav-link" id="date-and-time-settings-tab" data-bs-toggle="tab" data-bs-target="#date-and-time-settings" type="button" role="tab" aria-controls="date-and-time-settings" aria-selected="false">
                            <i class="fa-solid fa-calendar-days headings-icon"></i>
                            <span class="menuu-text">Date & Time Currency Settings</span>
                        </button>
                        <button class="nav-link" id="conferences-tab" data-bs-toggle="tab" data-bs-target="#conferences" type="button" role="tab" aria-controls="conferences" aria-selected="false">
                            <i class="fa-solid fa-users headings-icon"></i>
                            <span class="menuu-text">Conferences</span>
                        </button>
                        <button class="nav-link" id="announcements-tab" data-bs-toggle="tab" data-bs-target="#announcements" type="button" role="tab" aria-controls="announcements" aria-selected="false">
                            <i class="fa-solid fa-bullhorn headings-icon"></i>
                            <span class="menuu-text">Announcements</span>
                        </button>
                        <button class="nav-link" id="session-tab" data-bs-toggle="tab" data-bs-target="#session" type="button" role="tab" aria-controls="session" aria-selected="false">
                            <i class="fa-regular fa-clock headings-icon"></i>
                            <span class="menuu-text">Session</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
        <!-- <div class="col-12 col-sm-4 col-md-3 col-lg-1p5 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills py-0" id="v-pills-tab" role="tablist"
                aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <a class="nav-link nav-s active border-0 text-center align-items-center icon-img"
                    id="v-pills-tab-ones" data-toggle="pill" href="#logo-app" role="tab" aria-controls="logo-app"
                    aria-selected="true">
                        <div><img src="images/icons/add-courses.jpg" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Logo & Application Name</span>
                    </a>
                    <a class="nav-link nav-s border-0 text-center align-items-center icon-img" id="v-pills-tab-twos"
                    data-toggle="pill" href="#date-and-time-settings" role="tab" aria-controls="date-and-time-settings" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Date & Time Currency Settings</span>
                    </a>
                    <a class="nav-link nav-s border-0 text-center align-items-center icon-img" id="v-pills-tab-threes"
                    data-toggle="pill" href="#conferences" role="tab" aria-controls="conferences" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Conferences</span>
                    </a>  
                    <a class="nav-link nav-s border-0 text-center align-items-center icon-img" id="v-pills-tab-fours"
                    data-toggle="pill" href="#announcements" role="tab" aria-controls="announcements" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Announcements</span>
                    </a>
                    <a class="nav-link nav-s border-0 text-center align-items-center icon-img" id="v-pills-tab-fives"
                    data-toggle="pill" href="#ses" role="tab" aria-controls="ses" aria-selected="false">
                        <div><img src="images/icons/View-courses.jpg" class="mx-auto d-block mb-2" alt="" /></div>
                        <span>Session</span>
                    </a>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-sm-8 col-md-9 col-lg-6">
            <div class="tab-content border-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="logo-app" role="tabpanel" aria-labelledby="logo-app">
                    <div>
                        <!-- <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="border-bottom: 0px !important;" id="ad-au-tab"
                                data-bs-toggle="tab" data-bs-target="#ad-au" type="button" role="tab"
                                aria-controls="ad-au" aria-selected="true">
                                Logo & Application Name
                                </button>
                            </div>
                        </nav> -->
                        <div class="tab-content border-0 p-0" id="myTabContent">
                            <div class="tab-pane card-border border-top-0 fade show active mt-1" id="ad-au" role="tabpanel"
                            aria-labelledby="ad-au-tab">
                                <div class="row m-0">
                                    @php $site = \App\Models\Site::select('id','site_name',
                                    'banner_image', 'hide_sitename', 'favicon') ->orderBy('updated_at', 'desc')
                                    ->first(); @endphp
                                    <div class="col-12 col-lg-12">
                                        <div class="bg-white p-2 rounded-3">
                                        <form action="{{ url('settings/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                            @csrf
                                            @if ($errors->has('favicon'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('favicon') }}
                                            </div>
                                            @endif
                                            @if ($errors->has('banner_image'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('banner_image') }}
                                            </div>
                                            @endif
                                            @if (session('user_error'))
                                            <div class="alert alert-success">
                                                {!! session('user_error') !!}
                                            </div>
                                            @endif
                                            <div class="form-group row" id="siteNameFormGroup"
                                            style="{{ old('hide_sitename', $site->hide_sitename ?? 0) ? 'display:flex;' : 'display:flex;' }}">
                                                <label for="exampleInputUsername1" class="col-sm-4 col-md-3 col-lg-2 mb-2 col-form-label">Site
                                                Name</label>
                                                <div class="col-sm-8 col-md-9 col-lg-10">
                                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                                    name="site_name"
                                                    value="{{ old('site_name', $site->site_name ?? '') }}"
                                                    placeholder="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-3 col-lg-2"></div>
                                                <div class="col-sm-8 col-md-9 col-lg-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input ms-0" type="checkbox" id="exampleCheckbox1" name="example_checkbox" style="margin-top: 1px;" 
                                                        onchange="toggleSiteName(); updateHideSiteName();" 
                                                        {{ old('hide_sitename', $site->hide_sitename ?? 0) ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="exampleCheckbox1">
                                                            Hide Site Name
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="hide_sitename" id="hide_sitename"
                                                    value="{{ old('hide_sitename', $site->hide_sitename ?? 0) }}" />
                                                </div>
                                            </div>
                                        </form>

                                            <form action="{{ url('settings/store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row align-items-center py-1">
                                                    <label for="" class="col-sm-4 col-md-3 col-lg-2 col-form-label">Site Logo</label>
                                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                                        <div>
                                                            <input type="file" class="form-control" accept='.jpeg, .png, .jpg, .webp' name="banner_image" id="image"
                                                            style="padding-left: 15px !important; padding-top: 9px !important;" />
                                                            <small id="imageHelp" class="form-text text-muted">Allowed formats: JPEG, PNG, JPG, WEBP. size: 3MB. dimensions: 500x500 px.</small>
                                                            <input type="hidden" name="existing_banner_image" value="{{ $site->banner_image }}">
                                                        </div>

                                                        @if($site && $site->banner_image)
                                                        <div class="py-3">
                                                            <img src="{{ asset('storage/app/public/'.$site->banner_image) }}" alt="Site Logo" width="40" height="40" />
                                                            <a href="{{ url('delete_header_logo') }}" class="btn btn-danger btn-sm ms-3" onclick="return confirm('Are you sure you want to delete the logo?')"><i class="fa-solid fa-trash pr-1"></i> Delete Logo</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center py-1">
                                                    <label for="" class="col-sm-4 col-md-3 col-lg-2 col-form-label">Favicon</label>
                                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                                        <div>
                                                            <input type="file" class="form-control" accept='.ico, .jpeg, .png, .jpg, .webp' name="favicon"
                                                            style="padding-left: 15px !important; padding-top: 9px !important;" />
                                                            <small class="form-text text-muted">Allowed formats: ICO, JPEG, PNG, JPG, WEBP. size: 3MB. dimensions: 64x64 px.</small>
                                                            <input type="hidden" name="existing_favicon" value="{{ $site->favicon }}">
                                                        </div>
                                                        @if($site && $site->favicon)
                                                        <div class="py-3">
                                                            <img src="{{ asset('storage/app/public/'.$site->favicon) }}" alt="Favicon" width="40" height="40" />
                                                            <!-- <span class="ms-2">{{ $site->site_name }}</span> --> <!-- Display site name next to favicon -->
                                                            <a href="{{ url('delete_favicon') }}" class="btn btn-danger btn-sm ms-3" onclick="return confirm('Are you sure you want to delete the favicon?')"><i class="fa-solid fa-trash pr-1"></i> Delete Favicon</a>
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Submit</button> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <form action="{{ url('delete_header_logo') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="site_id" value="{{ $site->id }}">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the logo?')">Delete Logo</button>
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                function toggleSiteName() {
                    var checkBox = document.getElementById("exampleCheckbox1");
                    var headerSiteName = document.getElementById("headerSiteName");

                    if (checkBox.checked) {
                        if (headerSiteName) {
                            headerSiteName.style.display = "none";
                        }
                    } else {
                        if (headerSiteName) {
                            headerSiteName.style.display = "block";
                        }
                    }
                }
                toggleSiteName();

                $("#exampleCheckbox1").change(function() {
                    toggleSiteName();
                });

                function updateHideSiteName() {
                    var hideSiteName = $("#exampleCheckbox1").is(":checked") ? 1 : 0;

                    $.ajax({
                        url: '{{ url("/update_hide_sitename") }}',
                        type: "POST",
                        data: {
                            hide_sitename: hideSiteName,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            console.log("Hide site name updated successfully");
                            $("#hide_sitename").val(hideSiteName);
                            toggleSiteName();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating hide site name:", error);
                        },
                    });
                }

                toggleSiteName();

                $("#exampleCheckbox1").change(function() {
                    toggleSiteName();
                    updateHideSiteName();
                });
            });
        </script>