<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodFeedBack extends Model
{
    use HasFactory;

    protected $fillable = [ 'manage_id','feed_back_id'];
}
