<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasFactory;

    public function scopeSearch($query, $request){
        if ($request->name) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        if ($request->theme) {
            $query->where('theme', 'ilike', $request->theme);
        }

        return $query;
    }

    protected function casts():array {
        return [
            "start_date" => "datetime"
        ];
    }

}
