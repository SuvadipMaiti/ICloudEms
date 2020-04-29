<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function questionsmapping()
    {
        return $this->hasOne('App\Questionmapping','question','id');
    }
    public function questionsmappingCountById($id)
    {
        return $this->hasOne('App\Questionmapping','question','id')->where('id',$id)->count();
    }
    public function questionsmappingFilter($course,$questionpaper)
    {
        return $this->hasOne('App\Questionmapping','question','id')->where('course',$course)->where('questionpaper',$questionpaper)->first();
    }
}
