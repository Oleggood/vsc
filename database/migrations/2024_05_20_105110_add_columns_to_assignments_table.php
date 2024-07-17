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
        Schema::table('assignments', function (Blueprint $table) {
            $table->string('number_note')->nullable()->after('number_prefix');
            $table->date('spr_return')->nullable();
            //результат по с/о:
            $table->string('spr_prevent_crime')->nullable();
            $table->integer('spr_prevent')->nullable();
            $table->string('spr_solved_crime')->nullable();
            $table->integer('spr_solved')->nullable();
            $table->string('spr_search_crime')->nullable();
            $table->integer('spr_search')->nullable();
            $table->string('spr_search_person')->nullable();
            $table->date('spr_search_date')->nullable();
            $table->string('spr_dou')->nullable();
            $table->date('spr_dou_date')->nullable();
            $table->integer('spr_crim_liability')->nullable();
            $table->integer('spr_adm_liability')->nullable();
            $table->integer('spr_identity_established')->nullable();
            $table->integer('spr_connection')->nullable();
            $table->integer('spr_live_place')->nullable();
            $table->integer('spr_work_place')->nullable();
            $table->integer('spr_crim_groups')->nullable();
            $table->integer('spr_crim_groups_count')->nullable();
            $table->integer('spr_oper_accounting')->nullable();
            $table->longText('spr_result_another')->nullable();

            // изъятие:
            $table->integer('gun')->nullable();
            $table->integer('bullet')->nullable();
            $table->decimal('bang', total: 5, places: 2)->nullable();
            $table->decimal('drug', total: 5, places: 2)->nullable();
            $table->decimal('money', total: 8, places: 2)->nullable();
            $table->integer('car')->nullable();
            $table->integer('form')->nullable();
            $table->integer('tehn')->nullable();

            //связанные таблицы
            $table->foreignId('autor_id')->index()->constrained('users');
            $table->foreignId('number_index_id')->index()->constrained('number_indexes');
            $table->foreignId('base_id')->index()->constrained('basics');
            $table->foreignId('employer_id')->index()->constrained('employers');
            $table->foreignId('object_type_id')->index()->constrained('object_types');
            $table->foreignId('execut_id')->nullable()->index()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('spr_return');
            $table->dropColumn('number_note');
            //рез.:
            $table->dropColumn('spr_prevent_crime');
            $table->dropColumn('spr_prevent');
            $table->dropColumn('spr_solved_crime');
            $table->dropColumn('spr_solved');
            $table->dropColumn('spr_search_crime');
            $table->dropColumn('spr_search');
            $table->dropColumn('spr_search_person');
            $table->dropColumn('spr_search_date');
            $table->dropColumn('spr_dou');
            $table->dropColumn('spr_dou_date');
            $table->dropColumn('spr_crim_liability');
            $table->dropColumn('spr_adm_liability');
            $table->dropColumn('spr_identity_established');
            $table->dropColumn('spr_connection');
            $table->dropColumn('spr_live_place');
            $table->dropColumn('spr_work_place');
            $table->dropColumn('spr_crim_groups');
            $table->dropColumn('spr_crim_groups_count');
            $table->dropColumn('spr_oper_accounting');
            $table->dropColumn('spr_result_another');

            $table->dropColumn('gun');
            $table->dropColumn('bullet');
            $table->dropColumn('bang');
            $table->dropColumn('drug');
            $table->dropColumn('money');
            $table->dropColumn('car');
            $table->dropColumn('form');
            $table->dropColumn('tehn');

            $table->dropForeign(['autor_id']);
            $table->dropColumn('autor_id');
            $table->dropForeign(['number_index_id']);
            $table->dropColumn('number_index_id');
            $table->dropForeign(['base_id']);
            $table->dropColumn('base_id');
            $table->dropForeign(['employer_id']);
            $table->dropColumn('employer_id');
            $table->dropForeign(['object_type_id']);
            $table->dropColumn('object_type_id');
            $table->dropForeign(['execut_id']);
            $table->dropColumn('execut_id');
        });
    }
};
