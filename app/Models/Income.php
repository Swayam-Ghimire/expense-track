<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;
    protected $fillable = ['monthly_income', 'date', 'user_id', 'created_date'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
