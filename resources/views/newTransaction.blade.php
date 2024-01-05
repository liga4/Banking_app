<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Transaction') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">

            <form action="{{ route('newTransaction') }}" method="POST">
                @csrf

                <div class="mt-4">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$oldUser->name ?? ''" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="surname" :value="__('Surname')" />
                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="$oldUser->surname ?? ''" required />
                </div>

                <div class="mt-4">
                    <x-label for="account_number" :value="__('Account Number')" />
                    <x-input id="account_number" class="block mt-1 w-full" type="text" name="account_number" :value="$oldAccount->account_number ?? ''" required />
                </div>
                @if ($errors->has('account_number'))
                    <div class="alert alert-danger error-message" style="color: red">
                        {{ $errors->first('account_number') }}
                    </div>
                @endif
                @if ($errors->has('name') || $errors->has('surname'))
                    <div class="alert alert-danger error-message" style="color: red">
                        {{ $errors->first('name') }}
                    </div>
                @endif

                <div class="mt-4">
                    <x-label for="amount" :value="__('Amount')" />
                    <x-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="$oldTransaction ? number_format($oldTransaction->amount / 100, 2) : ''" required />
                </div>
                @if ($errors->has('amount'))
                    <div class="alert alert-danger error-message" style="color: red">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <div class="mt-4">
                    <x-label for="reference" :value="__('Reference')" />
                    <x-input id="reference" class="block mt-1 w-full" type="text" name="reference" :value="$oldTransaction->reference ?? ''"  required />
                </div>

                <x-button>
                    {{ __('Submit') }}
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>

