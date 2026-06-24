<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->longText('qr_code')->nullable(); // Armazena a imagem base64
            $table->string('qr_code_hash')->nullable()->unique(); // Link único do QR
        });
    }

    public function down(): void
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->dropColumn(['qr_code', 'qr_code_hash']);
        });
    }
};