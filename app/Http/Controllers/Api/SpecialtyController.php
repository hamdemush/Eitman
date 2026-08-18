<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the specialties.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $specialties = Specialty::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $specialties
        ], 200);
    }

    /**
     * Store a newly created specialty in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name|max:255',
            'description' => 'nullable|string'
        ]);

        $specialty = Specialty::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.specialty_created'),
            'data' => $specialty
        ], 201);
    }

    /**
     * Display the specified specialty.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $specialty = Specialty::find($id);

        if (!$specialty) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.specialty_not_found')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $specialty
        ], 200);
    }

    /**
     * Update the specified specialty in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $specialty = Specialty::find($id);

        if (!$specialty) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.specialty_not_found')
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $specialty->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.specialty_updated'),
            'data' => $specialty
        ], 200);
    }

    /**
     * Remove the specified specialty from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $specialty = Specialty::find($id);

        if (!$specialty) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.specialty_not_found')
            ], 404);
        }

        $specialty->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('messages.specialty_deleted')
        ], 200);
    }
}