<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\PregnancyProfile;
use App\Models\HarsResult;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pregnancy = PregnancyProfile::where('user_id', $user->id)->first();
        $latestHars = HarsResult::where('user_id', $user->id)->latest()->first();

        return view('mother.dashboard', compact('pregnancy', 'latestHars'));
    }
}