<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputData extends Model
{
    use HasFactory;
    public function language()
    {
        return $this->belongsTo('App\Models\language');
    }
    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }
}
