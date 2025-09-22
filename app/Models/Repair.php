<?php

namespace App\Models;


use App\Enums\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Repair extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'repairs';

    protected $fillable = [
        'ticket_number',
        'customer_id',
        'phone_number',
        'device_brand',
        'device_brand_id',
        'device_model',
        'device_model_id',
        'issue_description',
        'status_id',
        'priority_id',
        'estimated_cost',
        'final_cost',
        'repair_date',
        'completion_date',
        'notes'
    ];

    protected $casts = [
        'repair_date' => 'date',
        'completion_date' => 'date',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'device_brand_id');
    }

    public function phoneModel()
    {
        return $this->belongsTo(PhoneModel::class, 'device_model_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function priority()
    {
        return $this->belongsTo(PriorityModel::class, 'priority_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($repair) {
            $repair->ticket_number = 'TKT-' . strtoupper(uniqid());
        });

    }
}
