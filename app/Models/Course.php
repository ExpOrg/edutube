<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $serialize = ['tools_required', 'achivement', 'who_can_take'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'sub_title', 'description', 'language', 'is_test', 
        'status', 'tools_required', 'who_can_take', 'achivement', 'image', 
        'promo_video', 'price_currency', 'price', 'discount_currency',
        'discount_price', 'welcome_message', 'congratulation_message', 'privacy',
        'google_tracking_id', 'google_adwards', 'class_id', 'subject_id', 'is_paid'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }

    public function klass() {
        return $this->belongsTo('App\Models\Klass', 'class_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_course', 'course_id', 'category_id');
    }


    public static function search($request) {
        $term = $request->term;
        $class = $request->class_name;
        $subject = $request->subject;
        $category = $request->category_id;

        $search_courses = Course::leftJoin('subjects', 'courses.subject_id', '=', 'subjects.id')->leftJoin('classes', 'courses.class_id', '=', 'classes.id');

        if($category) {
          $search_courses = $search_courses->join('category_course', 'courses.id', '=', 'category_course.course_id')->where('category_course.category_id', '=', $category);
        }

        if($term) {
          $search_courses = $search_courses->where("subjects.title", 'like', '%' . $term . '%')->orWhere("classes.name", 'like', '%' . $term . '%');
        }
        else {
          if($class) {
            $search_courses = $search_courses->where("classes.name", 'like', '%' . $class . '%');
          }
          if($subject) {
            $search_courses = $search_courses->where("subjects.title", 'like', '%' . $subject . '%');
          }
        }
        return $search_courses->select('courses.*')->distinct()->get();
    }
}
