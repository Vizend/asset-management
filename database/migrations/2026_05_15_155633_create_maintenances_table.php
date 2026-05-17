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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->foreignId('performed_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            
            $table->date('maintenance_date');

            $table->date('next_maintenance')->nullable();

            $table->decimal('cost', 15, 2)->nullable();

            $table->string('vendor')->nullable();

            $table->text('description')->nullable();

            $table->enum('status', [
                'scheduled',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('scheduled');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
