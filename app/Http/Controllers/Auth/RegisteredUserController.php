<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidCurrency;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'currency' => ['required', 'string', new ValidCurrency]
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $accountNumber = $this->generateAccountNumber();
        $defaultAccountType = 'Checking_account';
        $account = new Account([
            'currency' => $request->currency,
            'account_number' => $accountNumber,
            'account_type' => $defaultAccountType
        ]);
        event(new Registered($user));
        $user->accounts()->save($account);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function generateAccountNumber(): string
    {
        $countryCode = 'LV';
        $checkDigits = '00';
        $bankCode = 'GGGG';
        $accountNumber = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

        return $countryCode . $checkDigits . $bankCode . $accountNumber;
    }
}
