<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr class="transaction-row " style="background-color: slategrey ">

                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Surname
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Account Number
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Reference
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Date
                            </th>

                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr >
                                <td class="px-6 py-4 whitespace-nowrap">{{ $otherUser[$transaction->id]->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $otherUser[$transaction->id]->surname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $accountNumber[$transaction->id] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->reference }}</td>

                                @if($transaction->category == 'incoming')
                                    <td class="px-6 py-4 whitespace-nowrap text-green-600">
                                        + {{ number_format($transaction->amount / 100, 2)." ". $account->currency }}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap text-red-600">
                                        - {{ number_format($transaction->amount / 100, 2)." ". $account->currency}}</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->date }}</td>
                                <td>
                                <form action="{{ route('newTransaction') }}"
                                      method="GET"
                                      style="background-color: lightsteelblue; color: #fff;">
                                    <button type='submit'
                                            name="transaction_id"
                                            value="{{ $transaction->id }}"
                                            class="bg-blue-300 text-gray-700 font-bold py-2 px-4 ">
                                        New Transaction
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
