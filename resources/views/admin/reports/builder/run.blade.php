@include('layouts.admin.header')

<div class="container-fluid py-3">
    <!-- Header & Action Bar -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-7">
            <div class="d-flex align-items-center mb-1">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-secondary me-2" title="Back to Reports">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h4 class="mb-0 text-dark fw-bold">{{ $report->name }}</h4>
            </div>
            @if($report->description)
                <p class="text-muted mb-0 font-smallsize ms-4">{{ $report->description }}</p>
            @endif
        </div>
        <div class="col-md-5 text-md-end mt-2 mt-md-0">
            <div class="btn-group">
                <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit Configuration
                </a>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-download me-1"></i> Export Report
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end font-smallsize">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'csv']) }}">
                                <i class="fa-solid fa-file-csv text-success me-2"></i> Export as CSV
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'excel']) }}">
                                <i class="fa-solid fa-file-excel text-success me-2"></i> Export as Excel (.xls)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.reports.export', ['report' => $report->id, 'format' => 'pdf']) }}">
                                <i class="fa-solid fa-file-pdf text-danger me-2"></i> Export as PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Metadata Summary Cards -->
    <div class="row mb-3">
        <div class="col-sm-4 mb-2">
            <div class="card card-border shadow-none border py-2 px-3">
                <small class="text-muted">Data Source</small>
                @php
                    $runSources = is_array($config['data_sources'] ?? null) 
                        ? $config['data_sources'] 
                        : (str_contains($report->data_source ?? '', ',') ? array_filter(array_map('trim', explode(',', $report->data_source))) : [$report->data_source]);
                @endphp
                @if(count($runSources) > 1)
                    <div class="fw-bold text-dark text-capitalize mt-1">
                        <span class="badge text-white me-1" style="background-color: #008080;"><i class="fa-solid fa-layer-group me-1"></i> Multi-Source ({{ count($runSources) }})</span>
                        <span class="font-smallsize text-muted">({{ implode(' + ', array_map(function($s) { return ucfirst(str_replace('_', ' ', $s)); }, $runSources)) }})</span>
                    </div>
                @else
                    <div class="fw-bold text-dark text-capitalize"><i class="fa-solid fa-database text-teal me-1" style="color: #008080;"></i> {{ str_replace('_', ' ', $report->data_source) }}</div>
                @endif
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="card card-border shadow-none border py-2 px-3">
                <small class="text-muted">Total Result Records</small>
                <div class="fw-bold text-dark"><i class="fa-solid fa-list-ol text-teal me-1" style="color: #008080;"></i> {{ $reportData['total_count'] }} records</div>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="card card-border shadow-none border py-2 px-3">
                <small class="text-muted">Execution Date</small>
                <div class="fw-bold text-dark"><i class="fa-regular fa-clock text-teal me-1" style="color: #008080;"></i> {{ date('d M, Y h:i A') }}</div>
            </div>
        </div>
    </div>

    <!-- Visual Chart (if applicable) -->
    @if(!empty($reportData['chart_data']) && in_array($reportData['output_type'], ['bar', 'line', 'pie', 'doughnut']))
        <div class="card card-border shadow-none border mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-chart-column me-2 text-teal" style="color: #008080;"></i>Visual Chart Analysis</h6>
            </div>
            <div class="card-body p-3" style="max-height: 400px; position: relative;">
                <canvas id="reportChart" height="120"></canvas>
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="card card-border shadow-none border">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-table me-2 text-teal" style="color: #008080;"></i>Report Data Table</h6>
            <span class="badge bg-light text-dark border">{{ $reportData['total_count'] }} rows</span>
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

