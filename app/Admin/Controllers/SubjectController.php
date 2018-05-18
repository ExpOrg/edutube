<?php

namespace App\Admin\Controllers;

use App\Models\Subject;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SubjectController extends Controller
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

            $content->header('All Subjects');
            $content->description('Subject List');

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

            $subject = Subject::find($id);

            $content->header($subject->title);
            $content->description('Edit Subject');

            $content->body($this->form()->edit($id));
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

            $content->header('Create Subject');
            $content->description('New Subject');

            $content->body($this->form());
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $subject = Subject::find($id);

            $content->header($subject->title);
            $content->description('view subject');

            $content->body(view('admin.subjects.show')->with('subject', $subject));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Subject::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title')->sortable();

            $grid->paginate(20);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('title');
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
        return Admin::form(Subject::class, function (Form $form) {

            $form->text('title')->rules('required');
            $form->textarea('description');
            $form->image('image')->move('/uploads/categories');
        });
    }
}
