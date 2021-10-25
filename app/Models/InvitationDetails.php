<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_invitation', 'nama_mempelai_pria','nama_mempelai_wanita',
        'nama_ibu_mempelai_pria','nama_ibu_mempelai_wanita',
        'nama_ayah_mempelai_wanita','nama_ayah_mempelai_pria',
        'instagram_account_pria','instagram_account_wanita',
        'tgl_resepsi','no_telp_client','tgl_akad','alamat_resepsi',
        'alamat_akad','langitude_resepsi','lotitude_resepsi',
        'langitude_akad','lotitude_akad','jam_akad','jam_selesai_akad',
        'jam_resepsi_sesi_1','jam_resepsi_sesi_2',
        'jam_resepsi_selesai_sesi_1','jam_resepsi_selesai_sesi_2',
        'created_by','updated_by',
        ];

    protected $dates = ['deleted_at'];

    /*
    * Function: change format timestamp
    * Param: 
    *	$request	: 
    */
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('d, M Y H:i');
    }

    /*
        * Function: change format timestamp
        * Param: 
        *	$request	: 
        */
    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
        ->format('d, M Y H:i');
    }

    /*
    * Function: add data invitation master
    * Param: 
    *	$request	: name,
    */
    public static function create_detail_invitation($request){
       
        $result= InvitationDetails::create([
                                'id_invitation' => $request['id_invitation'],
                                'nama_mempelai_pria' => $request['nama_mempelai_pria'],
                                'nama_mempelai_wanita' => $request['nama_mempelai_wanita'],
                                'nama_ayah_mempelai_wanita' => $request['nama_ayah_mempelai_wanita'],
                                'nama_ayah_mempelai_pria' => $request['nama_ayah_mempelai_pria'],
                                'nama_ibu_mempelai_pria' => $request['nama_ibu_mempelai_pria'],
                                'nama_ibu_mempelai_wanita' => $request['nama_ibu_mempelai_wanita'],
                                'instagram_account_pria' => $request['instagram_account_pria'],
                                'instagram_account_wanita' => $request['instagram_account_wanita'],
                                'tgl_resepsi' => $request['tgl_resepsi'],
                                'no_telp_client' => $request['no_telp_client'],
                                'tgl_akad' =>$request['tgl_akad'],
                                'alamat_resepsi' =>$request['alamat_resepsi'],
                                'alamat_akad' =>$request['alamat_akad'],
                                'langitude_resepsi' =>$request['langitude_resepsi'],
                                'lotitude_resepsi' =>$request['lotitude_resepsi'],
                                'langitude_akad' =>$request['langitude_akad'],
                                'lotitude_akad' =>$request['lotitude_akad'],
                                'jam_akad' =>$request['jam_akad'],
                                'jam_selesai_akad' =>$request['jam_selesai_akad'],
                                'jam_resepsi_sesi_1' =>$request['jam_resepsi_sesi_1'],
                                'jam_resepsi_sesi_2' =>$request['jam_resepsi_sesi_2'],
                                'jam_resepsi_selesai_sesi_1' =>$request['jam_resepsi_selesai_sesi_1'],
                                'jam_resepsi_selesai_sesi_2' =>$request['jam_resepsi_selesai_sesi_2'],
                                'created_by' =>$request['created_by'],
                            ] );
        return $result;
    }

    
}
