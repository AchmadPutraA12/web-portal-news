<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryArticle::class, 'category_id');
    }
}
