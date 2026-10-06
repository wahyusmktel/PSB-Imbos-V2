<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LandingSlider extends Model
{
    use HasFactory;

    protected $table = 'landing_sliders';
    protected $guarded = ['id'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Scope helper untuk slider halaman auth (login & register)
     */
    public function scopeAuthSliders($query)
    {
        return $query->where('type', 'auth')->where('status', true)->orderBy('urutan', 'asc');
    }
}
