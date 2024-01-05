# Banking App

Welcome to the Banking App! This application provides a range of financial functionalities to manage your accounts, perform transactions, and handle investments. It's built to offer a seamless experience for handling various currencies, making transactions, and exploring cryptocurrency investments.

## Features

### Account Management

- **Create Account**: Users can create different accounts based on currencies to manage their funds efficiently.

### Transactions

- **Make Transactions**: Perform transactions between different currency-based accounts.
- **Transaction History**: Review and track the history of transactions made across accounts.

### Investment

- **Investment Accounts**: Create investment accounts to explore crypto investment opportunities.
- **Crypto Purchase**: Purchase cryptocurrency through the app based on real-time exchange rates.
- **Crypto History**: Review past cryptocurrency transactions and monitor investment performance.

## To run Banking application in your server, you'll need 

#### PHP (version 7.4 or higher)
#### Composer
#### MySQL or a database of your choice
#### npm

1. **Clone the repository**:
    - Git clone ..

2. **Install Dependencies**:
    - composer install
    - npm install
    - npm run dev

3. **Set up environment**:
    - set up .env (recreate .env.example and add your database information)
    - php artisan key:generate

4. **Setup database**:
    - php artisan migrate
    - php artisan schedule:run 
5. **Start application**:
    - php artisan serve
