<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class admin_smtp_settings extends Model
{
    use HasFactory;
    protected $table = 'smtp_settings';
    protected $fillable =[
        'host',
        'username',
        'password',
        'email',
        'port',
        'protocol',
        'status',
    ];
}
