<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class MakeFilamentAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     protected $signature = 'make:filament-admin';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Filament admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('What is the name of the admin user?');
        $email = $this->ask('What is the email of the admin user?');
        $password = $this->secret('What is the password?');

        $admin = Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info("Admin user {$admin->name} created successfully!");

        return Command::SUCCESS;
    }

}
