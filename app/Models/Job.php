<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'salary', 'location', 'schedule', 'url', 'featured'
    ];
    
    public function tag(string $name): void
    {
        $tag = Tag::firstOrCreate(['name' => trim($name)]);
        $this->tags()->attach($tag);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

        // Add this cast for featured
    protected $casts = [
        'featured' => 'boolean'
     ];

}
