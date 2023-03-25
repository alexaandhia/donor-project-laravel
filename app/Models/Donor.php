<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;

class Donor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'age',
        'weight',
        'type',
        'email',
        'foto',

    ];

    public function response(){
        return $this->hasOne(Response::class);
    }
}
