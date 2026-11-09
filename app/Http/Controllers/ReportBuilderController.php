<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Support\Facades\Auth;

class ReportBuilderController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display list of all saved reports.
     */
    public function index(Request $request)
    {
        $totalSavedReports = Report::count();
        $query = Report::with('creator')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('data_source', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('data_source')) {
            $query->where('data_source', $request->data_source);
        }

        $perPage = (int) $request->input('per_page', 10);
        if ($perPage <= 0) $perPage = 10;
        $reports = $query->paginate($perPage)->withQueryString();
        $dataSources = $this->reportService->getDataSources();

        return view('admin.reports.builder.index', compact('reports', 'dataSources', 'totalSavedReports'));
    }

    /**
     * Show report builder create view.
     */
    public function create()
    {
        $dataSources = $this->reportService->getDataSources();
        $departments = \Illuminate\Support\Facades\DB::table('departments')->orderBy('department_name')->get();
        $designations = \Illuminate\Support\Facades\DB::table('designations')->orderBy('designation_name')->get();
        return view('admin.reports.builder.create', compact('dataSources', 'departments', 'designations'));
    }

    /**
     * AJAX endpoint to get schema for selected data source or multiple sources.
     */
    public function getSchema(Request $request)
    {
        $sourceKey = $request->get('data_sources') ?: $request->get('data_source');
        $schema = $this->reportService->getSourceSchema($sourceKey);

        if (!$schema) {
            return response()->json(['success' => false, 'message' => 'Invalid data source.'], 400);
        }

        return response()->json(['success' => true, 'schema' => $schema]);
    }

    /**
     * AJAX endpoint for live preview of report.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'data_source' => 'nullable|string',
            'data_sources' => 'nullable|array',
            'fields' => 'nullable|array',
            'filters' => 'nullable|array',
            'group_by' => 'nullable|string',
            'calculation' => 'nullable|array',
            'sort_field' => 'nullable|string',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'output_type' => 'nullable|string|in:table,bar,line,pie',
        ]);

        try {
            // Allow large previews to finish before the browser's 120-second deadline.
            if (function_exists('set_time_limit')) {
                set_time_limit(110);
            }
            $config = $request->all();
            if (empty($config['data_sources']) && !empty($config['data_source'])) {
                if (str_contains($config['data_source'], ',')) {
                    $config['data_sources'] = array_filter(array_map('trim', explode(',', $config['data_source'])));
                }
            }
            // Live preview: fetch all matching records (up to 5000)
            $previewLimit = intval($request->input('preview_limit', 5000));
            if ($previewLimit <= 0 || $previewLimit > 10000) {
                $previewLimit = 5000;
            }
            $result = $this->reportService->executeReport($config, $previewLimit);

            return response()->json([
                'success' => true,
                'data' => $result,
                'preview_limit' => $previewLimit,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating preview: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store new saved report.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'data_source' => 'nullable|string',
            'data_sources' => 'nullable|array',
            'configuration' => 'required|array',
        ]);

        $dataSources = $request->input('data_sources');
        if (is_array($dataSources) && !empty($dataSources)) {
            $dataSourceStr = implode(',', $dataSources);
        } else {
            $dataSourceStr = $request->input('data_source') ?? 'learners';
        }

        $config = $request->configuration;
        if (is_array($dataSources) && !empty($dataSources)) {
            $config['data_sources'] = $dataSources;
        }

        $report = Report::create([
            'name' => $request->name,
            'description' => $request->description,
            'data_source' => $dataSourceStr,
            'configuration' => $config,
            'created_by' => Auth::id() ?? 1,
            'status' => $request->input('status', 1),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Report saved successfully!',
                'redirect_url' => route('admin.reports.index'),
                'report' => $report,
            ]);
        }

        return redirect()->route('admin.reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Show report builder edit view.
     */
    public function edit(Report $report)
    {
        $dataSources = $this->reportService->getDataSources();
        $departments = \Illuminate\Support\Facades\DB::table('departments')->orderBy('department_name')->get();
        $designations = \Illuminate\Support\Facades\DB::table('designations')->orderBy('designation_name')->get();
        return view('admin.reports.builder.edit', compact('report', 'dataSources', 'departments', 'designations'));
    }

    /**
     * Update saved report.
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'data_source' => 'nullable|string',
            'data_sources' => 'nullable|array',
            'configuration' => 'required|array',
        ]);

        $dataSources = $request->input('data_sources');
        if (is_array($dataSources) && !empty($dataSources)) {
            $dataSourceStr = implode(',', $dataSources);
        } else {
            $dataSourceStr = $request->input('data_source') ?? 'learners';
        }

        $config = $request->configuration;
        if (is_array($dataSources) && !empty($dataSources)) {
            $config['data_sources'] = $dataSources;
        }

        $report->update([
            'name' => $request->name,
            'description' => $request->description,
            'data_source' => $dataSourceStr,
            'configuration' => $config,
            'status' => $request->input('status', 1),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Report updated successfully!',
                'redirect_url' => route('admin.reports.index'),
                'report' => $report,
            ]);
        }

        return redirect()->route('admin.reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Delete saved report.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
    }

    /**
     * Run / View saved report.
     */
    public function run(Report $report)
    {
        $config = $report->configuration ?? [];
        $config['name'] = $report->name;
        $config['data_source'] = $report->data_source;

        $reportData = $this->reportService->executeReport($config, 5000);

        return view('admin.reports.builder.run', compact('report', 'reportData', 'config'));
    }

    /**
     * Export saved report in specified format (csv, excel, pdf).
     */
    public function export(Report $report, $format)
    {
        try {
            $config = $report->configuration ?? [];
            $config['name'] = $report->name;
            $config['data_source'] = $report->data_source;

            if ($format === 'csv') {
                return $this->reportService->exportCsv($config, $report->name);
            } elseif ($format === 'excel') {
                return $this->reportService->exportExcel($config, $report->name);
            } elseif ($format === 'pdf') {
                return $this->reportService->exportPdf($config, $report->name);
            }

            return redirect()->back()->with('error', 'Unsupported export format.');
        } catch (\Throwable $e) {
            \Log::error('Report export error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    /**
     * Export direct live preview configuration without saving.
     */
    public function exportDirect(Request $request, $format)
    {
        try {
            $config = $request->all();
            $sourceName = $request->input('data_source');
            if (!empty($config['data_sources']) && is_array($config['data_sources'])) {
                $sourceName = 'Multi-Source (' . count($config['data_sources']) . ' Sources)';
            } elseif (is_string($sourceName) && str_contains($sourceName, ',')) {
                $sourceName = 'Multi-Source';
            }
            $reportName = $request->input('name') ?: ($sourceName ? ucfirst(str_replace('_', ' ', $sourceName)) . ' Report' : 'Custom Report');

            if ($format === 'csv') {
                return $this->reportService->exportCsv($config, $reportName);
            } elseif ($format === 'excel') {
                return $this->reportService->exportExcel($config, $reportName);
            } elseif ($format === 'pdf') {
                return $this->reportService->exportPdf($config, $reportName);
            }

            return redirect()->back()->with('error', 'Unsupported export format.');
        } catch (\Throwable $e) {
            \Log::error('Report exportDirect error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $msg = htmlspecialchars($e->getMessage());
            return response(
                "<div style=\"font-family:sans-serif;padding:30px;text-align:center;max-width:550px;margin:50px auto;border:1px solid #fecdd3;border-radius:8px;background:#fff1f2;\">" .
                "<h3 style=\"color:#e11d48;margin-top:0;\">Report Export Notice</h3>" .
                "<p style=\"color:#475569;\">{$msg}</p>" .
                "<p style=\"font-size:13px;color:#64748b;\">For complete or heavy datasets, please download using <strong>Excel (.xls)</strong> or <strong>CSV</strong>.</p>" .
                "<button onclick=\"window.close()\" style=\"padding:8px 18px;cursor:pointer;background:#008080;color:#fff;border:none;border-radius:4px;font-weight:600;\">Close Tab</button>" .
                "</div>",
                500
            );
        }
    }
}
