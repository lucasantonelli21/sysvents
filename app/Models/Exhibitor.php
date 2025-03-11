<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibitor extends Model
{
    use HasFactory;


    public function scopeSearch($query, $request){
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        if ($request->category) {
            $query->where('category', 'ilike', $request->category);
        }

        return $query;
    }
}
