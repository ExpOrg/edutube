<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Models\Klass;
use App\Models\Lecture;
use App\User;
use DB;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['details', 'search', 'related_course', 'top_courses']);
    }

    /**
     * Get user course lists.
     *
     * @param  none
     * @return Array course
     */
    protected function index()
    {
        $user = auth()->user();
        return response()->json(['success' => true, 'courses' => $user->courses()->get()]);
    }

    /**
     * Get user course lists.
     *
     * @param  none
     * @return Array course
     */
    protected function show(Request $request)
    {
        $course = Course::find($request->id);
        return response()->json(['success' => true, 'course' => $course]);
    }

    /**
     * Search course by class, subject or title.
     *
     * @param  search term
     * @return Array courses
     */
    protected function search(Request $request)
    {
      DB::enableQueryLog();
      $courses = array();
      $price_filter = $request->price_filter;
      $search_courses = Course::search($request);
      foreach($search_courses as $course) {
        $user = $course->user()->get()->first();
        $course_details = array('id' => $course->id, 'title' => $course->title, 'user' => "$user->first_name $user->last_name", 'price' => $course->price, 'image' => $course->image, 'price_currency' => $course->price_currency, 'discount_price' => $course->discount_price);
        if($price_filter == 'paid' && $course->price > 0) {
          $courses[] = $course_details;
        }
        else if($price_filter == 'free' && ($course->price <= 0 || $course->price == null)) {
          $courses[] = $course_details;
        }
        else if($price_filter == 'all' || !$price_filter) {
          $courses[] = $course_details;
        }
      }
      return response()->json(['success' => true, 'courses' => $courses]);
    }

    /**
     * Get course details user.
     *
     * @param  course id
     * @return Array course details
     */
    protected function details(Request $request)
    {
        $category = null;
        $course = Course::find($request->id);
        $user = $course->user()->get();
        if($request->category) {
          $category = Category::findBySlug($request->category);
        }
        return response()->json(['success' => true, 'course' => $course, 'user' => $user, 'category' => $category, 'lectures' => $course->lectures()->get()]);
    }

    /**
    * Get related course of a course 
    * @param course_id as id
    * @return Array of course
    */
    public function related_course(Request $request) {
      $course = Course::find($request->id);
      $courses = array();
      $related_course = Course::where('class_id', $course->class_id)
            //->where('subject_id', $course->subject_id)
            ->where('id','!=', $course->id)->get();

      foreach($related_course as $course) {
          $user = $course->user()->get()->first();
          $course_details = array('id' => $course->id, 'title' => $course->title, 'user' => "$user->first_name $user->last_name", 'price' => $course->price, 'image' => $course->image, 'price_currency' => $course->price_currency, 'discount_price' => $course->discount_price);
          $courses[] = $course_details;
        }
      return response()->json(['success' => true, 'related_course' => $courses]);
    }


    /**
     * Get random 5, first 5 and last 5 courses
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function top_courses(){
        $random_courses = Course::inRandomOrder()->limit(10)->get();
        $latest_courses = Course::orderBy('id', 'desc')->take(10)->get();
        $top_shared_courses = Course::orderBy('id', 'asc')->take(10)->get();
        return response()->json(['success' => true, 'top_view' => $random_courses, 'latest_upload' => $latest_courses, 'top_shared' => $top_shared_courses]);
    }

	  /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string'
        ]);
    }

    /*
    * Create education record of a student
    * @params education data
    * @return education data
    */
    public function create(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
      } 
      else {
        $user = auth()->user();
        $course_params = $request->all();
        $course_params['user_id'] = $user->id; 
        $course = new Course();
        $course = $course->fill($course_params);
        if($course->save()) {
          return response()->json(['success' => true, 'course' => $course]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to created course"]);
        }
      }
    }

    /*
    * Add category to a course
    * @params course_id, category_id
    *
    * @return newlly added category 
    */

    public function add_category(Request $request) {
      $course_id = $request->id;
      $category = Category::find($request->category_id);
      $course = Course::find($course_id);
      $category->courses()->attach($course_id);
      return response()->json(['success' => true]);
    }

    /*
    * Remove category from a course
    * @params course_id, category_id
    *
    * @return success response
    */

    public function remove_category(Request $request) {
      $course_id = $request->id;
      $category_id = $request->category_id;
      $category = Category::find($category_id);
      $course = Course::find($course_id);
      $category->courses()->detach($course_id);
      return response()->json(['success' => true]);
    }

    /*
    * Load course data category, classes, subject etc.
    * @params course_id
    *
    * @return Data array
    */

    public function edit(Request $request) {
      $course = Course::find($request->id);
      $categories = Category::select('title', 'id')->get();
      $course_categories = $course->categories()->select('title', 'categories.id')->get();
      $classes = Klass::all();
      $subjects = Subject::all();
      return response()->json(['success' => true, 'categories' => $categories, 'course_categories' => $course_categories, 'klasses' => $classes, 'subjects' => $subjects]);
    }

    /*
    * Update course record of a student
    * @params course id as integer
    * @return updated data
    */
    public function update(Request $request) {
      $validate = $this->validator($request->all());
      if($validate->fails()) {
        return response()->json(['success' => false, 'message' => "Validation error", 'errors' => $validate->errors()]);
      }
      else {
        $course = Course::find($request->id);
        $course = $course->fill($request->all());
        //$course->tools_required = serialize($request->tools_required);
        if($course->save()) {
          return response()->json(['success' => true, 'message' => 'Course has been updated!', 'course' => $course]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Unable to update course"]);
        }
      }
    }

    /**
    * Delete course by id
    *
    */

    public function delete(Request $request) {
      $user = auth()->user();
      $course = Course::find($request->id);
      if($course->user_id == $user->id) {
        if($course->delete()) {
          return response()->json(['success' => true, 'message' => "success"]);
        } 
        else {
          return response()->json(['success' => false, 'message' => "Unable to delete this course!"]);
        }
      }
      else {
        return response()->json(['success' => false, 'message' => "Course delete, Access denied!"]);
      }
    }

    /**
     * Upload course file image or video.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_file(Request $request) {
        $course = Course::find($request->id);
        $upload_type = $request->upload_type;
        if($upload_type == 'image') {
            $this->validate($request, [
              'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }
        else {
            $this->validate($request, [
              'file' => 'required|mimes:mp4,mpeg,mp3,mov|max:500048'
            ]);
        }

        if ($request->hasFile('file')) {
          $image = $request->file('file');
          $name = time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/uploads/courses/');
          $image->move($destinationPath, $name);
          $file_path = '/uploads/courses/'.$name;
          if($upload_type == 'image') {
            $course->fill(['image' => $file_path]);
          }
          else {
            $course->fill(['promo_video' => $file_path]);
          }
          if($course->save()) {
            return response()->json(['success' => true, 'message' => "$upload_type Uploaded!", 'file' => $file_path ]);
          }
          else {
            return response()->json(['success' => false, 'message' => "Unable to upload $upload_type"]);
          }
        }
    }

    /* COURSE LECTURE SECTION */

    /**
    * get all lecture of a course
    *
    * @return lectures as array
    */
    public function lectures(Request $request) {
      $course = Course::find($request->course_id);
      return response()->json(['success' => true, 'message' => "Lecture loaded!", 'lectures' => $course->lectures()->get()]);
    }

    /**
    * get lecture by id
    *
    * @return lecture as JSON
    */
    public function lecture(Request $request) {
      $course = Course::find($request->course_id);
      $lecture = Lecture::find($request->id);
      return response()->json(['success' => true, 'message' => "Lecture loaded!", 'lecture' => $lecture]);
    }

    /**
    * Update or create lecture.
    *
    * @return lecture data
    */
    public function update_lecture(Request $request) {
      $lecture = new Lecture();
      if($request->id) {
        $lecture = Lecture::find($request->id);
      }
      $validator = Validator::make(array('title' => $request->title), [
            'title' => 'required|string'
        ]);
      if($validator->fails()) {
        return response()->json(['success' => false, 'message' => "Validation failed! Check the required field"]);
      }
      else {
        $lecture->title = $request->title;
        $lecture->description = $request->description;
        $lecture->content_url = $lecture->uploadContent($request);
        $lecture->content_type = 'pdf';
        $lecture->course_id = $request->course_id;
        if($lecture->save()) {
          return response()->json(['success' => true, 'message' => "Lecture saved!", 'lecture' => $lecture]);
        }
        else {
          return response()->json(['success' => false, 'message' => "Something wrong! Please try again"]);
        }
      }
    }
}
