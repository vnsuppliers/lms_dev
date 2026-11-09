@include('layouts.admin.header')

@php
    $config = is_array($report->configuration) ? $report->configuration : (json_decode($report->configuration, true) ?? []);
    $rawSavedSources = $config['data_sources'] ?? null;
    if (empty($rawSavedSources)) {
        if (!empty($report->data_source) && str_contains($report->data_source, ',')) {
            $rawSavedSources = array_filter(array_map('trim', explode(',', $report->data_source)));
        } else {
            $rawSavedSources = [$report->data_source ?? ($config['data_source'] ?? 'learners')];
        }
    }
    $savedSources = is_array($rawSavedSources) ? array_values($rawSavedSources) : ['learners'];
    if (empty($savedSources)) {
        $savedSources = ['learners'];
    }

    $savedDatePreset = $config['date_preset'] ?? 'all';
    $savedDateFrom = $config['date_from'] ?? '';
    $savedDateTo = $config['date_to'] ?? '';
    $savedStatus = $config['status_filter'] ?? 'all';
    $savedLearner = $config['learner_filter'] ?? 'all';
    $savedCourse = $config['course_filter'] ?? 'all';
    $savedUserStatus = $config['user_status_filter'] ?? 'all';
    $savedCourseActive = $config['course_active_filter'] ?? 'all';
    $savedDepartment = $config['department_filter'] ?? 'all';
    $savedDesignation = $config['designation_filter'] ?? 'all';

    $savedFields = array_values(array_filter($config['fields'] ?? ($config['selected_fields'] ?? []), function($k) {
        return $k === 'users.emp_id' || (!str_ends_with($k, '.id') && !str_ends_with($k, '_id'));
    }));
    $savedSortField = $config['sort_field'] ?? '';
    $savedSortDirection = $config['sort_direction'] ?? 'desc';
    $savedAssessmentName = $config['assessment_name_filter'] ?? '';
    $savedAssessmentAssign = $config['assessment_assignment_filter'] ?? 'Total';
    $savedCertStatus = $config['certificate_status_filter'] ?? 'All';
    $savedFeedbackType = $config['feedback_type_filter'] ?? 'Total';
    $savedVideoType = $config['video_type_filter'] ?? 'All';
    $savedVideoWatch = $config['video_watch_filter'] ?? 'Total';
    $savedExamResult = $config['exam_result_filter'] ?? 'Total';
@endphp

<div class="container-fluid py-3">
    <!-- Header -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <h4 class="mb-1 text-dark fw-bold"><i class="fa-solid fa-sliders text-teal me-2" style="color: #008080;"></i>Edit Report Builder: {{ $report->name }}</h4>
            <p class="text-muted mb-0 font-smallsize">Configure custom query rules, filters, grouping, calculations and visualization.</p>
        </div>
        <div class="col-md-6 text-md-end mt-2 mt-md-0">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Saved Reports
            </a>
        </div>
    </div>

    <!-- Builder Form Card -->
    <div class="card card-border shadow-none border mb-4">
        <div class="card-body p-4">
            <form id="reportBuilderForm">
                @csrf
                @method('PUT')
                <div id="orderedFieldsContainer" style="display:none;"></div>

                <!-- STEP 1: Select Data Sources -->
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-circle p-2 me-2 text-white" style="background-color: #008080; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">1</span>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark">Select Data Sources <span class="badge ms-2 px-2 py-1 font-smallsize text-white" id="selectedSourcesBadge" style="background-color: #008080;">{{ count($savedSources) }} {{ count($savedSources) === 1 ? 'Source Selected' : 'Sources Selected' }}</span></h5>
                                <small class="text-muted">Select one or multiple related data sources to build a complete cross-functional report.</small>
                            </div>
                        </div>
                        <div class="mt-2 mt-sm-0">
                            <button type="button" class="btn btn-xs btn-outline-teal me-1" id="btnSelectAllSources" style="color: #008080; border-color: #008080;">
                                <i class="fa-solid fa-check-double me-1"></i> Select All Sources
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" id="btnClearAllSources">
                                <i class="fa-solid fa-rotate-left me-1"></i> Reset Selection
                            </button>
                        </div>
                    </div>
                    <div class="row g-3">
                        @foreach($dataSources as $key => $src)
                            <div class="col-md-4 col-sm-6">
                                <label class="card h-100 source-card p-3 {{ in_array($key, $savedSources) ? 'border-teal active-source-card' : '' }}" style="cursor: pointer; transition: all 0.2s ease;">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <div class="source-icon-box">
                                            <i class="{{ $src['icon'] ?? 'fa-solid fa-database' }}"></i>
                                        </div>
                                        <div class="source-check-indicator">
                                            <input type="checkbox" name="data_sources[]" value="{{ $key }}" class="form-check-input source-checkbox" {{ in_array($key, $savedSources) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="source-card-content">
                                        <h6 class="source-title mb-1 text-dark">{{ $src['label'] }}</h6>
                                        <p class="source-desc text-muted mb-0 font-smallsize">{{ $src['description'] }}</p>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- STEP 2: Select Fields -->
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-circle p-2 me-2 text-white" style="background-color: #008080; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">2</span>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark">Select Columns to Display <span class="badge bg-secondary ms-2 px-2 py-1 font-smallsize" id="selectedColumnsCount">0 columns selected</span></h5>
                                <small class="text-muted">Columns are organized by data source. <span class="text-dark fw-semibold"><i class="fa-solid fa-arrow-down-1-9 text-teal me-1" style="color: #008080;"></i>Selection order determines column position (#1, #2, #3...)</span> in Preview & Download.</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-white border-teal text-teal" style="color: #008080;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" id="columnSearchInput" class="form-control border-teal" placeholder="Search columns..." autocomplete="off">
                            </div>
                            <button type="button" class="btn btn-xs btn-outline-teal" id="selectAllFields" style="color: #008080; border-color: #008080;">
                                <i class="fa-solid fa-check-double me-1"></i>Select All
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-secondary" id="deselectAllFields">
                                <i class="fa-solid fa-rotate-left me-1"></i>Deselect All
                            </button>
                        </div>
                    </div>
                    <div id="fieldsContainer">
                        <div class="text-center py-3 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Loading fields...</div>
                    </div>
                </div>

                <!-- STEP 3: Simple & Smart Filters -->
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-circle p-2 me-2 text-white" style="background-color: #008080; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">3</span>
                                <h5 class="mb-0 fw-bold text-dark">Filter Records (Optional)</h5>
                            </div>
                            <small class="text-muted ms-4">Filter records by status, keyword, or date range.</small>
                        </div>
                    </div>

                    <!-- Universal Quick Filter Bar (Filter by Specific Learner, Course, Date Range & Status) -->
                    <div id="universalQuickFilterWrapper" class="p-3 mb-3 border rounded bg-light">
                        <div class="row g-3 align-items-center mb-2">
                            <!-- Filter by Specific Learner / User with Embedded Search Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-user text-teal me-1" style="color: #008080;"></i> Filter by Specific Learner / User:
                                </label>
                                <div class="position-relative" id="learnerFilterDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="learnerFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedLearnerLabel" class="text-truncate fw-semibold text-dark"><i class="fa-solid fa-users me-1 text-teal" style="color: #008080;"></i> All Learners (Everyone)</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="learner_filter" id="universalLearnerFilter" value="{{ $savedLearner }}">
                                    
                                    <!-- Embedded Search Dropdown Menu -->
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="learnerDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="p-1 mb-2 border-bottom bg-light rounded">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-teal text-teal" style="color: #008080;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" id="learnerSearchInput" class="form-control border-teal" placeholder="Type name, email, or emp ID to search..." autocomplete="off">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearLearnerSearch" title="Clear search"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>
                                        <div id="learnerOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <div class="text-center py-2 text-muted font-smallsize"><i class="fa-solid fa-spinner fa-spin me-1"></i> Loading learners...</div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Click dropdown and type in the search box to filter by learner name or email.</small>
                            </div>

                            <!-- Filter by Specific Course with Embedded Search Dropdown -->
                            <div class="col-md-6" id="universalCourseCol">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-book text-teal me-1" style="color: #008080;"></i> Filter by Specific Course:
                                </label>
                                <div class="position-relative" id="courseFilterDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="courseFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedCourseLabel" class="text-truncate fw-semibold text-dark"><i class="fa-solid fa-book me-1 text-teal" style="color: #008080;"></i> All Courses</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="course_filter" id="universalCourseFilter" value="{{ $savedCourse }}">
                                    
                                    <!-- Embedded Search Dropdown Menu -->
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="courseDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="p-1 mb-2 border-bottom bg-light rounded">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-teal text-teal" style="color: #008080;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" id="courseSearchInput" class="form-control border-teal" placeholder="Type course name or code to search..." autocomplete="off">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearCourseSearch" title="Clear search"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>
                                        <div id="courseOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <div class="text-center py-2 text-muted font-smallsize"><i class="fa-solid fa-spinner fa-spin me-1"></i> Loading courses...</div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Click dropdown and type in the search box to filter by course title.</small>
                            </div>
                        </div>

                        @php
                            $userStatusLabel = 'All Users (Active & Inactive)';
                            $userStatusIcon = '<i class="fa-solid fa-users me-1 text-teal" style="color: #008080;"></i>';
                            if ($savedUserStatus === '1' || $savedUserStatus === 'active') {
                                $userStatusLabel = 'Active Users Only';
                                $userStatusIcon = '<i class="fa-solid fa-user-check me-1 text-success"></i>';
                            } elseif ($savedUserStatus === '2' || $savedUserStatus === 'deactivated') {
                                $userStatusLabel = 'Deactivated Users Only';
                                $userStatusIcon = '<i class="fa-solid fa-user-slash me-1 text-warning"></i>';
                            } elseif ($savedUserStatus === '0' || $savedUserStatus === 'inactive') {
                                $userStatusLabel = 'Inactive Users Only';
                                $userStatusIcon = '<i class="fa-solid fa-user-xmark me-1 text-danger"></i>';
                            }

                            $courseActiveLabel = 'All Courses (Active & Inactive)';
                            $courseActiveIcon = '<i class="fa-solid fa-book me-1 text-teal" style="color: #008080;"></i>';
                            if ($savedCourseActive === '1' || $savedCourseActive === 'active') {
                                $courseActiveLabel = 'Active Courses Only';
                                $courseActiveIcon = '<i class="fa-solid fa-circle-check me-1 text-success"></i>';
                            } elseif ($savedCourseActive === '0' || $savedCourseActive === 'inactive') {
                                $courseActiveLabel = 'Inactive Courses Only';
                                $courseActiveIcon = '<i class="fa-solid fa-circle-pause me-1 text-warning"></i>';
                            }

                            $statusLabel = 'All Statuses';
                            $statusIcon = '<i class="fa-solid fa-layer-group me-1 text-teal" style="color: #008080;"></i>';
                            if ($savedStatus === 'in_progress' || $savedStatus === 'incomplete') {
                                $statusLabel = 'In Progress';
                                $statusIcon = '<i class="fa-solid fa-spinner me-1 text-warning"></i>';
                            } elseif ($savedStatus === 'completed') {
                                $statusLabel = 'Completed';
                                $statusIcon = '<i class="fa-solid fa-circle-check me-1 text-success"></i>';
                            } elseif ($savedStatus === 'not_started') {
                                $statusLabel = 'Not Started';
                                $statusIcon = '<i class="fa-regular fa-circle me-1 text-secondary"></i>';
                            } elseif ($savedStatus === 'expired') {
                                $statusLabel = 'Expired';
                                $statusIcon = '<i class="fa-solid fa-triangle-exclamation me-1 text-danger"></i>';
                            }

                            $selectedDeptName = 'All Departments';
                            if (isset($departments) && $savedDepartment !== 'all') {
                                foreach($departments as $d) {
                                    if ((string)$d->id === (string)$savedDepartment) {
                                        $selectedDeptName = $d->department_name;
                                        break;
                                    }
                                }
                            }

                            $selectedDesigName = 'All Designations';
                            if (isset($designations) && $savedDesignation !== 'all') {
                                foreach($designations as $ds) {
                                    if ((string)$ds->id === (string)$savedDesignation) {
                                        $selectedDesigName = $ds->designation_name;
                                        break;
                                    }
                                }
                            }

                            $datePresetLabels = [
                                'all' => 'All Time (No Date Filter)',
                                'today' => 'Today',
                                'yesterday' => 'Yesterday',
                                'last_7_days' => 'Last 7 Days',
                                'last_30_days' => 'Last 30 Days',
                                'this_month' => 'This Month',
                                'last_month' => 'Last Month',
                                'last_3_months' => 'Last 3 Months',
                                'this_year' => 'This Year',
                                'custom' => 'Custom Date Range...'
                            ];
                            $selectedPresetLabel = $datePresetLabels[$savedDatePreset] ?? 'All Time (No Date Filter)';
                        @endphp

                        <!-- Row 2: User Status, Course Availability (Active / Inactive Courses) & Course Status -->
                        <div class="row g-3 align-items-center mb-2 pt-2 border-top">
                            <!-- User Status Custom Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-user-check text-teal me-1" style="color: #008080;"></i> User Account Status:
                                </label>
                                <div class="position-relative" id="userStatusDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="userStatusFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedUserStatusLabel" class="text-truncate fw-semibold text-dark">{!! $userStatusIcon !!} {{ $userStatusLabel }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="user_status_filter" id="universalUserStatusFilter" value="{{ $savedUserStatus }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="userStatusDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="dropdown-item-custom dropdown-user-status-item p-2 rounded cursor-pointer {{ $savedUserStatus === 'all' || empty($savedUserStatus) ? 'active-item' : '' }}" data-value="all" data-label="All Users (Active & Inactive)" style="cursor: pointer;">
                                            <div class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-users me-2 text-teal" style="color: #008080;"></i>All Users (Active & Inactive)</div>
                                            <small class="text-muted font-smallsize">Show records for both active and inactive users</small>
                                        </div>
                                        <div class="dropdown-item-custom dropdown-user-status-item p-2 rounded cursor-pointer border-top mt-1 {{ $savedUserStatus === '1' || $savedUserStatus === 'active' ? 'active-item' : '' }}" data-value="1" data-label="Active Users Only" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-user-check me-2 text-success"></i>Active Users Only</span>
                                                <span class="badge bg-success text-white font-smallsize" style="font-size: 10.5px;">Active</span>
                                            </div>
                                            <small class="text-muted font-smallsize">Show records only for active learner accounts</small>
                                        </div>
                                        <div class="dropdown-item-custom dropdown-user-status-item p-2 rounded cursor-pointer border-top mt-1 {{ $savedUserStatus === '0' || $savedUserStatus === 'inactive' ? 'active-item' : '' }}" data-value="0" data-label="Inactive Users Only" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-user-xmark me-2 text-warning"></i>Inactive Users Only</span>
                                                <span class="badge bg-warning text-dark font-smallsize" style="font-size: 10.5px;">Inactive</span>
                                            </div>
                                            <small class="text-muted font-smallsize">Show records only for inactive accounts</small>
                                        </div>
                                        <div class="dropdown-item-custom dropdown-user-status-item p-2 rounded cursor-pointer border-top mt-1 {{ $savedUserStatus === '2' || $savedUserStatus === 'deactivated' ? 'active-item' : '' }}" data-value="2" data-label="Deactivated Users Only" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-user-slash me-2 text-danger"></i>Deactivated Users Only</span>
                                                <span class="badge bg-danger text-white font-smallsize" style="font-size: 10.5px;">Deactivated</span>
                                            </div>
                                            <small class="text-muted font-smallsize">Show records only for deactivated users with deactivation description</small>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Filter reports by learner account status.</small>
                            </div>

                            <!-- Course Availability Status (Active Courses / Inactive Courses) Custom Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-toggle-on text-teal me-1" style="color: #008080;"></i> Course Availability Status:
                                </label>
                                <div class="position-relative" id="courseActiveDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="courseActiveFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedCourseActiveLabel" class="text-truncate fw-semibold text-dark">{!! $courseActiveIcon !!} {{ $courseActiveLabel }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="course_active_filter" id="universalCourseActiveFilter" value="{{ $savedCourseActive }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="courseActiveDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="dropdown-item-custom dropdown-course-active-item p-2 rounded cursor-pointer {{ $savedCourseActive === 'all' || empty($savedCourseActive) ? 'active-item' : '' }}" data-value="all" data-label="All Courses (Active & Inactive)" style="cursor: pointer;">
                                            <div class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-book me-2 text-teal" style="color: #008080;"></i>All Courses (Active & Inactive)</div>
                                            <small class="text-muted font-smallsize">Show both published active and unpublished inactive courses</small>
                                        </div>
                                        <div class="dropdown-item-custom dropdown-course-active-item p-2 rounded cursor-pointer border-top mt-1 {{ $savedCourseActive === '1' || $savedCourseActive === 'active' ? 'active-item' : '' }}" data-value="1" data-label="Active Courses Only" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-circle-check me-2 text-success"></i>Active Courses Only</span>
                                                <span class="badge bg-success text-white font-smallsize" style="font-size: 10.5px;">Active</span>
                                            </div>
                                            <small class="text-muted font-smallsize">Show only currently active courses in catalog</small>
                                        </div>
                                        <div class="dropdown-item-custom dropdown-course-active-item p-2 rounded cursor-pointer border-top mt-1 {{ $savedCourseActive === '0' || $savedCourseActive === 'inactive' ? 'active-item' : '' }}" data-value="0" data-label="Inactive Courses Only" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-circle-pause me-2 text-warning"></i>Inactive Courses Only</span>
                                                <span class="badge bg-warning text-dark font-smallsize" style="font-size: 10.5px;">Inactive</span>
                                            </div>
                                            <small class="text-muted font-smallsize">Show only inactive, archived, or disabled courses</small>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Filter reports by active or inactive course catalog status.</small>
                            </div>

                            <!-- Course Progress / Result State Custom Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1" id="universalStatusFilterLabel">
                                    <i class="fa-solid fa-list-check text-teal me-1" style="color: #008080;"></i> Course Status:
                                </label>
                                <div class="position-relative" id="statusFilterDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="statusFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedStatusFilterLabel" class="text-truncate fw-semibold text-dark">{!! $statusIcon !!} {{ $statusLabel }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="status_filter" id="universalStatusFilter" value="{{ $savedStatus }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="statusFilterDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div id="statusOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <!-- Dynamically populated via updateStatusFilterOptions -->
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Filter records by learning stage or progress status.</small>
                            </div>
                        </div>

                        <!-- Row 3: Department & Designation Filter Row -->
                        <div class="row g-3 align-items-center mb-2 pt-2 border-top">
                            <!-- Department Custom Searchable Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-building text-teal me-1" style="color: #008080;"></i> Department:
                                </label>
                                <div class="position-relative" id="departmentFilterDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="departmentFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedDepartmentLabel" class="text-truncate fw-semibold text-dark"><i class="fa-solid fa-building me-1 text-teal" style="color: #008080;"></i> {{ $selectedDeptName }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="department_filter" id="universalDepartmentFilter" value="{{ $savedDepartment }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="departmentDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="p-1 mb-2 border-bottom bg-light rounded">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-teal text-teal" style="color: #008080;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" id="departmentSearchInput" class="form-control border-teal" placeholder="Type department name to search..." autocomplete="off">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearDepartmentSearch" title="Clear search"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>
                                        <div id="departmentOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <div class="dropdown-item-custom dropdown-department-item p-2 rounded cursor-pointer {{ $savedDepartment === 'all' ? 'active-item' : '' }}" data-value="all" data-label="All Departments" style="cursor: pointer;">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-building me-2 text-teal" style="color: #008080;"></i>All Departments</span>
                                            </div>
                                            @if(isset($departments) && count($departments) > 0)
                                                @foreach($departments as $dept)
                                                    <div class="dropdown-item-custom dropdown-department-item p-2 rounded cursor-pointer border-top mt-1 {{ (string)$savedDepartment === (string)$dept->id ? 'active-item' : '' }}" data-value="{{ $dept->id }}" data-search="{{ strtolower($dept->department_name) }}" data-label="{{ $dept->department_name }}" style="cursor: pointer;">
                                                        <span class="fw-semibold text-dark font-smallsize"><i class="fa-solid fa-layer-group text-secondary me-2"></i>{{ $dept->department_name }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Filter learners by corporate department.</small>
                            </div>

                            <!-- Designation Custom Searchable Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-id-badge text-teal me-1" style="color: #008080;"></i> Designation:
                                </label>
                                <div class="position-relative" id="designationFilterDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="designationFilterBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedDesignationLabel" class="text-truncate fw-semibold text-dark"><i class="fa-solid fa-id-badge me-1 text-teal" style="color: #008080;"></i> {{ $selectedDesigName }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="designation_filter" id="universalDesignationFilter" value="{{ $savedDesignation }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="designationDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div class="p-1 mb-2 border-bottom bg-light rounded">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-teal text-teal" style="color: #008080;"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" id="designationSearchInput" class="form-control border-teal" placeholder="Type designation to search..." autocomplete="off">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearDesignationSearch" title="Clear search"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>
                                        <div id="designationOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <div class="dropdown-item-custom dropdown-designation-item p-2 rounded cursor-pointer {{ $savedDesignation === 'all' ? 'active-item' : '' }}" data-value="all" data-label="All Designations" style="cursor: pointer;">
                                                <span class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-id-badge me-2 text-teal" style="color: #008080;"></i>All Designations</span>
                                            </div>
                                            @if(isset($designations) && count($designations) > 0)
                                                @foreach($designations as $desig)
                                                    <div class="dropdown-item-custom dropdown-designation-item p-2 rounded cursor-pointer border-top mt-1 {{ (string)$savedDesignation === (string)$desig->id ? 'active-item' : '' }}" data-value="{{ $desig->id }}" data-search="{{ strtolower($desig->designation_name) }}" data-label="{{ $desig->designation_name }}" style="cursor: pointer;">
                                                        <span class="fw-semibold text-dark font-smallsize"><i class="fa-solid fa-briefcase text-secondary me-2"></i>{{ $desig->designation_name }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Filter learners by job title or role.</small>
                            </div>
                        </div>

                        <!-- Row 4: Date Range Preset, From Date & To Date (All in One Row) -->
                        <div class="row g-3 align-items-center mb-2 pt-2 border-top" id="customDateRangeRow">
                            <!-- Quick Date Presets Custom Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-regular fa-calendar text-teal me-1" style="color: #008080;"></i> Date Range Preset:
                                </label>
                                <div class="position-relative" id="datePresetDropdownWrapper">
                                    <button type="button" class="form-select form-select-sm border-teal text-start d-flex justify-content-between align-items-center w-100 shadow-sm" id="datePresetBtn" style="background-color: #ffffff; cursor: pointer; min-height: 38px;">
                                        <span id="selectedDatePresetLabel" class="text-truncate fw-semibold text-dark"><i class="fa-regular fa-calendar me-1 text-teal" style="color: #008080;"></i> {{ $selectedPresetLabel }}</span>
                                        <i class="fa-solid fa-chevron-down ms-2 text-muted" style="font-size: 11px;"></i>
                                    </button>
                                    <input type="hidden" name="date_preset" id="datePresetFilter" value="{{ $savedDatePreset }}">
                                    
                                    <div class="custom-dropdown-menu shadow-lg border rounded p-2 bg-white d-none position-absolute w-100" id="datePresetDropdownMenu" style="top: 100%; left: 0; z-index: 1050; margin-top: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; border-color: #008080 !important;">
                                        <div id="datePresetOptionsList" style="overflow-y: auto; max-height: 250px;">
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'all' ? 'active-item' : '' }}" data-value="all" data-label="All Time (No Date Filter)" style="cursor: pointer;">
                                                <i class="fa-regular fa-calendar-check me-2 text-teal" style="color: #008080;"></i>All Time (No Date Filter)
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'today' ? 'active-item' : '' }}" data-value="today" data-label="Today" style="cursor: pointer;">
                                                <i class="fa-regular fa-sun me-2 text-warning"></i>Today
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'yesterday' ? 'active-item' : '' }}" data-value="yesterday" data-label="Yesterday" style="cursor: pointer;">
                                                <i class="fa-regular fa-clock me-2 text-secondary"></i>Yesterday
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'last_7_days' ? 'active-item' : '' }}" data-value="last_7_days" data-label="Last 7 Days" style="cursor: pointer;">
                                                <i class="fa-solid fa-calendar-week me-2 text-info"></i>Last 7 Days
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'last_30_days' ? 'active-item' : '' }}" data-value="last_30_days" data-label="Last 30 Days" style="cursor: pointer;">
                                                <i class="fa-solid fa-calendar-days me-2 text-primary"></i>Last 30 Days
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'this_month' ? 'active-item' : '' }}" data-value="this_month" data-label="This Month" style="cursor: pointer;">
                                                <i class="fa-regular fa-calendar me-2 text-success"></i>This Month
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'last_month' ? 'active-item' : '' }}" data-value="last_month" data-label="Last Month" style="cursor: pointer;">
                                                <i class="fa-regular fa-calendar-minus me-2 text-secondary"></i>Last Month
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'last_3_months' ? 'active-item' : '' }}" data-value="last_3_months" data-label="Last 3 Months" style="cursor: pointer;">
                                                <i class="fa-solid fa-calendar me-2 text-primary"></i>Last 3 Months
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'this_year' ? 'active-item' : '' }}" data-value="this_year" data-label="This Year" style="cursor: pointer;">
                                                <i class="fa-solid fa-calendar-check me-2 text-teal" style="color: #008080;"></i>This Year
                                            </div>
                                            <div class="dropdown-item-custom dropdown-date-preset-item py-1 px-2 rounded cursor-pointer {{ $savedDatePreset === 'custom' ? 'active-item' : '' }}" data-value="custom" data-label="Custom Date Range..." style="cursor: pointer;">
                                                <i class="fa-solid fa-sliders me-2 text-dark"></i>Custom Date Range...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted font-smallsize">Quick period filter.</small>
                            </div>

                            <!-- From Date -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-regular fa-calendar-days text-teal me-1" style="color: #008080;"></i> From Date:
                                </label>
                                <input type="date" name="date_from" id="dateFromFilter" class="form-control form-control-sm border-teal" value="{{ $savedDateFrom }}" style="min-height: 38px;">
                                <small class="text-muted font-smallsize">Start date of period.</small>
                            </div>

                            <!-- To Date -->
                            <div class="col-md-4">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-regular fa-calendar-check text-teal me-1" style="color: #008080;"></i> To Date:
                                </label>
                                <input type="date" name="date_to" id="dateToFilter" class="form-control form-control-sm border-teal" value="{{ $savedDateTo }}" style="min-height: 38px;">
                                <small class="text-muted font-smallsize">End date of period.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Dedicated Standalone Dropdowns for Course Assessments -->
                    <div id="assessmentDedicatedFilterWrapper" class="p-3 mb-3 border rounded bg-light d-none">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-magnifying-glass text-teal me-1" style="color: #008080;"></i> Assessment Name:
                                </label>
                                <input type="text" name="assessment_name_filter" id="assessmentNameFilter" class="form-control form-control-sm border-teal" placeholder="Search assessment..." value="{{ $savedAssessmentName }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-filter text-teal me-1" style="color: #008080;"></i> Assignment Type:
                                </label>
                                <select name="assessment_assignment_filter" id="assessmentQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="Total" {{ $savedAssessmentAssign === 'Total' ? 'selected' : '' }}>Total (All)</option>
                                    <option value="Assigned" {{ $savedAssessmentAssign === 'Assigned' ? 'selected' : '' }}>Assigned Only</option>
                                    <option value="Reassigned" {{ $savedAssessmentAssign === 'Reassigned' ? 'selected' : '' }}>Reassigned Only</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Dedicated Standalone Dropdown for Certificates -->
                    <div id="certificatesDedicatedFilterWrapper" class="p-3 mb-3 border rounded bg-light d-none">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-5">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-filter text-teal me-1" style="color: #008080;"></i> Certificate Status Filter:
                                </label>
                                <select name="certificate_status_filter" id="certificateStatusQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="All" {{ $savedCertStatus === 'All' ? 'selected' : '' }}>All (Active & Inactive)</option>
                                    <option value="1" {{ (string)$savedCertStatus === '1' ? 'selected' : '' }}>Active Only</option>
                                    <option value="0" {{ (string)$savedCertStatus === '0' ? 'selected' : '' }}>Inactive Only</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <small class="text-muted font-smallsize d-block mt-2 mt-md-0">
                                    <i class="fa-solid fa-circle-info text-teal me-1" style="color: #008080;"></i> 
                                    Switch easily between <strong>All</strong> (default), <strong>Active</strong>, or <strong>Inactive</strong> certificates.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Dedicated Standalone Dropdown for Ratings & Feedback -->
                    <div id="feedbackDedicatedFilterWrapper" class="p-3 mb-3 border rounded bg-light d-none">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-5">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-filter text-teal me-1" style="color: #008080;"></i> Feedback & Ratings Filter (Total / Overall / Category):
                                </label>
                                <select name="feedback_type_filter" id="feedbackTypeQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="Total" {{ $savedFeedbackType === 'Total' ? 'selected' : '' }}>Total (All Overall & Category)</option>
                                    <option value="Overall" {{ $savedFeedbackType === 'Overall' ? 'selected' : '' }}>Overall (Global Feedback)</option>
                                    <option value="Category" {{ $savedFeedbackType === 'Category' ? 'selected' : '' }}>Category (Course / Category Specific)</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <small class="text-muted font-smallsize d-block mt-2 mt-md-0">
                                    <i class="fa-solid fa-circle-info text-teal me-1" style="color: #008080;"></i> 
                                    Filter easily between <strong>Total</strong> (default), <strong>Overall</strong>, or <strong>Category</strong> ratings & feedback.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Dedicated Standalone Dropdown for Videos -->
                    <div id="videosDedicatedFilterWrapper" class="p-3 mb-3 border rounded bg-light d-none">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-photo-film text-teal me-1" style="color: #008080;"></i> Video & Content Type:
                                </label>
                                <select name="video_type_filter" id="videoTypeQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="All" {{ $savedVideoType === 'All' ? 'selected' : '' }}>All Content Types (Amazon, YouTube, Local, SCORM, Attachments)</option>
                                    <option value="1" {{ (string)$savedVideoType === '1' || strtolower((string)$savedVideoType) === 'amazon' ? 'selected' : '' }}>Amazon</option>
                                    <option value="2" {{ (string)$savedVideoType === '2' || strtolower((string)$savedVideoType) === 'youtube' ? 'selected' : '' }}>YouTube</option>
                                    <option value="3" {{ (string)$savedVideoType === '3' || strtolower((string)$savedVideoType) === 'local' ? 'selected' : '' }}>Local</option>
                                    <option value="4" {{ (string)$savedVideoType === '4' || strtolower((string)$savedVideoType) === 'scorm' ? 'selected' : '' }}>SCORM</option>
                                    <option value="5" {{ (string)$savedVideoType === '5' || strtolower((string)$savedVideoType) === 'attachments' || strtolower((string)$savedVideoType) === 'attachment' ? 'selected' : '' }}>Attachments</option>
                                </select>
                                <small class="text-muted font-smallsize d-block mt-1">
                                    Quick filter for <strong>Amazon</strong>, <strong>YouTube</strong>, <strong>Local</strong>, <strong>SCORM</strong>, or <strong>Attachments</strong>.
                                </small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-circle-check text-teal me-1" style="color: #008080;"></i> Video Watch Status (Total / Watched / Not Watched):
                                </label>
                                <select name="video_watch_filter" id="videoWatchQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="Total" {{ $savedVideoWatch === 'Total' ? 'selected' : '' }}>Total (All Watched & Not Watched)</option>
                                    <option value="Watched" {{ $savedVideoWatch === 'Watched' ? 'selected' : '' }}>Watched (Completed Videos)</option>
                                    <option value="Not Watched" {{ $savedVideoWatch === 'Not Watched' ? 'selected' : '' }}>Not Watched (Pending Videos)</option>
                                </select>
                                <small class="text-muted font-smallsize d-block mt-1">
                                    Filter easily between <strong>Total</strong>, <strong>Watched</strong>, or <strong>Not Watched</strong> video content.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Dedicated Standalone Dropdown for Assignment Exams -->
                    <div id="examsDedicatedFilterWrapper" class="p-3 mb-3 border rounded bg-light d-none">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-5">
                                <label class="form-label font-smallsize fw-bold text-dark mb-1">
                                    <i class="fa-solid fa-file-pen text-teal me-1" style="color: #008080;"></i> Exam Result Filter (Total / Passed / Failed / Pending / Not Attempted):
                                </label>
                                <select name="exam_result_filter" id="examResultQuickFilter" class="form-select form-select-sm border-teal">
                                    <option value="Total" {{ $savedExamResult === 'Total' ? 'selected' : '' }}>Total (All Attempts & Records)</option>
                                    <option value="Passed" {{ $savedExamResult === 'Passed' ? 'selected' : '' }}>Passed (Successful Attempts)</option>
                                    <option value="Failed" {{ $savedExamResult === 'Failed' ? 'selected' : '' }}>Failed (Unsuccessful Attempts)</option>
                                    <option value="Pending" {{ $savedExamResult === 'Pending' ? 'selected' : '' }}>Pending Evaluation</option>
                                    <option value="Not Attempted" {{ $savedExamResult === 'Not Attempted' ? 'selected' : '' }}>Not Attempted</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <small class="text-muted font-smallsize d-block mt-2 mt-md-0">
                                    <i class="fa-solid fa-circle-info text-teal me-1" style="color: #008080;"></i> 
                                    Filter easily between <strong>Total</strong> (default), <strong>Passed</strong>, <strong>Failed</strong>, <strong>Pending Evaluation</strong>, or <strong>Not Attempted</strong> assignment exams.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div id="filtersContainer" class="d-none"></div>
                </div>

                <!-- STEP 4: Sorting Options -->
                <div class="mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge rounded-circle p-2 me-2 text-white" style="background-color: #008080; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">4</span>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Sort Records (Optional)</h5>
                            <small class="text-muted">Set the primary sorting column and order direction for your reports.</small>
                        </div>
                    </div>
                    <div id="step4SortWrapper">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fa-solid fa-arrow-down-short-wide text-teal me-2" style="color: #008080;"></i> Order By Column:
                                </label>
                                <select name="sort_field" id="sortFieldSelect" class="form-select">
                                </select>
                                <small class="text-muted">Select the primary column to sort result rows by.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fa-solid fa-arrow-up-z-a text-teal me-2" style="color: #008080;"></i> Order Direction:
                                </label>
                                <select name="sort_direction" class="form-select">
                                    <option value="desc" {{ $savedSortDirection === 'desc' ? 'selected' : '' }}>Newest / Highest First</option>
                                    <option value="asc" {{ $savedSortDirection === 'asc' ? 'selected' : '' }}>Oldest / A-Z First</option>
                                </select>
                                <small class="text-muted">Sort direction (descending or ascending order).</small>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="output_type" id="outputTypeInput" value="table">
                </div>

                <!-- Action Buttons: Preview & Save -->
                <div class="d-flex flex-wrap justify-content-between align-items-center report-action-bar gap-3">
                    <div class="d-flex align-items-center text-muted font-smallsize">
                        <i class="fa-solid fa-circle-info text-teal me-2" style="color: #008080; font-size: 16px;"></i>
                        <span>Click <strong>Live Preview</strong> to inspect the dataset, or <strong>Update Report</strong> to save changes.</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-preview-action" id="btnPreview">
                            <i class="fa-solid fa-eye me-1"></i> Live Preview
                        </button>
                        <button type="button" class="btn btn-save-action" id="btnOpenSaveModal">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Update Report
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- PREVIEW RESULTS SECTION -->
    <div class="card card-border shadow-none border d-none" id="previewCard">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-table-list me-2 text-teal" style="color: #008080;"></i>Report Preview (<span id="previewCount">0</span> records)</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-download me-1"></i> Export Preview
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border">
                        <li>
                            <a class="dropdown-item btn-export-preview" href="javascript:void(0);" data-format="csv">
                                <i class="fa-solid fa-file-csv text-success me-2"></i> CSV (.csv)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item btn-export-preview" href="javascript:void(0);" data-format="excel">
                                <i class="fa-solid fa-file-excel text-success me-2"></i> Excel (.xls)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item btn-export-preview" href="javascript:void(0);" data-format="pdf">
                                <i class="fa-solid fa-file-pdf text-danger me-2"></i> PDF (Print Landscape)
                            </a>
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="$('#previewCard').addClass('d-none');">
                    <i class="fa-solid fa-xmark"></i> Close Preview
                </button>
            </div>
        </div>
        <div class="card-body p-3">
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <style>
                #previewTable {
                    min-width: 100%;
                    border-collapse: separate;
                    border-spacing: 0;
                    border: 1px solid #d1d5db;
                    background-color: #ffffff !important;
                }
                #previewTable thead th,
                #previewTable thead tr,
                #previewTable thead th:hover,
                #previewTable thead tr:hover,
                #previewTable thead tr:hover > th {
                    position: sticky;
                    top: 0;
                    z-index: 10;
                    background: linear-gradient(135deg, #008080 0%, #006666 100%) !important;
                    background-color: #008080 !important;
                    color: #ffffff !important;
                    font-weight: 600 !important;
                    font-size: 13px !important;
                    padding: 12px 14px !important;
                    border: 1px solid #005555 !important;
                    box-shadow: inset 0 1px 0 rgba(255,255,255,0.1), inset 0 -1px 0 rgba(0,0,0,0.15) !important;
                    white-space: nowrap !important;
                    vertical-align: middle !important;
                    letter-spacing: 0.2px;
                }
                #previewTable td {
                    vertical-align: top !important;
                    padding: 10px 14px !important;
                    font-size: 13px !important;
                    line-height: 1.5 !important;
                    border: 1px solid #e5e7eb !important;
                    color: #1f2937 !important;
                    background-color: #ffffff !important;
                }
                #previewTable tbody tr,
                #previewTable tbody td {
                    background-color: #ffffff !important;
                    background: #ffffff !important;
                    color: #1f2937 !important;
                }
                #previewTable tbody tr:hover,
                #previewTable tbody tr:hover > td,
                #previewTable tbody td:hover {
                    background-color: #ffffff !important;
                    background: #ffffff !important;
                    color: #1f2937 !important;
                    box-shadow: none !important;
                    --bs-table-accent-bg: transparent !important;
                    --bs-table-bg-state: transparent !important;
                    --bs-table-hover-bg: transparent !important;
                }
                #previewTable .line-item-entry {
                    padding: 3px 0;
                    min-height: 28px;
                }
                #previewTable .line-item-entry + .line-item-entry {
                    border-top: 1px dashed #e2e8f0;
                    margin-top: 4px;
                    padding-top: 4px;
                }

                /* Custom Searchable Dropdown Styling */
                .custom-dropdown-menu {
                    background-color: #ffffff !important;
                    border: 1.5px solid #008080 !important;
                    border-radius: 8px !important;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
                    z-index: 1060 !important;
                    max-height: 250px !important;
                    overflow-y: auto !important;
                    padding: 6px !important;
                }
                #datePresetOptionsList,
                #departmentOptionsList,
                #designationOptionsList,
                #learnerOptionsList,
                #courseOptionsList,
                #statusOptionsList {
                    max-height: 235px !important;
                    overflow-y: auto !important;
                }
                .dropdown-item-custom, .dropdown-course-item, .dropdown-date-preset-item {
                    transition: all 0.15s ease !important;
                    border-radius: 5px !important;
                    padding: 6px 10px !important;
                    margin-bottom: 2px !important;
                    margin-top: 0 !important;
                    border-top: none !important;
                    font-size: 13px !important;
                    line-height: 1.35 !important;
                }
                .dropdown-item-custom:hover, .dropdown-course-item:hover, .dropdown-date-preset-item:hover {
                    background-color: #e0f2f1 !important;
                }
                .dropdown-item-custom.active-item, .dropdown-course-item.active-item, .dropdown-date-preset-item.active-item {
                    background-color: #008080 !important;
                    color: #ffffff !important;
                }
                .dropdown-item-custom.active-item i,
                .dropdown-item-custom.active-item span,
                .dropdown-item-custom.active-item div,
                .dropdown-item-custom.active-item .text-dark,
                .dropdown-item-custom.active-item .text-muted,
                .dropdown-course-item.active-item i,
                .dropdown-course-item.active-item span,
                .dropdown-course-item.active-item div,
                .dropdown-course-item.active-item .text-dark,
                .dropdown-course-item.active-item .text-muted {
                    color: #ffffff !important;
                }
            
                /* Modern Data Source Selection Cards */
                .source-card {
                    border: 1.5px solid #e5e7eb !important;
                    border-radius: 10px !important;
                    background-color: #ffffff !important;
                    padding: 16px !important;
                    cursor: pointer !important;
                    transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    position: relative !important;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
                    user-select: none;
                }
                .source-card:hover {
                    border-color: #008080 !important;
                    background-color: #fbfdfd !important;
                    box-shadow: 0 4px 12px rgba(0, 128, 128, 0.08) !important;
                    transform: translateY(-2px);
                }
                .source-card.active-source-card,
                .source-card.border-teal {
                    border-color: #008080 !important;
                    border-width: 2px !important;
                    background-color: #f2faf9 !important;
                    box-shadow: 0 4px 14px rgba(0, 128, 128, 0.12) !important;
                }
                .source-card .source-icon-box {
                    width: 38px;
                    height: 38px;
                    border-radius: 8px;
                    background-color: #e6f3f3;
                    color: #008080;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 16px;
                    transition: all 0.2s ease;
                }
                .source-card.active-source-card .source-icon-box,
                .source-card.border-teal .source-icon-box {
                    background-color: #008080;
                    color: #ffffff;
                    box-shadow: 0 2px 6px rgba(0, 128, 128, 0.25);
                }
                .source-card .source-checkbox {
                    width: 19px !important;
                    height: 19px !important;
                    margin: 0 !important;
                    cursor: pointer !important;
                    accent-color: #008080 !important;
                }
                .source-card .source-title {
                    font-size: 14px;
                    font-weight: 700;
                    letter-spacing: -0.1px;
                }
                .source-card .source-desc {
                    font-size: 12px;
                    line-height: 1.4;
                    color: #64748b;
                }

                /* Source Group & Columns Display */
                .source-field-group {
                    border: 1px solid #e5e7eb !important;
                    border-radius: 10px !important;
                    overflow: hidden;
                    background: #ffffff;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
                }
                .source-field-group .card-header {
                    background-color: #f8fafc !important;
                    border-bottom: 1px solid #e5e7eb !important;
                    padding: 10px 16px !important;
                }
                .source-group-icon {
                    font-size: 15px;
                    color: #008080;
                }
                .source-group-count-badge {
                    font-size: 11px !important;
                    font-weight: 600 !important;
                    border-radius: 20px !important;
                    transition: all 0.2s ease;
                }

                /* Field Item Tile */
                .field-col-item .form-check {
                    display: flex !important;
                    flex-direction: column !important;
                    justify-content: flex-start !important;
                    padding: 10px 12px !important;
                    margin: 0 !important;
                    min-height: 66px !important;
                    border: 1.5px solid #e2e8f0 !important;
                    border-radius: 8px !important;
                    background-color: #ffffff !important;
                    box-shadow: none !important;
                    transition: all 0.18s ease-in-out !important;
                    cursor: pointer !important;
                    position: relative !important;
                    user-select: none;
                }
                .field-col-item .form-check:hover {
                    border-color: #008080 !important;
                    background-color: #fafefe !important;
                    box-shadow: 0 2px 6px rgba(0, 128, 128, 0.08) !important;
                }
                .field-col-item .form-check.border-teal {
                    border-color: #008080 !important;
                    border-width: 1.5px !important;
                    background-color: #f0fdfa !important;
                    box-shadow: 0 2px 6px rgba(0, 128, 128, 0.12) !important;
                }
                .field-col-item .form-check-input {
                    float: none !important;
                    margin: 0 8px 0 0 !important;
                    width: 16px !important;
                    height: 16px !important;
                    flex-shrink: 0 !important;
                    accent-color: #008080 !important;
                    cursor: pointer !important;
                }
                .field-col-item .form-check-label {
                    font-size: 12.5px !important;
                    font-weight: 600 !important;
                    color: #1e293b !important;
                    cursor: pointer !important;
                    line-height: 1.25 !important;
                }
                .field-col-item .field-desc {
                    font-size: 11px !important;
                    line-height: 1.35 !important;
                    color: #64748b !important;
                    padding-left: 24px !important;
                    margin-top: 3px !important;
                    display: -webkit-box !important;
                    -webkit-line-clamp: 2 !important;
                    -webkit-box-orient: vertical !important;
                    overflow: hidden !important;
                    text-overflow: ellipsis !important;
                }
            
                /* Step 3: Modern Filter Records Card */
                #universalQuickFilterWrapper {
                    background: #ffffff !important;
                    border: 1.5px solid #e5e7eb !important;
                    border-radius: 12px !important;
                    padding: 20px 24px !important;
                    box-shadow: 0 1px 4px rgba(0,0,0,0.03) !important;
                }
                #universalQuickFilterWrapper .border-top {
                    border-top: 1px solid #edf2f7 !important;
                    padding-top: 16px !important;
                    margin-top: 14px !important;
                }

                /* Contextual Dedicated Filter Wrappers */
                #assessmentDedicatedFilterWrapper,
                #certificatesDedicatedFilterWrapper,
                #feedbackDedicatedFilterWrapper,
                #videosDedicatedFilterWrapper,
                #examsDedicatedFilterWrapper {
                    background: #f0fdfa !important;
                    border: 1.5px solid #99f6e4 !important;
                    border-radius: 10px !important;
                    padding: 16px 20px !important;
                    box-shadow: 0 2px 6px rgba(0, 128, 128, 0.05) !important;
                }

                /* Filter Inputs & Dropdown Triggers */
                #universalQuickFilterWrapper .form-select,
                #universalQuickFilterWrapper .form-control,
                #universalQuickFilterWrapper button.form-select,
                #step4SortWrapper .form-select {
                    border: 1.5px solid #cbd5e1 !important;
                    border-radius: 8px !important;
                    background-color: #ffffff !important;
                    color: #1e293b !important;
                    font-size: 13px !important;
                    font-weight: 500 !important;
                    min-height: 40px !important;
                    padding: 8px 14px !important;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.02) !important;
                    transition: all 0.2s ease-in-out !important;
                }
                #universalQuickFilterWrapper .form-select:hover,
                #universalQuickFilterWrapper .form-control:hover,
                #universalQuickFilterWrapper button.form-select:hover,
                #step4SortWrapper .form-select:hover {
                    border-color: #008080 !important;
                    background-color: #fcfefe !important;
                }
                #universalQuickFilterWrapper .form-select:focus,
                #universalQuickFilterWrapper .form-control:focus,
                #universalQuickFilterWrapper button.form-select:focus,
                #step4SortWrapper .form-select:focus {
                    border-color: #008080 !important;
                    box-shadow: 0 0 0 3px rgba(0, 128, 128, 0.15) !important;
                    outline: none !important;
                }

                /* Filter Labels */
                #universalQuickFilterWrapper .form-label,
                #step4SortWrapper .form-label {
                    font-size: 13px !important;
                    font-weight: 700 !important;
                    color: #1e293b !important;
                    margin-bottom: 6px !important;
                    display: flex;
                    align-items: center;
                }

                /* Filter Helper Text */
                #universalQuickFilterWrapper small.text-muted,
                #step4SortWrapper small.text-muted {
                    font-size: 11px !important;
                    color: #64748b !important;
                    margin-top: 4px !important;
                    display: block;
                }

                /* Step 4: Sort Records Card */
                #step4SortWrapper {
                    background: #ffffff !important;
                    border: 1.5px solid #e5e7eb !important;
                    border-radius: 12px !important;
                    padding: 20px 24px !important;
                    box-shadow: 0 1px 4px rgba(0,0,0,0.03) !important;
                }

                /* Action Buttons Bar */
                .report-action-bar {
                    background: #f8fafc !important;
                    border: 1.5px solid #e2e8f0 !important;
                    border-radius: 12px !important;
                    padding: 16px 24px !important;
                    margin-top: 24px !important;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
                }
                .report-action-bar .btn-preview-action {
                    background: linear-gradient(135deg, #008080 0%, #006666 100%) !important;
                    border: none !important;
                    color: #ffffff !important;
                    font-weight: 600 !important;
                    font-size: 14px !important;
                    padding: 9px 24px !important;
                    border-radius: 8px !important;
                    box-shadow: 0 2px 8px rgba(0, 128, 128, 0.25) !important;
                    transition: all 0.2s ease !important;
                }
                .report-action-bar .btn-preview-action:hover {
                    box-shadow: 0 4px 14px rgba(0, 128, 128, 0.35) !important;
                    transform: translateY(-1px);
                }
                .report-action-bar .btn-save-action {
                    background: #10b981 !important;
                    border: none !important;
                    color: #ffffff !important;
                    font-weight: 600 !important;
                    font-size: 14px !important;
                    padding: 9px 24px !important;
                    border-radius: 8px !important;
                    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25) !important;
                    transition: all 0.2s ease !important;
                }
                .report-action-bar .btn-save-action:hover {
                    background: #059669 !important;
                    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35) !important;
                    transform: translateY(-1px);
                }
            </style>
            <div id="chartPreviewWrapper" class="mb-4 d-none" style="max-height: 380px; position: relative;">
                <canvas id="previewChart" height="120"></canvas>
            </div>

            <div class="table-responsive" style="min-height: 520px; max-height: 85vh; overflow-y: auto;">
                <table class="table table-bordered align-top mb-0 font-smallsize" id="previewTable">
                    <thead id="previewThead"></thead>
                    <tbody id="previewTbody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SAVE REPORT MODAL -->
<div class="modal fade" id="saveReportModal" tabindex="-1" aria-labelledby="saveReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="saveReportModalLabel"><i class="fa-solid fa-pen-to-square text-teal me-2" style="color: #008080;"></i>Update Saved Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold font-smallsize">Report Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="saveReportName" placeholder="e.g. Monthly Completed Enrollments by Department" value="{{ $report->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold font-smallsize">Description (Optional)</label>
                    <textarea class="form-control" id="saveReportDesc" rows="3" placeholder="Brief summary of what this report is for...">{{ $report->description }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnConfirmSave" style="background-color: #008080; border-color: #008080;">
                    <i class="fa-solid fa-check me-1"></i> Update Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT FOR REPORT BUILDER -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {
    let currentSchema = null;
    let chartInstance = null;
    let filterIndex = 0;
    let isInitialLoad = true;
    let savedFields = @json($savedFields);
    let savedSortField = "{{ $savedSortField }}";
    let savedDynamicFilters = @json($config['filters'] ?? []);
    let selectedFieldsOrder = Array.isArray(savedFields) && savedFields.length > 0 ? savedFields.slice() : [];

    function closeAllCustomDropdowns() {
        $('#learnerDropdownMenu, #courseDropdownMenu, #userStatusDropdownMenu, #courseActiveDropdownMenu, #statusFilterDropdownMenu, #departmentDropdownMenu, #designationDropdownMenu, #datePresetDropdownMenu').addClass('d-none');
    }

    // Toggle Learner Dropdown
    $(document).on('click', '#learnerFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#learnerDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#learnerDropdownMenu').removeClass('d-none');
            setTimeout(function () { $('#learnerSearchInput').focus(); }, 100);
        }
    });

    // Toggle Course Dropdown
    $(document).on('click', '#courseFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#courseDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#courseDropdownMenu').removeClass('d-none');
            setTimeout(function () { $('#courseSearchInput').focus(); }, 100);
        }
    });

    // Toggle User Status Dropdown
    $(document).on('click', '#userStatusFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#userStatusDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#userStatusDropdownMenu').removeClass('d-none');
        }
    });

    // Toggle Course Active Dropdown
    $(document).on('click', '#courseActiveFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#courseActiveDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#courseActiveDropdownMenu').removeClass('d-none');
        }
    });

    // Toggle Course Progress / State Dropdown
    $(document).on('click', '#statusFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#statusFilterDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#statusFilterDropdownMenu').removeClass('d-none');
        }
    });

    // Toggle Department Dropdown
    $(document).on('click', '#departmentFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#departmentDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#departmentDropdownMenu').removeClass('d-none');
            setTimeout(function () { $('#departmentSearchInput').focus(); }, 100);
        }
    });

    // Toggle Designation Dropdown
    $(document).on('click', '#designationFilterBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#designationDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#designationDropdownMenu').removeClass('d-none');
            setTimeout(function () { $('#designationSearchInput').focus(); }, 100);
        }
    });

    // Toggle Date Preset Dropdown
    $(document).on('click', '#datePresetBtn', function (e) {
        e.stopPropagation();
        let wasOpen = !$('#datePresetDropdownMenu').hasClass('d-none');
        closeAllCustomDropdowns();
        if (!wasOpen) {
            $('#datePresetDropdownMenu').removeClass('d-none');
        }
    });

    // Prevent closing when clicking inside any dropdown menu
    $(document).on('click', '.custom-dropdown-menu', function (e) {
        e.stopPropagation();
    });

    // Close all when clicking outside
    $(document).on('click', function () {
        closeAllCustomDropdowns();
    });

    // Search Filter inside Learner Dropdown
    $(document).on('input', '#learnerSearchInput', function () {
        let q = $(this).val().toLowerCase().trim();
        let matches = 0;
        $('#learnerOptionsList .dropdown-item-custom').each(function () {
            let isAll = $(this).data('value') === 'all';
            let searchIndex = ($(this).data('search') || '').toString();
            if (isAll || searchIndex.indexOf(q) !== -1) {
                $(this).removeClass('d-none');
                matches++;
            } else {
                $(this).addClass('d-none');
            }
        });
        if (matches === 0) {
            if ($('#noLearnerMatch').length === 0) {
                $('#learnerOptionsList').append('<div id="noLearnerMatch" class="text-center py-3 text-muted font-smallsize"><i class="fa-solid fa-circle-exclamation me-1 text-warning"></i> No learners found matching "' + q + '"</div>');
            }
        } else {
            $('#noLearnerMatch').remove();
        }
    });

    $(document).on('click', '#clearLearnerSearch', function () {
        $('#learnerSearchInput').val('').trigger('input').focus();
    });

    // Search Filter inside Course Dropdown
    $(document).on('input', '#courseSearchInput', function () {
        let q = $(this).val().toLowerCase().trim();
        let matches = 0;
        $('#courseOptionsList .dropdown-course-item').each(function () {
            let isAll = $(this).data('value') === 'all';
            let searchIndex = ($(this).data('search') || '').toString();
            if (isAll || searchIndex.indexOf(q) !== -1) {
                $(this).removeClass('d-none');
                matches++;
            } else {
                $(this).addClass('d-none');
            }
        });
        if (matches === 0) {
            if ($('#noCourseMatch').length === 0) {
                $('#courseOptionsList').append('<div id="noCourseMatch" class="text-center py-3 text-muted font-smallsize"><i class="fa-solid fa-circle-exclamation me-1 text-warning"></i> No courses found matching "' + q + '"</div>');
            }
        } else {
            $('#noCourseMatch').remove();
        }
    });

    $(document).on('click', '#clearCourseSearch', function () {
        $('#courseSearchInput').val('').trigger('input').focus();
    });

    // Department search filter & clear
    $(document).on('input', '#departmentSearchInput', function () {
        let q = $(this).val().toLowerCase().trim();
        $('#departmentOptionsList .dropdown-department-item').each(function () {
            let isAll = String($(this).data('value')) === 'all';
            let searchIndex = ($(this).data('search') || '').toString();
            if (isAll || searchIndex.indexOf(q) !== -1) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });

    $(document).on('click', '#clearDepartmentSearch', function () {
        $('#departmentSearchInput').val('').trigger('input').focus();
    });

    // Designation search filter & clear
    $(document).on('input', '#designationSearchInput', function () {
        let q = $(this).val().toLowerCase().trim();
        $('#designationOptionsList .dropdown-designation-item').each(function () {
            let isAll = String($(this).data('value')) === 'all';
            let searchIndex = ($(this).data('search') || '').toString();
            if (isAll || searchIndex.indexOf(q) !== -1) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });

    $(document).on('click', '#clearDesignationSearch', function () {
        $('#designationSearchInput').val('').trigger('input').focus();
    });

    // Select Learner Item
    $(document).on('click', '.dropdown-item-custom:not(.dropdown-user-status-item):not(.dropdown-course-active-item):not(.dropdown-status-filter-item):not(.dropdown-department-item):not(.dropdown-designation-item):not(.dropdown-date-preset-item)', function () {
        let val = $(this).data('value');
        let label = $(this).data('label');
        $('#universalLearnerFilter').val(val);
        $('#selectedLearnerLabel').html(val === 'all' ? '<i class="fa-solid fa-users me-1 text-teal" style="color: #008080;"></i> All Learners (Everyone)' : '<i class="fa-solid fa-user me-1 text-teal" style="color: #008080;"></i> ' + label);
        $('#learnerOptionsList .dropdown-item-custom').removeClass('active-item');
        $(this).addClass('active-item');
        $('#learnerDropdownMenu').addClass('d-none');
    });

    // Select Course Item
    $(document).on('click', '.dropdown-course-item', function () {
        let val = $(this).data('value');
        let label = $(this).data('label');
        $('#universalCourseFilter').val(val);
        $('#selectedCourseLabel').html(val === 'all' ? '<i class="fa-solid fa-book me-1 text-teal" style="color: #008080;"></i> All Courses' : '<i class="fa-solid fa-book-open me-1 text-teal" style="color: #008080;"></i> ' + label);
        $('#courseOptionsList .dropdown-course-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#courseDropdownMenu').addClass('d-none');
    });

    // Select User Status Item
    $(document).on('click', '.dropdown-user-status-item', function () {
        let val = String($(this).data('value'));
        let label = $(this).data('label');
        $('#universalUserStatusFilter').val(val);
        let iconHtml = val === '1' ? '<i class="fa-solid fa-user-check me-1 text-success"></i> ' : (val === '0' ? '<i class="fa-solid fa-user-xmark me-1 text-danger"></i> ' : (val === '2' ? '<i class="fa-solid fa-user-slash me-1 text-warning"></i> ' : '<i class="fa-solid fa-users me-1 text-teal" style="color: #008080;"></i> '));
        $('#selectedUserStatusLabel').html(iconHtml + label);
        $('#userStatusDropdownMenu .dropdown-user-status-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#userStatusDropdownMenu').addClass('d-none');
    });

    // Select Course Active Item
    $(document).on('click', '.dropdown-course-active-item', function () {
        let val = String($(this).data('value'));
        let label = $(this).data('label');
        $('#universalCourseActiveFilter').val(val);
        let iconHtml = val === '1' ? '<i class="fa-solid fa-circle-check me-1 text-success"></i> ' : (val === '0' ? '<i class="fa-solid fa-circle-pause me-1 text-warning"></i> ' : '<i class="fa-solid fa-book me-1 text-teal" style="color: #008080;"></i> ');
        $('#selectedCourseActiveLabel').html(iconHtml + label);
        $('#courseActiveDropdownMenu .dropdown-course-active-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#courseActiveDropdownMenu').addClass('d-none');
    });

    // Select Course Progress / State Item
    $(document).on('click', '.dropdown-status-filter-item', function () {
        let val = String($(this).data('value'));
        let label = $(this).data('label');
        $('#universalStatusFilter').val(val);
        $('#selectedStatusFilterLabel').html($(this).html().trim());
        $('#statusFilterDropdownMenu .dropdown-status-filter-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#statusFilterDropdownMenu').addClass('d-none');
    });

    // Select Department Item
    $(document).on('click', '.dropdown-department-item', function () {
        let val = String($(this).data('value'));
        let label = $(this).data('label');
        $('#universalDepartmentFilter').val(val);
        $('#selectedDepartmentLabel').html(val === 'all' ? '<i class="fa-solid fa-building me-1 text-teal" style="color: #008080;"></i> All Departments' : '<i class="fa-solid fa-layer-group me-1 text-teal" style="color: #008080;"></i> ' + label);
        $('#departmentOptionsList .dropdown-department-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#departmentDropdownMenu').addClass('d-none');
    });

    // Select Designation Item
    $(document).on('click', '.dropdown-designation-item', function () {
        let val = String($(this).data('value'));
        let label = $(this).data('label');
        $('#universalDesignationFilter').val(val);
        $('#selectedDesignationLabel').html(val === 'all' ? '<i class="fa-solid fa-id-badge me-1 text-teal" style="color: #008080;"></i> All Designations' : '<i class="fa-solid fa-briefcase me-1 text-teal" style="color: #008080;"></i> ' + label);
        $('#designationOptionsList .dropdown-designation-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#designationDropdownMenu').addClass('d-none');
    });

    // Select Date Preset Item
    $(document).on('click', '.dropdown-date-preset-item', function () {
        let val = String($(this).data('value'));
        $('#datePresetFilter').val(val);
        $('#selectedDatePresetLabel').html($(this).html().trim());
        $('#datePresetDropdownMenu .dropdown-date-preset-item').removeClass('active-item');
        $(this).addClass('active-item');
        $('#datePresetDropdownMenu').addClass('d-none');
        applyDatePreset(val);
    });

    function renderLearnerOptions(learners, selectedVal) {
        let html = `
            <div class="dropdown-item-custom p-2 rounded cursor-pointer ${(!selectedVal || selectedVal === 'all') ? 'active-item' : ''}" data-value="all" data-label="All Learners (Everyone)" style="cursor: pointer;">
                <div class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-users me-2 text-teal" style="color: #008080;"></i>All Learners (Everyone)</div>
                <small class="text-muted font-smallsize">Show records for all enrolled learners</small>
            </div>
        `;
        if (learners && learners.length > 0) {
            $.each(learners, function (idx, u) {
                let fullName = (u.first_name + ' ' + (u.last_name || '')).trim();
                let emailStr = u.email ? u.email : '';
                let empStr = u.emp_id ? u.emp_id : '';
                let isSel = (selectedVal == u.id) ? 'active-item' : '';
                let searchIndex = (fullName + ' ' + emailStr + ' ' + empStr).toLowerCase();
                let displayLabel = fullName + (emailStr ? ' (' + emailStr + ')' : '');

                if (selectedVal && selectedVal != 'all' && selectedVal == u.id) {
                    $('#selectedLearnerLabel').html('<i class="fa-solid fa-user me-1 text-teal" style="color: #008080;"></i> ' + displayLabel);
                }

                html += `
                    <div class="dropdown-item-custom p-2 rounded cursor-pointer border-bottom ${isSel}" data-value="${u.id}" data-search="${searchIndex}" data-label="${displayLabel}" style="cursor: pointer;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-dark font-smallsize"><i class="fa-solid fa-user text-secondary me-1" style="font-size: 11px;"></i>${fullName}</span>
                            ${empStr ? `<span class="badge bg-light text-muted border font-smallsize">${empStr}</span>` : ''}
                        </div>
                        ${emailStr ? `<div class="text-muted font-smallsize ps-3">${emailStr}</div>` : ''}
                    </div>
                `;
            });
        }
        $('#learnerOptionsList').html(html);
    }

    function renderCourseOptions(courses, selectedVal) {
        let html = `
            <div class="dropdown-course-item p-2 rounded cursor-pointer ${(!selectedVal || selectedVal === 'all') ? 'active-item' : ''}" data-value="all" data-label="All Courses" style="cursor: pointer;">
                <div class="fw-bold text-dark font-smallsize"><i class="fa-solid fa-book me-2 text-teal" style="color: #008080;"></i>All Courses</div>
                <small class="text-muted font-smallsize">Show records for all courses</small>
            </div>
        `;
        if (courses && courses.length > 0) {
            $.each(courses, function (idx, c) {
                let title = c.course_name || c.course_code || 'Course';
                let code = c.course_code || '';
                let isSel = (selectedVal == c.id) ? 'active-item' : '';
                let searchIndex = (title + ' ' + code).toLowerCase();

                if (selectedVal && selectedVal != 'all' && selectedVal == c.id) {
                    $('#selectedCourseLabel').html('<i class="fa-solid fa-book-open me-1 text-teal" style="color: #008080;"></i> ' + title);
                }

                html += `
                    <div class="dropdown-course-item p-2 rounded cursor-pointer border-bottom ${isSel}" data-value="${c.id}" data-search="${searchIndex}" data-label="${title}" style="cursor: pointer;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-dark font-smallsize"><i class="fa-solid fa-book-open text-secondary me-1" style="font-size: 11px;"></i>${title}</span>
                            ${code ? `<span class="badge bg-light text-muted border font-smallsize">${code}</span>` : ''}
                        </div>
                    </div>
                `;
            });
        }
        $('#courseOptionsList').html(html);
    }

    function getSelectedSources() {
        let sources = [];
        $('.source-checkbox:checked').each(function () {
            sources.push($(this).val());
        });
        if (sources.length === 0) {
            sources.push('learners');
            $('.source-checkbox[value="learners"]').prop('checked', true).closest('.source-card').addClass('border-teal bg-light shadow-sm');
        }
        return sources;
    }

    function updateSourcesBadge() {
        let count = $('.source-checkbox:checked').length;
        let text = count === 1 ? '1 Source Selected' : (count + ' Sources Selected');
        $('#selectedSourcesBadge').text(text);

        $('.source-checkbox').each(function () {
            if ($(this).is(':checked')) {
                $(this).closest('.source-card').addClass('border-teal active-source-card');
            } else {
                $(this).closest('.source-card').removeClass('border-teal active-source-card');
            }
        });
    }

    function updateFieldOrderBadges() {
        // Sync checkboxes, cards and badges with selectedFieldsOrder
        $('.field-col-item').each(function () {
            let key = $(this).data('key');
            let idx = selectedFieldsOrder.indexOf(key);
            let $card = $(this).find('.form-check');
            let $cb = $(this).find('.field-checkbox');
            let $badge = $(this).find('.field-order-badge');

            if (idx !== -1) {
                $cb.prop('checked', true);
                $card.addClass('border-teal');
                $badge.text('#' + (idx + 1)).removeClass('d-none');
            } else {
                $cb.prop('checked', false);
                $card.removeClass('border-teal');
                $badge.text('').addClass('d-none');
            }
        });

        // Live update selected count badge for each source group
        $('.source-field-group').each(function () {
            let srcKey = $(this).data('source');
            let totalInSrc = $(this).find('.field-checkbox').length;
            let checkedInSrc = $(this).find('.field-checkbox:checked').length;
            let $badge = $(this).find(`#badge_source_${srcKey}`);
            if (checkedInSrc > 0) {
                $badge.removeClass('bg-light text-muted border').addClass('text-white').css({
                    'background-color': '#008080',
                    'border': 'none'
                }).text(`${checkedInSrc} of ${totalInSrc} selected`);
            } else {
                $badge.removeClass('text-white').addClass('bg-light text-muted border').css({
                    'background-color': '',
                    'border': ''
                }).text(`0 of ${totalInSrc} selected`);
            }
        });

        let count = selectedFieldsOrder.length;
        let text = count === 1 ? '1 column selected' : (count + ' columns selected');
        $('#selectedColumnsCount').text(text);

        // Keep form's ordered hidden fields container in sync for direct export
        let $container = $('#orderedFieldsContainer');
        if ($container.length === 0) {
            $('#reportBuilderForm').append('<div id="orderedFieldsContainer" style="display:none;"></div>');
            $container = $('#orderedFieldsContainer');
        }
        $container.empty();
        selectedFieldsOrder.forEach(function (fieldKey) {
            $container.append($('<input>').attr({
                type: 'hidden',
                name: 'fields[]',
                value: fieldKey
            }));
        });
    }

    function updateSelectedColumnsCount() {
        updateFieldOrderBadges();
    }

    // Toggle source checkbox & card style
    $(document).on('change', '.source-checkbox', function () {
        if ($(this).is(':checked')) {
            $(this).closest('.source-card').addClass('border-teal active-source-card');
        } else {
            if ($('.source-checkbox:checked').length === 0) {
                $(this).prop('checked', true);
                return;
            }
            $(this).closest('.source-card').removeClass('border-teal active-source-card');
        }
        updateSourcesBadge();
        loadMultiSourceSchema();
    });

    $('#btnSelectAllSources').on('click', function () {
        $('.source-checkbox').prop('checked', true);
        $('.source-card').addClass('border-teal active-source-card');
        updateSourcesBadge();
        loadMultiSourceSchema();
    });

    $('#btnClearAllSources').on('click', function () {
        $('.source-checkbox').prop('checked', false);
        $('.source-card').removeClass('border-teal active-source-card');
        let first = $('.source-checkbox').first();
        first.prop('checked', true);
        first.closest('.source-card').addClass('border-teal active-source-card');
        updateSourcesBadge();
        loadMultiSourceSchema();
    });

    $(document).on('shown.bs.collapse', '.source-field-group .collapse', function () {
        $(this).closest('.source-field-group').find('.btn-source-collapse-toggle i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    });
    $(document).on('hidden.bs.collapse', '.source-field-group .collapse', function () {
        $(this).closest('.source-field-group').find('.btn-source-collapse-toggle i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });

    // Load initial schema
    updateSourcesBadge();
    loadMultiSourceSchema();

    // Date Presets Calculation Helper
    function applyDatePreset(preset) {
        if (!preset || preset === 'all' || preset === 'custom') {
            if (preset === 'all') {
                $('#dateFromFilter').val('');
                $('#dateToFilter').val('');
            }
            return;
        }
        let now = new Date();
        let fromDate = null;
        let toDate = null;

        function formatDate(d) {
            let year = d.getFullYear();
            let month = String(d.getMonth() + 1).padStart(2, '0');
            let day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        if (preset === 'today') {
            fromDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            toDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        } else if (preset === 'yesterday') {
            let y = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1);
            fromDate = y;
            toDate = y;
        } else if (preset === 'last_7_days') {
            fromDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 6);
            toDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        } else if (preset === 'last_30_days') {
            fromDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 29);
            toDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        } else if (preset === 'this_month') {
            fromDate = new Date(now.getFullYear(), now.getMonth(), 1);
            toDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
        } else if (preset === 'last_month') {
            fromDate = new Date(now.getFullYear(), now.getMonth() - 1, 1);
            toDate = new Date(now.getFullYear(), now.getMonth(), 0);
        } else if (preset === 'last_3_months') {
            fromDate = new Date(now.getFullYear(), now.getMonth() - 3, 1);
            toDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
        } else if (preset === 'this_year') {
            fromDate = new Date(now.getFullYear(), 0, 1);
            toDate = new Date(now.getFullYear(), 11, 31);
        }

        if (fromDate) $('#dateFromFilter').val(formatDate(fromDate));
        if (toDate) $('#dateToFilter').val(formatDate(toDate));
    }

    $(document).on('change', '#datePresetFilter', function () {
        let preset = $(this).val();
        applyDatePreset(preset);
    });

    $(document).on('input change', '#dateFromFilter, #dateToFilter', function () {
        if ($('#datePresetFilter').val() !== 'custom' && ($('#dateFromFilter').val() || $('#dateToFilter').val())) {
            $('#datePresetFilter').val('custom');
        }
    });

    // Global Select / Deselect All visible fields
    $('#selectAllFields').on('click', function () { 
        $('.field-checkbox:visible').each(function () {
            let key = $(this).val();
            if (!selectedFieldsOrder.includes(key)) {
                selectedFieldsOrder.push(key);
            }
        });
        updateFieldOrderBadges();
    });

    $('#deselectAllFields').on('click', function () { 
        let visibleKeys = [];
        $('.field-checkbox:visible').each(function () {
            visibleKeys.push($(this).val());
        });
        selectedFieldsOrder = selectedFieldsOrder.filter(function (k) {
            return !visibleKeys.includes(k);
        });
        updateFieldOrderBadges();
    });

    // Source Group Select / Deselect
    $(document).on('click', '.btn-source-select-all', function () {
        let src = $(this).data('source');
        $(`.field-checkbox[data-source="${src}"]:visible`).each(function () {
            let key = $(this).val();
            if (!selectedFieldsOrder.includes(key)) {
                selectedFieldsOrder.push(key);
            }
        });
        updateFieldOrderBadges();
    });

    $(document).on('click', '.btn-source-deselect-all', function () {
        let src = $(this).data('source');
        let srcKeys = [];
        $(`.field-checkbox[data-source="${src}"]`).each(function () {
            srcKeys.push($(this).val());
        });
        selectedFieldsOrder = selectedFieldsOrder.filter(function (k) {
            return !srcKeys.includes(k);
        });
        updateFieldOrderBadges();
    });

    // Column checkbox toggle: when checked, push to END (becomes last column); when unchecked, remove
    $(document).on('change', '.field-checkbox', function () {
        let key = $(this).val();
        let isChecked = $(this).is(':checked');

        if (isChecked) {
            // Remove if already present (safety), and push to the end
            selectedFieldsOrder = selectedFieldsOrder.filter(function (f) { return f !== key; });
            selectedFieldsOrder.push(key);
        } else {
            // Remove from selected list
            selectedFieldsOrder = selectedFieldsOrder.filter(function (f) { return f !== key; });
        }
        updateFieldOrderBadges();
    });

    // Allow clicking anywhere on card to toggle checkbox
    $(document).on('click', '.field-col-item .form-check', function (e) {
        if ($(e.target).is('input') || $(e.target).is('label') || $(e.target).closest('label').length) {
            return;
        }
        let $cb = $(this).find('.field-checkbox');
        $cb.prop('checked', !$cb.prop('checked')).trigger('change');
    });

    // Live Column Search Filter
    $(document).on('input', '#columnSearchInput', function () {
        let q = $(this).val().toLowerCase().trim();
        if (!q) {
            $('.field-col-item').removeClass('d-none');
            $('.source-field-group').removeClass('d-none');
            $('.no-fields-matched-alert').addClass('d-none');
            $('.fields-grid-container').removeClass('d-none');
            return;
        }

        $('.source-field-group').each(function () {
            let group = $(this);
            let matchedInGroup = 0;
            group.find('.field-col-item').each(function () {
                let label = ($(this).data('label') || '').toString();
                let key = ($(this).data('key') || '').toString();
                if (label.indexOf(q) !== -1 || key.indexOf(q) !== -1) {
                    $(this).removeClass('d-none');
                    matchedInGroup++;
                } else {
                    $(this).addClass('d-none');
                }
            });

            if (matchedInGroup === 0) {
                group.find('.no-fields-matched-alert').removeClass('d-none');
                group.find('.fields-grid-container').addClass('d-none');
            } else {
                group.find('.no-fields-matched-alert').addClass('d-none');
                group.find('.fields-grid-container').removeClass('d-none');
                group.removeClass('d-none');
            }
        });
    });

    $('#addFilterBtn').on('click', function () { addFilterRow(); });
    $(document).on('click', '.btn-remove-filter', function () {
        $(this).closest('.filter-row').remove();
        if ($('.filter-row').length === 0) {
            $('#noFiltersText').show();
        }
    });

    $(document).on('click', '.user-status-btn', function () {
        let val = String($(this).data('val'));
        $('#universalUserStatusFilter').val(val).trigger('change');
    });

    $('#universalUserStatusFilter').on('change', function () {
        let val = String($(this).val());
        $('.user-status-btn').removeClass('active');
        $(`.user-status-btn[data-val="${val}"]`).addClass('active');
    });

    // Dynamic Filter Input Change based on selected field
    $(document).on('change', '.filter-field-select', function () {
        let fieldKey = $(this).val();
        let row = $(this).closest('.filter-row');
        let rowId = row.data('row-id');
        let fieldMeta = currentSchema.fields[fieldKey] || {};
        row.find('.filter-input-wrapper').html(renderFilterInput(rowId, fieldMeta, '', ''));
    });

    function loadMultiSourceSchema() {
        let sources = getSelectedSources();
        $('#fieldsContainer').html('<div class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2 text-teal" style="color: #008080;"></i> Loading fields for selected data sources...</div>');

        // Toggle dedicated standalone dropdown filters based on selected sources
        if (sources.includes('assessments')) {
            $('#assessmentDedicatedFilterWrapper').removeClass('d-none');
            if (!isInitialLoad) $('#assessmentQuickFilter').val('Total');
        } else {
            $('#assessmentDedicatedFilterWrapper').addClass('d-none');
        }

        if (sources.includes('certificates')) {
            $('#certificatesDedicatedFilterWrapper').removeClass('d-none');
            if (!isInitialLoad) $('#certificateStatusQuickFilter').val('All');
        } else {
            $('#certificatesDedicatedFilterWrapper').addClass('d-none');
        }

        if (sources.includes('feedback')) {
            $('#feedbackDedicatedFilterWrapper').removeClass('d-none');
            if (!isInitialLoad) $('#feedbackTypeQuickFilter').val('Total');
        } else {
            $('#feedbackDedicatedFilterWrapper').addClass('d-none');
        }

        if (sources.includes('videos')) {
            $('#videosDedicatedFilterWrapper').removeClass('d-none');
            if (!isInitialLoad) {
                $('#videoTypeQuickFilter').val('All');
                $('#videoWatchQuickFilter').val('Total');
            }
        } else {
            $('#videosDedicatedFilterWrapper').addClass('d-none');
        }

        if (sources.includes('exams')) {
            $('#examsDedicatedFilterWrapper').removeClass('d-none');
            if (!isInitialLoad) $('#examResultQuickFilter').val('Total');
        } else {
            $('#examsDedicatedFilterWrapper').addClass('d-none');
        }

        updateStatusFilterOptions(sources);

        $.ajax({
            url: "{{ route('admin.reports.schema') }}",
            type: "GET",
            data: { data_sources: sources },
            success: function (res) {
                if (res.success) {
                    currentSchema = res.schema;
                    renderCategorizedFields(currentSchema.fields_by_source, currentSchema.fields);
                    renderSortOptions(currentSchema.fields, currentSchema.fields_by_source);

                    // Render searchable course and learner dropdowns
                    renderCourseOptions(res.schema.courses, $('#universalCourseFilter').val());
                    renderLearnerOptions(res.schema.learners, $('#universalLearnerFilter').val());

                    $('#filtersContainer').empty();
                    filterIndex = 0;

                    if (isInitialLoad && Array.isArray(savedDynamicFilters) && savedDynamicFilters.length > 0) {
                        $('#noFiltersText').hide();
                        $.each(savedDynamicFilters, function (idx, flt) {
                            addFilterRow(flt);
                        });
                    } else {
                        $('#noFiltersText').show();
                    }

                    isInitialLoad = false;
                }
            }
        });
    }

    function updateStatusFilterOptions(sources, selectedVal) {
        let currentVal = selectedVal || $('#universalStatusFilter').val() || 'all';
        let optionsHtml = '';
        if (Array.isArray(sources) && sources.includes('exams') && sources.length === 1) {
            $('#universalStatusFilterLabel').html('<i class="fa-solid fa-list-check text-teal me-1" style="color: #008080;"></i> Exam Result / Status:');
            optionsHtml = `
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer ${currentVal === 'all' ? 'active-item' : ''}" data-value="all" data-label="All Results & Statuses" style="cursor: pointer;">
                    <i class="fa-solid fa-list-check me-2 text-teal" style="color: #008080;"></i>All Results & Statuses
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'passed' ? 'active-item' : ''}" data-value="passed" data-label="Passed" style="cursor: pointer;">
                    <span class="text-success fw-bold"><i class="fa-solid fa-check me-2"></i>Passed</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'failed' ? 'active-item' : ''}" data-value="failed" data-label="Failed" style="cursor: pointer;">
                    <span class="text-danger fw-bold"><i class="fa-solid fa-xmark me-2"></i>Failed</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'pending' ? 'active-item' : ''}" data-value="pending" data-label="Pending Evaluation" style="cursor: pointer;">
                    <span class="text-warning fw-bold"><i class="fa-solid fa-clock me-2"></i>Pending Evaluation</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'not_started' ? 'active-item' : ''}" data-value="not_started" data-label="Not Started / Not Attempted" style="cursor: pointer;">
                    <span class="text-secondary"><i class="fa-regular fa-circle me-2"></i>Not Started / Not Attempted</span>
                </div>
            `;
            if (currentVal === 'passed') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-check me-1 text-success"></i> Passed');
            else if (currentVal === 'failed') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-xmark me-1 text-danger"></i> Failed');
            else if (currentVal === 'pending') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-clock me-1 text-warning"></i> Pending Evaluation');
            else if (currentVal === 'not_started') $('#selectedStatusFilterLabel').html('<i class="fa-regular fa-circle me-1 text-secondary"></i> Not Started');
            else $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-list-check me-1 text-teal" style="color: #008080;"></i> All Results & Statuses');
        } else {
            $('#universalStatusFilterLabel').html('<i class="fa-solid fa-list-check text-teal me-1" style="color: #008080;"></i> Course Status:');
            optionsHtml = `
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer ${currentVal === 'all' ? 'active-item' : ''}" data-value="all" data-label="All Statuses" style="cursor: pointer;">
                    <i class="fa-solid fa-layer-group me-2 text-teal" style="color: #008080;"></i>All Statuses
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'in_progress' || currentVal === 'incomplete' ? 'active-item' : ''}" data-value="in_progress" data-label="In Progress" style="cursor: pointer;">
                    <span class="text-warning fw-bold"><i class="fa-solid fa-spinner fa-spin-pulse me-2"></i>In Progress</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'completed' ? 'active-item' : ''}" data-value="completed" data-label="Completed" style="cursor: pointer;">
                    <span class="text-success fw-bold"><i class="fa-solid fa-circle-check me-2"></i>Completed</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'not_started' ? 'active-item' : ''}" data-value="not_started" data-label="Not Started" style="cursor: pointer;">
                    <span class="text-secondary"><i class="fa-regular fa-circle me-2"></i>Not Started</span>
                </div>
                <div class="dropdown-item-custom dropdown-status-filter-item p-2 rounded cursor-pointer border-top mt-1 ${currentVal === 'expired' ? 'active-item' : ''}" data-value="expired" data-label="Expired" style="cursor: pointer;">
                    <span class="text-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i>Expired</span>
                </div>
            `;
            if (currentVal === 'in_progress' || currentVal === 'incomplete') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-spinner me-1 text-warning"></i> In Progress');
            else if (currentVal === 'completed') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-circle-check me-1 text-success"></i> Completed');
            else if (currentVal === 'not_started') $('#selectedStatusFilterLabel').html('<i class="fa-regular fa-circle me-1 text-secondary"></i> Not Started');
            else if (currentVal === 'expired') $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-triangle-exclamation me-1 text-danger"></i> Expired');
            else $('#selectedStatusFilterLabel').html('<i class="fa-solid fa-layer-group me-1 text-teal" style="color: #008080;"></i> All Statuses');
        }
        $('#statusOptionsList').html(optionsHtml);
    }

    function getFieldSimpleDescription(key, label) {
        const descMap = {
            // Users & Learner Profile
            'users.first_name': 'Full name of the registered learner',
            'users.last_name': 'Surname or family name of the learner',
            'users.email': 'Official email address used for LMS login',
            'users.emp_id': 'Unique employee code or staff ID',
            'departments.department_name': 'Company department or division the user belongs to',
            'designations.designation_name': 'Current job title or role designation of the user',
            'users.active': 'Account status: Active or Inactive',
            'users.last_login': 'Date and time user last logged into LMS',
            'users.created_at': 'Date when user account was created in LMS',

            // Learner Metrics
            'users.assigned_courses_count': 'Total number of courses allocated to this learner',
            'users.completed_courses_count': 'Number of assigned courses fully completed',
            'users.inprogress_courses_count': 'Number of assigned courses currently in progress',
            'users.notstarted_courses_count': 'Number of assigned courses not yet started',
            'users.expired_courses_count': 'Number of assigned courses that passed their due date without completion',
            'users.course_completion_rate': 'Percentage of assigned courses completed',
            'users.assigned_assessments_count': 'Total quizzes and assessments assigned in courses',
            'users.completed_assessments_count': 'Number of assessments attempted by this learner',
            'users.avg_assessment_score': 'Average score percentage across all attempted assessments',
            'users.exams_attempted_count': 'Number of assignment exams submitted',
            'users.exams_passed_count': 'Number of assignment exams successfully passed',
            'users.videos_watched_count': 'Total learning videos and interactive modules watched',
            'users.certificates_count': 'Total course completion certificates earned',

            // Courses & Catalog
            'tbl_courses.course_name': 'Official title of the course',
            'tbl_courses.course_code': 'Unique reference code or catalog number of the course',
            'tbl_categories.category_name': 'Subject category or domain of the course',
            'tbl_courses.active': 'Course availability status: Active or Inactive',
            'tbl_courses.course_status': 'Course progress status: Not Started, In Progress, Completed, or Expired',
            'tbl_courses.enrolled_learners_count': 'Total learners enrolled in this course',
            'tbl_courses.completed_learners_count': 'Total learners who successfully finished this course',
            'tbl_courses.inprogress_learners_count': 'Total learners currently learning and in progress',
            'tbl_courses.notstarted_learners_count': 'Total enrolled learners who have not yet started',
            'tbl_courses.expired_learners_count': 'Total enrolled learners whose due date has passed without completion',
            'tbl_courses.completion_rate': 'Overall percentage of learners who completed the course',
            'tbl_courses.total_assessments_count': 'Total quizzes and tests included in this course',
            'tbl_courses.total_videos_count': 'Total videos and documents uploaded to this course',
            'tbl_courses.avg_assessment_score': 'Average score percentage achieved by learners in this course',
            'tbl_courses.capacity': 'Maximum number of learners allowed in this course',
            'tbl_courses.points': 'Reward points earned upon completing this course',
            'tbl_courses.expiration_date': 'Due date or deadline to finish the course',
            'tbl_courses.created_at': 'Date when this course was created',

            // Enrollments
            'tbl_assignedusers.team_name': 'Team name, group, or course category',
            'tbl_assignedusers.created_at': 'Date when the course was assigned to the learner',
            'tbl_assignedusers.expires_in_days': 'Number of days remaining before course expires',
            'tbl_assignedusers.start_date': 'Date the learner first accessed the course',
            'tbl_assignedusers.completed_on': 'Date when the learner completed the course',
            'tbl_assignedusers.progress_status': 'Learning stage: Not Started, In Progress, Completed, or Expired',
            'tbl_assignedusers.status': 'Course completion status code',
            'tbl_assignedusers.result': 'Overall evaluation result: Pass, Fail, or Not Attempted',
            'tbl_assignedusers.comments': 'Assignment type: Newly Assigned or Reassigned',

            // Assessments & Quizzes
            'tbl_course_documents_list.file_name': 'Title or file name of the quiz or assessment',
            'tbl_course_assessment_result.score': 'Actual marks or points scored in the quiz',
            'tbl_course_assessment_result.percentage': 'Score percentage achieved in the quiz',
            'tbl_course_assessment_result.time_spent': 'Total time taken to complete the quiz',
            'tbl_course_assessment_result.status': 'Assessment status: Completed, In Progress, or Not Started',
            'tbl_course_assessment_result.pass_fail': 'Overall quiz result: Passed, Failed, Pending, or Not Attempted',
            'tbl_course_assessment_result.created_at': 'Date and time when the quiz was taken',
            'tbl_course_assessment_result.completed_at': 'Date and time when the quiz was submitted',
            'tbl_course_assessment_result.comments': 'Whether test is initially assigned or reassigned',

            // Assignment Exams
            'tbl_assignment_exams.name': 'Title of the assignment examination',
            'tbl_assignment_exams.exam_name': 'Title of the assignment examination',
            'tbl_exam_attempts.exam_result': 'Pass or Fail evaluation outcome of the exam',
            'tbl_exam_attempts.exam_marks': 'Marks awarded for the assignment exam',
            'tbl_exam_attempts.exam_percentage': 'Score percentage achieved in the assignment exam',
            'tbl_exam_attempts.exam_attend_date': 'Date and time when the learner started the exam',
            'tbl_exam_attempts.evaluation_completed_date': 'Date and time when evaluation was completed',

            // Videos & Learning Materials
            'tbl_course_documents_list.content_title': 'Title of the video, file, or interactive module',
            'tbl_course_documents_list.org_file_name': 'Original uploaded file name and extension',
            'tbl_course_documents_list.type': 'Format: Amazon Video, YouTube, Local Video, SCORM, File',
            'tbl_assessment_video_access.watch_status': 'Whether learner has watched or not watched this item',

            // Certificates
            'tbl_certificates.certificate_name': 'Name or title of the certificate template',
            'tbl_certificates.code': 'Unique certificate verification number or code',
            'tbl_certificates.status': 'Certificate validity: Active or Inactive',
            'tbl_certificates.signature_status': 'Whether authorized instructor signature is present',
            'tbl_certificates.created_at': 'Date when the certificate was issued',

            // Feedback & Ratings
            'tbl_feedback_ratings_settings.name': 'Feedback form title or question category',
            'tbl_employee_feedback_ratings.type': 'Feedback scope: Overall LMS or Category-specific',
            'tbl_employee_feedback_ratings.rating': 'Star rating given by the learner (1 to 5 stars)',
            'tbl_employee_feedback_ratings.feedback': 'Written comments or reviews submitted by learner',
            'tbl_employee_feedback_ratings.suggestions': 'Suggestions for course improvement',
            'tbl_employee_feedback_ratings.created_at': 'Date and time when feedback was submitted',

            // Training Matrix & Department Analytics
            'departments.total_users_count': 'Count of active learners in this department',
            'departments.total_courses_assigned': 'Total course assignments across this department',
            'departments.total_courses_completed': 'Total courses completed by department staff',
            'departments.completion_rate': 'Department overall training completion rate (%)',
            'departments.total_assessments_assigned': 'Total quiz assignments for department staff',
            'departments.total_assessments_passed': 'Total passed quizzes among department staff',
            'departments.avg_assessment_score': 'Average assessment score percentage for this department',
        };

        if (descMap[key]) {
            return descMap[key];
        }

        let l = (label || '').toLowerCase();
        if (l.includes('email')) return 'Email address of the learner';
        if (l.includes('name') && l.includes('course')) return 'Title of the course';
        if (l.includes('name') && (l.includes('learner') || l.includes('user') || l.includes('employee'))) return 'Full name of the learner';
        if (l.includes('department')) return 'Department or division name';
        if (l.includes('designation')) return 'Job title or role designation';
        if (l.includes('status')) return 'Current status or progress state';
        if (l.includes('date') && l.includes('due')) return 'Deadline or due date';
        if (l.includes('date') && l.includes('assign')) return 'Date when assigned';
        if (l.includes('date')) return 'Recorded date and time';
        if (l.includes('score') || l.includes('marks')) return 'Score or marks achieved';
        if (l.includes('percentage') || l.includes('rate')) return 'Percentage calculation value';
        if (l.includes('count') || l.includes('total')) return 'Total calculated count';
        if (l.includes('result') || l.includes('pass')) return 'Pass, Fail, or completion outcome';
        if (l.includes('time') || l.includes('spent')) return 'Duration of time taken';
        if (l.includes('code')) return 'Unique identifier code';

        return 'Report column for ' + (label || key);
    }

    function renderCategorizedFields(fieldsBySource, flatFields) {
        let validKeys = flatFields ? Object.keys(flatFields) : [];
        if (validKeys.length === 0 && fieldsBySource) {
            $.each(fieldsBySource, function (sKey, grp) {
                if (grp.fields) {
                    validKeys = validKeys.concat(Object.keys(grp.fields));
                }
            });
        }

        // If initial load and selectedFieldsOrder is empty, populate from savedFields
        if (selectedFieldsOrder.length === 0 && isInitialLoad && Array.isArray(savedFields) && savedFields.length > 0) {
            savedFields.forEach(function (k) {
                if (!selectedFieldsOrder.includes(k)) {
                    selectedFieldsOrder.push(k);
                }
            });
        }

        // Filter existing selection to keep only active fields
        selectedFieldsOrder = selectedFieldsOrder.filter(function (key) {
            return validKeys.includes(key);
        });

        // If still empty (e.g. no saved fields or completely new source), populate with defaults
        if (selectedFieldsOrder.length === 0) {
            if (fieldsBySource && Object.keys(fieldsBySource).length > 0) {
                $.each(fieldsBySource, function (srcKey, group) {
                    let fields = group.fields || {};
                    $.each(fields, function (key, item) {
                        if (item.default && !selectedFieldsOrder.includes(key)) {
                            selectedFieldsOrder.push(key);
                        }
                    });
                });
            } else if (flatFields) {
                $.each(flatFields, function (key, item) {
                    if (item.default && !selectedFieldsOrder.includes(key)) {
                        selectedFieldsOrder.push(key);
                    }
                });
            }
        }

        let html = '';
        if (fieldsBySource && Object.keys(fieldsBySource).length > 0) {
            $.each(fieldsBySource, function (srcKey, group) {
                let srcLabel = group.label || srcKey;
                let srcIcon = group.icon || 'fa-solid fa-table';
                let fields = group.fields || {};
                let fieldCount = Object.keys(fields).length;
                if (fieldCount === 0) return;

                html += `
                    <div class="card shadow-none border mb-3 source-field-group" data-source="${srcKey}">
                        <div class="card-header bg-white py-2 px-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <span class="source-group-icon me-1 text-teal" style="color: #008080;"><i class="${srcIcon}"></i></span>
                                <span class="fw-bold text-dark font-smallsize">${srcLabel}</span>
                                <span class="badge source-group-count-badge font-smallsize px-2 py-1 bg-light text-muted border" id="badge_source_${srcKey}">0 of ${fieldCount} selected</span>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <button type="button" class="btn btn-xs btn-outline-teal btn-source-select-all" data-source="${srcKey}" style="font-size: 11px; padding: 2px 8px; color: #008080; border-color: #008080;">
                                    <i class="fa-solid fa-check me-1"></i>Select All
                                </button>
                                <button type="button" class="btn btn-xs btn-outline-secondary btn-source-deselect-all" data-source="${srcKey}" style="font-size: 11px; padding: 2px 8px;">
                                    <i class="fa-solid fa-xmark me-1"></i>Clear
                                </button>
                                <button type="button" class="btn btn-xs btn-light border btn-source-collapse-toggle ms-1" data-bs-toggle="collapse" data-bs-target="#collapse_source_${srcKey}" aria-expanded="true" title="Toggle section" style="padding: 2px 6px;">
                                    <i class="fa-solid fa-chevron-up text-secondary" style="font-size: 10px;"></i>
                                </button>
                            </div>
                        </div>
                        <div id="collapse_source_${srcKey}" class="collapse show">
                            <div class="card-body p-3">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-2 fields-grid-container">
                `;

                $.each(fields, function (key, item) {
                    let isChecked = selectedFieldsOrder.includes(key);
                    let orderIdx = selectedFieldsOrder.indexOf(key);
                    let orderNum = orderIdx !== -1 ? (orderIdx + 1) : null;
                    let activeCardClass = isChecked ? 'border-teal' : '';
                    let checkedAttr = isChecked ? 'checked' : '';
                    let desc = item.description || getFieldSimpleDescription(key, item.label);
                    let searchIndex = (item.label + ' ' + desc + ' ' + key).toLowerCase();
                    let safeKey = key.replace(/[^a-zA-Z0-9_]/g, '_');
                    html += `
                        <div class="col field-col-item" data-key="${key}" data-label="${searchIndex}" data-source="${srcKey}">
                            <div class="form-check p-2 border rounded bg-white shadow-sm h-100 ${activeCardClass}">
                                <div class="d-flex align-items-center justify-content-between w-100 mb-1">
                                    <div class="d-flex align-items-center me-2 overflow-hidden flex-grow-1">
                                        <input class="form-check-input field-checkbox me-2" type="checkbox" value="${key}" id="field_${safeKey}_${srcKey}" data-source="${srcKey}" ${checkedAttr} style="cursor: pointer; flex-shrink: 0;">
                                        <label class="form-check-label font-smallsize cursor-pointer text-dark fw-bold text-truncate mb-0" for="field_${safeKey}_${srcKey}" title="${item.label}">
                                            ${item.label}
                                        </label>
                                    </div>
                                    <span class="badge rounded-pill field-order-badge px-2 py-1 ${orderNum ? '' : 'd-none'}" style="background-color: #008080; color: #fff; font-size: 10px; font-weight: 700; flex-shrink: 0; min-width: 24px; text-align: center;">
                                        ${orderNum ? '#' + orderNum : ''}
                                    </span>
                                </div>
                                <div class="field-desc text-muted" title="${desc}">
                                    ${desc}
                                </div>
                            </div>
                        </div>
                    `;
                });

                html += `
                                </div>
                                <div class="no-fields-matched-alert d-none text-muted font-smallsize text-center py-2">
                                    <i class="fa-solid fa-filter me-1 text-warning"></i> No fields in this section match the search.
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
        } else if (flatFields) {
            html += '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-2">';
            $.each(flatFields, function (key, item) {
                let isChecked = selectedFieldsOrder.includes(key);
                let orderIdx = selectedFieldsOrder.indexOf(key);
                let orderNum = orderIdx !== -1 ? (orderIdx + 1) : null;
                let activeCardClass = isChecked ? 'border-teal' : '';
                let checkedAttr = isChecked ? 'checked' : '';
                let desc = item.description || getFieldSimpleDescription(key, item.label);
                let safeKey = key.replace(/[^a-zA-Z0-9_]/g, '_');
                html += `
                    <div class="col field-col-item" data-key="${key}" data-label="${(item.label + ' ' + desc + ' ' + key).toLowerCase()}">
                        <div class="form-check p-2 border rounded bg-white shadow-sm h-100 ${activeCardClass}">
                            <div class="d-flex align-items-center justify-content-between w-100 mb-1">
                                <div class="d-flex align-items-center me-2 overflow-hidden flex-grow-1">
                                    <input class="form-check-input field-checkbox me-2" type="checkbox" value="${key}" id="field_${safeKey}" ${checkedAttr} style="cursor: pointer; flex-shrink: 0;">
                                    <label class="form-check-label font-smallsize cursor-pointer text-dark fw-bold text-truncate mb-0" for="field_${safeKey}" title="${item.label}">
                                        ${item.label}
                                    </label>
                                </div>
                                <span class="badge rounded-pill field-order-badge px-2 py-1 ${orderNum ? '' : 'd-none'}" style="background-color: #008080; color: #fff; font-size: 10px; font-weight: 700; flex-shrink: 0; min-width: 24px; text-align: center;">
                                    ${orderNum ? '#' + orderNum : ''}
                                </span>
                            </div>
                            <div class="field-desc text-muted" title="${desc}">
                                ${desc}
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }
        $('#fieldsContainer').html(html);
        updateFieldOrderBadges();
    }

    function renderSummaryOptions(summaryOptions) {
        let html = '';
        if (summaryOptions) {
            $.each(summaryOptions, function (key, label) {
                html += `<option value="${key}">${label}</option>`;
            });
        }
        if (!html) {
            html = '<option value="COUNT">Total Count</option>';
        }
        $('#calcTypeSelect').html(html);
    }

    function renderSortOptions(fields, fieldsBySource) {
        let sortHtml = '';
        if (fieldsBySource && Object.keys(fieldsBySource).length > 1) {
            $.each(fieldsBySource, function (srcKey, group) {
                sortHtml += `<optgroup label="${group.label}">`;
                $.each(group.fields, function (key, item) {
                    let isSel = (savedSortField && savedSortField === key) ? 'selected' : '';
                    sortHtml += `<option value="${key}" ${isSel}>${item.label}</option>`;
                });
                sortHtml += `</optgroup>`;
            });
        } else {
            $.each(fields, function (key, item) {
                let isSel = (savedSortField && savedSortField === key) ? 'selected' : '';
                sortHtml += `<option value="${key}" ${isSel}>${item.label}</option>`;
            });
        }
        $('#sortFieldSelect').html(sortHtml);
    }

    // Generate input based on field type
    function renderFilterInput(rowId, fieldMeta, val = '', valTo = '') {
        if (fieldMeta.type === 'select' && fieldMeta.options) {
            let optHtml = '';
            let hasAll = fieldMeta.options.hasOwnProperty('Total') || fieldMeta.options.hasOwnProperty('All') || fieldMeta.options.hasOwnProperty('');
            if (!hasAll) {
                optHtml += '<option value="">-- All / Any --</option>';
            }
            $.each(fieldMeta.options, function (optVal, optLabel) {
                let isFirst = (optVal === 'Total' || optVal === 'All' || optVal === '');
                let sel = (val == optVal || (!val && isFirst)) ? 'selected' : '';
                optHtml += `<option value="${optVal}" ${sel}>${optLabel}</option>`;
            });
            return `<select name="filters[${rowId}][value]" class="form-select form-select-sm filter-val">${optHtml}</select>`;
        } else if (fieldMeta.type === 'date') {
            return `
                <div class="d-flex gap-2 align-items-center">
                    <input type="date" name="filters[${rowId}][value]" class="form-control form-control-sm filter-val" value="${val}" title="From Date">
                    <span class="text-muted font-smallsize">to</span>
                    <input type="date" name="filters[${rowId}][value_to]" class="form-control form-control-sm filter-val-to" value="${valTo}" title="To Date">
                </div>
            `;
        } else if (fieldMeta.type === 'number') {
            return `<input type="number" name="filters[${rowId}][value]" class="form-control form-control-sm filter-val" placeholder="Enter number (e.g. 70)..." value="${val}">`;
        } else {
            return `<input type="text" name="filters[${rowId}][value]" class="form-control form-control-sm filter-val" placeholder="Search keyword (e.g. CECO, Rahul)..." value="${val}">`;
        }
    }

    // Add a Dynamic Filter Row
    function addFilterRow(existingFilter = null) {
        if (!currentSchema) return;
        $('#noFiltersText').hide();

        let rowId = filterIndex++;
        let firstFieldKey = Object.keys(currentSchema.fields)[0];
        let selectedField = existingFilter ? existingFilter.field : firstFieldKey;
        let fieldMeta = currentSchema.fields[selectedField] || {};

        let fieldOptions = '';
        if (currentSchema.fields_by_source && Object.keys(currentSchema.fields_by_source).length > 1) {
            $.each(currentSchema.fields_by_source, function (srcKey, group) {
                fieldOptions += `<optgroup label="${group.label}">`;
                $.each(group.fields, function (key, item) {
                    let sel = (selectedField === key) ? 'selected' : '';
                    fieldOptions += `<option value="${key}" ${sel}>${item.label}</option>`;
                });
                fieldOptions += `</optgroup>`;
            });
        } else {
            $.each(currentSchema.fields, function (key, item) {
                let sel = (selectedField === key) ? 'selected' : '';
                fieldOptions += `<option value="${key}" ${sel}>${item.label}</option>`;
            });
        }

        let inputHtml = renderFilterInput(rowId, fieldMeta, existingFilter ? (existingFilter.value || '') : '', existingFilter ? (existingFilter.value_to || '') : '');

        let rowHtml = `
            <div class="row g-2 align-items-center mb-2 filter-row p-2 border rounded bg-light" id="filter_row_${rowId}" data-row-id="${rowId}">
                <div class="col-md-5">
                    <label class="form-label font-smallsize text-muted mb-1">Filter Field</label>
                    <select name="filters[${rowId}][field]" class="form-select form-select-sm filter-field-select">
                        ${fieldOptions}
                    </select>
                </div>
                <div class="col-md-6 filter-input-wrapper">
                    <label class="form-label font-smallsize text-muted mb-1">Search Keyword / Value</label>
                    ${inputHtml}
                </div>
                <div class="col-md-1 text-center pt-3">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-filter" title="Remove Filter"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        `;

        $('#filtersContainer').append(rowHtml);
    }

    // Live Preview
    $('#btnPreview').on('click', function () {
        let $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Querying...');

        $('#previewCard').removeClass('d-none');
        $('#previewThead').html('<tr><th class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i> Querying LMS database...</th></tr>');
        $('#previewTbody').empty();
        $('#chartPreviewWrapper').addClass('d-none');

        $('html, body').animate({ scrollTop: $("#previewCard").offset().top - 80 }, 200);

        let sources = getSelectedSources();
        let dataSource = sources[0] || 'learners';
        let fields = selectedFieldsOrder.slice();

        let filters = [];
        $('.filter-row').each(function () {
            let field = $(this).find('.filter-field-select').val();
            let val = $(this).find('.filter-val').val();
            let valTo = $(this).find('.filter-val-to').val();
            if (field && (val || valTo)) {
                filters.push({ field: field, value: val, value_to: valTo });
            }
        });

        let payload = {
            _token: "{{ csrf_token() }}",
            data_sources: sources,
            data_source: dataSource,
            fields: fields,
            filters: filters,
            learner_filter: $('#universalLearnerFilter').val(),
            course_filter: $('#universalCourseFilter').val(),
            user_status_filter: $('#universalUserStatusFilter').val(),
            course_active_filter: $('#universalCourseActiveFilter').val(),
            department_filter: $('#universalDepartmentFilter').val(),
            designation_filter: $('#universalDesignationFilter').val(),
            date_preset: $('#datePresetFilter').val(),
            date_from: $('#dateFromFilter').val(),
            date_to: $('#dateToFilter').val(),
            status_filter: $('#universalStatusFilter').val(),
            assessment_name_filter: $('#assessmentNameFilter').val(),
            assessment_assignment_filter: $('#assessmentQuickFilter').val(),
            certificate_status_filter: $('#certificateStatusQuickFilter').val(),
            feedback_type_filter: $('#feedbackTypeQuickFilter').val(),
            video_type_filter: $('#videoTypeQuickFilter').val(),
            video_watch_filter: $('#videoWatchQuickFilter').val(),
            exam_result_filter: $('#examResultQuickFilter').val(),
            group_by: 'none_individual',
            calculation: {
                type: $('#calcTypeSelect').val()
            },
            sort_field: $('#sortFieldSelect').val(),
            sort_direction: $('select[name="sort_direction"]').val(),
            preview_limit: 5000,
            output_type: $('#outputTypeInput').val() || 'table'
        };

        $.ajax({
            url: "{{ route('admin.reports.preview') }}",
            type: "POST",
            data: payload,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            timeout: 120000,
            success: function (res) {
                $btn.prop('disabled', false).html('<i class="fa-solid fa-eye me-1"></i> Live Preview');
                if (res.success && res.data) {
                    renderPreviewResults(res.data);
                } else {
                    $('#previewThead').html('<tr><th class="text-danger py-3 text-center">Failed to generate preview.</th></tr>');
                }
            },
            error: function (xhr, status, error) {
                $btn.prop('disabled', false).html('<i class="fa-solid fa-eye me-1"></i> Live Preview');
                let msg = status === 'timeout'
                    ? 'The report took longer than two minutes. Select a smaller date range or add filters and try again.'
                    : ((xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : ('Error: ' + (error || 'Network error')));
                $('#previewThead').empty().append(
                    $('<tr>').append($('<th>').addClass('text-danger py-3 text-center').text(msg))
                );
            }
        });
    });

    function renderPreviewResults(data) {
        $('#previewCount').text(data.total_count);

        let theadHtml = '<tr>';
        $.each(data.headers, function (i, h) {
            let colStyle = 'style="white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            if (h === 'S.No' || h === '#') {
                colStyle = 'style="width: 55px; min-width: 45px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h === 'Course Name') {
                colStyle = 'style="min-width: 240px; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Assessment Name') !== -1 || h.indexOf('Assignment Name') !== -1 || h.indexOf('Content Title') !== -1 || h === 'Exam Name') {
                colStyle = 'style="min-width: 250px; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Users') !== -1) {
                colStyle = 'style="min-width: 220px; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Attempts') !== -1) {
                colStyle = 'style="min-width: 110px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h === 'Learner Email') {
                colStyle = 'style="min-width: 220px; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Watch Status') !== -1) {
                colStyle = 'style="min-width: 130px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Course Status') !== -1) {
                colStyle = 'style="min-width: 130px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Result') !== -1) {
                colStyle = 'style="min-width: 130px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Marks') !== -1) {
                colStyle = 'style="min-width: 100px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Score') !== -1) {
                colStyle = 'style="min-width: 90px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Time') !== -1) {
                colStyle = 'style="min-width: 110px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h === 'Status') {
                colStyle = 'style="min-width: 120px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Assigned Date') !== -1) {
                colStyle = 'style="min-width: 130px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Attend Date') !== -1 || h.indexOf('Start Date') !== -1) {
                colStyle = 'style="min-width: 150px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Completed') !== -1) {
                colStyle = 'style="min-width: 150px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            } else if (h.indexOf('Assessment Status') !== -1 || h.indexOf('Assignment Status') !== -1) {
                colStyle = 'style="min-width: 140px; text-align: center; white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;"';
            }
            theadHtml += `<th ${colStyle}>${h}</th>`;
        });
        theadHtml += '</tr>';
        $('#previewThead').html(theadHtml);

        let tbodyHtml = '';
        if (data.rows.length === 0) {
            tbodyHtml = `<tr><td colspan="${data.headers.length}" class="text-center py-4 text-muted align-top">No records match the selected search criteria.</td></tr>`;
        } else {
            $.each(data.rows, function (i, r) {
                tbodyHtml += '<tr>';
                let rowspans = r._rowspans || null;

                if (rowspans && typeof rowspans === 'object') {
                    for (let j = 0; j < data.headers.length; j++) {
                        let span = typeof rowspans[j] !== 'undefined' ? rowspans[j] : 1;
                        if (span > 0) {
                            let hName = data.headers[j] || '';
                            let isCenter = hName === 'S.No' || hName === '#' || hName.indexOf('Attempts') !== -1 || hName.indexOf('Result') !== -1 || hName.indexOf('Marks') !== -1 || hName.indexOf('Score') !== -1 || hName.indexOf('Time') !== -1 || hName.indexOf('Status') !== -1 || hName.indexOf('Date') !== -1 || hName.indexOf('Completed') !== -1 || hName.indexOf('Count') !== -1 || hName.indexOf('Rate') !== -1;
                            let cellAlign = isCenter ? 'text-center' : 'text-start';
                            let spanAttr = span > 1 ? `rowspan="${span}"` : '';
                            let bgStyle = span > 1 ? 'background-color: #ffffff;' : '';
                            let sNoStyle = (hName === 'S.No' || hName === '#') ? 'font-weight: 600; color: #475569;' : '';
                            tbodyHtml += `<td ${spanAttr} class="align-top ${cellAlign}" style="padding: 8px 10px; vertical-align: top !important; border: 1px solid #e9ecef; ${bgStyle} ${sNoStyle}">${r[j] !== null && r[j] !== undefined ? r[j] : '-'}</td>`;
                        }
                    }
                } else if (typeof r._course_rowspan !== 'undefined') {
                    let courseRowspan = r._course_rowspan || 0;
                    let itemRowspan = r._item_rowspan || 0;
                    if (courseRowspan > 0) {
                        tbodyHtml += `<td rowspan="${courseRowspan}" class="align-top text-start" style="vertical-align: top !important; background-color: #ffffff; padding: 10px 12px; border: 1px solid #e9ecef;">${r[0] !== null ? r[0] : '-'}</td>`;
                    }
                    let startIdx = 1;
                    if (typeof r._item_rowspan !== 'undefined') {
                        if (itemRowspan > 0) {
                            tbodyHtml += `<td rowspan="${itemRowspan}" class="align-top text-start" style="vertical-align: top !important; background-color: #ffffff; padding: 10px 12px; border: 1px solid #e9ecef;">${r[1] !== null ? r[1] : '-'}</td>`;
                        }
                        startIdx = 2;
                    }
                    for (let j = startIdx; j < data.headers.length; j++) {
                        let hName = data.headers[j] || '';
                        let isCenter = hName === 'S.No' || hName === '#' || hName.indexOf('Attempts') !== -1 || hName.indexOf('Result') !== -1 || hName.indexOf('Marks') !== -1 || hName.indexOf('Score') !== -1 || hName.indexOf('Time') !== -1 || hName.indexOf('Status') !== -1 || hName.indexOf('Date') !== -1 || hName.indexOf('Completed') !== -1;
                        let cellAlign = isCenter ? 'text-center' : 'text-start';
                        tbodyHtml += `<td class="align-middle ${cellAlign}" style="padding: 8px 10px; vertical-align: middle !important; border: 1px solid #e9ecef;">${r[j] !== null && r[j] !== undefined ? r[j] : '-'}</td>`;
                    }
                } else {
                    $.each(r, function (j, cell) {
                        if (typeof j === 'string' && j.startsWith('_')) return;
                        let hName = data.headers[j] || '';
                        let isCenter = hName === 'S.No' || hName === '#' || hName.indexOf('Attempts') !== -1 || hName.indexOf('Result') !== -1 || hName.indexOf('Marks') !== -1 || hName.indexOf('Score') !== -1 || hName.indexOf('Time') !== -1 || hName.indexOf('Status') !== -1 || hName.indexOf('Date') !== -1 || hName.indexOf('Completed') !== -1;
                        let cellAlign = isCenter ? 'text-center' : 'text-start';
                        let sNoStyle = (hName === 'S.No' || hName === '#') ? 'font-weight: 600; color: #475569;' : '';
                        tbodyHtml += `<td class="align-top ${cellAlign}" style="padding: 8px 10px; vertical-align: top !important; border: 1px solid #e9ecef; ${sNoStyle}">${cell !== null ? cell : '-'}</td>`;
                    });
                }
                tbodyHtml += '</tr>';
            });
        }
        $('#previewTbody').html(tbodyHtml);

        if (data.chart_data && (data.output_type === 'bar' || data.output_type === 'line' || data.output_type === 'pie' || data.output_type === 'doughnut')) {
            $('#chartPreviewWrapper').removeClass('d-none');

            if (chartInstance) {
                chartInstance.destroy();
                chartInstance = null;
            }

            $('#chartPreviewWrapper').html('<canvas id="previewChart" style="max-height: 380px; width: 100%;"></canvas>');

            let ctx = document.getElementById('previewChart').getContext('2d');
            chartInstance = new Chart(ctx, {
                type: data.chart_data.type,
                data: {
                    labels: data.chart_data.labels,
                    datasets: data.chart_data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: (data.chart_data.type === 'pie' || data.chart_data.type === 'doughnut'),
                            position: 'bottom'
                        }
                    }
                }
            });
        } else {
            $('#chartPreviewWrapper').addClass('d-none');
            if (chartInstance) {
                chartInstance.destroy();
                chartInstance = null;
            }
        }
    }

    $('#btnOpenSaveModal').on('click', function () { $('#saveReportModal').modal('show'); });

    $('#btnConfirmSave').on('click', function () {
        let name = $('#saveReportName').val().trim();
        if (!name) {
            alert('Please enter a report name.');
            return;
        }

        let desc = $('#saveReportDesc').val().trim();
        let sources = getSelectedSources();
        let dataSource = sources.join(',');

        let config = {
            data_source: dataSource,
            data_sources: sources,
            fields: [],
            filters: [],
            learner_filter: $('#universalLearnerFilter').val(),
            course_filter: $('#universalCourseFilter').val(),
            user_status_filter: $('#universalUserStatusFilter').val(),
            course_active_filter: $('#universalCourseActiveFilter').val(),
            department_filter: $('#universalDepartmentFilter').val(),
            designation_filter: $('#universalDesignationFilter').val(),
            date_preset: $('#datePresetFilter').val(),
            date_from: $('#dateFromFilter').val(),
            date_to: $('#dateToFilter').val(),
            status_filter: $('#universalStatusFilter').val(),
            assessment_name_filter: $('#assessmentNameFilter').val(),
            assessment_assignment_filter: $('#assessmentQuickFilter').val(),
            certificate_status_filter: $('#certificateStatusQuickFilter').val(),
            feedback_type_filter: $('#feedbackTypeQuickFilter').val(),
            video_type_filter: $('#videoTypeQuickFilter').val(),
            video_watch_filter: $('#videoWatchQuickFilter').val(),
            exam_result_filter: $('#examResultQuickFilter').val(),
            group_by: 'none_individual',
            calculation: {
                type: $('#calcTypeSelect').val()
            },
            sort_field: $('#sortFieldSelect').val(),
            sort_direction: $('select[name="sort_direction"]').val(),
            output_type: $('#outputTypeInput').val() || 'table'
        };

        config.fields = selectedFieldsOrder.slice();

        $('.filter-row').each(function () {
            let field = $(this).find('.filter-field-select').val();
            let val = $(this).find('.filter-val').val();
            let valTo = $(this).find('.filter-val-to').val();
            if (field && (val || valTo)) {
                config.filters.push({ field: field, value: val, value_to: valTo });
            }
        });

        $.ajax({
            url: "{{ route('admin.reports.update', $report->id) }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                name: name,
                description: desc,
                data_source: dataSource,
                data_sources: sources,
                configuration: config
            },
            success: function (res) {
                if (res.success) {
                    $('#saveReportModal').modal('hide');
                    window.location.href = res.redirect_url;
                }
            },
            error: function (xhr) {
                alert('Error saving report: ' + (xhr.responseJSON ? xhr.responseJSON.message : 'Please check inputs.'));
            }
        });
    });

    $(document).on('click', '.btn-export-preview', function (e) {
        e.preventDefault();
        updateFieldOrderBadges();
        let format = $(this).data('format');
        let form = $('#reportBuilderForm');
        let prevAction = form.attr('action');
        let prevTarget = form.attr('target');
        let prevMethod = form.attr('method');

        let exportUrl = "{{ url('admin/reports/export-direct') }}/" + format;

        form.attr('action', exportUrl);
        form.attr('method', 'POST');
        form.attr('target', '_blank');
        form.submit();

        setTimeout(function () {
            form.attr('action', prevAction || '');
            form.attr('target', prevTarget || '_self');
            form.attr('method', prevMethod || 'POST');
        }, 500);
    });
});
</script>

@include('layouts.admin.footer')

