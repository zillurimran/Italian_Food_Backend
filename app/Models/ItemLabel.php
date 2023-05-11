<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLabel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getLabel(){
        return $this->belongsTo(TrelloLabel::class, 'label_id', 'id');
    }
}
