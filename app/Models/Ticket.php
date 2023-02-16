<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Ticket extends Model
{
    use HasFactory;
    use Uuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'status',
    ];
    
    protected $appends = ['user_name'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUuidAttribute()
    {
        return bin2hex($this->attributes['uuid']);
    }

    public function getUserNameAttribute() 
    { 
        return $this->user->name; 
    }
}
