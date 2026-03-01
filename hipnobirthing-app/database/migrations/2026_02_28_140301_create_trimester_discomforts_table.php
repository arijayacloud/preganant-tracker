<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trimester_discomforts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('trimester'); // 1,2,3
            $table->enum('category', ['fisik', 'emosional']);
            $table->string('discomfort');
            $table->text('solution');
            $table->text('notes')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimester_discomforts');
    }
};
