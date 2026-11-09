<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $reportName }}</title>
    <style>
        @page {
            margin: 6mm 6mm 8mm 6mm;
        }
        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
            font-size: 7pt;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.25;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #008080;
            padding-bottom: 4px;
            margin-bottom: 5px;
        }
        .report-title {
            font-size: 13pt;
            font-weight: bold;
            color: #008080;
            margin: 0 0 3px 0;
        }
        .meta-text {
            font-size: 7.2pt;
            color: #475569;
            margin: 0;
        }
        .notice-box {
            background-color: #fff8e6;
            color: #92400e;
            padding: 4px 8px;
            font-size: 7pt;
            border: 1px solid #fde68a;
            border-radius: 3px;
            margin-bottom: 6px;
        }

        /* Grouped Table Styling */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 3px;
            table-layout: auto;
        }
        .report-table thead {
            display: table-header-group;
        }
        .report-table tr {
            page-break-inside: auto;
        }
        @php
            $headersCount = count($headers);
        @endphp
        @if($headersCount > 25)
            body { font-size: 5pt; }
            .report-table th { font-size: 5pt; padding: 2px 2px; }
            .report-table td { font-size: 4.8pt; padding: 2px 2px; }
            .badge, .badge-pill { font-size: 4.8pt; padding: 1px 3px; }
        @elseif($headersCount > 12)
            body { font-size: 5.8pt; }
            .report-table th { font-size: 5.8pt; padding: 3px 2.5px; }
            .report-table td { font-size: 5.5pt; padding: 2.5px 2.5px; }
            .badge, .badge-pill { font-size: 5.5pt; padding: 1px 4px; }
        @endif
        .report-table th {
            background-color: #008080;
            color: #ffffff;
            font-weight: bold;
            font-size: 7pt;
            text-align: left;
            padding: 4.5px 4px;
            border: 0.5px solid #006666;
            vertical-align: middle;
            word-wrap: break-word;
            line-height: 1.2;
        }
        .report-table td {
            padding: 4px 4px;
            border: 0.5px solid #cbd5e1;
            font-size: 6.9pt;
            vertical-align: top;
            color: #1e293b;
            word-wrap: break-word;
            line-height: 1.2;
        }

        /* Line item block entries for multiple assessments per course */
        .line-item-entry {
            display: block;
            padding: 2px 0;
            min-height: 16px;
            line-height: 1.3;
        }
        .line-item-entry + .line-item-entry {
            border-top: 0.5px dashed #cbd5e1;
            margin-top: 2px;
            padding-top: 2px;
        }

        /* Status & Result Badge Pills */
        .badge, .badge-pill {
            display: inline-block;
            padding: 1.5px 6px;
            border-radius: 3px;
            font-size: 6.8pt;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
        }
        .badge-completed, .badge-passed, .badge-watched, .badge-active, .bg-success {
            background-color: #dcfce7 !important;
            color: #15803d !important;
            border: 0.5px solid #86efac !important;
        }
        .badge-inprogress, .badge-pending, .badge-reassigned, .badge-inactive, .bg-warning {
            background-color: #fef3c7 !important;
            color: #b45309 !important;
            border: 0.5px solid #fde68a !important;
        }
        .badge-notstarted, .badge-notattempted, .badge-notwatched, .badge-assigned, .bg-secondary {
            background-color: #f1f5f9 !important;
            color: #475569 !important;
            border: 0.5px solid #cbd5e1 !important;
        }
        .badge-expired, .badge-failed, .badge-deactivated, .bg-danger {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
            border: 0.5px solid #fca5a5 !important;
        }
        .bg-light {
            background-color: #f8fafc !important;
            color: #475569 !important;
            border: 0.5px solid #e2e8f0 !important;
        }
        .text-teal {
            color: #008080 !important;
        }
        .text-dark {
            color: #0f172a !important;
        }

        .footer-table {
            position: fixed;
            bottom: -5mm;
            left: 0;
            right: 0;
            height: 4mm;
            border-top: 0.5px solid #cbd5e1;
            padding-top: 2px;
            font-size: 6.5pt;
            color: #64748b;
        }
    </style>
</head>
<body>
    <!-- Top Header on First Page -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                <h1 class="report-title">{{ $reportName }}</h1>
                <p class="meta-text">
                    <strong>Data Source:</strong> {{ ucfirst(str_replace('_', ' ', $config['data_source'] ?? 'Report')) }} &nbsp;|&nbsp;
                    <strong>Total Records:</strong> {{ number_format($totalCount) }} &nbsp;|&nbsp;
                    <strong>Generated On:</strong> {{ date('d-M-Y h:i A') }}
                </p>
            </td>
        </tr>
    </table>

    @if($totalCount > ($totalExported ?? 0))
        <div class="notice-box">
            <strong>Note:</strong> Showing the first {{ number_format($totalExported) }} formatted records for PDF export. For the complete dataset, please download via Excel (.xls) or CSV.
        </div>
    @endif

    @php
        $headersCount = count($headers);
        $prevParentKey = null;
        $prevCourseKey = null;

        $learnerColIndices = [];
        $courseColIndices = [];

        $hasSNo = !empty($headers) && ($headers[0] === 'S.No' || $headers[0] === '#');
        $rootColIdx = $hasSNo ? 1 : 0;
        $isLearnerRoot = str_contains(strtolower($headers[$rootColIdx] ?? ''), 'learner') || str_contains(strtolower($headers[$rootColIdx] ?? ''), 'user') || str_contains(strtolower($headers[$rootColIdx] ?? ''), 'name');

        foreach ($headers as $cIdx => $h) {
            $hLower = strtolower($h);
            if ($hasSNo && $cIdx === 0) {
                continue;
            }
            if ($cIdx === $rootColIdx) {
                $learnerColIndices[] = $rootColIdx;
                continue;
            }
            if (str_contains($hLower, 'email') || str_contains($hLower, 'department') || str_contains($hLower, 'designation') || str_contains($hLower, 'emp id') || str_contains($hLower, 'employee') || str_contains($hLower, 'total assigned') || str_contains($hLower, 'completion rate') || str_contains($hLower, 'registration') || ($hLower === 'status')) {
                $learnerColIndices[] = $cIdx;
            } elseif (str_contains($hLower, 'course name') || str_contains($hLower, 'course code') || str_contains($hLower, 'category') || str_contains($hLower, 'course status') || str_contains($hLower, 'progress') || str_contains($hLower, 'expiration') || str_contains($hLower, 'due date')) {
                $courseColIndices[] = $cIdx;
            }
        }
    @endphp

    <table class="report-table">
        <thead>
            <tr>
                @foreach($headers as $h)
                    @php
                        $isCenter = ($h === 'S.No' || $h === '#') || str_contains($h, 'Attempts') || str_contains($h, 'Score') || str_contains($h, 'Marks') || str_contains($h, 'Result') || str_contains($h, 'Time') || str_contains($h, 'Status') || str_contains($h, 'Date') || str_contains($h, 'Completed') || str_contains($h, 'Count') || str_contains($h, 'Rate');
                        $thWidth = ($h === 'S.No' || $h === '#') ? 'width: 32px;' : '';
                    @endphp
                    <th style="{{ $isCenter ? 'text-align: center;' : 'text-align: left;' }} {{ $thWidth }}">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $rIdx => $row)
                @php
                    $rowArr = (array)$row;
                    $currParentVal = trim(strip_tags((string)($rowArr[$rootColIdx] ?? '')));
                    $isNewParent = ($currParentVal !== $prevParentKey);
                    if ($isNewParent) {
                        $prevParentKey = $currParentVal;
                        $prevCourseKey = null;
                    }

                    $courseColIdx = !empty($courseColIndices) ? $courseColIndices[0] : $rootColIdx;
                    $currCourseVal = trim(strip_tags((string)($rowArr[$courseColIdx] ?? '')));
                    $isNewCourse = ($isNewParent || $currCourseVal !== $prevCourseKey);
                    if ($isNewCourse) {
                        $prevCourseKey = $currCourseVal;
                    }

                    $rowTopBorder = $isNewParent && $rIdx > 0 ? 'border-top: 1.5px solid #008080;' : ($isNewCourse && $rIdx > 0 ? 'border-top: 1px solid #cbd5e1;' : '');
                @endphp
                <tr style="{{ $rowTopBorder }}">
                    @for($cIdx = 0; $cIdx < $headersCount; $cIdx++)
                        @php
                            $hName = $headers[$cIdx] ?? '';
                            $isCenter = ($hName === 'S.No' || $hName === '#') || str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed') || str_contains($hName, 'Count') || str_contains($hName, 'Rate');
                            $cellVal = $rowArr[$cIdx] ?? '-';
                            $valLower = strtolower(trim(strip_tags((string)$cellVal)));
                            $alignClass = $isCenter ? 'text-align: center;' : 'text-align: left;';

                            $isLearnerCol = in_array($cIdx, $learnerColIndices);
                            $isCourseCol = in_array($cIdx, $courseColIndices);

                            $tdStyle = $alignClass;
                            $displayContent = $cellVal;

                            if ($hasSNo && $cIdx === 0) {
                                if ($isNewParent) {
                                    $tdStyle .= ' font-weight: 600; color: #475569; background-color: #ffffff; text-align: center; width: 32px;';
                                } else {
                                    $displayContent = '';
                                    $tdStyle .= ' border-top: none !important; border-bottom: none !important; background-color: #ffffff; text-align: center; width: 32px;';
                                }
                            } elseif ($isLearnerRoot) {
                                if ($isLearnerCol) {
                                    if ($isNewParent) {
                                        $tdStyle .= ' font-weight: 600; color: #0f172a; background-color: #ffffff;';
                                    } else {
                                        $displayContent = '';
                                        $tdStyle .= ' border-top: none !important; border-bottom: none !important; background-color: #ffffff;';
                                    }
                                } elseif ($isCourseCol) {
                                    if ($isNewCourse) {
                                        $tdStyle .= ' font-weight: 500; color: #1e293b; background-color: #ffffff;';
                                    } else {
                                        $displayContent = '';
                                        $tdStyle .= ' border-top: none !important; border-bottom: none !important; background-color: #ffffff;';
                                    }
                                }
                            } else {
                                if ($isCourseCol || $cIdx === 0) {
                                    if ($isNewParent) {
                                        $tdStyle .= ' font-weight: 600; color: #0f172a; background-color: #ffffff;';
                                    } else {
                                        $displayContent = '';
                                        $tdStyle .= ' border-top: none !important; border-bottom: none !important; background-color: #ffffff;';
                                    }
                                }
                            }
                        @endphp
                        <td style="{{ $tdStyle }}">
                            @if($displayContent === '')
                                &nbsp;
                            @elseif(str_contains((string)$displayContent, '<div') || str_contains((string)$displayContent, '<span') || str_contains((string)$displayContent, '<br'))
                                {!! $displayContent !!}
                            @elseif($valLower === 'completed' || $valLower === 'passed' || $valLower === 'watched' || $valLower === 'active')
                                <span class="badge-pill badge-completed">{{ $displayContent }}</span>
                            @elseif($valLower === 'in progress' || $valLower === 'pending' || $valLower === 'reassigned' || $valLower === 'inactive')
                                <span class="badge-pill badge-inprogress">{{ $displayContent }}</span>
                            @elseif($valLower === 'failed' || $valLower === 'expired' || $valLower === 'deactivated')
                                <span class="badge-pill badge-expired">{{ $displayContent }}</span>
                            @elseif($valLower === 'not started' || $valLower === 'not attempted' || $valLower === 'not watched' || $valLower === 'assigned')
                                <span class="badge-pill badge-notstarted">{{ $displayContent }}</span>
                            @else
                                {{ $displayContent !== null && $displayContent !== '' ? $displayContent : '-' }}
                            @endif
                        </td>
                    @endfor
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" style="text-align: center; padding: 12px; color: #64748b;">
                        No records match the report criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <table class="footer-table" style="width: 100%;">
        <tr>
            <td style="text-align: left;">LMS Report System</td>
            <td style="text-align: right;">Generated on {{ date('d M, Y h:i A') }}</td>
        </tr>
    </table>
</body>
</html>
