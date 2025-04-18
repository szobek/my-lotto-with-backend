<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }
    public function ticketsData()
    {
        return $this->hasMany(Ticket::class);
    }
    private function rolesData()
    {
        return $this->hasMany(UserRole::class);
    }

    public function hasRole(int $userRole)
    {
        $roles=$this->rolesData()->get();

        foreach ($roles as $role) {
            if ($role->role_id === $userRole) {
                return true;
            }
        }
        return false;
    }
    public function formatName(string $name){
        return "Ticket owner: $name";
    }
}
