<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'level_education',
        'serie',
        'shift',
        'school_id',
    ];

    /**
     * The attributes that will not be displayed.
     *
     * @var array
     */
    protected $hidden = ['pivot', 'school_id'];

    /**
    * The students that belong to the classroom.
    */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student');
    }

    /**
    * Get the school that owns the classroom.
    */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
