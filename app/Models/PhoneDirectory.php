<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model
{
    use HasFactory;

    protected $guarded = []; // this is the line that allows mass assignment
}
