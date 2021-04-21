<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total_students',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * The attributes that will not be displayed.
     *
     * @var array
     */
    protected $hidden = ['classrooms'];

    /**
     * The classrooms that belong to the school.
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    /**
     * Get the total number of students per school.
     *
     * @return int
     */
    public function getTotalStudentsAttribute()
    {
        $classrooms = Classroom::withCount('students')->where('school_id', $this->id)->get();

        if(count($classrooms) >= 1) {
            return $classrooms[0]->students_count;
        }

        return 0;
    }
}
