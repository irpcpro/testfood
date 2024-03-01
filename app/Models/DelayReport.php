<?php

namespace App\Models;

use App\Enums\DelayReportStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
