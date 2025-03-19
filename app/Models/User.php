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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
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



    public function scopeEvents($query, $id)
    {
        $query->from('users as u')->join('tickets as t', 't.user_id', '=', 'u.id')
            ->join('ticket_batches as tb', 't.ticket_batch_id', '=', 'tb.id')
            ->join('ticket_types as tp', 'tb.ticket_type_id', '=', 'tp.id')
            ->join('events as e', 'tp.event_id', '=', 'e.id')
            ->where('u.id', $id)
            ->select([
                'u.id',
                'u.name',
                'e.id as event_id',
                'e.name as event_name',
                'e.start_date',
                'e.end_date',
                'e.description as event_description',
                'e.image_path as path'
            ]);
        return $query;
    }

    public function scopeEvent($query, $id, $eventId)
    {
        $query->from('users as u')->join('tickets as t', 't.user_id', '=', 'u.id')
            ->join('ticket_batches as tb', 't.ticket_batch_id', '=', 'tb.id')
            ->join('ticket_types as tp', 'tb.ticket_type_id', '=', 'tp.id')
            ->join('events as e', 'tp.event_id', '=', 'e.id')
            ->where('u.id', $id)
            ->select([
                'u.id',
                'u.name',
                'e.id as event_id',
                'e.name as event_name',
                'e.start_date',
                'e.end_date',
                'e.description as event_description',
                'e.theme as event_theme',
                'e.image_path as path',
                't.owner_name as ticket_owner',
                't.owner_cpf as ticket_owner_cpf',
            ]);
        $query->where('e.id', $eventId);
        return $query;
    }
}
