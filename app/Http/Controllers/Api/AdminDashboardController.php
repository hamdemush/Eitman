<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsychologistProfile;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Admin dashboard data fetched successfully.',
        ]);
    }
}