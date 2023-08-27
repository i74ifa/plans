<?php

namespace App\Providers\Filament;

use App\Filament\Customer\Pages\Tenancy\RegisterCustomer;
use App\Models\Subscription;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CustomerPanelProvider extends PanelProvider
{

    public $test;
    public function mounted(): void
    {
        $this->test = 'test';
    }

    public function panel(Panel $panel): Panel
    {
        // $f = 'f';
        return $panel
            ->id('customer')
            ->path('customer')
            ->login()
            ->registration(RegisterCustomer::class)
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->discoverResources(in: app_path('Filament/Customer/Resources'), for: 'App\\Filament\\Customer\\Resources')
            ->discoverPages(in: app_path('Filament/Customer/Pages'), for: 'App\\Filament\\Customer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('الاعدادات')
                    ->url(fn (): string => '/settings')
                    ->icon('heroicon-o-cog-6-tooth'),
                // ...
            ])->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->viteTheme('resources/css/filament/customer/theme.css')
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function getSubscription()
    {
        return auth()->user()->subscription;
    }
}
