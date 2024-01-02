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
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="surname" :value="__('Surname')" />
                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required />
                </div>

                <div class="mt-4">
                    <x-label for="account_number" :value="__('Account Number')" />
                    <x-input id="account_number" class="block mt-1 w-full" type="text" name="account_number" :value="old('account_number')" required />
                </div>

                <div class="mt-4">
                    <x-label for="amount" :value="__('Amount')" />
                    <x-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="old('amount')" required />
                </div>
                @if ($errors->has('amount'))
                    <div class="alert alert-danger error-message">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <div class="mt-4">
                    <x-label for="reference" :value="__('Reference')" />
                    <x-input id="reference" class="block mt-1 w-full" type="text" name="reference" :value="old('reference')" required />
                </div>

                <x-button>
                    {{ __('Submit') }}
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>

