<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\AdminVideo;
use App\Category;
use App\SubCategory;
  
class AdminVideosExport implements FromView 
{

    public function __construct(Request $request)
    {
        $this->search_key = $request->search_key;
        $this->status = $request->status;
        $this->video_type = $request->video_type;
        $this->downloadable = $request->downloadable;
        $this->originals = $request->originals;
        $this->category_id = $request->category_id;
        $this->sub_category_id = $request->sub_category_id;

       
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View {

         $base_query = AdminVideo::orderBy('admin_videos.created_at' , 'desc')
                     ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id');



            if($this->search_key) {

                $base_query = $base_query->where('admin_videos.title','LIKE','%'.$this->search_key.'%')
                                        ->orWhere('categories.name','LIKE','%'.$this->search_key.'%')
                                        ->orWhere('sub_categories.name','LIKE','%'.$this->search_key.'%');
            }

            if($this->status != '') {

                $status = $this->status;

                switch ($status) {

                    case SORT_BY_APPROVED:
                    $base_query = $base_query->where('admin_videos.is_approved', APPROVED);
                    break;

                    case SORT_BY_DECLINED:
                    $base_query = $base_query->where('admin_videos.is_approved', DECLINED);
                    break;

                    default:
                    $base_query = $base_query->where('admin_videos.is_approved',APPROVED);
                    break;
                }
            }

             if($this->originals != '') {

                    $base_query = $base_query->where('admin_videos.is_original_video', ORIGINAL_VIDEO_YES);
            }

            if($this->video_type != '') {

                $video_type = $this->video_type;

                switch ($video_type) {

                    case SORT_BY_APPROVED:
                    $base_query = $base_query->where('admin_videos.is_pay_per_view', YES);
                    break;

                    case SORT_BY_DECLINED:
                    $base_query = $base_query->where('admin_videos.is_pay_per_view', NO);
                    break;

                    default:
                    $base_query = $base_query->where('admin_videos.is_pay_per_view',YES);
                    break;
                }
            }

            $query = $base_query->select('admin_videos.id as video_id', 'admin_videos.*');

            if($this->downloadable) {

                $base_query = $base_query->where('admin_videos.download_status', ENABLED_DOWNLOAD);
            }

            if($this->category_id) {

                $base_query = $base_query->where('admin_videos.category_id', $this->category_id);
            }

            if($this->sub_category_id) {

                $base_query = $base_query->where('admin_videos.sub_category_id', $this->sub_category_id);
            }

            $base_query = $base_query->get();

       return view('exports.videos', [
           'data' => $base_query
       ]);

    }

}