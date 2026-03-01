<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\HarsQuestion;
use App\Models\HarsResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HarsController extends Controller
{
    /**
     * Tampilkan halaman kuesioner HARS
     */
    public function index()
    {
        $questions = HarsQuestion::orderBy('id')->get();

        $history = HarsResult::where('user_id', Auth::id())
            ->latest()
            ->take(6)
            ->get()
            ->reverse();

        return view('mother.hars', compact('questions', 'history'));
    }

    /**
     * Simpan hasil kuesioner HARS
     */
    public function store(Request $request)
    {
        $request->validate([
            'score' => 'required|array',
            'score.*' => 'required|integer|min:0|max:4',
        ]);

        $total = array_sum($request->score);

        if ($total <= 17) {
            $level = 'ringan';
        } elseif ($total <= 24) {
            $level = 'sedang';
        } else {
            $level = 'berat';
        }

        HarsResult::create([
            'user_id' => Auth::id(),
            'total_score' => $total,
            'anxiety_level' => $level
        ]);

        return redirect()
            ->route('mother.hars') // lebih baik balik ke halaman HARS
            ->with('success', 'Hasil skrining HARS berhasil disimpan.');
    }

    /**
     * (Optional) Lihat riwayat hasil HARS
     */
    public function history()
    {
        $results = HarsResult::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('mother.hars-history', compact('results'));
    }
}
