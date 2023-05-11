<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function food(){
        return $this->belongsTo(FoodsOffer::class, 'food_id', 'id');
    }

    public function status(){
        return $this->belongsTo(OrderStatus::class, 'order_status','id');
    }

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

    public function getCustomer(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}

