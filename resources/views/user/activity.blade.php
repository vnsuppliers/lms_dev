@include('layouts.user.header')

<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />

<style>
    /*body{
        height: 100vh;
        overflow-y: hidden;
    }*/
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }
    .filters-indicator {
        display: none;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        position: relative;
        left: 0px;
        top: -8px;
    }

    /* DataTable Custom Styling for Activity */
    #user_activity_table {
        width: 100% !important;
        border-collapse: separate;
        border-spacing: 0;
    }
    #user_activity_table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 14px;
    }
    #user_activity_table tbody td {
        vertical-align: middle;
        padding: 12px 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    #user_activity_table tbody tr:hover,
    #user_activity_table tbody tr:hover > * {
        background-color: transparent !important;
    }
    #user_activity_table_wrapper .dataTables_length,
    #user_activity_table_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }
    #user_activity_table_wrapper .dataTables_info,
    #user_activity_table_wrapper .dataTables_paginate {
        margin-top: 1rem;
    }
    #user_activity_table_wrapper .dataTables_length select {
        padding: 4px 28px 4px 10px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 0.875rem;
    }
    #user_activity_table_wrapper .dataTables_filter input {
        padding: 5px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 0.875rem;
        margin-left: 0.5rem;
        outline: none;
    }
    #user_activity_table_wrapper .dataTables_filter input:focus {
        border-color: #005452;
        box-shadow: 0 0 0 2px rgba(0, 84, 82, 0.15);
    }
    #user_activity_table_wrapper .page-item.active .page-link {
        background-color: #005452;
        border-color: #005452;
        color: #ffffff;
    }
    #user_activity_table_wrapper .page-link {
        color: #005452;
        border-radius: 4px;
        margin: 0 2px;
    }
    .dataTables_empty {
        text-align: center;
        padding: 40px 20px !important;
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 offset-0 col-lg-10 offset-lg-1">
            <div class="rounded-3 bg-white p-3">
                {{-- <div class="row mb-2">
                    <div class="col-12 col-lg-6 my-auto">
                        <div class="row">
                            <div class="col-4 col-lg-2 my-auto">
                                <div class="">
                                    Log <i class="fa-solid fa-circle-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side filter bar with preset buttons & Date Pickers matching #005452 theme -->
                    <div class="col-12 col-lg-6 my-auto">
                        <div class="d-flex align-items-center justify-content-end flex-wrap gap-2">
                            
                            <!-- Preset Filter Buttons -->
                            <div class="btn-group btn-group-sm mb-1" role="group">
                                <button type="button" class="btn preset-filter-btn px-2 px-md-3" data-preset="today" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Today</button>
                                <button type="button" class="btn preset-filter-btn px-2 px-md-3" data-preset="last_week" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Last Week</button>
                                <button type="button" class="btn preset-filter-btn px-2 px-md-3" data-preset="this_month" style="border: 1px solid #005452; background-color: #fff; color: #005452;">Last Month</button>
                                <button type="button" class="btn preset-filter-btn active px-2 px-md-3" data-preset="all" style="border: 1px solid #005452; background-color: #005452; color: #ffffff;">Custom</button>
                            </div>

                            <!-- Manual/Custom Date Pickers -->
                            <div class="d-flex align-items-center p-1 rounded bg-white mb-1 shadow-sm" style="border: 1px solid #005452 !important;">
                                <span class="small font-weight-bold me-1 text-muted px-1">From:</span>
                                <input type="date" id="filter_from_date" class="form-control form-control-sm border-0 p-0 me-1" style="width: 110px;">
                                
                                <span class="small font-weight-bold me-1 text-muted px-1">To:</span>
                                <input type="date" id="filter_to_date" class="form-control form-control-sm border-0 p-0 me-1" style="width: 110px;">
                                
                                <button type="button" class="btn btn-sm py-0 px-2 ms-1" id="apply_custom_date_filter" style="background-color: #005452; border-color: #005452; color: #ffffff;">Filter</button>
                            </div>

                        </div>
                    </div>
                </div> --}}

                <!-- Session Time Spent Summary Box (Added for User Side) -->
                {{-- <div class="row mb-3 px-2" id="session_duration_container" style="display: none;">
                    <div class="col-12 border p-3 bg-light rounded shadow-sm">
                        <h6 class="font-weight-bold text-primary mb-2"><i class="fa-solid fa-clock"></i> Session Time Spent Summary</h6>
                        <div class="row text-secondary">
                            <div class="col-md-4">
                                <strong>Login Time:</strong> <span id="val_login_time">--</span>
                            </div>
                            <div class="col-md-4">
                                <strong>Logout Time:</strong> <span id="val_logout_time">--</span>
                            </div>
                            <div class="col-md-4">
                                <strong>Total Time Spent:</strong> <span id="val_total_time" class="text-success font-weight-bold">--</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="user_activity_list">
                    <div class="table-responsive">
                        <table id="user_activity_table" class="table align-middle mb-0 w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;" class="text-center">#</th>
                                    <th>Activity</th>
                                    <th style="width: 220px;" class="text-md-end">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($activities_data) && count($activities_data) > 0)
                                    @foreach($activities_data as $index => $activities)
                                    <tr>
                                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="icon-bg-stiles">
                                                    <i class="fa-regular fa-clipboard icon icon-stiles"></i>
                                                </div>
                                                <div class="activity-course-block">
                                                    <span class="icon bg-primary"><i class="fa-regular fa-file icon-tag"></i></span> 
                                                    <span class="ps-2 activity-course-name">{{$activities->activity??''}}</span> 
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-md-end text-muted small" data-order="{{ !empty($activities->created_at) ? \Carbon\Carbon::parse($activities->created_at)->timestamp : 0 }}">
                                            {{ !empty($activities->created_at) ? \Carbon\Carbon::parse($activities->created_at)->format('m/d/Y - h:i:s A') : '' }}
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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        var todayStr = new Date().toISOString().split('T')[0];
        $('#filter_from_date').attr('max', todayStr);
        $('#filter_to_date').attr('max', todayStr);

        $('#filter_from_date').on('change', function() {
            var fromVal = $(this).val();
            $('#filter_to_date').attr('min', fromVal);
            if ($('#filter_to_date').val() && $('#filter_to_date').val() < fromVal) {
                $('#filter_to_date').val(fromVal);
            }
        });

        $('#filter_to_date').on('change', function() {
            var toVal = $(this).val();
            $('#filter_from_date').attr('max', toVal);
            if ($('#filter_from_date').val() && $('#filter_from_date').val() > toVal) {
                $('#filter_from_date').val(toVal);
            }
        });
    });

    function formatDate(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    function getTodayRange() {
        var today = new Date();
        return {
            from: formatDate(today),
            to: formatDate(today)
        };
    }

    function getLastWeekRange() {
        var today = new Date();
        var end = new Date(today.getTime());
        end.setDate(today.getDate() - 1);
        
        var start = new Date(end.getTime());
        start.setDate(end.getDate() - 6);

        return {
            from: formatDate(start),
            to: formatDate(end)
        };
    }

    function getLastMonthRange() {
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        
        var lastMonthStart = new Date(year, month - 1, 1);
        var lastMonthEnd = new Date(year, month, 0);

        return {
            from: formatDate(lastMonthStart),
            to: formatDate(lastMonthEnd)
        };
    }

    function resetPresetButtons() {
        $('.preset-filter-btn').css({
            'background-color': '#fff',
            'color': '#005452',
            'border-color': '#005452'
        }).removeClass('active');
    }

    function activatePreset(preset) {
        resetPresetButtons();
        $('.preset-filter-btn[data-preset="' + preset + '"]').css({
            'background-color': '#005452',
            'color': '#ffffff',
            'border-color': '#005452'
        }).addClass('active');
    }

    // Auto-detects if manual custom dates match presets
    function checkMatchingPreset(fromDate, toDate) {
        if (!fromDate || !toDate) {
            activatePreset('all'); 
            return;
        }

        var todayRange = getTodayRange();
        var lastWeekRange = getLastWeekRange();
        var lastMonthRange = getLastMonthRange();

        if (fromDate === todayRange.from && toDate === todayRange.to) {
            activatePreset('today');
        } else if (fromDate === lastWeekRange.from && toDate === lastWeekRange.to) {
            activatePreset('last_week');
        } else if (fromDate === lastMonthRange.from && toDate === lastMonthRange.to) {
            activatePreset('this_month');
        } else {
            activatePreset('all'); // Falls back to Custom if it doesn't match presets
        }
    }

    function loadUserActivities(fromDate, toDate) {
        $.ajax({
            type: 'GET',
            url: "{{ url('fetch_own_activity_filter') }}",
            data: {
                from_date: fromDate,
                to_date: toDate
            },
            dataType: 'json',
            success: function(response) {
                $('.user_activity_list').html(response.activity_html);

                if (response.login_time || response.total_time_spent) {
                    $('#val_login_time').text(response.login_time || '--');
                    $('#val_logout_time').text(response.logout_time || '--');
                    $('#val_total_time').text(response.total_time_spent || '--');
                    $('#session_duration_container').show();
                } else {
                    $('#val_login_time').text('--');
                    $('#val_logout_time').text('--');
                    $('#val_total_time').text('0 minutes');
                    $('#session_duration_container').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching activities:', error);
            }
        });
    }

    $('.preset-filter-btn').on('click', function() {
        var preset = $(this).data('preset');
        var fromDate = '';
        var toDate = '';

        if (preset === 'today') {
            var todayRange = getTodayRange();
            fromDate = todayRange.from;
            toDate = todayRange.to;
        } else if (preset === 'last_week') {
            var lastWeekRange = getLastWeekRange();
            fromDate = lastWeekRange.from;
            toDate = lastWeekRange.to;
        } else if (preset === 'this_month') {
            var lastMonthRange = getLastMonthRange();
            fromDate = lastMonthRange.from;
            toDate = lastMonthRange.to;
        } else if (preset === 'all') {
            fromDate = '';
            toDate = '';
            $('#filter_from_date').val('');
            $('#filter_to_date').val('');
            activatePreset('all');
            loadUserActivities('', '');
            $('#session_duration_container').hide();
            return;
        }

        $('#filter_from_date').val(fromDate);
        $('#filter_to_date').val(toDate);
        activatePreset(preset);
        loadUserActivities(fromDate, toDate);
    });

    $('#apply_custom_date_filter').on('click', function() {
        var fromDate = $('#filter_from_date').val();
        var toDate = $('#filter_to_date').val();

        if (!fromDate || !toDate) {
            activatePreset('all');
            loadUserActivities('', '');
            $('#session_duration_container').hide();
            return;
        }

        if (fromDate > toDate) {
            alert('From date cannot be later than To date.');
            return;
        }

        // Evaluates if custom range matches any preset button
        checkMatchingPreset(fromDate, toDate); 
        loadUserActivities(fromDate, toDate);
    });
</script>

@include('layouts.user.footer')

<!-- DataTables JS & Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script>
    (function($) {
        // Prevent DataTables from ever displaying popup alerts
        if (typeof $.fn.dataTable !== 'undefined') {
            $.fn.dataTable.ext.errMode = 'none';
        }

        $(document).ready(function() {
            if (typeof $.fn.dataTable !== 'undefined') {
                $.fn.dataTable.ext.errMode = 'none';
            }

            if ($('#user_activity_table').length && typeof $.fn.DataTable !== 'undefined') {
                var activityTable = $('#user_activity_table').DataTable({
                    pageLength: 25,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, 'All']
                    ],
                    ordering: true,
                    order: [], // Preserves initial server-side order (id desc / latest first)
                    searching: true,
                    info: true,
                    paging: true,
                    responsive: true,
                    autoWidth: false,
                    columnDefs: [
                        { targets: 0, orderable: false, searchable: false }
                    ],
                    language: {
                        emptyTable: "No activity records found",
                        zeroRecords: "No matching activity records found",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "Showing 0 to 0 of 0 entries",
                        infoFiltered: "(filtered from _MAX_ total entries)",
                        lengthMenu: "Show _MENU_ records per page",
                        search: "Search:",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: '<i class="fa-solid fa-angle-right"></i>',
                            previous: '<i class="fa-solid fa-angle-left"></i>'
                        }
                    }
                });

                // Suppress any runtime warning/error events so alerts never pop up
                $('#user_activity_table').on('error.dt', function(e, settings, techNote, message) {
                    console.warn('DataTables warning suppressed:', message);
                });
            }
        });
    })(jQuery);
</script>