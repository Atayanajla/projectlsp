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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('namaLengkap')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('imgProfile')->nullable();
            $table->string('alamatKTP')->nullable();
            $table->string('alamatSaatIni')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('noHp')->nullable();
            $table->string('noTelpon')->nullable();
            $table->enum('kewarganegaraan', ["WNI Asli", "WNI Keturunan", "WNA"])->nullable();
            $table->string("asalWNA")->nullable();
            $table->string("tgl_lahir")->nullable();
            $table->string("tmp_lahir")->nullable();
            $table->enum("jk", ["pria", "wanita"])->nullable();
            $table->enum("statusMenikah", ["Belum Menikah", "Menikah", "Lain-lain (janda/duda)"])->nullable();
            $table->enum("agama", ["Islam", "Katolik", "Kristen", "Hindu", "Budha", "lain-lain"])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');

  }
};