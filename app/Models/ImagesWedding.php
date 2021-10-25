<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagesWedding extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_invitation', 'image_wedding',
        ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'deleted_at',
    ];

    /*
    * Function: add data invitation master
    * Param: 
    *	$request	: name,
    */
    public static function add_images($request){
        
        $result= ImagesWedding::create([
                                'id_invitation' => $request['id_invitation'],
                                'image_wedding' => $request['images'],
                            ] );
        return $result;
    }
}
