<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsychologistProfile;
use Illuminate\Support\Facades\Storage;

class PsychologistProfileController extends Controller
{
    /**
     * Display the profile of the current authenticated psychologist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCurrent(Request $request)
    {
        $user = $request->user();
        
        $profile = PsychologistProfile::where('user_id', $user->id)
            ->with(['specialty', 'user'])
            ->first();

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.profile_not_found')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ], 200);
    }

    /**
     * Create or update the psychologist profile data along with CV attachment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOrUpdate(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'bio' => 'required|string|min:20',
            'experience_years' => 'required|integer|min:0',
            'cv_attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $profile = PsychologistProfile::firstOrNew(['user_id' => $user->id]);

        if ($request->hasFile('cv_attachment')) {
            if ($profile->cv_attachment && Storage::disk('public')->exists($profile->cv_attachment)) {
                Storage::disk('public')->delete($profile->cv_attachment);
            }
            
            $path = $request->file('cv_attachment')->store('cvs', 'public');
            $profile->cv_attachment = $path;
        }

        $profile->specialty_id = $request->specialty_id;
        $profile->bio = $request->bio;
        $profile->experience_years = $request->experience_years;
        $profile->is_verified = false;
        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => __('messages.profile_saved'),
            'data' => $profile->load('specialty')
        ], 200);
    }
}