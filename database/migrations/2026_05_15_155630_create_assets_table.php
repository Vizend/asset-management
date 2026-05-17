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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete()
                ->restrictOnDelete();
            
            $table->string('asset_code')->unique();
            $table->string('name');

            $table->string('brand')->nullable();
            $table->string('model')->nullable();

            $table->string('serial_no')->nullable()->unique();

            $table->date('purchase_date')->nullable();

            $table->decimal('purchase_price', 15, 2)->nullable();

            $table->enum('condition', [
                'good',
                'minor_damage',
                'broken'
            ])->default('good');

            $table->enum('status', [
                'available',
                'borrowed',
                'maintenance',
                'retired'
            ])->default('available');

            $table->string('location')->nullable();

            $table->text('qr_code')->nullable();
            $table->text('photo')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_code');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
