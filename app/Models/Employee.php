<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'firstLastName',
        'secondLastName',
        'firstName',
        'middleName',
        'country',
        'typeId',
        'doc',
        'email',
        'startDate',
        'area',
        'state',
    ];
}
