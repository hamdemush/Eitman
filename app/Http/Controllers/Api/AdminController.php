<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PsychologistProfile;

class AdminController extends Controller
{
    /**
     * Get a list of pending psychologist profiles waiting for approval.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingPsychologists()
    {
        $profiles = PsychologistProfile::where('is_verified', false)
            ->with(['user', 'specialty'])
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $profiles
        ], 200);
    }

    /**
     * Approve a psychologist application.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvePsychologist($id)
    {
        $profile = PsychologistProfile::find($id);

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.psychologist_not_found')
            ], 404);
        }

        $profile->is_verified = true;
        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => __('messages.psychologist_approved'),
            'data' => $profile->load('user')
        ], 200);
    }

    /**
     * Reject a psychologist application.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectPsychologist($id)
    {
        $profile = PsychologistProfile::find($id);

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.psychologist_not_found')
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('messages.psychologist_rejected')
        ], 200);
    }

    /**
     * Get all registered users with option to filter by role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listUsers(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);
    }

    /**
     * Toggle or update user account status (active/inactive).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleUserStatus(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.user_not_found')
            ], 404);
        }

        $user->is_active = $request->is_active;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => __('messages.user_status_updated'),
            'data' => $user
        ], 200);
    }
}