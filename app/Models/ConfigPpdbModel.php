<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConfigPpdbModel extends Model
{
    use HasFactory;

    protected $table = 'config_ppdbs';

    protected $guarded = ['id'];

    public $incrementing = false;
    protected $keyType = 'string';

    // Automatically generate a UUID when creating a new record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Example of a method that can be used to get active PPDB config
    public static function getActiveConfig()
    {
        return self::where('status', true)->first();
    }
}
