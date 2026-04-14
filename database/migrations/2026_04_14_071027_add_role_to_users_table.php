<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Role sudah ditambahkan langsung di create_users_table
        // File ini dibiarkan kosong agar tidak konflik
    }

    public function down(): void
    {
        //
    }
};