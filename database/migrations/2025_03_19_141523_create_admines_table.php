<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('admines', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->timestamps();

        // });
        
        DB::statement('CREATE TABLE admines() INHERITS(users)');
        DB::statement('ALTER TABLE admines ADD CONSTRAINT admins_id_unique PRIMARY KEY (id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admines');
    }
};
