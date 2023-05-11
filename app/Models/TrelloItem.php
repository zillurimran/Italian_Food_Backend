<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrelloItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getItemMemebers(){
        return $this->hasMany(TrelloItemMember::class, 'item_id', 'id');
    }

    public function getItemLabels(){
        return $this->hasMany(ItemLabel::class, 'item_id', 'id');   
    }

    public function getChecklists(){
        return $this->hasMany(ItemChecklist::class, 'item_id', 'id');
    }

    public function getActivity(){
        return $this->hasMany(ItemActivity::class, 'item_id', 'id');
    }
}
