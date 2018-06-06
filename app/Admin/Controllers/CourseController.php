<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Klass;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CourseController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Courses');
            $content->description('Course List');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $course = Course::find($id);

            $content->header($course->title);
            $content->description('Edit Course');

            $content->body($this->form()->edit($id));
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $course = Course::find($id);
            $content->body(view('admin.courses.show')->with('course', $course));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Course');
            $content->description('Create Course');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Course::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title();
            $grid->sub_title();

            $grid->column('Course By')->display(function () {
                if ($this->user_id == NULL){
                    return 'Admin';
                }else{
                    return "<a href=\"/admin/website_users/{$this->user_id}\">{$this->user->first_name} {$this->user->last_name}</a>";

                }

            });

            $grid->column('Class')->display(function() {
                if($this->class_id == NULL || $this->klass == NULL) {
                  return 'N/A';
                }
                else {
                  return "<a href=\"/admin/classes/{$this->class_id}\">{$this->klass->name} </a>";                    
                }
            });

            $grid->column('Subject')->display(function() {
                if($this->subject_id == NULL || $this->subject == NULL) {
                  return 'N/A';
                }
                else {
                  return "<a href=\"/admin/subjects/{$this->subject_id}\">{$this->subject->title} </a>";                    
                }
            });

            $grid->column('Status')->display(function() {
                if($this->status == NULL) {
                  return 'Draft';
                }
                else {
                  return $this->status;                    
                }
            });

            $grid->created_at()->date_format()->sortable();

            $grid->column('')->display(function() {
                return "<a href=\"http://www.siteedutube.xyz/courses/{$this->id}\" target='_blank'>
                 Web View </a>";
            }); 

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('title');
                $filter->equal('sub_title');
                $filter->between('created_at')->datetime();
                $filter->between('updated_at')->datetime();
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Course::class, function (Form $form) {

            $form->text('title');
            $form->text('sub_title');
            $form->select('status')->options(['draft' => 'Draft', 'submitted' => 'Submitted', 'approved' => 'Approved'])->rules('required');
            $form->select('user_id', 'User')->options(User::selectRaw('id, CONCAT(first_name," ",last_name) as full_name')->pluck('full_name', 'id'));
            $form->select('class_id', 'Class')->options(Klass::all()->pluck('name', 'id'));
            $form->select('subject_id', 'Subject')->options(Subject::all()->pluck('title', 'id'));
            $form->multipleSelect('categories', 'Categories')->options(Category::all()->pluck('title', 'id'));
            $form->text('language');
            $form->text('price_currency');
            $form->number('price');
            $form->text('discount_currency');
            $form->number('discount_price');
            $form->textarea('welcome_message');
            $form->textarea('congratulation_message');
            $form->image('image')->move('/uploads/courses');
            $form->editor('description');
        });
    }
}
