<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the specializations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $specializations = Specialization::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $specializations
        ], 200);
    }

    /**
     * Store a newly created specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specializations,name|max:255',
            'description' => 'nullable|string'
        ]);

        $specialization = Specialization::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Specialization created successfully.',
            'data' => $specialization
        ], 21);
    }

    /**
     * Display the specified specialization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $specialization = Specialization::find($id);

        if (!$specialization) {
            return response()->json([
                'status' => 'error',
                'message' => 'Specialization not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $specialization
        ], 200);
    }

    /**
     * Update the specified specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $specialization = Specialization::find($id);

        if (!$specialization) {
            return response()->json([
                'status' => 'error',
                'message' => 'Specialization not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:specializations,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $specialization->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Specialization updated successfully.',
            'data' => $specialization
        ], 200);
    }

    /**
     * Remove the specified specialization from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $specialization = Specialization::find($id);

        if (!$specialization) {
            return response()->json([
                'status' => 'error',
                'message' => 'Specialization not found.'
            ], 404);
        }

        $specialization->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Specialization deleted successfully.'
        ], 200);
    }
}