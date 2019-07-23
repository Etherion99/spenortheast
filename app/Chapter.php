<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';

    protected $fillable = [
        'name',
        'description',
        'extension'
    ];

    public function members(){
    	return $this->hasMany('App\Member');
    }
}
