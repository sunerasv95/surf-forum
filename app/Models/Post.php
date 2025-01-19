<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Post extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            "tags" => "array"
        ];
    }

    //------------------------
    //----- RELATIONSHIPS
    //------------------------

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Get the category that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the post's votes.
     */
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function scopeWithAuthor(Builder $query): Builder
    {
        return $query->with("user", fn($query) => $query->select("id", "name"));
    }

    public function scopeWithCategory(Builder $query): Builder
    {
        return $query->with("category", fn($query) => $query->select("id", "category_name"));
    }

    public function scopeWithCommentsCount(Builder $query): Builder
    {
        return $query->withCount("comments as total_replies");
    }
}
