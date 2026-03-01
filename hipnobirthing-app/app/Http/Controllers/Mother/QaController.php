<?php

namespace App\Http\Controllers\Mother;

use App\Http\Controllers\Controller;
use App\Models\Qa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QaController extends Controller
{
    public function index()
    {
        $qas = Qa::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('mother.qa', compact('qas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|min:5|max:1000'
        ]);

        Qa::create([
            'user_id' => Auth::id(),
            'question' => $request->question
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pertanyaan berhasil dikirim. Silakan menunggu jawaban dari bidan.');
    }
}