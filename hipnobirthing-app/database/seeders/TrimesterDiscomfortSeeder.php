<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrimesterDiscomfort;

class TrimesterDiscomfortSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            /*
        =====================================
        TRIMESTER 1 (14 DATA)
        =====================================
        */

            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Mual dan muntah', 'solution' => 'Makan sedikit tetapi sering dan hindari makanan berbau tajam.', 'notes' => 'Jika muntah berlebihan hingga tidak bisa makan/minum segera periksa.', 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Lemas dan mudah lelah', 'solution' => 'Istirahat cukup dan konsumsi makanan bergizi seimbang.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Sembelit', 'solution' => 'Perbanyak konsumsi serat dan air putih.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Sering buang air kecil', 'solution' => 'Tetap cukup minum namun kurangi sebelum tidur.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Payudara terasa nyeri', 'solution' => 'Gunakan bra yang menopang dengan baik.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Pusing', 'solution' => 'Bangun secara perlahan dari posisi duduk atau tidur.', 'notes' => 'Jika pusing berat disertai pandangan kabur segera periksa.', 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Ngidam', 'solution' => 'Penuhi keinginan dalam batas wajar dan tetap jaga gizi.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'fisik', 'discomfort' => 'Air liur berlebihan', 'solution' => 'Sering berkumur dan minum air putih.', 'notes' => null, 'reference' => 'Buku KIA'],

            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Mood swing', 'solution' => 'Latihan relaksasi dan komunikasi dengan pasangan.', 'notes' => 'Jika sedih berkepanjangan konsultasikan ke tenaga kesehatan.', 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Cemas terhadap kehamilan', 'solution' => 'Lakukan pemeriksaan rutin dan cari informasi terpercaya.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Sensitif dan mudah menangis', 'solution' => 'Beristirahat dan berbagi cerita dengan orang terdekat.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Takut keguguran', 'solution' => 'Hindari aktivitas berat dan kontrol rutin ke bidan/dokter.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Sulit berkonsentrasi', 'solution' => 'Kurangi stres dan buat jadwal aktivitas ringan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 1, 'category' => 'emosional', 'discomfort' => 'Perubahan nafsu makan karena emosi', 'solution' => 'Tetap atur pola makan terjadwal.', 'notes' => null, 'reference' => 'Buku KIA'],

            /*
        =====================================
        TRIMESTER 2 (13 DATA)
        =====================================
        */

            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Nyeri punggung', 'solution' => 'Gunakan bantal penyangga dan hindari berdiri terlalu lama.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Kram kaki', 'solution' => 'Lakukan peregangan ringan sebelum tidur.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Heartburn (asam lambung)', 'solution' => 'Hindari makanan pedas dan makan porsi kecil.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Gatal pada perut', 'solution' => 'Gunakan pelembap dan hindari menggaruk berlebihan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Hidung tersumbat', 'solution' => 'Gunakan humidifier dan perbanyak minum air.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Keputihan meningkat', 'solution' => 'Jaga kebersihan area genital dan gunakan pakaian dalam katun.', 'notes' => 'Jika berbau dan gatal segera periksa.', 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Gusi mudah berdarah', 'solution' => 'Gunakan sikat gigi lembut dan jaga kebersihan mulut.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'fisik', 'discomfort' => 'Stretch mark', 'solution' => 'Gunakan pelembap khusus ibu hamil.', 'notes' => null, 'reference' => 'Buku KIA'],

            ['trimester' => 2, 'category' => 'emosional', 'discomfort' => 'Cemas terhadap kondisi janin', 'solution' => 'Kontrol rutin dan dengarkan detak jantung janin saat ANC.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'emosional', 'discomfort' => 'Perubahan citra tubuh', 'solution' => 'Berpikir positif dan dukungan pasangan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'emosional', 'discomfort' => 'Merasa kurang percaya diri', 'solution' => 'Fokus pada kesehatan ibu dan bayi.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'emosional', 'discomfort' => 'Lebih mudah tersinggung', 'solution' => 'Latihan komunikasi dan relaksasi.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 2, 'category' => 'emosional', 'discomfort' => 'Takut perubahan hubungan suami istri', 'solution' => 'Diskusikan dengan pasangan secara terbuka.', 'notes' => null, 'reference' => 'Buku KIA'],

            /*
        =====================================
        TRIMESTER 3 (13 DATA)
        =====================================
        */

            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Sesak napas', 'solution' => 'Tidur miring ke kiri dan hindari aktivitas berat.', 'notes' => 'Jika sesak berat segera ke fasilitas kesehatan.', 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Kaki bengkak', 'solution' => 'Istirahat dengan posisi kaki lebih tinggi.', 'notes' => 'Jika disertai sakit kepala segera periksa.', 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Sulit tidur', 'solution' => 'Relaksasi sebelum tidur dan atur posisi nyaman.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Sering kontraksi palsu (Braxton Hicks)', 'solution' => 'Istirahat dan ubah posisi tubuh.', 'notes' => 'Jika kontraksi teratur dan nyeri segera periksa.', 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Nyeri panggul', 'solution' => 'Gunakan sabuk penyangga kehamilan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Sering buang air kecil', 'solution' => 'Kurangi minum sebelum tidur namun tetap cukup cairan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'fisik', 'discomfort' => 'Wasir', 'solution' => 'Perbanyak serat dan hindari mengejan berlebihan.', 'notes' => null, 'reference' => 'Buku KIA'],

            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Cemas menjelang persalinan', 'solution' => 'Latihan pernapasan dan afirmasi positif.', 'notes' => 'Diskusikan rencana persalinan dengan bidan.', 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Takut rasa sakit persalinan', 'solution' => 'Ikuti kelas persiapan persalinan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Tidak sabar menunggu kelahiran', 'solution' => 'Alihkan perhatian dengan aktivitas positif.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Khawatir menjadi ibu', 'solution' => 'Cari dukungan keluarga dan edukasi parenting.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Perasaan campur aduk menjelang melahirkan', 'solution' => 'Berbagi cerita dengan tenaga kesehatan.', 'notes' => null, 'reference' => 'Buku KIA'],
            ['trimester' => 3, 'category' => 'emosional', 'discomfort' => 'Lebih sensitif secara emosional', 'solution' => 'Istirahat cukup dan kelola stres.', 'notes' => null, 'reference' => 'Buku KIA'],
        ];

        foreach ($data as $item) {
            TrimesterDiscomfort::create($item);
        }
    }
}
