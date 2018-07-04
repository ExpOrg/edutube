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
      $course_id = $request->id;
      print_r($request->file('file'));
      die(); 
      if ($request->hasFile('file')) {
          $image = $request->file('file');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path("/uploads/courses/" + $course_id + "/lecture/");
          $image->move($destinationPath, $name);
          return "/uploads/courses/" + $course_id + "/lecture/".$name;
      }
      else {
      	return $request->content_url;
      }
    }

    public function course() {
      return $this->belongsTo('App\Models\Course');
    }
}
