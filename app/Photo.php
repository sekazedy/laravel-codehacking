<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file_path'];

    protected $uploads_path = '/images/';

    // accessor for file_path field in table
    public function getFilePathAttribute($photo){
        return $this->uploads_path . $photo;
    }
}
