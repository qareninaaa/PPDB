<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $table = 'calon_siswa';

    protected $fillable = [
       'user_id',
       'nisn',
       'nama',
       'alamat',
       'tanggal_lahir',
       'jenis_kelamin',
       'sekolah_asal',
       'status',

       ];

    public function berkas()
    {
        return $this->hasOne(Berkas::class, 'calon_siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
