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
use GMaps;

class RoutingController extends Controller
{
    function about(){
    	$images = $this->getImages(['about_group']);
    	$members = Member::select('id', 'name', 'position', 'extension')->get();

    	return view('about', [
    		'images' => $images,
    		'members' => $members
    	]);
    }

    function memberships(){
        return view('memberships');
    }

    function events(){
    	$images = $this->getImages([]);
    	$recentEvents = Event::select('id', 'title', DB::raw('SUBSTRING(description, 1, 808) as description_preview'), 'start_date', 'end_date', 'extension')->where('end_date', '<', Carbon::now())->get();
        $soonEvents = Event::select('id', 'title', DB::raw('SUBSTRING(description, 1, 808) as description_preview'), 'start_date', 'end_date', 'extension')->where('end_date', '>=', Carbon::now())->get();

    	return view('events', [
    		'images' => $images,
    		'recentEvents' => $recentEvents,
            'soonEvents' => $soonEvents
    	]);
    }

    function programs(){
        $images = $this->getImages([]);
        $programs = Program::select('id', 'name', 'name', 'extension')->get();

        return view('programs', [
            'images' => $images,
            'programs' => $programs
        ]);
    }

    function students_chapters($id = null){
        if($id == null){
            $images = $this->getImages([]);
            $chapters = Chapter::select('id', 'name', 'extension')->get();

            return view('students_chapters', [
                'images' => $images,
                'chapters' => $chapters
            ]);
        }else{
            $images = $this->getImages([]);
            $chapter = Chapter::select('name', 'extension')->where('id', $id)->get();

            return view('student_chapter', [
                'images' => $images,
                'chapter' => $chapter
            ]);
        }
        
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
}
