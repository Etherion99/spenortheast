<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = 'indicators';

    protected $fillable = [
        'value',
        'type'
    ];

    public function indicatorType(){
    	return $this->belongsTo('App\IndicatorType');
    }
}
