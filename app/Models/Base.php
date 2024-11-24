<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;

    protected $table = 'base'; // Table name

    protected $fillable = ['cityname', 'latitude', 'longitude', 'status']; // Fillable columns
}
