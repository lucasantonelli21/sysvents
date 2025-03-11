<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    //

    public function scopeSearch($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }


        if ($request->fee) {
            $query->where('fee', 'ilike', '%' . $request->fee . '%');
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
