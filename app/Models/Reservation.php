<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'class_id'
    ];

    // Relación con la clase
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
