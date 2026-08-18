<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Availability;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments for the authenticated user (Patient or Psychologist).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'psychologist') {
            $appointments = Appointment::where('psychologist_id', $user->id)
                ->with(['patient', 'availability'])
                ->latest()
                ->get();
        } else {
            $appointments = Appointment::where('patient_id', $user->id)
                ->with(['psychologist.psychologistProfile', 'availability'])
                ->latest()
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ], 200);
    }

    /**
     * Book a new appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'psychologist_id' => 'required|exists:users,id',
            'availability_id' => 'required|exists:availabilities,id',
            'notes' => 'nullable|string'
        ]);

        $availability = Availability::find($request->availability_id);

        if ($availability->is_booked) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.already_booked')
            ], 422);
        }

        $appointment = Appointment::create([
            'patient_id' => $request->user()->id,
            'psychologist_id' => $request->psychologist_id,
            'availability_id' => $request->availability_id,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        $availability->update(['is_booked' => true]);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.appointment_booked'),
            'data' => $appointment->load(['psychologist', 'availability'])
        ], 201);
    }

    /**
     * Display the specified appointment details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $appointment = Appointment::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('patient_id', $user->id)
                      ->orWhere('psychologist_id', $user->id);
            })
            ->with(['patient', 'psychologist.psychologistProfile', 'availability'])
            ->first();

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.appointment_not_found')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $appointment
        ], 200);
    }

    /**
     * Update appointment status (approve, cancel, or complete).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,cancelled,completed'
        ]);

        $user = $request->user();

        $appointment = Appointment::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('patient_id', $user->id)
                      ->orWhere('psychologist_id', $user->id);
            })
            ->first();

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.appointment_not_found')
            ], 404);
        }

        $appointment->status = $request->status;
        $appointment->save();

        if ($request->status === 'cancelled' && $appointment->availability) {
            $appointment->availability->update(['is_booked' => false]);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('messages.status_updated'),
            'data' => $appointment
        ], 200);
    }
}