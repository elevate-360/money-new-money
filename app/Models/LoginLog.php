<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'tblUserLoginLog';
    protected $primaryKey = 'logId';
    // Disable timestamps for this model
    public $timestamps = false;
}
