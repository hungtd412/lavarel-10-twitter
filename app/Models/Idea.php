<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $withCount = ['likes'];

    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];


    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    //define properties that could be assigned
    protected $fillable = [
        'user_id',
        'content',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }
}
