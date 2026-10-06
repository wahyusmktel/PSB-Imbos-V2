<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendaftarTransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_transaksis';

    // Menggunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'pendaftar_id',
        'biaya_id',
        'tanggal_pembayaran',
        'nama_pengirim',
        'metode_pembayaran',
        'bukti_pembayaran',
        'kode_transaksi',
        'status_pembayaran',
        'status',
        'created_by',
        'updated_by',
    ];

    // Boot method untuk otomatis mengisi UUID saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected $casts = [
        'tanggal_pembayaran' => 'datetime',  // Cast tanggal_pembayaran as datetime
    ];

    /**
     * Relasi ke model AkunPendaftar
     * Setiap transaksi berhubungan dengan satu pendaftar
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id', 'id');
    }

    /**
     * Relasi ke model ConfigBiaya
     * Setiap transaksi terkait dengan satu biaya
     */
    public function biaya()
    {
        return $this->belongsTo(ConfigBiayaModel::class, 'biaya_id');
    }
}
