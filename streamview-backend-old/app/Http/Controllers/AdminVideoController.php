<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @method admin_videos_create
     *
     * @uses show the video upload page
     *
     * @created vithya R
     *
     * @updated vithya R
     *
     * @param
     *
     * @return view page
     */
    
    public function admin_videos_create(Request $request) {

    	$categories = \App\Category::where('categories.is_approved', APPROVED)
		                    ->whereHas('subCategory', function($q) {
						        $q->where('is_approved', APPROVED);
						    })
		                    ->orderBy('categories.name' , 'asc')
		                    ->get();

        $cast_crews = \App\CastCrew::select('id', 'name')->where('status', APPROVED)->get();

        return view('admin.admin_videos.create')
                ->with('page', 'videos')
                ->with('sub_page', 'admin_videos_create')
                ->with('categories', $categories)
                ->with('cast_crews', $cast_crews);

    }

    /**
     * @method videos_save
     *
     * @uses show the video upload page
     *
     * @created vithya R
     *
     * @updated vithya R
     *
     * @param
     *
     * @return view page
     */
    
    public function videos_save(Request $request) {

    }
}
