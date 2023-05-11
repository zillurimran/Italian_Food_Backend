<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getMember(){
        return $this->belongsTo(User::class, 'member', 'id');
    }
}
