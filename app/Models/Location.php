<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory, ModelQueryTrait, UploadFileTrait;
    protected $guarded = [];

    protected static function booted(): void
    {

        if (!request()->is("admin/*")) {
            static::addGlobalScope('activeWeb', function (Builder $query) {
                $query->where('status', 1);
            });
            static::addGlobalScope('orderedWeb', function (Builder $query) {
                $query->where('phase', 'accepted');
            });
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
