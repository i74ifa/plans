<x-filament-panels::page>
    <x-filament::modal id="subscription-modal">
        @isset($plan->name)
        سوف تقوم بالترقية الى <h1 class="mb-4 text-xl font-bold">{{ __($plan->name) }}</h1>

        <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>تاريخ التجديد القادم</span>
            <span>{{ Date::now()->addMonth()->format('Y/m/d') }}</span>
        </div>

        <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>السعر</span>
            <span>ر.س {{ number_format($bill['price'], 2) }}</span>
        </div>

        <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>الخصم</span>
            <span>ر.س {{ number_format($bill['discount'], 2) }}</span>
        </div>
        <hr class="border-gray-300 dark:border-gray-600" />
        <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>الاجمالي</span>
            <span>ر.س {{ number_format($bill['amount'], 2) }}</span>
        </div>

        <label for="" class="text-gray-700 dark:text-gray-300">مدة الباقة</label>
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model="planTypeId" wire:change='changePlanType'>
                @foreach ($this->planTypes as $type)
                <option value="{{ $type->id }}">{{ __($type->months_count . ' months') }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>

        <button wire:click="submit"
            class="mt-4 w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ترقية</button>
        @endisset
    </x-filament::modal>
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">وسع من قدرات
                    مشروعك</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">تستطيع التغيير الى اي خطة تناسب
                    مشروعك في اي وقت.</p>
            </div>
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                <!-- Pricing Card -->
                @foreach ($this->plans as $plan)
                @php
                $isPlan = $plan->id == $subscription->plan_id
                @endphp
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white {{ $isPlan ? 'border border-gray-300 dark:border-gray-600 shadow-none' : '' }}">
                    <h3 class="mb-4 text-2xl font-semibold">{{ __($plan->name) }}</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">{{ $plan->description }}
                    </p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-4xl font-extrabold text-gray-700 dark:text-gray-300">{{ $plan->price == 0
                            ? 'مجانا' :
                            $plan->price . 'ر.س'
                            }}</span>
                    </div>
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        @foreach ($plan->features as $feature)
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @if (!$isPlan)
                    <button type="button" wire:click="openModal({{ $plan->id }})"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">اشترك</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-filament-panels::form wire:click="register">
        {{ $this->form }}

    </x-filament-panels::form>
</x-filament-panels::page>
