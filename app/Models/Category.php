<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model
{

	use Sluggable;
	use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'image','title', 'description'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Course', 'category_course', 'category_id', 'course_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'category_course', 'category_id', 'course_id');
    }

}
