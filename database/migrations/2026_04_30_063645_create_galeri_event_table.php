<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('galeri_event', function (Blueprint $table) {
        $table->id('id_galeri'); // Primary Key
        
        // Pastikan tipe datanya sama dengan id_wisata di tabel data_wisata
        // Kalau di data_wisata pakai integer biasa, ganti jadi $table->integer('id_wisata');
        $table->unsignedBigInteger('id_wisata'); 
        
        $table->string('gambar_poster'); // Buat nyimpen nama file poster
        $table->timestamps(); // Bikin kolom created_at & updated_at otomatis

        // Opsional: Relasi Foreign Key biar data sinkron (kalau wisata dihapus, galeri ikut terhapus)
        // $table->foreign('id_wisata')->references('id_wisata')->on('data_wisata')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_event');
    }
};
