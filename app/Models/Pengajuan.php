<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class pengajuan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function __construct()
    {
        $this->table = 'Pengajuan_approved';
        $this->pk = 'id';
    }

    protected $fillable = [
        'Nama_Layanan',
        'Kelurahan',
        'nama_verification_kelurahan',
        'Nama_Penandatangan_kelurahan',
        'Kecamatan',
        'Nama_verification_kecamatan',
        'nama_penandatangan_kecamatan',
        'No_surat',
        'id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
