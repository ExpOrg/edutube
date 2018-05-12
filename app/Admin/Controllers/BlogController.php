<?php

namespace App\Admin\Controllers;

use App\Blog;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use phpDocumentor\Reflection\Types\Null_;
use App\User;

class BlogController extends Controller
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

            $content->header('All Blogs');
            $content->description('Blog List');
            $content->body($this->grid());

        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $blog = Blog::find($id);

            $content->body(view('admin.blogs.show')->with('blog', $blog));
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

            $blog = Blog::find($id);

            $content->header('Edit Blog');
            $content->description($blog->title);

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Blog::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            //$grid->image()->image();
            $grid->title('Title');
            $states = [
                'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 2, 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->status('Published')->switch($states)->sortable();

            $grid->column('Posted By')->display(function () {
                if ($this->user_id == NULL){
                    return 'Admin';
                }else{
                    return "<a href=\"/admin/website_users/{$this->user_id}\">{$this->user->name}</a>";

                }

            });

            $grid->created_at()->date_format()->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Blog::class, function (Form $form) {

            $form->text('title');
            $form->select('user_id')->options(User::all()->pluck('name', 'id'));
            $form->text('subtitle');
            $form->editor('content');
            $form->image('image')->move('/uploads/blogs');
            $form->switch('status', 'Publish');

        });
    }
}
