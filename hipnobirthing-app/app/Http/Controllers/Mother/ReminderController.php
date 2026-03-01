<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\AncReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PregnancyProfile;

class ReminderController extends Controller
{
    /**
     * List semua reminder ANC ibu
     */
    public function index()
    {
        $reminders = AncReminder::where('user_id', Auth::id())
            ->orderBy('appointment_date')
            ->get();

        $nextReminder = AncReminder::where('user_id', Auth::id())
            ->whereDate('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->first();

        $pregnancy = PregnancyProfile::where('user_id', Auth::id())->first();

        return view('mother.reminder', compact(
            'reminders',
            'nextReminder',
            'pregnancy'
        ));
    }

    /**
     * Simpan reminder baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255'
        ]);

        AncReminder::create([
            'user_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'location' => $request->location
        ]);

        return redirect()
            ->back()
            ->with('success', 'Reminder ANC berhasil ditambahkan.');
    }

    /**
     * Update reminder
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'location' => 'required|string|max:255'
        ]);

        $reminder = AncReminder::where('user_id', Auth::id())
            ->findOrFail($id);

        $reminder->update([
            'appointment_date' => $request->appointment_date,
            'location' => $request->location
        ]);

        return back()->with('success', 'Reminder berhasil diperbarui.');
    }

    /**
     * Hapus reminder
     */
    public function destroy($id)
    {
        $reminder = AncReminder::where('user_id', Auth::id())
            ->findOrFail($id);

        $reminder->delete();

        return back()->with('success', 'Reminder berhasil dihapus.');
    }
}
