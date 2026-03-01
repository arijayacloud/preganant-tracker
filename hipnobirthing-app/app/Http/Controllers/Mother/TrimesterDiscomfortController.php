<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\TrimesterDiscomfort;
use App\Models\PregnancyProfile;
use Illuminate\Support\Facades\Auth;

class TrimesterDiscomfortController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ Ambil Profil Kehamilan
        |--------------------------------------------------------------------------
        */
        $pregnancy = PregnancyProfile::where('user_id', $user->id)->first();

        $currentTrimester = optional($pregnancy)->trimester ?? 1;
        $week = optional($pregnancy)->week ?? 1; // ✅ TAMBAHKAN INI

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ Ambil Data Ketidaknyamanan Trimester
        |--------------------------------------------------------------------------
        */
        $discomforts = TrimesterDiscomfort::where('trimester', $currentTrimester)
            ->orderBy('category')
            ->get();

        $fisik = $discomforts->where('category', 'fisik');
        $emosional = $discomforts->where('category', 'emosional');

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ Ambil HARS Terakhir
        |--------------------------------------------------------------------------
        */
        $latestHars = $user->latestHars;
        $harsLevel = optional($latestHars)->anxiety_level;

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ Rekomendasi Jika Kecemasan Sedang/Berat
        |--------------------------------------------------------------------------
        */
        $showRecommendation = in_array($harsLevel, ['sedang', 'berat']);

        /*
        |--------------------------------------------------------------------------
        | 5️⃣ Return View
        |--------------------------------------------------------------------------
        */
        return view('mother.panduan', [
            'trimester' => $currentTrimester,
            'week' => $week, // ✅ KIRIM KE VIEW
            'fisik' => $fisik,
            'emosional' => $emosional,
            'harsLevel' => $harsLevel,
            'showRecommendation' => $showRecommendation,
        ]);
    }
}