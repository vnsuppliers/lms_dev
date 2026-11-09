<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\ActivityLog;
use App\Models\Activity;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userTypes = json_decode($user->user_type, true);

            if (in_array(1, $userTypes)) {
                return redirect()->intended('organizationdashboard');
            } else {
                return redirect('organization_dashboard');
            }
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->last_login = now();
            $user->save();

            User_login::create([
                'user_id' => $user->id,
                'login_time' => now(),
            ]);

            $userTypes = json_decode($user->user_type, true);

            if (in_array(1, $userTypes) || $user->roles->contains('role_type', 1)) {
                return redirect()->intended('organizationdashboard');
            } else {
                return redirect('organization_dashboard');
            }
        } else {
            return redirect('/')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $latestLogin = User_login::where('user_id', $user->id)
                                    ->orderBy('id', 'desc')
                                    ->first();

            if ($latestLogin) {
                $loginTime = $latestLogin->created_at;
                $logoutTime = now();

                $duration = \Carbon\Carbon::parse($loginTime)->diffAsCarbonInterval($logoutTime);
                $durationString = $duration->format('%i minutes %s seconds');

                ActivityLog::log(
                    $user,
                    'Logged in for ' . $durationString . ' before logging out.',
                    2
                );
            }
        }

        Session::flush();
        Auth::logout();

        return redirect('/');
    }

    public function forgetPassword(Request $request)
    {
        return view('auth.passwords.email');
    }

    public function loginAs($role)
    {
        $roleMap = [
            'admin'    => '1',
            'user'     => '2',
            'manager1' => '3',
            'manager2' => '4',
            'teamlead' => '5',
        ];

        if (!array_key_exists($role, $roleMap)) {
            abort(404);
        }

        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }

        $latestLogin = User_login::where('user_id', $user->id)
                                ->orderBy('id', 'desc')
                                ->first();

        if ($latestLogin) {
            $loginTime = $latestLogin->created_at;
            $logoutTime = now();

            $duration = \Carbon\Carbon::parse($loginTime)->diffAsCarbonInterval($logoutTime);
            $durationString = $duration->format('%i minutes %s seconds');

            ActivityLog::log(
                $user,
                'Logged in for ' . $durationString . ' before logging out.',
                2
            );
        }

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Auth::loginUsingId($user->id);
        request()->session()->regenerate();

        User_login::create([
            'user_id'    => $user->id,
            'login_time' => now(),
        ]);

        session(['acting_role' => $role]);

        if ($role === 'admin') {
            return redirect('organizationdashboard');
        }

        return redirect('organization_dashboard');
    }

    // User closes the browser / tab / window.
    public function browserClosed(Request $request)
    {
        // Retrieve user_id sent from localStorage via FormData
        $userId = $request->input('user_id') 
                ?? session()->get('login_web_' . sha1(\App\Models\User::class)) 
                ?? auth()->id();

        if (!$userId) {
            \Log::warning('Browser closed tracker: No user identifier found.');
            return response()->json(['success' => false], 401);
        }

        $user = User::find($userId);

        if (!$user) {
            \Log::error('Browser closed tracker: User not found for ID: ' . $userId);
            return response()->json(['success' => false], 404);
        }

        $latestLogin = User_login::where('user_id', $user->id)
            ->orderByDesc('id')
            ->first();

        if ($latestLogin) {
            $loginTime = $latestLogin->created_at;
            $logoutTime = now();

            $duration = \Carbon\Carbon::parse($loginTime)->diffAsCarbonInterval($logoutTime);
            $durationString = $duration->format('%i minutes %s seconds');

            $activity = ActivityLog::log(
                $user,
                'Browser closed. User was logged in for ' . $durationString . '.',
                3 // Type 3 requirement
            );

            // Remember which activity row this specific tab created so a
            // same-tab reload can undo just this row (see sessionResume()),
            // without touching another tab's genuine close event.
            $tabToken = $request->input('tab_token');
            if ($tabToken && !empty($activity->id)) {
                \Cache::put('tab_close_' . $tabToken, $activity->id, 20);
            }
        }

        return response()->json(['success' => true]);
    }

    // Undo a browser-close record that was actually just a page refresh /
    // back-forward navigation in the same tab, not a real close. Scoped to
    // the exact tab (via tab_token) so it never touches another tab's
    // genuine close event.
    public function sessionResume(Request $request)
    {
        $userId = $request->input('user_id') ?? auth()->id();
        $tabToken = $request->input('tab_token');

        if (!$userId || !$tabToken) {
            return response()->json(['success' => false], 401);
        }

        $activityId = \Cache::pull('tab_close_' . $tabToken);

        if ($activityId) {
            Activity::where('id', $activityId)
                ->where('user_id', $userId)
                ->where('type', 3)
                ->delete();
        }

        return response()->json(['success' => true]);
    }

}