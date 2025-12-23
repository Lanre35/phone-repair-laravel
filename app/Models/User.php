<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has the given role (string).
     */
    public function hasRole(string $role): bool
    {
        return isset($this->role) && strcasecmp($this->role, $role) === 0;
    }

    
    /**
     * Check if user has any of the given roles (array).
     */
    public function hasAnyRole(array $roles): bool
    {
        if (! isset($this->role)) {
            return false;
        }
        $current = strtolower($this->role);
        foreach ($roles as $r) {
            if ($current === strtolower(trim((string)$r))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Assign a role to the user and save.
     */
    // public function assignRole(string $role): self
    // {
    //     $this->role = $role;
    //     $this->save();
    //     return $this;
    // }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
