<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function orders(){
        return $this->hasMany(MyOrder::class, 'order_status', 'id')->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }
}
