<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class notification_main extends Model
{
    use HasFactory;
    protected $table = 'notification_main';
    protected $fillable =[
        'notification_message',
        'notification_reason',
        'notification_status',
    ];

}
