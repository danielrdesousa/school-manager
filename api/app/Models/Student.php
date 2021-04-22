<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'gender',
    ];

    /**
     * The attributes that will not be displayed.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * The classrooms that belong to the student.
     */
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'students_classrooms', 'student_id');
    }
}
