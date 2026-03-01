<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\HarsResult;
use App\Models\RelaxationSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RelaxationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $latestHars = HarsResult::where('user_id', $user->id)
            ->latest()
            ->first();

        $level = $latestHars->anxiety_level ?? 'ringan';

        // 🔊 Audio berdasarkan level kecemasan
        $audios = $this->getAudioByLevel($level);
        $tutorialVideos = $this->getTutorialVideos();

        // ✅ Total semua sesi
        $totalSessions = RelaxationSession::where('user_id', $user->id)->count();

        // ✅ Latihan minggu ini
        $thisWeek = RelaxationSession::where('user_id', $user->id)
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();

        // ✅ Weekly progress (7 hari terakhir)
        $weeklyData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i);

            $count = RelaxationSession::where('user_id', $user->id)
                ->whereDate('created_at', $date)
                ->count();

            $weeklyData[] = [
                'date' => $date->format('d M'),
                'count' => $count
            ];
        }

        // 🧠 Insight otomatis
        $recommendation = null;

        if ($latestHars) {

            if ($level == 'tinggi' && $thisWeek < 3) {
                $recommendation = "Kecemasan masih tinggi dan latihan belum rutin. Coba minimal 1x per hari.";
            } elseif ($thisWeek >= 3) {
                $recommendation = "Bagus! Latihan rutin membantu menjaga kestabilan emosi 🌸";
            } else {
                $recommendation = "Latihan sudah berjalan, tingkatkan konsistensi untuk hasil optimal.";
            }
        }

        // 🔔 Reminder jika 3 hari tidak latihan
        $lastSession = RelaxationSession::where('user_id', $user->id)
            ->latest()
            ->first();

        $showReminder = false;

        if (!$lastSession || $lastSession->created_at->diffInDays(now()) >= 3) {
            $showReminder = true;
        }

        return view('mother.relaxation', compact(
            'latestHars',
            'audios',
            'tutorialVideos',
            'weeklyData',
            'totalSessions',
            'thisWeek',
            'recommendation',
            'showReminder'
        ));
    }

    private function getAudioByLevel($level)
    {
        if ($level == 'ringan') {
            return [
                [
                    'title' => 'Pernapasan Dasar 5 Menit',
                    'type' => 'guided',
                    'duration' => 5,
                    'url'  => 'https://www.youtube.com/embed/SEfs5TJZ6Nk'
                ],
                [
                    'title' => 'Afirmasi Positif Ibu Hamil',
                    'type' => 'affirmation',
                    'duration' => 7,
                    'url'  => 'https://www.youtube.com/embed/ZToicYcHIOU'
                ],
            ];
        }

        if ($level == 'sedang') {
            return [
                [
                    'title' => 'Relaksasi Hypnobirthing 10 Menit',
                    'type' => 'guided',
                    'duration' => 10,
                    'url'  => 'https://www.youtube.com/embed/1vx8iUvfyCY'
                ],
                [
                    'title' => 'Afirmasi Menjelang Persalinan',
                    'type' => 'affirmation',
                    'duration' => 8,
                    'url'  => 'https://www.youtube.com/embed/9xwazD5SyVg'
                ],
            ];
        }

        // tinggi / berat
        return [
            [
                'title' => 'Deep Relaxation 20 Menit',
                'type' => 'guided',
                'duration' => 20,
                'url'  => 'https://www.youtube.com/embed/lFcSrYw-ARY'
            ],
            [
                'title' => 'Afirmasi Tenang & Aman',
                'type' => 'affirmation',
                'duration' => 10,
                'url'  => 'https://www.youtube.com/embed/4EaMJOo1jks'
            ],
        ];
    }

    public function storeSession(Request $request)
    {
        RelaxationSession::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'type' => $request->type,
            'duration' => $request->duration ?? 10,
        ]);

        return back()->with('success', 'Latihan berhasil dicatat 🎉');
    }

    private function getTutorialVideos()
    {
        return [
            [
                'title' => 'Teknik Dasar Hypnobirthing',
                'duration' => 15,
                'url' => 'https://www.youtube.com/embed/59zX2mpQgCQ'
            ],
            [
                'title' => 'Latihan Pernapasan untuk Persalinan',
                'duration' => 12,
                'url' => 'https://www.youtube.com/embed/1vx8iUvfyCY'
            ],
            [
                'title' => 'Relaksasi Mendalam Menjelang Persalinan',
                'duration' => 20,
                'url' => 'https://www.youtube.com/embed/lFcSrYw-ARY'
            ],
        ];
    }
}
