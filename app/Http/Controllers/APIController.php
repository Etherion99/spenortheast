<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\IndicatorType;
use App\Indicator;
use Carbon\Carbon;
use Vinkla\Instagram\Instagram;

class APIController extends Controller
{
    public function saveIndicators(){
    	$client = new Client();

    	$indicators = [
    		[
    			'name' => 'Brent',
    			'url' => 'https://es.investing.com/commodities/brent-oil'
    		],
    		[
    			'name' => 'WTI',
    			'url' => 'https://es.investing.com/commodities/crude-oil'
    		],
    		[
    			'name' => 'TRM',
    			'url' => 'https://es.investing.com/currencies/usd-cop'
    		]
    	];

    	foreach($indicators as $indicator){
    		$crawler = $client->request('GET', $indicator['url']);

	        $value = $crawler->filter('#last_last')->eq(0)->first()->text();
	        $value = str_replace(".","",$value);     
	        $value = floatval(str_replace(",",".",$value));

	        $type = IndicatorType::select('id')->where('name', $indicator['name'])->first();

	        Indicator::create([
	        	'value' => $value,
	        	'type' => $type->id
	        ]);
    	} 
    }

    public function getIndicator($type){
    	$typeObject = IndicatorType::select('id')->where('name', $type)->first();

    	$indicator = Indicator::select('value')->where('type', $typeObject->id)->whereDate('created_at', Carbon::today())->first();

    	if(!$indicator){
    		$this->saveIndicators();
    		$indicator = Indicator::select('value')->where('type', $typeObject->id)->whereDate('created_at', Carbon::today())->first();
    	}

    	return response()->json($indicator);
    }

    public function getIGFeed(){
        // Create a new instagram instance.
        $instagram = new Instagram('11388896573.151c37b.c0490b15540b4c2daf3bea15e991cc34');

        /*// Fetch recent user media items.
        $instagram->media();

        // Fetch user information.
        $instagram->self();*/

        return response()->json($instagram->media(['count' => 1]));
    }
}
