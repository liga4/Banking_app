
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __( 'Your Investment Account' ) }}
</h2>
</x-slot>
    <div class="flex justify-center">
        @foreach ($currencies as $currency)
            <div class="m-4">
                <table class="border ">
                    <tr>
                        <td colspan="2" class="p-2 text-center font-bold bg-gray-100">{{ $currency['name']}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2 text-center">
                            <div class="flex justify-center">
                                <img src="{{ $currency['logo'] }}" alt="{{ $currency['name'] }} Logo" width="200" height="200">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">Price:</td>

                        <td class="p-2">{{ $currency['exchangeRate'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2 text-center">
                            <form action="{{ route('buyCrypto') }}"
                                  method="GET">
                                <x-button type='submit'
                                          name="buyCrypto"
                                          value="{{ $currency['name'] }}">
                                    Buy
                                </x-button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
    <h3 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 19%;">
        {{ __('Crypto History') }}
    </h3>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr class="transaction-row" style="background-color: slategrey">
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Currency
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Amount Bought
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Percentage Change
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactionDetails as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transaction['currency'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transaction['amount'] }}</td>
                                @if($transaction['percentage'][0] == '+')
                                <td class="px-6 py-4 whitespace-nowrap" style="color: green">{{ $transaction['percentage'] }}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap" style="color: red">{{ $transaction['percentage'] }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div></x-app-layout>
