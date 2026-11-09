<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth;

use App\Models\Activity;

class ActivityLog
{
    public static function log($user, $activity, $type)
    {
        if (!$user) {
            return null;
        }

        $userId = is_object($user) ? ($user->id ?? null) : $user;
        if (!$userId) {
            return null;
        }

        return Activity::create([
            'user_id' => $userId,
            'activity' => $activity,
            'type' => $type,
        ]);
    }
}