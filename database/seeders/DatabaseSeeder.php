<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use LogicException;

class DatabaseSeeder extends Seeder
{
    /** Membuat akun demo yang diatur untuk local atau testing. */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        foreach (config('demo_accounts') as $role => $account) {
            if ($account['email'] === null && $account['password'] === null) {
                continue;
            }

            if ($account['email'] === null || $account['password'] === null) {
                throw new LogicException("Both email and password are required for the {$role} demo account.");
            }

            User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $role === 'admin' ? 'Administrator' : 'Petugas',
                    'password' => $account['password'],
                    'role' => $role,
                ],
            );
        }
    }
}
