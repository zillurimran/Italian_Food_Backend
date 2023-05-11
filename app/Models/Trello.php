<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trello extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getItem(){
        return $this->hasMany(TrelloItem::class, 'trello_id', 'id')->orderBy('order', 'asc');
    }
}
