<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class AkunPendaftar extends Model implements AuthenticatableContract
{

    use HasFactory, Authenticatable; // Menggunakan trait Authenticatable

    use HasFactory;

    protected $table = 'akun_pendaftars';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nisn',
        'asal_sekolah',
        'no_hp',
        'username',
        'password',
        'no_pendaftaran',
        'gelombang',
        'status',
        'created_by',
        'updated_by'
    ];

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function pendaftarJalur()
    {
        return $this->hasOne(PendaftarJalurModel::class, 'pendaftar_id', 'id');
    }

    public function pendaftarJenjang()
    {
        return $this->hasOne(PendaftarJenjangModel::class, 'pendaftar_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne(PendaftarTransaksiModel::class, 'pendaftar_id');
    }

    // Relasi ke tabel pendaftar_alamats
    public function alamat()
    {
        return $this->hasOne(PendaftarAlamatModel::class, 'pendaftar_id', 'id');
    }

    public function biodataDiri()
    {
        return $this->hasOne(BiodataDiriModel::class, 'id_pendaftar', 'id');
    }

    public function biodataOrangTua()
    {
        return $this->hasOne(BiodataOrangTuaModel::class, 'pendaftar_id', 'id');
    }

    public function pendaftarPenyakit()
    {
        return $this->hasOne(BiodataPenyakitModel::class, 'pendaftar_id', 'id');
    }

    public function pendaftarBerkas()
    {
        return $this->hasOne(PendaftarBerkas::class, 'pendaftar_id', 'id');
    }

    public function hasilSeleksi()
    {
        return $this->hasOne(HasilSeleksiModel::class, 'pendaftar_id', 'id');
    }
}
