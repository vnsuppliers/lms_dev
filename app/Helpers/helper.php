<?php

use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

if (!function_exists('hasPermission')) {
    function hasPermission($permissionId)
    {
        if (!Auth::check()) {
            return false;
        }

        // Check if we are "Acting As" a specific role
        if (session()->has('acting_role')) {
            $actingRoleName = session('acting_role');
            
            // Fetch the role record by name/slug
            $role = Roles::where('role', $actingRoleName)->first();
            
            if ($role) {
                $permissions = json_decode($role->permission_id, true) ?? [];
                return in_array($permissionId, $permissions);
            }
        }

        //  Fallback to normal logged-in user permissions
        $userTypes = json_decode(Auth::user()->user_type, true) ?? [];
        $roles = Roles::whereIn('id', $userTypes)->get();
        
        foreach ($roles as $role) {
            $permissions = json_decode($role->permission_id, true) ?? [];
            if (in_array($permissionId, $permissions)) {
                return true;
            }
        }

        return false;
    }
}

 function getUserImage($name,$last_name='')
    {
       $nameForAvatar = !empty($last_name) 
                ? $name . ' ' . $last_name 
                : strtoupper(substr($name, 0, 1)); // Use first letter of first name
               // dd('hi');
            return Avatar::create($nameForAvatar)->toBase64();
        
    }