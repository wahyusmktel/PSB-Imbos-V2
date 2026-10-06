<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'pertanyaan',
        'jawaban',
        'urutan',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('urutan', 'asc');
    }
}
