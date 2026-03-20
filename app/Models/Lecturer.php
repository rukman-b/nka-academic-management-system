<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lecturer extends Model
{
    use HasFactory;

    protected $fillable =['name','email','phone','department_id','active'];

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


}
