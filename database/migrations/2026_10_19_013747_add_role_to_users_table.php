<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Menambahkan kolom role dengan nilai awal customer. */
    public function up(): void
    {
        // Daftarkan role agar pencarian berdasarkan hak akses lebih efisien.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->index();
        });
    }

    /** Menghapus kolom role saat migrasi dibatalkan. */
    public function down(): void
    {
        // Hapus indeks sebelum menghapus kolom role.
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn('role');
        });
    }
};
