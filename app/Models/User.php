<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE = 0;

    const INACTIVE = 1;

    const STATUS_ARR = [
        self::ACTIVE => 'Active',
        self::INACTIVE => 'InActive',
    ];

    const THEME_DARK_MODE = 1;

    const THEME_LIGHT_MODE = 0;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email:filter|unique:users,email',
        'password' => 'nullable|same:password_confirmation|min:6',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @var array
     */
    protected $appends = ['encrypted_id', 'full_name'];

    /**
     * @var array
     */
    public static $messages = [
        'first_name.required' => 'First name is reuired',
        'last_name.required' => 'Last name is reuired',
    ];

    /**
     * @return array
     */
    public function prepareData(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name ?? 'N/A',
            'last_name' => $this->last_name ?? 'N/A',
            'email' => $this->email ?? 'N/A',
        ];
    }


    /**
     * @return string
     */
    public function getEncryptedIdAttribute()
    {
        return encrypt($this->id);
    }


    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}