<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'body',
        'image',
        'category_id',
        'user_id',
        'featured',
        'published',
        'trending',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getRouteKey()
	{
	    return $this->slug;
	}
	public function getRouteKeyName()
	{
	    return 'slug';
	}
    public function incrementViewCount()
    {
        $this->views++;
        return $this->save();
    }
}
