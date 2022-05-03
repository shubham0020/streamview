<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class SubCategory extends Model
{
	public function subCategoryImage()
    {
        return $this->hasMany('App\SubCategoryImage');
    }

    public function genres()
    {
        return $this->hasMany('App\Genre');
    }

    public function adminVideo()
    {
        return $this->hasMany('App\AdminVideo');
    }

    public function approvedAdminVideos()
    {
        return $this->hasMany('App\AdminVideo')->where('admin_videos.is_approved', VIDEO_APPROVED)
            ->where('admin_videos.status', VIDEO_PUBLISHED);
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($sub_categories)
        {
        	foreach($sub_categories->subCategoryImage as $image)
            {

                Helper::storage_delete_file($image->picture, SUB_CATEGORY_FILE_PATH);

                $image->delete();
            } 

            foreach($sub_categories->genres as $genre)
            {                

                Helper::delete_picture($genre->image,'/uploads/images/'); 

                
                if ($genre->video) {

                    Helper::delete_picture($genre->video, '/uploads/videos/original/');   

                }

                if ($genre->subtitle) {
                    
                    Helper::delete_picture($genre->subtitle, SUBTITLE_PATH);

                }  
 

                $genre->delete();
            } 

            foreach($sub_categories->adminVideo as $video)
            {     

                deleteVideoAndImages($video);

                $video->delete();
            } 

        });	

    }
    
}
