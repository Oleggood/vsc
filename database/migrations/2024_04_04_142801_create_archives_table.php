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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id'); //id задачи
            $table->date('task_date')->nullable(); //дата задачи (документа)
            $table->string('number', '30')->nullable(); //номер документа
            $table->string('task_name', '700')->nullable();; //наименование документа
            $table->string('item', '20')->nullable(); ; //пункт
            $table->longText('task')->nullable();; //текст поручения
            $table->longText('note')->nullable(); //примечание
            $table->longText('done')->nullable(); //отметки об исполнении
            $table->longText('comment')->nullable(); //комментарий исполнителя
            $table->date('deadline')->nullable();; //крайняя дата исполнения
            $table->integer('task_status_id')->nullable(); //связь с таблицей статусов
            $table->longText('users_string')->nullable();; //пользователи (строка)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
