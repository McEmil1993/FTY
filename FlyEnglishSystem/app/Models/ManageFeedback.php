<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageFeedback extends Model
{
    protected $fillable = [ 'date',
                            'student_id',
                            'book_id',
                            'good_feedback_id',
                            'improve_feedback_id',
                            'mispronounce',
                            'incorrect',
                            'correct',
                            'check_homework',
                            'topic',
                            'homework'
                            ];
}
