<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'name',
        'position',
        'chapter',
        'extension'
    ];

    public function chapter(){
    	return $this->belongsTo('App\Chapter');
    }
}
