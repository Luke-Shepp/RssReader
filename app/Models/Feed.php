<?php

namespace App\Models;

use App\Scopes\CurrentUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feed extends Model
{
    /** @var array */
    protected $fillable = [
        'user_id',
        'url'
    ];

    /**
     * Register scopes
     */
    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope(new CurrentUser());
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
