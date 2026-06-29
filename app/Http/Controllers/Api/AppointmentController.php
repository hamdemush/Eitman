<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display appointments for the current authenticated patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientAppointments(Request $request)
    {
        $appointments = Appointment::where('patient_id', $request->user()->id)
            ->with('psychologist.user')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ], 200);
    }

    /**
     * Display appointments for the current authenticated psychologist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function psychologistAppointments(Request $request)
    {
        $appointments = Appointment::where('psychologist_id', $request->user()->id)
            ->with('patient')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ], 200);
    }

    /**
     * Store a newly booked appointment by a patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'psychologist_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::create([
            'patient_id' => $request->user()->id,
            'psychologist_id' => $request->psychologist_id,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully. Waiting for doctor approval.',
            'data' => $appointment
        ], 201);
    }

    /**
     * Update the status of an appointment (Approved / Cancelled / Completed).
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

        $appointment = Appointment::where('id', $id)
            ->where('psychologist_id', $request->user()->id)
            ->first();

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found or unauthorized access.'
            ], 404);
        }

        $appointment->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment status updated to ' . $request->status . ' successfully.'
        ], 200);
    }
}