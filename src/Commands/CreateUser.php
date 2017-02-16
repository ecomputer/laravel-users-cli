<?php

namespace Ecomputer\LaravelUsersCLI\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $userData = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecomputer:users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new user for the admin panel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->_fillNewAccount();

        $this->line('You are going to create an account with the following data:');

        $this->table(['Name', 'Email'], [[$this->userData['name'], $this->userData['email']]]);

        if ($this->confirm('It is ok?')) {
            User::create([
                'name' => $this->userData['name'],
                'email' => $this->userData['email'],
                'password' => bcrypt($this->userData['password'])
            ]);
            $this->info('Account created successfully.');
        } else {
            $this->error('Account not created');
        }
    }

    private function _fillNewAccount()
    {
        $this->userData['name'] = $this->ask('What\'s your fullname?');
        $this->userData['email'] = $this->ask('What\'s your email?');
        $this->userData['password'] = $this->_askForPassword();
    }

    private function _askForPassword()
    {
        $password = $this->secret('Please type a password');

        if ($password !== $this->secret('Please type the same password again')) {
            $this->error('The passwords didn\'t match');
            return $this->_askForPassword();
        } else {
            return $password;
        }
    }
}
