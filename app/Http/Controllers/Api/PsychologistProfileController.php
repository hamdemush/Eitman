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
            ->with('specializations')
            ->first();

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Psychologist profile not found. Please create one.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ], 200);
    }

    /**
     * Create or update the psychologist profile data along with certificates.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOrUpdate(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'bio' => 'required|string|min:20',
            'experience_years' => 'required|integer|min:0',
            'license_number' => 'required|string|max:100',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // حد أقصى 10 ميجابايت
            'specializations' => 'required|array',
            'specializations.*' => 'exists:specializations,id'
        ]);

        $profile = PsychologistProfile::firstOrNew(['user_id' => $user->id]);

        if ($request->hasFile('certificate_file')) {
            if ($profile->certificate_path) {
                Storage::disk('public')->delete($profile->certificate_path);
            }
            
            $path = $request->file('certificate_file')->store('certificates', 'public');
            $profile->certificate_path = $path;
        }

        $profile->bio = $request->bio;
        $profile->experience_years = $request->experience_years;
        $profile->license_number = $request->license_number;
        $profile->is_verified = false; 
        $profile->save();
        $profile->specializations()->sync($request->specializations);

        return response()->json([
            'status' => 'success',
            'message' => 'Psychologist profile saved successfully and pending administrative review.',
            'data' => $profile->load('specializations')
        ], 200);
    }
}