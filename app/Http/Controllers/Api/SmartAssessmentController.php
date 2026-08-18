<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Services\AiAssessmentService;

class SmartAssessmentController extends Controller
{
    protected $aiService;

    public function __construct(AiAssessmentService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Submit user answers for psychological assessment and generate AI results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        $user = $request->user();

        $aiResult = $this->aiService->analyzeAnswers($request->answers);

        $assessment = Assessment::create([
            'user_id' => $user->id,
            'answers' => $request->answers,
            'summary' => $aiResult['summary'] ?? null,
            'recommended_specialty_id' => $aiResult['recommended_specialty_id'] ?? null,
            'score' => $aiResult['score'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.assessment_success'),
            'data' => $assessment->load('recommendedSpecialty')
        ], 201);
    }

    /**
     * Get the latest assessment for the logged-in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showLatest(Request $request)
    {
        $user = $request->user();

        $assessment = Assessment::where('user_id', $user->id)
            ->with('recommendedSpecialty')
            ->latest()
            ->first();

        if (!$assessment) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.not_found')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $assessment
        ], 200);
    }
}