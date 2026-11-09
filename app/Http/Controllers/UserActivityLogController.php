<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserActivityLogController extends Controller
{
    // Filters activity logs for a specific user from the admin panel.
    public function fetch_user_activity_filter(Request $request) 
    {
        $userId = $request->input('user_id');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = Activity::where('user_id', $userId);

        if (!empty($fromDate) && !empty($toDate)) {
            $query->whereBetween('created_at', [
                Carbon::parse($fromDate)->startOfDay(), 
                Carbon::parse($toDate)->endOfDay()
            ]);
        }

        $activities = $query->orderBy('created_at', 'desc')->get();

        //  Get the FIRST (earliest) login activity (type = 1) in the selected range
        $firstLoginQuery = Activity::where('user_id', $userId)->where('type', 1);
        if (!empty($fromDate) && !empty($toDate)) {
            $firstLoginQuery->whereBetween('created_at', [
                Carbon::parse($fromDate)->startOfDay(), 
                Carbon::parse($toDate)->endOfDay()
            ]);
        }
        $firstLogin = $firstLoginQuery->orderBy('created_at', 'asc')->first();

        // Formatted to MM/DD/YYYY 12-hour format with AM/PM
        $loginTime = $firstLogin ? Carbon::parse($firstLogin->created_at)->format('m/d/Y h:i:s A') : '--';

        // Get the LAST (latest) logout/session summary time in the selected range
        $lastLogoutQuery = Activity::where('user_id', $userId)
            ->where(function($q) {
                $q->where('type', 2)
                  ->orWhere('activity', 'like', '%session%')
                  ->orWhere('activity', 'like', '%logged in for%');
            });
        if (!empty($fromDate) && !empty($toDate)) {
            $lastLogoutQuery->whereBetween('created_at', [
                Carbon::parse($fromDate)->startOfDay(), 
                Carbon::parse($toDate)->endOfDay()
            ]);
        }
        $lastLogout = $lastLogoutQuery->orderBy('created_at', 'desc')->first();

        // Formatted to MM/DD/YYYY 12-hour format with AM/PM
        $logoutTime = $lastLogout ? Carbon::parse($lastLogout->created_at)->format('m/d/Y h:i:s A') : '--';

        // Accumulate total time spent across ALL session records found in this range
        $sessionRecordsQuery = Activity::where('user_id', $userId)
            ->where(function($q) {
                $q->where('type', 2)
                  ->orWhere('activity', 'like', '%session%')
                  ->orWhere('activity', 'like', '%logged in for%');
            });
        if (!empty($fromDate) && !empty($toDate)) {
            $sessionRecordsQuery->whereBetween('created_at', [
                Carbon::parse($fromDate)->startOfDay(), 
                Carbon::parse($toDate)->endOfDay()
            ]);
        }
        $sessionRecords = $sessionRecordsQuery->get();

        $totalSeconds = 0;
        foreach ($sessionRecords as $session) {
            preg_match('/(\d+)\s*(hours?|hrs?)/i', $session->activity, $hrMatches);
            if (isset($hrMatches[1])) {
                $totalSeconds += intval($hrMatches[1]) * 3600;
            }
            preg_match('/(\d+)\s*(minutes?|mins?)/i', $session->activity, $minMatches);
            if (isset($minMatches[1])) {
                $totalSeconds += intval($minMatches[1]) * 60;
            }
            preg_match('/(\d+)\s*(seconds?|secs?)/i', $session->activity, $secMatches);
            if (isset($secMatches[1])) {
                $totalSeconds += intval($secMatches[1]);
            }
        }

        if ($totalSeconds > 0) {
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            $timeParts = [];
            if ($hours > 0) $timeParts[] = $hours . ' hours';
            if ($minutes > 0) $timeParts[] = $minutes . ' minutes';
            if ($seconds > 0 || empty($timeParts)) $timeParts[] = $seconds . ' seconds';

            $totalTimeSpent = implode(' ', $timeParts);
        } else {
            $totalTimeSpent = '0 minutes';
        }

        // Build list UI HTML matching your user dashboard items format
        $activityHtml = '';
        if ($activities->count() > 0) {
            foreach ($activities as $activities_item) {
                $formattedActDate = Carbon::parse($activities_item->created_at)->format('m/d/Y - h:i:s A');
                $activityHtml .= '
                <div class="row py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div class="col-12 col-md-9">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg-stiles">
                                <i class="fa-regular fa-clipboard icon icon-stiles"></i>
                            </div>
                            <div class="activity-course-block">
                                <span class="icon bg-primary"><i class="fa-regular fa-file icon-tag"></i></span> 
                                <span class="ps-2 activity-course-name">' . htmlspecialchars($activities_item->activity ?? '') . '</span> 
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 text-md-end text-muted small mt-2 mt-md-0">
                        ' . $formattedActDate . '
                    </div>
                </div>';
            }
        } else {
            $activityHtml = '<div class="col-12 py-3 text-center text-muted">No activity found for this period.</div>';
        }

        return response()->json([
            'activity_html' => $activityHtml,
            'login_time' => $loginTime,
            'logout_time' => $logoutTime,
            'total_time_spent' => trim($totalTimeSpent)
        ]);
    }


    // User dashboard filter handler (for logged-in user's own activity).
    // public function fetch_own_activity_filter(Request $request) 
    // {
    //     $userId = Auth::id();
    //     $fromDate = $request->input('from_date');
    //     $toDate = $request->input('to_date');

    //     $query = Activity::where('user_id', $userId);

    //     if (!empty($fromDate) && !empty($toDate)) {
    //         $query->whereBetween('created_at', [
    //             Carbon::parse($fromDate)->startOfDay(), 
    //             Carbon::parse($toDate)->endOfDay()
    //         ]);
    //     }

    //     $activities_data = $query->orderBy('created_at', 'desc')->get();

    //     //  First Login in Range
    //     $firstLoginQuery = Activity::where('user_id', $userId)->where('type', 1);
    //     if (!empty($fromDate) && !empty($toDate)) {
    //         $firstLoginQuery->whereBetween('created_at', [
    //             Carbon::parse($fromDate)->startOfDay(), 
    //             Carbon::parse($toDate)->endOfDay()
    //         ]);
    //     }
    //     $firstLogin = $firstLoginQuery->orderBy('created_at', 'asc')->first();
    //     $loginTime = $firstLogin ? Carbon::parse($firstLogin->created_at)->format('m/d/Y h:i:s A') : '--';

    //     // Last Logout in Range
    //     $lastLogoutQuery = Activity::where('user_id', $userId)
    //         ->where(function($q) {
    //             $q->where('type', 2)
    //               ->orWhere('activity', 'like', '%session%')
    //               ->orWhere('activity', 'like', '%logged in for%');
    //         });
    //     if (!empty($fromDate) && !empty($toDate)) {
    //         $lastLogoutQuery->whereBetween('created_at', [
    //             Carbon::parse($fromDate)->startOfDay(), 
    //             Carbon::parse($toDate)->endOfDay()
    //         ]);
    //     }
    //     $lastLogout = $lastLogoutQuery->orderBy('created_at', 'desc')->first();
    //     $logoutTime = $lastLogout ? Carbon::parse($lastLogout->created_at)->format('m/d/Y h:i:s A') : '--';

    //     // Total Time Spent Calculation
    //     $sessionRecordsQuery = Activity::where('user_id', $userId)
    //         ->where(function($q) {
    //             $q->where('type', 2)
    //               ->orWhere('activity', 'like', '%session%')
    //               ->orWhere('activity', 'like', '%logged in for%');
    //         });
    //     if (!empty($fromDate) && !empty($toDate)) {
    //         $sessionRecordsQuery->whereBetween('created_at', [
    //             Carbon::parse($fromDate)->startOfDay(), 
    //             Carbon::parse($toDate)->endOfDay()
    //         ]);
    //     }
    //     $sessionRecords = $sessionRecordsQuery->get();

    //     $totalSeconds = 0;
    //     foreach ($sessionRecords as $session) {
    //         preg_match('/(\d+)\s*(hours?|hrs?)/i', $session->activity, $hrMatches);
    //         if (isset($hrMatches[1])) {
    //             $totalSeconds += intval($hrMatches[1]) * 3600;
    //         }
    //         preg_match('/(\d+)\s*(minutes?|mins?)/i', $session->activity, $minMatches);
    //         if (isset($minMatches[1])) {
    //             $totalSeconds += intval($minMatches[1]) * 60;
    //         }
    //         preg_match('/(\d+)\s*(seconds?|secs?)/i', $session->activity, $secMatches);
    //         if (isset($secMatches[1])) {
    //             $totalSeconds += intval($secMatches[1]);
    //         }
    //     }

    //     if ($totalSeconds > 0) {
    //         $hours = floor($totalSeconds / 3600);
    //         $minutes = floor(($totalSeconds % 3600) / 60);
    //         $seconds = $totalSeconds % 60;

    //         $timeParts = [];
    //         if ($hours > 0) $timeParts[] = $hours . ' hours';
    //         if ($minutes > 0) $timeParts[] = $minutes . ' minutes';
    //         if ($seconds > 0 || empty($timeParts)) $timeParts[] = $seconds . ' seconds';

    //         $totalTimeSpent = implode(' ', $timeParts);
    //     } else {
    //         $totalTimeSpent = '0 minutes';
    //     }

    //     $activityHtml = '';
    //     if ($activities_data->count() > 0) {
    //         foreach ($activities_data as $activities) {
    //             $formattedDate = Carbon::parse($activities->created_at)->format('m/d/Y - h:i:s A');
                
    //             $activityHtml .= '
    //             <div class="row py-3 border-bottom d-flex align-items-center justify-content-between">
    //                 <div class="col-12 col-md-9">
    //                     <div class="d-flex align-items-center">
    //                         <div class="icon-bg-stiles">
    //                             <i class="fa-regular fa-clipboard icon icon-stiles"></i>
    //                         </div>
    //                         <div class="activity-course-block">
    //                             <span class="icon bg-primary"><i class="fa-regular fa-file icon-tag"></i></span> 
    //                             <span class="ps-2 activity-course-name">' . htmlspecialchars($activities->activity ?? '') . '</span> 
    //                         </div>
    //                     </div>
    //                 </div>
    //                 <div class="col-12 col-md-3 text-md-end text-muted small mt-2 mt-md-0">
    //                     ' . $formattedDate . '
    //                 </div>
    //             </div>';
    //         }
    //     } else {
    //         $activityHtml = '<div class="col-12 py-3 text-center text-muted">No activity found for this period.</div>';
    //     }

    //     return response()->json([
    //         'activity_html' => $activityHtml,
    //         'login_time' => $loginTime,
    //         'logout_time' => $logoutTime,
    //         'total_time_spent' => trim($totalTimeSpent)
    //     ]);
    // }

}