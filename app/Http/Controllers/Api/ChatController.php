<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Appointment;

class ChatController extends Controller
{
    /**
     * Fetch all messages for a specific session/appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $appointmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchMessages(Request $request, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.chat_not_found')
            ], 404);
        }

        $userId = $request->user()->id;
        if ($appointment->patient_id !== $userId && $appointment->psychologist_id !== $userId) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.chat_unauthorized')
            ], 403);
        }

        $messages = Message::where('appointment_id', $appointmentId)
            ->with('sender:id,name,role')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ], 200);
    }

    /**
     * Send a text message or file attachment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $appointmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request, $appointmentId)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        if (!$request->filled('message') && !$request->hasFile('file')) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.message_required')
            ], 422);
        }

        $appointment = Appointment::find($appointmentId);
        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.chat_not_found')
            ], 404);
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat_files', 'public');
        }

        $message = Message::create([
            'appointment_id' => $appointmentId,
            'sender_id' => $request->user()->id,
            'message' => $request->message,
            'file_path' => $filePath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.message_sent'),
            'data' => $message->load('sender:id,name,role')
        ], 201);
    }
}