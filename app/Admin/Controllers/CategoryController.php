<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CategoryController extends Controller
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

            $content->header('Categories');
            $content->description('Category List');

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

            $category = Category::find($id);

            $content->header($category->title);
            $content->description('Edit Category');

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

            $content->header('Create Category');
            $content->description('New Category');

            $content->body($this->form());
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $category = Category::find($id);

            $content->header($category->title);
            $content->description('view category');

            $content->body(view('admin.categories.show')->with('category', $category));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Category::class, function (Grid $grid) {

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
        return Admin::form(Category::class, function (Form $form) {

            $form->text('title')->rules('required');
            $form->textarea('description');
            $form->image('image')->move('/uploads/categories');
        });
    }
}
