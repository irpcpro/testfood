<?php


namespace App\Enums;

enum DelayReportStatusEnum:int
{
    case PENDING = 1;
    case ASSIGNED = 2;
    case SOLVED = 3;
}
