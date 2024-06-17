<?php

// app/Models/InteractionLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteractionLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact_id', 'type', 'interaction_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
