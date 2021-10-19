<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function team(){
        return $this->belongsTo(Teams::class,'team_id','id');
    }

    public function getImageAttribute($value){
        return asset('storage/'.$value);
    }
}
