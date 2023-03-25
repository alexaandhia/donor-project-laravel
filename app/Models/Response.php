<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donor;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'donor_id',
        'status',
        'date',
    ];

    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
