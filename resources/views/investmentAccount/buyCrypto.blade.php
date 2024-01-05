<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Crypto') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center h-full">
        <form action="{{ route('buyCrypto') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <img src="{{$logo}}" alt="{{$name}}" width="200" height="200">
            <div class="mb-4">
                <label for="cryptoName" class="block text-gray-700 font-bold mb-2"> {{$name}}</label>
            </div>
            <div class="mb-4">
                <label for="exchangeRate" class="block text-gray-700 font-bold mb-2">Exchange Rate: {{$exchange_rate}}</label>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-bold mb-2">For how much you want to buy:</label>
                <input type="number" id="amount" name="amount" step="0.01" required class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
            </div>
            @if ($errors->has('amount'))
                <div class="alert alert-danger error-message" style="color: red">
                    {{ $errors->first('amount') }}
                </div>
            @endif
            <x-button name="name" value="{{$name}}" type="submit">Buy Crypto</x-button>
        </form>
    </div>
</x-app-layout>
