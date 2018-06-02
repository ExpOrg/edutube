<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\User;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $student = User::where("user_type", '=', 'student')->count();
            $teacher = User::where("user_type", '=', 'teacher')->count();
            $all = User::all()->count();
            $courses = Course::all()->count();
            $stats = array('all' => $all, 'student' => $student, 'teacher' => $teacher, 'courses' => $courses);
            $content->header('Dashboard');
            $content->description('Edutube admin dashboard...');
            $content->body(view('admin.dashboard.dashboard')->with('stats', $stats));
        });
    }
}
