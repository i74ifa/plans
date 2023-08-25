<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    use HasFactory;

    public static $all;

    public const Weekly = 1;

    public const Monthly = 2;

    public const EveryThreeMonth = 3;

    public const Yearly = 4;

    public static function initial()
    {
        self::$all = self::all();
    }
}
