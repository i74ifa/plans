<x-filament-panels::page>
    <h1 class="fi-simple-header-heading text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
        تسجيل حساب جديد
    </h1>
    <div class="flex items-center justify-center gap-x-1">
        <span class="text-sm text-gray-500"> او</span>
        <a style="--c-300:var(--primary-300);--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
            class="fi-link fi-link-size-md relative inline-flex items-center justify-center font-semibold outline-none transition duration-75 hover:underline focus:underline gap-1.5 text-sm text-custom-600 dark:text-custom-400 fi-ac-link-action"
            href="/customer/login">
            دخول
        </a>
    </div>
    <x-filament-panels::form wire:submit="register">

        {{ $this->form }}

    </x-filament-panels::form>
</x-filament-panels::page>
