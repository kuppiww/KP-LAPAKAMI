<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
}
