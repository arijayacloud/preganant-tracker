<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\TrimesterDiscomfort;
use App\Models\PregnancyProfile;
use Illuminate\Support\Facades\Auth;

class TrimesterDiscomfortController extends Controller
{
    public function index($trimester = 1)
    {
        $user = Auth::user();

        $pregnancy = PregnancyProfile::where('user_id', $user->id)->first();

        // Gunakan trimester dari tab
        $currentTrimester = in_array($trimester, [1, 2, 3]) ? $trimester : 1;

        $week = optional($pregnancy)->week ?? 1;

        $discomforts = TrimesterDiscomfort::where('trimester', $currentTrimester)
            ->orderBy('category')
            ->get();

        $fisik = $discomforts->where('category', 'fisik');
        $emosional = $discomforts->where('category', 'emosional');

        $latestHars = $user->latestHars;
        $harsLevel = optional($latestHars)->anxiety_level;

        $showRecommendation = in_array($harsLevel, ['sedang', 'berat']);

        return view('mother.panduan', [
            'trimester' => $currentTrimester,
            'week' => $week,
            'fisik' => $fisik,
            'emosional' => $emosional,
            'harsLevel' => $harsLevel,
            'showRecommendation' => $showRecommendation,
        ]);
    }
}
