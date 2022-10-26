<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\AvisoUserCreated;

class AvisoUser extends Model
{
    protected $table = 'aviso_user';
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => AvisoUserCreated::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }
}
