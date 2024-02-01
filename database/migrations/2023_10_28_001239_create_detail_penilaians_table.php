<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penilaian_id');
            $table->bigInteger('surah_id');
            $table->integer('juz');
            $table->integer('dari_ayat');
            $table->integer('sampai_ayat');
            $table->integer('fashoh');
            $table->integer('tajwid');
            $table->integer('lancar');
            $table->integer('nilai');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penilaians');
    }
};