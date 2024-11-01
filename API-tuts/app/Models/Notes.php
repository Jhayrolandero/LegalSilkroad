<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    // protected $primaryKey = 'note_id';
    protected $table = 'notes';
    protected $fillable = ['title', 'content','user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
