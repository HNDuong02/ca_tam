<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use TCG\Voyager\Models\Post as VoyagerPost;

class Post extends VoyagerPost
{
    use HasFactory;
    
    protected $guarded = [];

    protected $translatable = ['title', 'slug', 'content', 'meta_title', 'meta_description'];

    public function save(array $options = [])
    {
        // Prevent Voyager from setting author_id since the column doesn't exist
        return \Illuminate\Database\Eloquent\Model::save($options);
    }
}
