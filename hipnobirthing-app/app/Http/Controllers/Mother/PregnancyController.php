<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\PregnancyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PregnancyController extends Controller
{
    /**
     * Tampilkan halaman pregnancy + data jika ada
     */
    public function index()
    {
        $pregnancy = PregnancyProfile::where('user_id', Auth::id())->first();

        // Jika ada data, update otomatis usia kehamilan
        if ($pregnancy) {
            $this->recalculateGestationalAge($pregnancy);
        }

        return view('mother.pregnancy', compact('pregnancy'));
    }

    /**
     * Simpan atau update data kehamilan
     */
    public function store(Request $request)
    {
        $request->validate([
            'hpht' => 'required|date|before_or_equal:today',
            'cycle_length' => 'required|integer|min:21|max:35'
        ]);

        $hpht = Carbon::parse($request->hpht);
        $today = Carbon::now();

        // 🔹 Hitung usia kehamilan
        $totalDays = $hpht->diffInDays($today);
        $weeks = floor($totalDays / 7);

        // 🔹 Koreksi HPL berdasarkan siklus
        // Standar 28 hari → 280 hari
        // Jika siklus > 28 → tambahkan selisih
        $cycleAdjustment = $request->cycle_length - 28;
        $edd = $hpht->copy()->addDays(280 + $cycleAdjustment);

        PregnancyProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'hpht' => $request->hpht,
                'cycle_length' => $request->cycle_length,
                'estimated_due_date' => $edd,
                'gestational_age_weeks' => $weeks
            ]
        );

        return redirect()
            ->route('pregnancy.index')
            ->with('success', 'Data kehamilan berhasil disimpan / diperbarui');
    }

    /**
     * Recalculate otomatis usia kehamilan
     */
    private function recalculateGestationalAge($pregnancy)
    {
        $hpht = Carbon::parse($pregnancy->hpht);
        $today = Carbon::now();

        $totalDays = $hpht->diffInDays($today);
        $weeks = floor($totalDays / 7);

        if ($pregnancy->gestational_age_weeks != $weeks) {
            $pregnancy->update([
                'gestational_age_weeks' => $weeks
            ]);
        }
    }
}