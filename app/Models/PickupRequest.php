<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'description',
        'jenis_sampah',
        'status',
        'admin_id',
        'pickup_time',
        'admin_notes'
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
        'status' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}