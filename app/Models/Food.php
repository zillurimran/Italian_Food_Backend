<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory; 

    protected $table = 'food';

    //getAllergies
    public function getAllergies(){
        return $this->belongsToMany(Allergy::class);
    }

    public function getBoutique()
    {
        $this->belongsTo(PickupAddress::class, 'id', 'boutique_name');
    }
}
