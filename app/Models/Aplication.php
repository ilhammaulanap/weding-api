<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aplication extends Model
{
    protected $fillable = [
        'api_key', 'client_app_nm',
        'ip_address_whitelist',
        ];
    use HasFactory;
    /*
	 * Function: check api key
	 * Param: 
	 *	$request	: $api
	 */
    public static function cek_api_key($api){
        $result= DB::select(DB::raw("select * from aplications where api_key = '{$api}'"));
        return $result;
    }
}
