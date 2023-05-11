<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getAssignee(){
        return $this->belongsToMany(User::class, 'planning_assigns', 'planning_id', 'user_id');
    }

    public function getTrello(){
        return $this->hasMany(Trello::class, 'planning_id', 'id')->orderBy('order', 'asc');
    }
}
