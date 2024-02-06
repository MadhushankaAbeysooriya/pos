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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();

            $table->string('reference_no')->unique();
            $table->date('issue_date');
            $table->decimal('sub_total',12,2);
            $table->decimal('discount',10,2)->default(0.00);
            $table->decimal('total',12,2);

            $table->unsignedBigInteger('issue_location_id')->nullable();
            $table->foreign('issue_location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->foreign('created_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->tinyInteger('status')->default(0);//0=>pending, 1=>in transit, 2=>completed

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
