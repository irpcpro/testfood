<?php

namespace App\Models;

use App\Enums\DelayReportStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DelayReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'order_id',
        'status',
        'estimate',
        'context',
    ];

    protected $casts = [
        'status' => DelayReportStatusEnum::class
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function agent(): HasOne
    {
        return $this->hasOne(Agent::class, 'id', 'agent_id');
    }

}
