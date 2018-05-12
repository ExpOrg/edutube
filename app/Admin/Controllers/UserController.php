<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Table;

class UserController extends Controller
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

            $content->header('Website Users');
            $content->description('User List');

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
            $user = User::find($id);

            $content->header('Edit User');
            $content->description($user->name);

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

            $content->header('Create Users');
            $content->description('Website users');

            $content->body($this->form());
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $user = User::find($id);

            $content->header($user->name);
            $content->description('view users');

            $content->body(view('admin.website_users.show')->with('user', $user));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->paginate(20);

            $grid->id('ID')->sortable();
            $grid->name();
            $grid->email();
            $grid->country();
            $grid->city();
            $grid->phone();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('name');
                $filter->equal('email');
                $filter->equal('country');
                $filter->equal('city');
                $filter->equal('created_at')->datetime();
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
        return Admin::form(User::class, function (Form $form) {
            $form->model()->makeVisible('password');
            $form->text('name')/*->rules('required')*/;
            $form->email('email')->rules('required');
            $form->password('password')->rules('confirmed');
            $form->password('password_confirmation');
            $form->textarea('about_me');
            $form->text('degree');
            $form->text('institution');
            $form->text('country');
            $form->text('city');
            $form->text('phone');
            $form->ignore(['password_confirmation']);
        });
    }

}
