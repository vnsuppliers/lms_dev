@include('layouts.admin.header')

<style>
    /* Modern SaaS Report Execution Theme */
    .report-run-page {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .modern-header-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px 24px;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.04);
        margin-bottom: 20px;
    }
    .btn-back-square {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        color: #475569;
        font-size: 15px;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-back-square:hover {
        background: #0f766e;
        color: #ffffff;
        border-color: #0f766e;
        transform: translateX(-2px);
    }
    .report-title-main {
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.3px;
        margin-bottom: 2px;
    }
    .report-subtitle {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 0;
    }
    .badge-status-pill {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        font-weight: 600;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.2px;
    }
    .btn-action-edit {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 18px;
        border-radius: 8px 0 0 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-action-edit:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: #0f172a;
    }
    .btn-action-export {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: 1px solid #059669;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 20px;
        border-radius: 0 8px 8px 0;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        transition: all 0.2s ease;
    }
    .btn-action-export:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
    }

    /* Modern Quick Stats Strip */
    .modern-stats-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 18px;
        padding-top: 18px;
        border-top: 1px solid #f1f5f9;
    }
    @media (max-width: 768px) {
        .modern-stats-strip {
            grid-template-columns: 1fr;
        }
    }
    .stat-pill-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .stat-pill-box:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        box-shadow: 0 3px 8px rgba(0,0,0,0.04);
    }
    .stat-icon-wrapper {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .stat-icon-source {
        background: #ecfdf5;
        color: #059669;
    }
    .stat-icon-records {
        background: #eff6ff;
        color: #2563eb;
    }
    .stat-icon-date {
        background: #fef3c7;
        color: #d97706;
    }
    .stat-label-text {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        margin-bottom: 2px;
    }
    .stat-val-text {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0;
        line-height: 1.2;
    }

    /* Modern Table Container Card */
    .modern-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
        overflow: hidden;
    }
    .modern-table-header {
        background: #ffffff;
        padding: 16px 22px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .table-title-text {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
    }
    .badge-rows-count {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        font-weight: 600;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
    }
</style>

<div class="container-fluid py-3 report-run-page">
    <!-- Modern Header & Action Card -->
    <div class="modern-header-card">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.reports.index') }}" class="btn-back-square" title="Back to Reports">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="report-title-main">{{ $report->name }}</h4>
                        <span class="badge-status-pill"><i class="fa-solid fa-circle-check me-1"></i> Executed</span>
                    </div>
                    @if($report->description)
                        <p class="report-subtitle">{{ $report->description }}</p>
                    @else
                        <p class="report-subtitle">Report executed successfully. View rows below or export to file.</p>
                    @endif
                </div>
            </div>
            <div class="d-flex align-items-center gap-0 ms-auto">
                <div class="btn-group shadow-sm" role="group">
                    <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn-action-edit">
                        <i class="fa-solid fa-pen-to-square text-teal" style="color: #0f766e;"></i> Edit Configuration
                    </a>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn-action-export dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-download me-1"></i> Export Report
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border py-2" style="border-radius: 10px;">
                            <li>
                                <a class="dropdown-item py-2 px-3 font-smallsize" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'csv']) }}">
                                    <i class="fa-solid fa-file-csv text-success me-2"></i> Export as CSV (.csv)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 font-smallsize" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'excel']) }}">
                                    <i class="fa-solid fa-file-excel text-success me-2"></i> Export as Excel (.xls)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 font-smallsize" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'pdf']) }}">
                                    <i class="fa-solid fa-file-pdf text-danger me-2"></i> Export as PDF (.pdf)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Integrated Modern Stats Strip -->
        <div class="modern-stats-strip">
            <!-- Data Source -->
            <div class="stat-pill-box">
                <div class="stat-icon-wrapper stat-icon-source">
                    <i class="fa-solid fa-database"></i>
                </div>
                <div>
                    <div class="stat-label-text">Data Source</div>
                    <div class="stat-val-text text-capitalize">
                        @php
                            $runSources = is_array($config['data_sources'] ?? null) 
                                ? $config['data_sources'] 
                                : (str_contains($report->data_source ?? '', ',') ? array_filter(array_map('trim', explode(',', $report->data_source))) : [$report->data_source]);
                        @endphp
                        @if(count($runSources) > 1)
                            Multi-Source ({{ count($runSources) }})
                        @else
                            {{ ucfirst(str_replace('_', ' ', $report->data_source)) }}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Total Result Records -->
            <div class="stat-pill-box">
                <div class="stat-icon-wrapper stat-icon-records">
                    <i class="fa-solid fa-list-ol"></i>
                </div>
                <div>
                    <div class="stat-label-text">Total Result Records</div>
                    <div class="stat-val-text">
                        {{ number_format($reportData['total_count']) }} records
                    </div>
                </div>
            </div>

            <!-- Execution Date -->
            <div class="stat-pill-box">
                <div class="stat-icon-wrapper stat-icon-date">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div>
                    <div class="stat-label-text">Execution Date</div>
                    <div class="stat-val-text">
                        {{ date('d M, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Chart (if applicable) -->
    @if(!empty($reportData['chart_data']) && in_array($reportData['output_type'], ['bar', 'line', 'pie', 'doughnut']))
        <div class="card modern-table-card border-0 mb-4">
            <div class="modern-table-header">
                <h6 class="table-title-text"><i class="fa-solid fa-chart-column text-teal" style="color: #0f766e;"></i> Visual Chart Analysis</h6>
            </div>
            <div class="card-body p-3" style="max-height: 400px; position: relative;">
                <canvas id="reportChart" height="120"></canvas>
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="card modern-table-card border-0">
        <div class="modern-table-header">
            <h6 class="table-title-text"><i class="fa-solid fa-table text-teal" style="color: #0f766e;"></i> Report Data Table</h6>
            <span class="badge-rows-count">{{ number_format($reportData['total_count']) }} rows</span>
        </div>
        <div class="card-body p-3">
            <style>
                #reportResultTable {
                    min-width: 100%;
                    border-collapse: separate;
                    border-spacing: 0;
                    border: 1px solid #d1d5db;
                }
                #reportResultTable thead th,
                #reportResultTable thead tr,
                #reportResultTable thead th:hover,
                #reportResultTable thead tr:hover,
                #reportResultTable thead tr:hover > th {
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
                #reportResultTable td {
                    vertical-align: top !important;
                    padding: 10px 14px !important;
                    font-size: 13px !important;
                    line-height: 1.5 !important;
                    border: 1px solid #e5e7eb !important;
                    color: #1f2937 !important;
                    background-color: #ffffff !important;
                }
                #reportResultTable tbody tr,
                #reportResultTable tbody td {
                    background-color: #ffffff !important;
                    background: #ffffff !important;
                    color: #1f2937 !important;
                }
                #reportResultTable tbody tr:hover,
                #reportResultTable tbody tr:hover > td,
                #reportResultTable tbody td:hover {
                    background-color: #ffffff !important;
                    background: #ffffff !important;
                    color: #1f2937 !important;
                    box-shadow: none !important;
                    --bs-table-accent-bg: transparent !important;
                    --bs-table-bg-state: transparent !important;
                    --bs-table-hover-bg: transparent !important;
                }
                #reportResultTable .line-item-entry {
                    padding: 3px 0;
                    min-height: 28px;
                }
                #reportResultTable .line-item-entry + .line-item-entry {
                    border-top: 1px dashed #e2e8f0;
                    margin-top: 4px;
                    padding-top: 4px;
                }
            </style>
            @php
                $isGroupedHierarchy = (count($reportData['headers']) === 4 && ($reportData['headers'][0] ?? '') === 'Course Name');
            @endphp
            <div class="table-responsive" style="min-height: 520px; max-height: 85vh; overflow-y: auto;">
                <table class="table table-bordered align-top mb-0 font-smallsize" id="reportResultTable">
                    <thead>
                        <tr>
                            @foreach($reportData['headers'] as $index => $h)
                                @php
                                    $thStyle = 'white-space: nowrap; vertical-align: middle; padding: 10px 12px; font-weight: 600; font-size: 13px;';
                                    if ($h === 'S.No' || $h === '#') {
                                        $thStyle .= 'width: 60px; min-width: 50px; text-align: center;';
                                    } elseif ($h === 'Course Name') {
                                        $thStyle .= 'min-width: 240px;';
                                    } elseif (str_contains($h, 'Assessment Name') || str_contains($h, 'Assignment Name') || str_contains($h, 'Content Title') || $h === 'Exam Name') {
                                        $thStyle .= 'min-width: 250px;';
                                    } elseif (str_contains($h, 'Users')) {
                                        $thStyle .= 'min-width: 220px;';
                                    } elseif (str_contains($h, 'Attempts')) {
                                        $thStyle .= 'min-width: 110px; text-align: center;';
                                    } elseif ($h === 'Learner Email') {
                                        $thStyle .= 'min-width: 220px;';
                                    } elseif (str_contains($h, 'Watch Status')) {
                                        $thStyle .= 'min-width: 130px; text-align: center;';
                                    } elseif (str_contains($h, 'Course Status')) {
                                        $thStyle .= 'min-width: 130px; text-align: center;';
                                    } elseif (str_contains($h, 'Result')) {
                                        $thStyle .= 'min-width: 130px; text-align: center;';
                                    } elseif (str_contains($h, 'Marks')) {
                                        $thStyle .= 'min-width: 100px; text-align: center;';
                                    } elseif (str_contains($h, 'Score')) {
                                        $thStyle .= 'min-width: 90px; text-align: center;';
                                    } elseif (str_contains($h, 'Time')) {
                                        $thStyle .= 'min-width: 110px; text-align: center;';
                                    } elseif ($h === 'Status') {
                                        $thStyle .= 'min-width: 120px; text-align: center;';
                                    } elseif (str_contains($h, 'Assigned Date')) {
                                        $thStyle .= 'min-width: 130px; text-align: center;';
                                    } elseif (str_contains($h, 'Attend Date') || str_contains($h, 'Start Date')) {
                                        $thStyle .= 'min-width: 150px; text-align: center;';
                                    } elseif (str_contains($h, 'Completed')) {
                                        $thStyle .= 'min-width: 150px; text-align: center;';
                                    } elseif (str_contains($h, 'Assessment Status') || str_contains($h, 'Assignment Status')) {
                                        $thStyle .= 'min-width: 140px; text-align: center;';
                                    }
                                @endphp
                                <th style="{{ $thStyle }}">{{ $h }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reportData['rows'] as $row)
                            @php
                                $rowArr = (array)$row;
                                $rowspans = $rowArr['_rowspans'] ?? null;
                            @endphp
                            <tr>
                                @if(!empty($rowspans) && is_array($rowspans))
                                    @for($cIdx = 0; $cIdx < count($reportData['headers']); $cIdx++)
                                        @php
                                            $span = $rowspans[$cIdx] ?? 1;
                                        @endphp
                                        @if($span > 0)
                                            @php
                                                $hName = $reportData['headers'][$cIdx] ?? '';
                                                $isCenter = ($hName === 'S.No' || $hName === '#') || str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed') || str_contains($hName, 'Count') || str_contains($hName, 'Rate');
                                                $cellAlign = $isCenter ? 'text-center' : 'text-start';
                                                $bgStyle = $span > 1 ? 'background-color: #ffffff;' : '';
                                                $sNoStyle = ($hName === 'S.No' || $hName === '#') ? 'font-weight: 600; color: #475569;' : '';
                                            @endphp
                                            <td @if($span > 1) rowspan="{{ $span }}" @endif class="align-top {{ $cellAlign }}" style="padding: 8px 10px; vertical-align: top !important; border: 1px solid #e9ecef; {{ $bgStyle }} {{ $sNoStyle }}">
                                                {!! $rowArr[$cIdx] ?? '-' !!}
                                            </td>
                                        @endif
                                    @endfor
                                @elseif(isset($rowArr['_course_rowspan']))
                                    @php
                                        $courseRowspan = $rowArr['_course_rowspan'] ?? 1;
                                        $itemRowspan = $rowArr['_item_rowspan'] ?? 1;
                                    @endphp
                                    @if($courseRowspan > 0)
                                        <td rowspan="{{ $courseRowspan }}" class="align-top" style="vertical-align: top !important; background-color: #ffffff; padding: 10px 12px; border: 1px solid #e9ecef;">
                                            {!! $rowArr[0] ?? '-' !!}
                                        </td>
                                    @endif
                                    @php $startIdx = 1; @endphp
                                    @if(isset($rowArr['_item_rowspan']))
                                        @if($itemRowspan > 0)
                                            <td rowspan="{{ $itemRowspan }}" class="align-top" style="vertical-align: top !important; background-color: #ffffff; padding: 10px 12px; border: 1px solid #e9ecef;">
                                                {!! $rowArr[1] ?? '-' !!}
                                            </td>
                                        @endif
                                        @php $startIdx = 2; @endphp
                                    @endif
                                    @for($cIdx = $startIdx; $cIdx < count($reportData['headers']); $cIdx++)
                                        @php
                                            $hName = $reportData['headers'][$cIdx] ?? '';
                                            $isCenter = str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed');
                                            $cellAlign = $isCenter ? 'text-center' : 'text-start';
                                        @endphp
                                        <td class="align-middle {{ $cellAlign }}" style="padding: 8px 10px; vertical-align: middle !important; border: 1px solid #e9ecef;">
                                            {!! $rowArr[$cIdx] ?? '-' !!}
                                        </td>
                                    @endfor
                                @else
                                    @foreach((array)$row as $cellIdx => $cell)
                                        @if(!str_starts_with((string)$cellIdx, '_'))
                                            @php
                                                $hName = $reportData['headers'][$cellIdx] ?? '';
                                                $isCenter = str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed');
                                                $cellAlign = $isCenter ? 'text-center' : 'text-start';
                                            @endphp
                                            <td class="align-top {{ $cellAlign }}" style="padding: 8px 10px; vertical-align: top !important; border: 1px solid #e9ecef;">
                                                {!! $cell !== null && $cell !== '' ? $cell : '-' !!}
                                            </td>
                                        @endif
                                    @endforeach
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($reportData['headers']) }}" class="text-center py-4 text-muted">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart Initialization Script -->
@if(!empty($reportData['chart_data']) && in_array($reportData['output_type'], ['bar', 'line', 'pie', 'doughnut']))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {
    const chartData = @json($reportData['chart_data']);
    const ctx = document.getElementById('reportChart').getContext('2d');
    new Chart(ctx, {
        type: chartData.type,
        data: {
            labels: chartData.labels,
            datasets: chartData.datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: (chartData.type === 'pie' || chartData.type === 'doughnut'),
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endif

@include('layouts.admin.footer')

