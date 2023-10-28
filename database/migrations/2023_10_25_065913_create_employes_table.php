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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->char('first_name');
            $table->char('last_name');
            $table->char('email');
            $table->char('phone');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('companies_id')->nullable();

            $table->index('companies_id', 'post_companies_idx');
            $table->foreign('companies_id', 'post_companies_fk')->on('companies')->references('id')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
