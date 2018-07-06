<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'course_id', 'content_url', 'resourse', 'content_type'];

    public function uploadContent($request) {
      $course_id = $request->course_id;
      $upload = $request->upload;
      if ($request->hasFile('file')) {
          $file = $request->file;
          $file_name = $request->file('file')->getClientOriginalName();
          if($file_name) {
            $name = time().'_'.$file_name;
          }
          else {
            $name = time().'.'.$file->getClientOriginalExtension();
          }
          $destinationPath = public_path("/uploads/courses/" . $course_id . "/lecture/");
          $file->move($destinationPath, $name);
          return "/uploads/courses/" . $course_id . "/lecture/".$name;
      }
      else {
      	return $request->content_url;
      }
    }

    public function course() {
      return $this->belongsTo('App\Models\Course');
    }

    public function assessments()
    {
        return $this->morphMany('App\Models\Assessment', 'assessmentable');
    }
}
