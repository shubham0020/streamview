<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;

class Category extends Model
{

    protected $hidden = ['deleted_at'];
    
	public function subCategory()
    {
        return $this->hasMany('App\SubCategory');
    }

    public function genre()
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
    
	public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($categories)
        {
            Helper::storage_delete_file($categories->picture,CATEGORY_FILE_PATH);

            foreach($categories->subCategory as $sub_category)
            {  

                foreach($sub_category->subCategoryImage as $image) {

                    Helper::delete_picture($image->picture,'/uploads/images/');  

                    $image->delete();
                } 

                $sub_category->delete();
            } 

            foreach($categories->adminVideo as $video) {           

                deleteVideoAndImages($video);

                $video->delete();
            } 

            foreach($categories->genre as $genre) {                

                Helper::delete_picture($genre->image,'/uploads/images/');
                
                if($genre->video) {

                    Helper::delete_picture($genre->video, '/uploads/videos/original/');   

                }

                if ($genre->subtitle) {
                    
                    Helper::delete_picture($genre->subtitle, SUBTITLE_PATH);

                }  
  

                $genre->delete();
            } 

        });	

    }

    
}
