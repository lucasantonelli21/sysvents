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



    public function scopeSearch($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        if ($request->email) {
            $query->where('email', 'ilike', $request->email);
        }

        if ($request->cpf) {
            $query->where('cpf', 'ilike', '%' . $request->cpf . '%');
        }

        if ($request->phone) {
            $query->where('phone', 'ilike', '%' . $request->phone . '%');
        }
        if ($request->birth_date_min || $request->birth_date_max) {

            if ($request->birth_date_max && $request->birth_date_min) {
                $query->whereBetween('birth_date', [$request->birth_date_min, $request->birth_date_max]);
            } else {
                if ($request->birth_date_min) {
                    $query->where('birth_date', '>=', $request->birth_date_min);
                } else {
                    $query->where('birth_date', '<=', $request->birth_date_max);
                }
            }
        }

        return $query;
    }
}
