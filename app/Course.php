<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function faculties()
    {
        return $this->belongsToMany('App\Faculty','course_faculty','course','faculty');
    }
    public function questions()
    {
        return $this->hasMany('App\Question','course','id');
    }
    public function questionpapers()
    {
        return $this->hasMany('App\Questionpaper','course','id');
    }
    public function questionsExamTypeWise($exam_type)
    {
        return $this->hasMany('App\Question','course','id')->where('exam_type',$exam_type);
    }
}
