<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicatorType extends Model
{
    protected $table = 'indicator_types';

    protected $fillable = [
        'name'
    ];

    public function indicators(){
    	return $this->hasMany('App\Indicator');
    }
}
