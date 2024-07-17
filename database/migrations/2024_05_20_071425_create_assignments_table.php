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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->char('number', 4);
            $table->integer('number_prefix');
            $table->date('in_date');
            $table->string('base_number')->nullable();
            $table->date('base_date')->nullable();
            $table->binary('object')->nullable();
            $table->date('object_birthday')->nullable();
            $table->boolean('citizenship')->default(false);
            $table->boolean('judging')->default(false);
            $table->boolean('ethnicity')->default(false);
            $table->boolean('itt')->default(false);
            $table->boolean('budget')->default(false);
            $table->boolean('bdsm')->default(false);
            $table->boolean('ptsm')->default(false);
            $table->boolean('quickly')->default(false);
            $table->boolean('transit')->default(false);
            $table->boolean('outside_zone')->default(false);
            $table->boolean('og')->default(false);
            $table->boolean('series')->default(false);
            //исп. общее:
            $table->boolean('without_execution')->default(false); //без исполнения
            $table->date('executed_date')->nullable(); //дата исп.
            $table->integer('page')->nullable(); //листы
            $table->boolean('doc_control')->default(false); //док. контроль
            $table->boolean('audio_control')->default(false); //аудио контроль
            $table->boolean('track_control')->default(false); //тр. контроль
            $table->boolean('together_control')->default(false); //контроль
            $table->longText('employer_defect')->nullable(); //брак зак.
            $table->longText('note')->nullable(); //примечание
            //исп. 2:
            $table->boolean('use_video')->default(false);
            $table->boolean('use_photo')->default(false);
            $table->boolean('use_audio')->default(false);
            $table->boolean('for_us')->default(false);
            $table->boolean('place_work')->default(false);
            $table->integer('relation')->nullable();
            $table->integer('ident_relation')->nullable();
            $table->boolean('is_fail')->default(false);
            $table->boolean('region')->default(false);
            $table->boolean('bio')->default(false);
            $table->boolean('copy')->default(false);
            $table->boolean('spravka')->default(false);
            $table->integer('photo_device')->nullable();
            $table->integer('photo_device_photo')->nullable();
            $table->integer('photo_device_video')->nullable();
            $table->integer('photo_device_audio')->nullable();
            $table->integer('video_device')->nullable();
            $table->integer('video_device_photo')->nullable();
            $table->integer('video_device_video')->nullable();
            $table->integer('video_device_audio')->nullable();
            $table->integer('audio_device')->nullable();
            $table->integer('audio_device_audio')->nullable();
            //исп. 5:
            $table->integer('input_data')->nullable();
            $table->integer('persons')->nullable();
            $table->integer('firms')->nullable();
            $table->integer('transport')->nullable();
            $table->integer('address')->nullable();
            $table->integer('photo')->nullable();
            $table->boolean('scheme')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
