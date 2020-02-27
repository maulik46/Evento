<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblstudent extends Model
{
    protected $table='tblstudent';
    public $timestamps=false;
    protected $fillable = [
        'senrl', 'sname', 'rno','clgcode','dob','class','division','email','mobile','address','gender'
    ];
}
