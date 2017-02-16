<?php

namespace Ecomputer\LaravelUsersCLI\Commands;

use App\User;
use Illuminate\Console\Command;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecomputer:users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the registered users';

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
        $users = User::all(['id', 'name', 'email'])->toArray();
        $this->table(['ID', 'Full name', 'Email'], $users);
    }
}
