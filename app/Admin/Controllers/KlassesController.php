<?php

namespace App\Admin\Controllers;

use App\Models\Klass;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class KlassesController extends Controller
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

            $content->header('All Class');
            $content->description('Class List');

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

            $class = Klass::find($id);

            $content->header($class->name);
            $content->description('Edit Class');

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

            $content->header('Create Class');
            $content->description('New Class');

            $content->body($this->form());
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $class = Klass::find($id);

            $content->header($class->title);
            $content->description('view class');

            $content->body(view('admin.classes.show')->with('class', $class));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Klass::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Name')->sortable();

            $grid->paginate(20);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('name');
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
        return Admin::form(Klass::class, function (Form $form) {

            $form->text('name')->rules('required');
            $form->textarea('description');
        });
    }
}
