<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PendaftarJenjangModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_jenjangs';
    
    // Use UUID for primary key
    protected $keyType = 'string';
    public $incrementing = false;

    // Columns that can be filled
    protected $fillable = [
        'id',
        'pendaftar_id',
        'jenjang_id',
        'status',
        'created_by',
        'updated_by'
    ];

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

    // Relationship with AkunPendaftar (pendaftar_id)
    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }

    // Relationship with ConfigJenjang (jenjang_id)
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(ConfigJenjangModel::class, 'jenjang_id');
    }
}
