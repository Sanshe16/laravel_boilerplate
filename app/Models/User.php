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

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    const ACTIVE = 'active';
    const INACTIVE = 'inactive';


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
        'name' => 'required|string',
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
        'name.required' => 'Last name is required',
    ];

    /**
     * @return array
     */
    public function prepareData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->last_name ?? 'N/A',
            'email' => $this->email ?? 'N/A',
        ];
    }

    /**
     * @var array
     */
    private array $defaultSelect = [
        'id',
        'email',
        'name',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    private array $allowedIncludes = [];

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
    ];


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
