<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'description',
        'image_path',
        'status',
        'latitude',
        'longitude',
        'dispatch_date',
        'completion_date'
    ];

    protected $casts = [
        'dispatch_date' => 'date',
        'completion_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}