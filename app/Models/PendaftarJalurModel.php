<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PendaftarJalurModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_jalurs';

    protected $fillable = [
        'id',
        'pendaftar_id',
        'jalur_id',
        'status',
        'created_by',
        'updated_by',
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    // Boot function to auto-generate UUID for 'id'
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relationship with AkunPendaftar
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }

    // Relationship with ConfigJalur
    public function jalur()
    {
        return $this->belongsTo(ConfigJalurModel::class, 'jalur_id');
    }
}