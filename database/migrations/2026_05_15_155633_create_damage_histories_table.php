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
        Schema::create('damage_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_id')
                ->constrained()
                ->cascadeOnDelete();
            
            $table->foreignId('reported_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('damage_date');

            $table->text('description');

            $table->enum('severity', [
                'low',
                'medium',
                'high',
                'critical'
            ])->default('low');

            $table->enum('repair_status', [
                'reported',
                'checking',
                'repairing',
                'fixed',
                'unrepairable'
            ])->default('reported');
            
            $table->text('photo')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_histories');
    }
};
