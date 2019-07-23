<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Image;
use App\Member;
use App\Event;
use App\Program;
use App\Chapter;
use App\IndicatorType;
use App\Indicator;

class RoutingController extends Controller
{
    function about(){
    	$images = $this->getImages(['about_group']);
    	$members = Member::select('id', 'name', 'position', 'extension')->whereNull('chapter')->get();

    	return view('about', [
    		'images' => $images,
    		'members' => $members,
            'indicators' => $this->getIndicators()
    	]);
    }

    function memberships(){
        return view('memberships', [
            'indicators' => $this->getIndicators()
        ]);
    }

    function events($id=null){
        if($id == null){
            $images = $this->getImages([]);
            $recentEvents = Event::select('id', 'title', DB::raw('SUBSTRING(description, 1, 808) as description_preview'), 'start_date', 'end_date', 'extension')->where('end_date', '<', Carbon::now())->get();
            $soonEvents = Event::select('id', 'title', DB::raw('SUBSTRING(description, 1, 808) as description_preview'), 'start_date', 'end_date', 'extension')->where('end_date', '>=', Carbon::now())->get();

            return view('events', [
                'images' => $images,
                'recentEvents' => $recentEvents,
                'soonEvents' => $soonEvents,
                'indicators' => $this->getIndicators()
            ]);
        }else{
            $event = Event::where('id', $id)->first();

            return view('event_detail', [
                'event' => $event,
                'indicators' => $this->getIndicators()
            ]);
        }    	
    }

    function programs($id=null){
        if($id == null){
            $images = $this->getImages([]);
            $programs = Program::select('id', 'name', 'name', 'extension')->get();

            return view('programs', [
                'images' => $images,
                'programs' => $programs,
                'indicators' => $this->getIndicators()
            ]);
        }else{

        }        
    }

    function chapters($id=null){
        if($id == null){
            $images = $this->getImages([]);
            $chapters = Chapter::select('id', 'name', 'extension')->get();

            return view('chapters', [
                'images' => $images,
                'chapters' => $chapters,
                'indicators' => $this->getIndicators()
            ]);
        }else{
            $chapter = Chapter::select('name', 'description', 'extension')->where('id', $id)->first();
            $chapter['id'] = $id;

            $members = Member::select('id', 'name', 'position', 'extension')->where('chapter', $id)->get();

            return view('chapter_detail', [
                'chapter' => $chapter,
                'members' => $members,
                'indicators' => $this->getIndicators()
            ]); 
        }    
    }

    function contact(){
        return view('contact', [
            'indicators' => $this->getIndicators()
        ]); 
    }

    function getImages($list){
		$images = [];
		$query = Image::select('name', 'extension');

		foreach($list as $value){
			$query->orwhere('name', $value);
		}

		foreach($query->get() as $value){
			$images[$value['name']] = $value['extension'];
		}

		return $images;
	}

    function getIndicators(){
        $indicators = ['Brent', 'WTI', 'TRM'];
        $indicatorObjs = [];

        foreach($indicators as $indicator){
            $typeObj = IndicatorType::select('id')->where('name', $indicator)->first();

            $indicatorObj = Indicator::select('value')->where('type', $typeObj->id)->whereDate('created_at', Carbon::today())->first();
            $indicatorObj['name'] = $indicator;

            array_push($indicatorObjs, $indicatorObj);
        }

        return $indicatorObjs;
    }
}
