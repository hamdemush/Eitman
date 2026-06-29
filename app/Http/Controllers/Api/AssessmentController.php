<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    /**
     * Submit a self-assessment and process the score to diagnose condition level.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitAssessment(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|min:0|max:5', // درجات الإجابة لكل سؤال من 0 إلى 5
        ]);

        $totalScore = array_sum($request->answers);
        $maxPossibleScore = count($request->answers) * 5;
        
        $percentage = ($maxPossibleScore > 0) ? ($totalScore / $maxPossibleScore) * 100 : 0;

        if ($percentage <= 30) {
            $resultLevel = 'Mild (خفيف)';
            $recommendation = 'حالتك مستقرة، ننصحك بممارسة تمارين الاسترخاء والقراءة العامة عن الصحة النفسية.';
        } elseif ($percentage <= 70) {
            $resultLevel = 'Moderate (متوسط)';
            $recommendation = 'لديك بعض المؤشرات المتوسطة، يفضل حجز جلسة استشارية مع أحد الأطباء المتخصصين في الاستشارات العامة لمساعدتك.';
        } else {
            $resultLevel = 'Severe (شديد)';
            $recommendation = 'المؤشرات مرتفعة وتستدعي الاهتمام، نوصيك بشدة وبشكل عاجل بحجز موعد مع طبيب نفسي مختص لبدء خطة علاجية مخصصة.';
        }

        $assessment = Assessment::create([
            'patient_id' => $request->user()->id,
            'score' => $totalScore,
            'result_level' => $resultLevel,
            'recommendation' => $recommendation
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Assessment processed and saved successfully.',
            'analysis' => [
                'score' => $totalScore,
                'percentage' => round($percentage, 2) . '%',
                'level' => $resultLevel,
                'recommendation' => $recommendation
            ],
            'data' => $assessment
        ], 200);
    }

    /**
     * Display history of self-assessments for the authenticated patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function history(Request $request)
    {
        $history = Assessment::where('patient_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $history
        ], 200);
    }
}