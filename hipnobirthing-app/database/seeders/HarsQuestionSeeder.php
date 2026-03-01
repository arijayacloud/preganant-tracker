<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HarsQuestion;

class HarsQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            "Perasaan cemas, khawatir, atau firasat buruk",
            "Merasa tegang, gelisah, atau tidak bisa rileks",
            "Merasa takut tanpa alasan jelas",
            "Kesulitan tidur (insomnia)",
            "Sulit berkonsentrasi atau mengingat sesuatu",
            "Perasaan sedih atau kehilangan minat",
            "Ketegangan otot atau nyeri otot",
            "Gangguan sensorik seperti pusing atau penglihatan kabur",
            "Jantung berdebar atau nyeri dada",
            "Sesak napas atau napas terasa pendek",
            "Gangguan pencernaan seperti mual atau perut tidak nyaman",
            "Sering buang air kecil atau keluhan pada sistem kemih",
            "Berkeringat berlebihan, mulut kering, atau pusing",
            "Gelisah atau tidak bisa diam"
        ];

        foreach ($questions as $question) {
            HarsQuestion::create([
                'question' => $question
            ]);
        }
    }
}
