<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'company',
        'date_of_birth',
        'notes',
        'profile_image',
        'last_contacted_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_contact');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_contact');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function interactionLogs()
    {
        return $this->hasMany(InteractionLog::class);
    }
}
