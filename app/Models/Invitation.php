<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cd_invitation', 'valid_from',
        'valid_to','created_by',
        'updated_by'
        ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'deleted_at',
    ];
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
    public static function create_invitation($request){
        if(empty($request['id_payment'])){
            $request['id_payment'] = null;
        }
        $result= Invitation::create([
                                'cd_invitation' => $request['cd_invitation'],
                                'valid_from' => $request['valid_from'],
                                'valid_to' => $request['valid_to'],
                                'id_payment' => $request['id_payment'],
                                'valid_from' => $request['valid_from'],
                                'valid_to' => $request['valid_to'],
                                'created_by' =>$request['created_by'],
                            ] );
        return $result;
    }
    

    /*
        * Function: Get invitation details by id
        * Param: cd_invitation
        * $request	: 
    */
    public static function get_outlet_user($request){
        
        $result = Invitation::where('invitations.cd_invitation', $request)
                ->select('invitations.*', 'invitation_details.*')
                ->join('invitation_details','invitation_details.id_invitation','=','invitations.id')
                ->get();
        return $result;
    }
}
