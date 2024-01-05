<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Investment Account') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">

            <form action="{{ route('createInvestmentAccount') }}" method="POST">
                @csrf

                <div class="mt-4">
                    An investment account for crypto buying is a specialized financial account that enables individuals
                    to invest in cryptocurrencies such as Bitcoin, Ethereum, or other digital assets.<br>
                    It's a dedicated account tailored for the purpose of acquiring, holding, and potentially profiting
                    from fluctuations in cryptocurrency prices.<br>
                    When creating an investment account for crypto buying,
                    users gain access to a platform that facilitates the process of investing in cryptocurrencies,
                    offering them an opportunity to participate in the crypto market and potentially benefit
                    from its volatility and growth.
                    <br>
                    <br>
                    Do you want to proceed with aplication?
                </div>
                <br>
                <x-button>
                    {{ __('Yes, create') }}
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>
