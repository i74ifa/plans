<?php

namespace App\Models;

use App\Casts\DateForHuman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $period = '+7 day';
        $user->subscription()->firstOrCreate([
            'plan_id' => 1,
            'period' => $period,
            'expire_at' => now()->modify($period),
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
