<?php

namespace App\Filament\Customer\Pages\Tenancy;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Pages\SimplePage;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterCustomer extends Page
{
    protected static string $layout = 'filament-panels::components.layout.simple';

    protected static $type = 'customer';

    protected static string $view = 'filament.customer.pages.tenancy.register-customer';

    protected ?string $heading = 'التسجيل';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    protected string $userModel;

    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;


    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->intended('/customer');
        }

        $this->form->fill();
    }

    public static function getLabel(): string
    {
        return 'Register Customer';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('الاسم'),
                TextInput::make('email')->email()->required()->label('البريد الالكتروني'),
                TextInput::make('password')->password()->required()->label('كلمة المرور'),
                Actions::make([
                    Action::make('submit')->label('تسجيل')->action(function () {
                        $this->handleRegistration();
                    }),
                ])
            ]);
    }
    protected function handleRegistration()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];

        $data['type'] = 'subscription';
        $user = User::create($data);
        Subscription::trail($user);
        Auth::login($user);

        return redirect()->intended('/customer');
    }
}
