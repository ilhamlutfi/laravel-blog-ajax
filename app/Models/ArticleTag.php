<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleTag extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'article_tag';

    protected $dates = ['deleted_at'];
}
