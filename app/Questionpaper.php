<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionpaper extends Model
{
    public function questionsmapping()
    {
        return $this->hasOne('App\Questionmapping','questionpaper','id');
    }
    public function questionsmappingFilter($section)
    {
        return $this->hasOne('App\Questionmapping','questionpaper','id')->where('section',$section)->get();
    }
    public function orquestionFilter($section)
    {
        return $this->hasMany('App\Orquestion','questionpaper','id')->where('section',$section)->get();
    }
    public function questionsmappingFilterQu($question)
    {
        return $this->hasOne('App\Questionmapping','questionpaper','id')->where('question',$question)->first();
    }
    public function optionalquestionFilter($section)
    {
        return $this->hasMany('App\Optionalquestion','questionpaper','id')->where('section',$section)->get();
    }
    
}
