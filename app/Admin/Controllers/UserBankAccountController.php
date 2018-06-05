<?php

namespace App\Admin\Controllers;

use App\Models\UserBankAccount;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserBankAccountController extends Controller
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

            $content->header('All Bank Accounts');
            $content->description('Bank Account List');

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

            $account = UserBankAccount::find($id);

            $content->header($account->account_name);
            $content->description('Edit Account');

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

            $content->header('Create Bank Account');
            $content->description('New Bank Account');

            $content->body($this->form());
        });
    }

    public function show($id){
        return Admin::content(function (Content $content) use ($id) {
            $account = UserBankAccount::find($id);

            $content->header($account->account_name);
            $content->description('view account');

            $content->body(view('admin.user_bank_account.show')->with('account', $account));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {
        return Admin::grid(UserBankAccount::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->account_name();
            $grid->bank_name();
            $grid->mobile_number();

            $grid->column('Account Of')->display(function () {
                if ($this->user_id == NULL){
                    return 'Admin';
                }else{
                    return "<a href=\"/admin/website_users/{$this->user_id}\">{$this->user->first_name} {$this->user->last_name}</a>";
                }
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('account_name');
                $filter->equal('bank_name');
                $filter->equal('mobile_number');
                $filter->equal('nid_number');
                $filter->equal('bkash_number');
                $filter->equal('account_number');
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

        return Admin::form(UserBankAccount::class, function (Form $form) {
            $account_user_ids = UserBankAccount::all()->pluck('user_id');

            $form->select('user_id', 'User')->options(User::selectRaw('id, CONCAT(first_name," ",last_name) as full_name')->whereNotIn('id', $account_user_ids)->pluck('full_name', 'id'))->rules('required');
            $form->text('account_name')->rules('required');
            $form->text('bank_name')->rules('required');
            $form->text('mobile_number')->rules('required');
            $form->text('nid_number')->rules('required');
            $form->text('account_number')->rules('required');
            $form->text('bkash_number');
            $form->textarea('details');
        });
    }
}
