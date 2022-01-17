<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use Sluggable;
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function author()
    {
        return $this->hasOne(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id',
        );
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
// $post = Post::find(1);
// $post->category->title;
// $post->tags;
// $post->author->name;
// $post->author->email;
