<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $guarded = ['name','logo'];

    public function player(){
        return $this->hasMany(Players::class,'team_id','id');
    }

    public function getLogoAttribute($value){
        return asset('storage/'.$value);
    }
}
