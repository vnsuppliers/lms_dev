@include('layouts.user.header')

<style>
    .sidepop .closebtn{
        margin-top: 0.5%;
    }
    .course-name{
        line-height: 20px;
    }
    .modal-backdrop.show {
        opacity: 0.5;
        z-index: 0 !important;
    }
    div#certificateView{
        backdrop-filter: contrast(0.5) !important;
    }
    .accordion-button::after {
        flex-shrink: 0;
        width: 0.8rem;
        height: 0.8rem;
        margin-left: 15px;
        background-size: 0.8rem;
    }
    button.accordion-button.collapsed {
/*        background: #005452;*/
        border: 1px solid #005452;
        width: auto;
        color: #005452;
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 6px !important;
    }
    button.accordion-button.collapsed:focus, button.accordion-button.collapsed:hover, .accordion-button:not(.collapsed){
        background: #fff;
        border: 1px solid #005452;
        width: auto;
        color: #005452;
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 6px !important;
        box-shadow: none;
    }
   /* .accordion-button.collapsed:hover::after {
        background-image: url('/images/collapse-down-arrow-green.svg') !important;
        transform: rotate(-180deg) !important;
    }  */ 
    .accordion-button::after {
        background-image: url('public/images/collapse-down-arrow-green.svg') !important;
    }
    .accordion-button:not(.collapsed)::after{
        background-image: url('public/images/collapse-down-arrow-green.svg') !important;
        transform: rotate(-180deg) !important;
    }

    #pageLoader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 400px;
        background: rgba(255, 255, 255, .85);
        z-index: 1050;
        display: none;
        justify-content: center;
        align-items: center;
    }

    #pageLoader .spinner {
        width: 60px;
        height: 60px;
        border: 5px solid #ddd;
        border-top: 5px solid #0d6efd;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

</style>

<div class="tab-pane" id="fm" role="tabpanel" aria-labelledby="fm-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border border-0 shadow-none rounded-0">
                <div class="card-body px-0 py-0 bg-transparent rounded-3 pb-2">
                    <div class="row mx-0">
                         <div class="mt-0" id="main" style="width: 100%;">
                            <div class="row">
                                <div class="col-12 offset-0 col-lg-10 offset-lg-1 main_subdiv px-2 px-lg-2" id="main_subdiv">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 mt-1">
                                        <label class="res-main-headings font-weight-bold d-flex align-items-center mb-2 mb-md-0"> 
                                            <i class="fa-solid fa-user me-2 headings-icon"></i> 
                                            <span class="text-blue font-weight-500">User Reports</span> 
                                        </label>
                                        <div class="w-100 w-md-auto" style="min-width: 260px; max-width: 360px;">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-end-0"><i class="fa fa-search text-muted"></i></span>
                                                <input 
                                                    type="text" 
                                                    class="form-control border-start-0 ps-0" 
                                                    id="myteam_user_search" 
                                                    placeholder="Search by name or email"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 bg-white rounded-3">
                                        <div class="my-team-user-reports">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 200px;">User Details</th>
                                                            <!-- <th style="width: 200px;">User Type</th> -->
                                                            <th>Assigned&nbsp;Courses</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="myteam_list_div">
                                                        @foreach ($allUsers as $user)
                                                        <tr class="user_check" data-id="6" style="cursor: pointer;">
                                                            <td class="myteam_each_details" style="cursor:pointer;"  data-id="{{$user->id}}" onclick="openData()">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="profile-image-div-sm">
                                                                    @if(!empty($user->profile_image))
                                                                        <img src="{{ url('storage/app/public/' . $user->profile_image) }}" class="img-fluid" alt="Profile Image">
                                                                    @else

                                                                        <img src="{{ getUserImage($user->first_name,$user->last_name) }}" class="img-fluid" alt="Default Image">
                                                                    @endif
                                                                       
                                                                    </div>
                                                                    <div class="ms-2">
                                                                        <div class="py-1 web-text-color font-weight-bold text-truncate" >{{ $user->first_name ??''}} {{$user->last_name ??''}}</div>
                                                                        <div class="py-1 sub-categories-styles text-truncate">{{ $user->email ??''}}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><div class="py-1 text-start">{{ implode(', ', $user->role_names) }}
                                                            </div></td> -->
                                                            <td style="width:100px;">
                                                                <div class="py-1 text-center">@if(isset($user->assigned_user)){{ $user->assigned_user->count() ??'0' }} @endif</div>
                                                            </td>
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

                        <div class="sidepop pr-0 pr-md-0 pt-1" id="dataOverlay">
                            {{-- In-drawer Centered Loader --}}
                            <div id="pageLoader">
                                <div class="spinner"></div>
                            </div>
                            <div class="col-12 myteam_ajax_html_div p-0">
                            
                            </div>
                            <div><a href="javascript:void(0)" class="closebtn" onclick="closeData()">&times;</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script>
    function openData() {
        if (window.screen.availWidth <= 991) {
            document.getElementById("dataOverlay").style.width = "100%";
        }
        else{
          document.getElementById("dataOverlay").style.width = "60%";
        }
        if (window.screen.availWidth <= 991) {
            document.getElementById("main").style.width = "100%";
        }
        else{
            document.getElementById("main").style.width = "40%";
        }
      // document.getElementById("main").style.marginRight = "40%";
      document.getElementById("dataOverlay").style.right = "0px";
      $('.main_subdiv').removeClass('col-lg-10 offset-lg-1');
      $('.card-list-div').removeClass('col-lg-3')
    }

    function closeData() {
      document.getElementById("dataOverlay").style.width = "0";
      document.getElementById("main").style.width = "100%";
      document.getElementById("main").style.marginRight= "0";
      document.getElementById("dataOverlay").style.marginRight= "0";
      document.getElementById("dataOverlay").style.right = "-25px";
      $('.main_subdiv').addClass('col-lg-10 offset-lg-1');
      $('.card-list-div').addClass('col-lg-3');
      $('#pageLoader').hide();
      $('#myteam_list_div tr').removeClass('course-active');
      sessionStorage.removeItem('lms_myteam_user_id');
      sessionStorage.removeItem('lms_myteam_open_tab');
      sessionStorage.removeItem('lms_myteam_assign_id');
      if (window.history.replaceState) {
          window.history.replaceState({}, document.title, "{{ url('userslist') }}");
      }
    }
</script>
<script>
$(document).ready(function () {

    // Store state on click of assessment view result
    $(document).on('click', '.take_result', function () {
        var userId = $(this).data('user-id');
        var assignId = $(this).data('assign-id');
        if (userId) {
            sessionStorage.setItem('lms_myteam_user_id', userId);
            sessionStorage.setItem('lms_myteam_open_tab', 'assessment');
            if (assignId) {
                sessionStorage.setItem('lms_myteam_assign_id', assignId);
            }
        }
    });

    $('.myteam_each_details').on('click', function () {

        $(this).parents('#myteam_list_div').find('tr').removeClass('course-active');
        $(this).parents('tr').addClass('course-active');

        var user_id = $(this).data('id');
        sessionStorage.setItem('lms_myteam_user_id', user_id);

        $.ajax({
            url: "{{ url('fetch_myteam_userdetails') }}",
            type: "GET",
            data: {
                user_id: user_id
            },
            dataType: "html",

            beforeSend: function () {
                $('#pageLoader').css('display', 'flex').show();
                $('.myteam_ajax_html_div').empty();
            },

            success: function (response) {
                $('.myteam_ajax_html_div').html(response);
            },

            error: function () {
                $('.myteam_ajax_html_div').html('<div class="p-4 text-center text-danger">Failed to load user details. Please try again.</div>');
            },

            complete: function () {
                $('#pageLoader').hide();
            }
        });

    });

    // Auto-open user drawer if returning from assessment view
    var urlParams = new URLSearchParams(window.location.search);
    var autoUserId = urlParams.get('user_id') || sessionStorage.getItem('lms_myteam_user_id');
    var autoOpenTab = urlParams.get('open_tab') || sessionStorage.getItem('lms_myteam_open_tab') || 'assessment';
    var autoAssignId = urlParams.get('assign_id') || sessionStorage.getItem('lms_myteam_assign_id');

    if (sessionStorage.getItem('lms_myteam_user_id')) {
        sessionStorage.removeItem('lms_myteam_user_id');
        sessionStorage.removeItem('lms_myteam_open_tab');
        sessionStorage.removeItem('lms_myteam_assign_id');
    }

    if (autoUserId) {
        var targetRow = $('.myteam_each_details[data-id="' + autoUserId + '"]');
        if (targetRow.length) {
            $('#myteam_list_div tr').removeClass('course-active');
            targetRow.closest('tr').addClass('course-active');
            try {
                targetRow[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } catch (err) {}
        }
        openData();
        $.ajax({
            url: "{{ url('fetch_myteam_userdetails') }}",
            type: "GET",
            data: {
                user_id: autoUserId
            },
            dataType: "html",
            beforeSend: function () {
                $('#pageLoader').css('display', 'flex').show();
                $('.myteam_ajax_html_div').empty();
            },
            success: function (response) {
                $('.myteam_ajax_html_div').html(response);

                if (autoOpenTab === 'assessment' || autoAssignId) {
                    var assessmentTab = document.getElementById('course-assesments-n-certificates-tab');
                    if (assessmentTab) {
                        try {
                            var bsTab = (typeof bootstrap !== 'undefined' && bootstrap.Tab && bootstrap.Tab.getOrCreateInstance)
                                ? bootstrap.Tab.getOrCreateInstance(assessmentTab)
                                : new bootstrap.Tab(assessmentTab);
                            bsTab.show();
                        } catch (e) {
                            assessmentTab.click();
                        }
                    }
                    $('#course-assesments-n-certificates-tab').addClass('active');
                    $('#reports-tab').removeClass('active');
                    $('#course-assesments-n-certificates').addClass('show active');
                    $('#reports').removeClass('show active');

                    if (autoAssignId) {
                        setTimeout(function () {
                            var targetCollapse = $('.myteam-course-collapse[data-assign-id="' + autoAssignId + '"]');
                            var targetBtn = $('.myteam-course-toggle-btn[data-assign-id="' + autoAssignId + '"]');
                            if (targetCollapse.length) {
                                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                                    try {
                                        var bsCol = bootstrap.Collapse.getOrCreateInstance 
                                            ? bootstrap.Collapse.getOrCreateInstance(targetCollapse[0], { toggle: false }) 
                                            : new bootstrap.Collapse(targetCollapse[0], { toggle: false });
                                        bsCol.show();
                                    } catch(e) {
                                        targetCollapse.addClass('show');
                                    }
                                } else {
                                    targetCollapse.addClass('show');
                                }
                                if (targetBtn.length) {
                                    targetBtn.removeClass('collapsed').attr('aria-expanded', 'true');
                                }
                                targetCollapse[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        }, 250);
                    }
                }
            },
            error: function () {
                $('.myteam_ajax_html_div').html('<div class="p-4 text-center text-danger">Failed to load user details. Please try again.</div>');
            },
            complete: function () {
                $('#pageLoader').hide();
            }
        });
    }

});
</script>

{{-- Search functionality for myteam users --}}
<script>
    $(document).ready(function() {
        $('#myteam_user_search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#myteam_list_div tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    // Handle browser back / forward navigation cleanly on My Team page
    (function() {
        try {
            history.pushState({ lms_myteam_page: true }, document.title, window.location.href);
        } catch (e) {}

        window.addEventListener('popstate', function(event) {
            var overlay = document.getElementById("dataOverlay");
            if (overlay && overlay.style.width && overlay.style.width !== "0px" && overlay.style.width !== "0") {
                closeData();
                try {
                    history.pushState({ lms_myteam_page: true }, document.title, window.location.href);
                } catch (err) {}
                return;
            }
            window.location.href = "{{ url('userslist') }}";
        });

        window.addEventListener('pageshow', function(event) {
            var navEntries = (window.performance && window.performance.getEntriesByType) ? window.performance.getEntriesByType("navigation") : [];
            var isBackForward = event.persisted || (navEntries.length > 0 && navEntries[0].type === "back_forward") || (window.performance && window.performance.navigation && window.performance.navigation.type === 2);
            if (isBackForward) {
                window.location.reload();
            } else {
                try {
                    history.pushState({ lms_myteam_page: true }, document.title, window.location.href);
                } catch (e) {}
            }
        });
    })();
</script>

@include('layouts.user.footer')