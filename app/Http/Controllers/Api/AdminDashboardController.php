<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsychologistProfile;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of pending psychologist profiles for verification.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingPsychologists()
    {
        $pending = PsychologistProfile::where('is_verified', false)
            ->with('user')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $pending
        ], 200);
    }

    /**
     * Verify and approve a specific psychologist profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyPsychologist(Request $request, $id)
    {
        $profile = PsychologistProfile::find($id);

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Psychologist profile not found.'
            ], 404);
        }

        $profile->update([
            'is_verified' => true
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Psychologist profile has been successfully verified and activated.'
        ], 200);
    }
}