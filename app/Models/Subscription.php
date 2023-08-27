<?php

namespace App\Models;

use App\Casts\DateForHuman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a subscription trail for the given user.
     * Initial the subscription
     *
     * @param User $user The user object.
     * @return void
     */
    public static function trail(User $user): void
    {
        $user->subscription()->firstOrCreate([
            'plan_id' => null,
            'plan_type_id' => 0,
            'expire_at' => now()->addWeek(),
        ]);
    }

    public function subscription($planId, $period)
    {
        return $this->update([
            'plan_id' => $planId,
            'period' => $period,
            'expire_at' => now()->modify($period),
        ]);
    }

    public function renewal()
    {
        //
    }
}
