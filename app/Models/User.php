<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens;
    use SoftDeletes;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'idRole',
        'idStudent',
        'idProfesseur',
        'idStaff',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getUsers()
    {
        return User::select('*')
            ->leftJoin('roles', 'users.idRole', '=', 'roles.idRole')
            ->orderBy('codeRole')
            ->get();
    }

    public static function getUser($username)
    {
        return User::select('*')
            ->leftJoin('roles', 'users.idRole', '=', 'roles.idRole')
            ->where('username', $username)->first();
    }

    public static function createStudentAccount($idStudent, $name, $username)
    {
        $role = Roles::getStudentRole();
        $password = Str::random(8);
        User::create([
            'name' => $name,
            'idStudent' => $idStudent,
            'username' => $username,
            'idRole' => $role->idRole,
            'password' => Hash::make($password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $password;
    }

    public static function createProfAccount($idProfesseur, $name, $username)
    {
        $role = Roles::getProfRole();
        $password = Str::random(8);
        User::create([
            'name' => $name,
            'idProfesseur' => $idProfesseur,
            'username' => $username,
            'idRole' => $role->idRole,
            'password' => Hash::make($password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $password;
    }

    public static function createStaffAccount($idStaff, $name, $username)
    {
        $role = Roles::getStaffRole();
        $password = Str::random(8);
        User::create([
            'name' => $name,
            'idStaff' => $idStaff,
            'username' => $username,
            'idRole' => $role->idRole,
            'password' => Hash::make($password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return $password;
    }

    public static function checkUsername($username)
    {
        return User::select('*')
            ->where('username', $username)
            ->count();
    }


    public static function checkEmail($email)
    {
        return User::select('*')
            ->where('email', $email)
            ->count();
    }

    /* -------------------------------
    / Reset Password
    / -------------------------------*/
    public static function resetPassword($id, $password)
    {
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->save();
    }

    public static function deleteStaffAccount($idStaff)
    {
        User::where('idStaff', $idStaff)
            ->delete();
    }
    public static function deleteProfAccount($idProfesseur)
    {
        User::where('idProfesseur', $idProfesseur)->delete();
    }
    public static function deleteStudentAccount($idStudent)
    {
        User::where('idStudent', $idStudent)->delete();
    }
    // force delete
    public static function forceProfAccount($idProfesseur)
    {
        User::withTrashed()->where('idProfesseur', $idProfesseur)
            ->forceDelete();
    }
    public static function forceStaffAccount($idStaff)
    {
        User::withTrashed()->where('idStaff', $idStaff)
            ->forceDelete();
    }
    public static function forceStudentAccount($idStudent)
    {
        User::withTrashed()->where('idStudent', $idStudent)
            ->forceDelete();
    }
}
