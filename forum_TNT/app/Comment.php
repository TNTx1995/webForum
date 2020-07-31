<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CommentableTrait;
    protected $fillable=['body','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commnetable(){
        return $this->morphTo();
    }




}
