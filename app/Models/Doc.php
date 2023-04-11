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

    // ?department_id=1
    public function scopeDepartmentId($query, $request)
    {
        if ($request->query('department_id')) {
            return $query->where('department_id', intval($request->query('department_id')));
        }

        return $query;
    }

    // ?extension_id=1
    public function scopeExtensionId($query, $request)
    {
        if ($request->query('extension_id')) {
            return $query->where('extension_id', intval($request->query('extension_id')));
        }

        return $query;
    }

    public function scopeIsPublished($query)
    {
        return $query->where("is_published", 1)
            ->where("published_date", "<", now())
            ->where("unpublished_date", null);
    }

    public function scopeSearch($query, $request)
    {
        if ($request->query('search')) {
            return $query
                ->where('title', 'like', '%' . $request->query('search') . '%')
                ->orWhere('file', 'like', '%' . $request->query('search') . '%');
        }
    }

    public function scopeOrder($query, $request)
    {
        if ($request->query('sort') === 'alphabetical') {
            return $query->orderBy('title');
        }

        return $query->orderBy(
            request('sort', 'published_date'),
            request('order', 'desc'));
    }
}
