<?php

namespace App\Models;

use App\Enums\GendersEnum;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Timestamp;

    protected $fillable = [
        'name',
        'general_record',
        'registration_physical_person',
        'birth_date',
        'gender',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'gender' => GendersEnum::class,
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
