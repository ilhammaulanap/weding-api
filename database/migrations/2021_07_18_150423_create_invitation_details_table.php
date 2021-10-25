<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_details', function (Blueprint $table) {
            $table->id();
            $table->string('id_invitation');
            $table->string('nama_mempelai_pria',50)->nullable();
            $table->string('nama_mempelai_wanita',50)->nullable();
            $table->string('nama_ibu_mempelai_pria',50)->nullable();
            $table->string('nama_ibu_mempelai_wanita',50)->nullable();
            $table->string('nama_ayah_mempelai_wanita',50)->nullable();
            $table->string('nama_ayah_mempelai_pria',50)->nullable();
            $table->string('instagram_account_pria',30)->nullable();
            $table->string('instagram_account_wanita',30)->nullable();
            $table->date('tgl_resepsi')->nullable();
            $table->string('no_telp_client',15)->nullable();
            $table->string('created_by',25)->nullable();
            $table->string('updated_by',25)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitation_details');
    }
}
