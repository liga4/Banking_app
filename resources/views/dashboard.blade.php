
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __( 'Hello ' . Auth::user()->name .' '. Auth::user()->surname ) }}
        </h2>
    </x-slot>
    <div class="py-12 flex justify-center">
        <div class="w-1/2 bg-gray-100 p-8">
            <div class="text-3xl font-semibold mb-4">Account Details</div>
            <div class="text-xl mb-4">
                <span class="font-semibold">Account Number:</span> {{ (auth()->user()['accounts']->first())->account_number }}
            </div>
            <div class="text-xl mb-4">
                <span class="font-semibold">Balance:</span> {{ number_format((auth()->user()['accounts']->first())->balance / 100, 2) }} {{(auth()->user()['accounts']->first())->currency}}
            </div>
        </div>
    </div>
</x-app-layout>
