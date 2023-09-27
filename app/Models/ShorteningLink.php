<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShorteningLink extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function click() {
        return $this->hasMany(ClickCount::class);
    }
}
