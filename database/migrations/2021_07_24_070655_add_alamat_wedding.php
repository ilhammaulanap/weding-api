<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatWedding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invitation_details', function($table)
        {
            $table->date('tgl_akad')->after('tgl_resepsi')->nullable();
            $table->text('alamat_resepsi')->nullable();
            $table->text('alamat_akad')->nullable();
            $table->text('langitude_resepsi')->nullable();
            $table->text('lotitude_resepsi')->nullable();
            $table->text('langitude_akad')->nullable();
            $table->text('lotitude_akad')->nullable();
            $table->time('jam_akad')->nullable();
            $table->time('jam_selesai_akad')->nullable();
            $table->time('jam_resepsi_sesi_1')->nullable();
            $table->time('jam_resepsi_selesai_sesi_1')->nullable();
            $table->time('jam_resepsi_sesi_2')->nullable();
            $table->time('jam_resepsi_selesai_sesi_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitation_details', function($table)
        {
            $table->dropColumn('tgl_akad');
            $table->dropColumn('alamat_resepsi');
            $table->dropColumn('alamat_akad');
            $table->dropColumn('langitude_resepsi');
            $table->dropColumn('lotitude_resepsi');
            $table->dropColumn('langitude_akad');
            $table->dropColumn('lotitude_akad');
            $table->dropColumn('jam_akad');
            $table->dropColumn('jam_selesai_akad');
            $table->dropColumn('jam_resepsi_sesi_1');
            $table->dropColumn('jam_resepsi_selesai_sesi_1');
            $table->dropColumn('jam_resepsi_sesi_2');
            $table->dropColumn('jam_resepsi_selesai_sesi_2');
        });
    }
}
