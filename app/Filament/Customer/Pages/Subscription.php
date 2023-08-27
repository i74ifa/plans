<?php

namespace App\Filament\Customer\Pages;

use App\Models\Bill;
use App\Models\Plan;
use App\Models\PlanType;
use Filament\Actions\Action;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use stdClass;

class Subscription extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.customer.pages.subscription';

    protected static ?string $navigationLabel = 'الاشتراك';

    protected static ?string $title = 'اشتراكك';

    public Collection $plans;

    public $subscription;
    public $plan;

    /**
     * plan type id
     */
    public $planTypeId;

    /**
     * all plan types
     */
    public $planTypes;

    /**
     * Summary of bill
     */
    public ?array $bill;

    public function mount(): void
    {
        $this->plans = Plan::where('id', '>', 1)->get();
        $this->planTypes = PlanType::$all;
        $this->subscription = auth()->user()->subscription;
        $this->planTypeId = PlanType::Monthly;
        $this->bill = [];
    }

    public function changePlanType(): void
    {
        $type = PlanType::$all->find($this->planTypeId);
        $amount = $this->plan->price * $type->months_count;
        $discount = $amount * ($type->discount / 100);
        $this->bill['price'] = $amount;
        $this->bill['discount'] = $discount;
        $this->bill['amount'] = $amount - $discount;
    }

    public function openModal($id)
    {
        $this->plan = $this->plans->find($id);
        $this->bill['price'] = $this->plan->price;
        $this->bill['discount'] = 0;
        $this->bill['amount'] = $this->plan->price;
        $this->dispatch('open-modal', id: 'subscription-modal');
    }

    public function submit()
    {
        $user = Auth::user();
        $planType = PlanType::$all->find($this->planTypeId);
        Notification::make()
            ->title('تم ترقية الاشتراك بنجاح')
            ->success()
            ->send();
        $this->dispatch('close-modal', id: 'subscription-modal');
        $user->subscription()->update([
            'plan_id' => $this->plan->id,
            'expire_at' => Date::now()->modify($planType->months_count . ' months'),
            'plan_type_id' => PlanType::find(PlanType::Monthly)->id,
        ]);
        Bill::create([
            'user_id' => $user->id,
            'plan_id' => $this->plan->id,
            'discount' => $this->bill['discount'],
            'amount' => $this->bill['amount'],
        ]);
    }

    public function subscription()
    {
        return auth()->user()->subscription;
    }
}
