<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Lecture;
use App\Models\Assessment;
use App\User;
use DB;

class AssessmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'search', 'related_course', 'top_courses']);
    }

    /**
     * Get user course lists.
     *
     * @param  none
     * @return Array course
     */
    protected function index(Request $request)
    {
      $lecture = Lecture::find($request->lecture_id);
      $assessment = $lecture->assessment()->first();
      if(!$assessment) {
        $assessment = new Assessment();
        $assessment->assessmentable_id = $request->lecture_id;
      }
      return response()->json(['success' => true, 'assesment' => $assessment->with('questions', 'questions.answers')->get()]);
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
    public function update(Request $request) {
      $lecture = Lecture::find($request->lecture_id);
      $assessment = $lecture->assessment()->first();
      if(!$assessment) {
        $assessment = new Assessment();
      }
      $assessment->title = $request->title;
      if($lecture->assessment()->save($assessment)) {
        return response()->json(['success' => true, 'assessment' => $assessment]);
      }
      else {
        return response()->json(['success' => false, 'message' => 'Validation error! Please check your data']);
      }
    }

    /*
    * Update or create question and answer
    * @params question and answer data
    *
    * @return updated question 
    */

    public function update_question(Request $request) {
      $assessment = Assessment::find($request->assessment_id);
      if($request->id) {
        $question = Question::find($request->id);
      }
      else {
        $question = new Question();
      }
      $question->title = $request->title;
      $question->assessment_id = $request->assessment_id;
      if($question->save()) {
        $answers = $request->answers;
        foreach ($answers as $key => $answer) {
          if(!empty($answer['id'])) {
            $obj_answer = Answer::find($answer['id']); 
          }    
          else {
            $obj_answer = new Answer();
          }
          $obj_answer->title = $answer['title'];
          $obj_answer->is_correct = $answer['is_correct'];
          $obj_answer->question_id = $question->id;
          $obj_answer->save();
        }
        return response()->json(['success' => true, 'question' => Question::with('answers')->where('id', $question->id)->first()]);
      }
      else {
        return response()->json(['success' => false, 'message' => 'Validation error! Please check your data']);
      }

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
}
