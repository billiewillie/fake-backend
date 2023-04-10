<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extension extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = false;

    public function docs(): HasMany
    {
        return $this->hasMany(Doc::class);
    }
}
