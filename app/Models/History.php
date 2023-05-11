<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function getGroup(){
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
