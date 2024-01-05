
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __( 'Hello ' . $user['name'] .' '. $user['surname'] ) }}
        </h2>
    </x-slot>
    <div class="py-12 flex justify-center">
        <div class="w-1/2 bg-gray-100 p-8">
            <div class="text-3xl font-semibold mb-4">Account Details</div>
            <div class="text-xl mb-4">
                <span class="font-semibold">Account Number:</span> {{ $account->account_number }}
            </div>
            <div class="text-xl mb-4">
                <span class="font-semibold">Balance:</span> {{ number_format($account->balance / 100, 2) }} {{$account->currency}}
            </div>
        </div>
    </div>
    @if (!$hasInvestmentAccount)
    <form action="{{ route('createInvestmentAccount') }}"
          method="GET"
          style="background-color: lightsteelblue; color: #fff; margin-left: 19%;">
        <x-button type='submit'>
            {{__('Create investment account')}}
        </x-button>
    </form>
    @else
        <x-button style="margin-left: 19%;" onclick="window.location.href = '{{ route('investmentAccount') }}' ">
            {{__('Go to investment account')}}
        </x-button>
    @endif
</x-app-layout>
