<?php

class BlogPost extends Eloquent {
    protected $fillable = array('title', 'body', 'author_id');

    public function author()
    {
        return $this->belongsTo('User');
    }
}
