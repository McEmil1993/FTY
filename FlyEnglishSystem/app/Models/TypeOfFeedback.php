<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfFeedback extends Model
{
    protected $fillable = ['feedback','status'];
}
