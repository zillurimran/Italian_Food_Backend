<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemChecklist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function getItems(){
        return $this->hasMany(ChecklistItem::class, 'checklist_id', 'id');
    }
}
