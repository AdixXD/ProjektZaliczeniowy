<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
     //relacja 1:1 dla Debtor i User:
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
