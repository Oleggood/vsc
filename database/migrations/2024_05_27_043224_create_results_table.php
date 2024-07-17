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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->index()->constrained('assignments');
            $table->date('result_date');

            //факт.рез:
            $table->foreignId('fact_prevent_crime_id')->nullable()->index()->constrained('crimes');
            $table->integer('fact_prevent')->nullable();
            $table->foreignId('fact_solved_crime_id')->nullable()->index()->constrained('crimes');
            $table->integer('fact_solved')->nullable();
            $table->string('number_ud')->nullable();
            $table->date('date_ud')->nullable();
            $table->string('decision_ud')->nullable();
            $table->date('date_decision_ud')->nullable();

            $table->foreignId('fact_search_crime_id')->nullable()->index()->constrained('crimes');
            $table->integer('fact_search')->nullable();
            $table->string('fact_search_fio')->nullable();
            $table->date('fact_search_data')->nullable();

            $table->string('fact_dou')->nullable();
            $table->date('fact_dou_date')->nullable();
            $table->integer('fact_crim_liability')->nullable();

            $table->longText('fact_result_another')->nullable();

            $table->boolean('is_result')->default(false);

            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
