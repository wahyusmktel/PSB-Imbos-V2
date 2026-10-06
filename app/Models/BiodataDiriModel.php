<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BiodataDiriModel extends Model
{
    use HasFactory;

    protected $table = 'biodata_diris';
    
    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'id_pendaftar',
        'alamat_asal_sekolah',
        'ukuran_baju',
        'pas_photo',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'anak_ke',
        'jumlah_saudara',
        'tinggi_badan',
        'berat_badan',
        'jumlah_saudara_tiri',
        'jumlah_saudara_angkat',
        'bahasa_sehari_hari',
        'bakat_dan_prestasi',
        'status',
        'created_by',
        'updated_by',
    ];

    // Event untuk membuat UUID otomatis
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
     * Relasi ke model AkunPendaftar
     * Setiap biodata akan berhubungan dengan satu pendaftar
     */

    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }
}
