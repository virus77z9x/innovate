<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['class_name'];
    public $table = 'classrooms';
    protected $fillable = [
        'class_name',
        'notes',
        'grade_id'];

    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
