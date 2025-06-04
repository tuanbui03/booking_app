<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'room_number', 'room_type', 'price', 'capacity'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function availables()
    {
        return $this->hasMany(Available::class);
    }
}
