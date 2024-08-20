<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class SysUsers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function __construct()
    {
        $this->table = 'sys_users';
        $this->pk = 'user_id';
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_username', 'user_name', 'user_email', 'user_phone', 'user_nip', 'kd_kel', 'user_password', 'user_phone', 'group_id', 'is_active', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected $primaryKey 	= "user_id";

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() 
    {
        return $this->user_password;
     }

    public function getByNIK($nik)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where('user_nik', '=', $nik)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } 

    public function getByAdmin($nik)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where('user_id_simkel', '=', $nik)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function getByEmail($email)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where('user_email', '=', $email)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where('user_id', '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateData(array $data, $id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where($this->primaryKey, '=', $id)
                ->update($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
