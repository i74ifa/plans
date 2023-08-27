<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PlanType extends Model
{
    use HasFactory;

    public static Collection $all;

    public const Monthly = 1;

    public const EveryThreeMonth = 2;

    public const Yearly = 3;

    public static function initial()
    {
        self::$all = self::all();
    }


    public static function monthly($attribute = null)
    {
        if ($attribute) {
            return self::$all->find(self::Monthly)->{$attribute};
        }

        return self::$all->find(self::Monthly);
    }

    public static function yearly($attribute = null)
    {
        if ($attribute) {
            return self::$all->find(self::Yearly)->{$attribute};
        }

        return self::$all->find(self::Yearly);
    }
}
