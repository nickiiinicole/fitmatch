<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes'; // si el nombre no coincide con "class_models"
    protected $fillable = [
        'name',
        'description',
        'capacity',
        'date',
        'time',
        'duration',
        'coach_id'
    ];

    // Relación con las reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'class_id');
    }
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }

}
