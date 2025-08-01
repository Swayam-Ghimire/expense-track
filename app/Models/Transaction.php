<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['amount', 'description', 'transaction_date', 'user_id', 'category_id'];
    /** @use HasFactory<\Database\Factories\TransationFactory> */
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Categories::class);
    }
}
