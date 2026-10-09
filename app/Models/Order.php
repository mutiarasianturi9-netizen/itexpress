<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Status;
use App\Models\Service;
use App\Models\Technician;
use App\Models\Review;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'technician_id',
        'service_id',
        'status_id',
        'customer_name',
        'phone',
        'address',
        'date',
        'problem',
        'photo',
    ];
    
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technician(){
        return $this->belongsTo(Technician::class);
    }

    public function status()
{
    return $this->belongsTo(Status::class);
}
public function service()
{
    return $this->belongsTo(Service::class);
}
    }