<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
       'user_id',
       'lng',
       'lat'
     ];

     public function user(){
       return $this->belongsTo(User::class);
     }
}
