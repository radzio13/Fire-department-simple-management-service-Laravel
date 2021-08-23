<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Tag;


class Post extends Model
{
	use SoftDeletes;

    protected $fillable = ['title','description','content',  'image', 'category_id'];


    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function tags() {
    	return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId) {
    	return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
}
