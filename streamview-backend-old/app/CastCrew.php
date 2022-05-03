<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;


class CastCrew extends Model
{
    //
    public function videoCastCrews() {
        return $this->hasMany('App\VideoCastCrew', 'cast_crew_id', 'id');
    }

    /**
	 * Save the unique ID 
	 *
	 *
	 */
    public function setUniqueIdAttribute($value){

		$this->attributes['unique_id'] = uniqid(str_replace(' ', '-', $value));

	}


    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($video)
        {
            Helper::storage_delete_file($video->image,CAST_CREWS_FILE_PATH);

            if ($video->videoCastCrews->count() > 0) {

                foreach($video->videoCastCrews as $value)
                {
                    $value->delete();
                } 

            }

        });

    }
}
