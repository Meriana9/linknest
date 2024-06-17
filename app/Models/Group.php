<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Définir les relations si nécessaire, par exemple, si un groupe a plusieurs contacts
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
