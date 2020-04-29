<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionmapping extends Model
{
    public function getCoMappingLevelAttribute($co_mapping_level)
    {
      return explode(',', $co_mapping_level);
    }
    public function questionPaper()
    {
        return $this->belongsTo('App\Questionpaper','questionpaper','id');
    }
    public function questionPaperCountById($id)
    {
        return $this->belongsTo('App\Questionpaper','questionpaper','id')->where('id',$id)->count();
    }
    public function questionData()
    {
        return $this->belongsTo('App\Question','question','id');
    }
}
