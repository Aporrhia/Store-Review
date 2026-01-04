<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'comment_writer_id',
        'comment_receiver_id',
        'title',
        'comment'
    ];
    // The user who received the comment
    public function commentReceiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'comment_receiver_id');
    }

    // The user who wrote the comment
    public function commentWriter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'comment_writer_id');
    }
    // Replies to this comment
    public function replies()
    {
        return $this->hasMany(CommentReply::class, 'comment_id');
    }
}
