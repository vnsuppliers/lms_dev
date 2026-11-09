@include('layouts.admin.header')

<style>
    /* Stats Cards */
    .report-stat-card {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 10px !important;
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
        transition: all 0.2s ease !important;
    }
    .report-stat-card:hover {
        border-color: #008080 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 128, 128, 0.08) !important;
    }

    /* Table Container Card */
    .report-table-card {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        background: #ffffff !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03) !important;
    }
    .report-table-card .card-header {
        background-color: #ffffff !important;
        border-bottom: 1px solid #edf2f7 !important;
        padding: 14px 20px !important;
    }

    /* Custom Reports Table */
    .custom-reports-table {
        margin-bottom: 0 !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    .custom-reports-table thead th {
        background-color: #f8fafc !important;
        border-bottom: 2px solid #e2e8f0 !important;
        color: #475569 !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 13px 16px !important;
        vertical-align: middle !important;
        white-space: nowrap !important;
    }
    .custom-reports-table tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #edf2f7 !important;
        font-size: 13px !important;
        background-color: #ffffff !important;
    }
    .custom-reports-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Source Badges */
    .source-badge-pill {
        display: inline-flex !important;
        align-items: center !important;
        background-color: #f0fdfa !important;
        color: #0f766e !important;
        border: 1px solid #99f6e4 !important;
        border-radius: 6px !important;
        padding: 5px 11px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        box-shadow: none !important;
        text-decoration: none !important;
    }
    .badge-multi-source {
        background-color: #008080 !important;
        color: #ffffff !important;
        border-radius: 6px !important;
        padding: 5px 10px !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        box-shadow: none !important;
    }
    .badge-column-count {
        background-color: #f8fafc !important;
        color: #334155 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 5px 10px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        box-shadow: none !important;
    }

    /* Action Buttons */
    .btn-action-view {
        background-color: #008080 !important;
        color: #ffffff !important;
        border: 1px solid #008080 !important;
        border-radius: 6px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 5px 13px !important;
        box-shadow: 0 1px 3px rgba(0, 128, 128, 0.2) !important;
        transition: all 0.18s ease !important;
        text-decoration: none !important;
    }
    .btn-action-view:hover {
        background-color: #006666 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0, 128, 128, 0.35) !important;
    }
    .btn-action-edit {
        background-color: #ffffff !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        font-size: 12px !important;
        padding: 5px 9px !important;
        transition: all 0.18s ease !important;
        text-decoration: none !important;
    }
    .btn-action-edit:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }
    .btn-action-export {
        background-color: #ecfdf5 !important;
        color: #059669 !important;
        border: 1px solid #a7f3d0 !important;
        border-radius: 6px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 5px 11px !important;
        transition: all 0.18s ease !important;
    }
    .btn-action-export:hover {
        background-color: #d1fae5 !important;
        color: #047857 !important;
        border-color: #6ee7b7 !important;
    }
    .btn-action-delete {
        background-color: #ffffff !important;
        color: #ef4444 !important;
        border: 1px solid #fecaca !important;
        border-radius: 6px !important;
        font-size: 12px !important;
        padding: 5px 9px !important;
        transition: all 0.18s ease !important;
    }
    .btn-action-delete:hover {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border-color: #fca5a5 !important;
    }
    .avatar-circle-sm {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #e6f3f3;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    /* Professional Pagination Styling */
    .pagination {
        margin-bottom: 0 !important;
        gap: 4px !important;
        display: flex !important;
        align-items: center !important;
    }
    .pagination .page-item .page-link {
        color: #334155 !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 7px !important;
        padding: 6px 13px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        transition: all 0.18s ease-in-out !important;
        box-shadow: none !important;
        background-color: #ffffff !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 36px !important;
        min-height: 36px !important;
    }
    .pagination .page-item .page-link:hover {
        background-color: #f0fdfa !important;
        border-color: #008080 !important;
        color: #008080 !important;
    }
    .pagination .page-item.active .page-link {
        background-color: #008080 !important;
        border-color: #008080 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        box-shadow: 0 2px 6px rgba(0, 128, 128, 0.25) !important;
    }
    .pagination .page-item.disabled .page-link {
        color: #cbd5e1 !important;
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        cursor: not-allowed !important;
    }
</style>

<div class="container-fluid py-3">
    <!-- Page Header -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <h4 class="mb-1 text-dark fw-bold"><i class="fa-solid fa-file-invoice text-teal me-2" style="color: #008080;"></i>Dynamic LMS Reports</h4>
            <p class="text-muted mb-0 font-smallsize">Build, customize, filter, and export custom reports across all LMS data sources.</p>
        </div>
        <div class="col-md-6 text-md-end mt-2 mt-md-0">
            <a href="{{ route('admin.reports.create') }}" class="btn btn-primary" style="background-color: #008080; border-color: #008080;">
                <i class="fa-solid fa-plus me-1"></i> Create New Report
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Quick Stats Cards -->
    <div class="row mb-3">
        <div class="col-sm-6 col-lg-3 mb-2">
            <div class="card report-stat-card shadow-none">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="me-3 p-3 rounded text-white" style="background-color: #008080;">
                        <i class="fa-solid fa-file-lines fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 font-smallsize">Total Saved Reports</h6>
                        <h4 class="mb-0 fw-bold">{{ $totalSavedReports ?? $reports->total() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-2">
            <div class="card report-stat-card shadow-none">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="me-3 p-3 rounded text-white" style="background-color: #20b2aa;">
                        <i class="fa-solid fa-database fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 font-smallsize">Available Data Sources</h6>
                        <h4 class="mb-0 fw-bold">{{ count($dataSources) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-2">
            <div class="card report-stat-card shadow-none">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="me-3 p-3 rounded text-white" style="background-color: #4682b4;">
                        <i class="fa-solid fa-file-export fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 font-smallsize">Export Formats</h6>
                        <h4 class="mb-0 fw-bold">CSV, Excel, PDF</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-2">
            <div class="card report-stat-card shadow-none">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="me-3 p-3 rounded text-white" style="background-color: #008080;">
                        <i class="fa-solid fa-table fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 font-smallsize">Report Format</h6>
                        <h4 class="mb-0 fw-bold">Data Table</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Reports Table Card -->
    <div class="card report-table-card shadow-none">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-folder-open me-2 text-teal" style="color: #008080;"></i>Saved Custom Reports</h6>
            <form action="{{ route('admin.reports.index') }}" method="GET" class="d-flex align-items-center flex-nowrap gap-2 m-0">
                <select name="per_page" class="form-select form-select-sm" style="width: auto; border: 1.5px solid #cbd5e1; border-radius: 8px;" onchange="this.form.submit()" title="Records Per Page">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                </select>
                <select name="data_source" class="form-select form-select-sm" style="width: auto; border: 1.5px solid #cbd5e1; border-radius: 8px;" onchange="this.form.submit()">
                    <option value="">All Data Sources</option>
                    @foreach($dataSources as $key => $src)
                        <option value="{{ $key }}" {{ request('data_source') == $key ? 'selected' : '' }}>{{ $src['label'] }}</option>
                    @endforeach
                </select>
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="text" name="search" class="form-control" style="border: 1.5px solid #cbd5e1; border-right: none;" placeholder="Search reports..." value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.reports.index', array_filter(['data_source' => request('data_source'), 'per_page' => request('per_page')])) }}" class="btn btn-outline-secondary d-flex align-items-center" style="border: 1.5px solid #cbd5e1; border-left: none; border-right: none; background: #ffffff; color: #64748b; text-decoration: none;" title="Clear Search">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                    <button class="btn btn-outline-secondary" style="border: 1.5px solid #cbd5e1; border-left: none; background: #ffffff;" type="submit" title="Search"><i class="fa-solid fa-magnifying-glass text-muted"></i></button>
                </div>
                @if(request('search') || request('data_source'))
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center" title="Reset Filters" style="white-space: nowrap;">
                        <i class="fa-solid fa-rotate-left me-1"></i>Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table custom-reports-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="min-width: 200px;">Report Name</th>
                            <th style="min-width: 220px;">Data Source</th>
                            <th style="width: 130px;">Columns</th>
                            <th style="min-width: 140px;">Created By</th>
                            <th style="min-width: 130px;">Created On</th>
                            <th class="text-end" style="min-width: 240px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            @php
                                $cfg = $report->configuration ?? [];
                                $fieldsCount = count($cfg['fields'] ?? []);
                                $rawSources = is_array($cfg['data_sources'] ?? null) 
                                    ? $cfg['data_sources'] 
                                    : (str_contains($report->data_source ?? '', ',') ? array_filter(array_map('trim', explode(',', $report->data_source))) : [$report->data_source]);
                                $isMulti = count($rawSources) > 1;
                            @endphp
                            <tr>
                                <td class="text-muted fw-semibold">{{ $loop->iteration + ($reports->currentPage() - 1) * $reports->perPage() }}</td>
                                <td>
                                    <div class="fw-bold text-dark fs-6" style="color: #0f172a !important;">{{ $report->name }}</div>
                                    @if($report->description)
                                        <div class="text-muted font-smallsize mt-1" style="font-size: 11.5px; line-height: 1.35;">{{ Str::limit($report->description, 65) }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($isMulti)
                                        <div>
                                            <span class="badge badge-multi-source mb-1">
                                                <i class="fa-solid fa-layer-group me-1"></i> Multi-Source ({{ count($rawSources) }})
                                            </span>
                                            <div class="d-flex flex-wrap gap-1 mt-1">
                                                @foreach($rawSources as $sKey)
                                                    @php $sInfo = $dataSources[$sKey] ?? null; @endphp
                                                    <span class="source-badge-pill" style="font-size: 11px; padding: 3px 8px;">
                                                        <i class="{{ $sInfo['icon'] ?? 'fa-solid fa-table' }} me-1" style="color: #008080;"></i> {{ $sInfo['label'] ?? ucfirst($sKey) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $sKey = $rawSources[0] ?? $report->data_source;
                                            $sourceInfo = $dataSources[$sKey] ?? null;
                                        @endphp
                                        @if($sourceInfo)
                                            <span class="source-badge-pill">
                                                <i class="{{ $sourceInfo['icon'] ?? 'fa-solid fa-database' }} me-1" style="color: #008080;"></i> {{ $sourceInfo['label'] }}
                                            </span>
                                        @else
                                            <span class="source-badge-pill">{{ ucfirst($report->data_source) }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-column-count">
                                        <i class="fa-solid fa-table-columns me-1" style="color: #008080;"></i> {{ $fieldsCount }} {{ $fieldsCount === 1 ? 'Column' : 'Columns' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle-sm me-2">
                                            <i class="fa-solid fa-user text-teal" style="font-size: 11px; color: #008080;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size: 13px;">{{ $report->creator->first_name ?? 'Admin' }} {{ $report->creator->last_name ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted" style="font-size: 12.5px;">
                                        <i class="fa-regular fa-calendar me-1 text-secondary" style="font-size: 11px;"></i>{{ $report->created_at ? $report->created_at->format('d M, Y') : '-' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <a href="{{ route('admin.reports.run', $report->id) }}" class="btn btn-action-view" title="View Report">
                                            <i class="fa-solid fa-eye me-1"></i> View
                                        </a>
                                        <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn btn-action-edit" title="Edit Configuration">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <div class="dropdown d-inline-block">
                                            <button type="button" class="btn btn-action-export dropdown-toggle report-export-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
                                                <i class="fa-solid fa-download me-1"></i> Export
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end font-smallsize shadow-sm border">
                                                <li>
                                                    <a class="dropdown-item py-2" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'csv']) }}">
                                                        <i class="fa-solid fa-file-csv text-success me-2"></i> Export as CSV
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item py-2" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'excel']) }}">
                                                        <i class="fa-solid fa-file-excel text-success me-2"></i> Export as Excel (.xls)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item py-2" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'pdf']) }}">
                                                        <i class="fa-solid fa-file-pdf text-danger me-2"></i> Export as PDF
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline mb-0" onsubmit="return confirm('Are you sure you want to delete this saved report?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-action-delete" title="Delete Report">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @if(request('search') || request('data_source'))
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-magnifying-glass fa-3x mb-3 text-secondary" style="color: #94a3b8 !important;"></i>
                                        <h5 class="fw-bold text-dark">No matching reports found</h5>
                                        <p class="font-smallsize mb-3 text-muted">
                                            No saved reports matched your criteria
                                            @if(request('search'))
                                                for <strong>"{{ request('search') }}"</strong>
                                            @endif
                                            @if(request('data_source'))
                                                in data source <strong>"{{ $dataSources[request('data_source')]['label'] ?? request('data_source') }}"</strong>
                                            @endif
                                            .
                                        </p>
                                        <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-rotate-left me-1"></i> Reset Filters & Show All Reports
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-file-circle-question fa-3x mb-3 text-secondary"></i>
                                        <h5>No reports saved yet</h5>
                                        <p class="font-smallsize mb-3">Click below to start creating your first custom LMS report.</p>
                                        <a href="{{ route('admin.reports.create') }}" class="btn btn-sm btn-primary" style="background-color: #008080; border-color: #008080;">
                                            <i class="fa-solid fa-plus me-1"></i> Create First Report
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($reports->hasPages())
            <div class="card-footer bg-white py-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports</small>
                    {{ $reports->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@include('layouts.admin.footer')

<script>
    document.querySelectorAll('.report-export-toggle').forEach(function (button) {
        new bootstrap.Dropdown(button, {
            popperConfig: function (defaultConfig) {
                return Object.assign({}, defaultConfig, {
                    strategy: 'fixed',
                    modifiers: defaultConfig.modifiers.concat([{
                        name: 'preventOverflow',
                        options: {
                            boundary: document.body,
                            rootBoundary: 'viewport'
                        }
                    }])
                });
            }
        });
    });
</script>