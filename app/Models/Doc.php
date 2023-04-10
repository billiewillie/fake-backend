<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doc extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function extension(): BelongsTo
    {
        return $this->belongsTo(Extension::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }
}
