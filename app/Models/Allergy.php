<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{   
    public $fillable = ['name'];
    use HasFactory;
//getFoods
public function getFoods(){
    return $this->belongsToMany(Food::class);
}
}
