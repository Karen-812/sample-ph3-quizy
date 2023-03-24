<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function input_data()
    {
        return $this->hasMany('App\Models\InputData');
    }
}
