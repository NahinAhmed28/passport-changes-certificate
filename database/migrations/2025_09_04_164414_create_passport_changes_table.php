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
        Schema::create('passport_changes', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->nullable();
            $table->date('date')->nullable();
            $table->date('new_passport_issue_date')->nullable();
            $table->string('name')->nullable();
            $table->string('old_passport_number')->nullable();
            $table->string('old_name')->nullable();
            $table->string('old_father_name')->nullable();
            $table->string('old_mother_name')->nullable();
            $table->date('old_dob')->nullable();
            $table->string('new_passport_number')->nullable();
            $table->string('new_name')->nullable();
            $table->string('new_father_name')->nullable();
            $table->string('new_mother_name')->nullable();
            $table->date('new_dob')->nullable();
            $table->boolean('name_changed')->default(false);
            $table->boolean('father_changed')->default(false);
            $table->boolean('mother_changed')->default(false);
            $table->boolean('dob_changed')->default(false);
            $table->boolean('nid')->default(false);
            $table->boolean('brc')->default(false);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passport_changes');
    }
};
