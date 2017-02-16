<?php

namespace Ecomputer\LaravelUsersCLI\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecomputer:users:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the selected user from the database';

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
        // If not passed id by param show the user list
        if (empty($this->option('id'))) {
            $list = [];

            $bar = $this->output->createProgressBar(User::count() + 1);
            $bar->start();

            $users = User::all(['name', 'email']);

            $bar->advance();

            foreach ($users as $user) {
                $list[] = $user->name.' <'.$user->email.'>';
                $bar->advance();
            }

            $nameAndEmail = $this->choice('Which user would you wish to delete?', $list);
            $selectedUser = User::where('email', $this->_extractEmail($nameAndEmail))->first();
        } else {
            $selectedUser = User::find($this->option('id'));
        }

        if ($selectedUser !== null) {
            $this->_confirmAndDelete($selectedUser);
        } else {
            $this->error('The selected user id ('.$this->option('id').') does not exists!');
        }
    }

    /**
     * Extracts email from a <example@example.com> format
     *
     * @param $nameAndEmail Email in `Name <example@example.com` format
     * @return mixed
     */
    private function _extractEmail($nameAndEmail)
    {
        return explode('>', explode('<', $nameAndEmail)[1])[0];
    }

    /**
     * Asks for confirmation and removes the user
     *
     * @param User $user
     */
    private function _confirmAndDelete(User $user)
    {
        if ($this->confirm('Are you sure you want to delete this user? "'.$user->name.' <'.$user->email.'>"')) {
            $user->delete();

            $this->info('User successfully deleted.');
        }
    }
}
