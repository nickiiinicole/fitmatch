<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone'];
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'coach_id');
    }
}
