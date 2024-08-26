<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scene extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'button',
      'parent_id',
      'redirect_id',
      'button_redirect'
    ];

    //The connected father of the scene/route
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Scene::class, 'parent_id');
    }

    //Connected options for this scene/route
    public function children(): HasMany
    {
        return $this->hasMany(Scene::class, 'parent_id');
    }

    //Redirects to a previous route or hops to a different route
    public function redirect(): BelongsTo
    {
        return $this->belongsTo(Scene::class, 'redirect_id');
    }
}
