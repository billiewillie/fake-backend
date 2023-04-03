<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Comment extends Model
    {
        use HasFactory;

        protected $guarded = false;

        public function post(): BelongsTo
        {
            return $this->belongsTo(Post::class);
        }

        public function parent(): BelongsTo
        {
            return $this->belongsTo(static::class);
        }
    }
