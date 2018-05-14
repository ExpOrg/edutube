<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
use App\Admin\Extensions\CustomActions;
use Encore\Admin\Grid\Column;
use Carbon\Carbon;

//Encore\Admin\Form::forget(['map', 'editor']);
app('view')->prependNamespace('admin', resource_path('views/admin'));

Column::define('__actions__', CustomActions::class);

Column::extend('date_format', function ($value) {
    $parseDate = new DateTime($value, new DateTimezone('Asia/Dhaka'));
    return $parseDate->format('F j, Y, g:i a');
});

