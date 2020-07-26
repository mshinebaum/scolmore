<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    // Table Name
    protected $table = 'sms';
    // Primary Key
    public $promaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
