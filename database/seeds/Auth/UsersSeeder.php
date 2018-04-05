<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        $users = [
            [
                'name' => 'Test Landlord',
                'email' => 'landlord.laravel@irent.com',
                'password' => bcrypt('landlord'),
                'active' => true,
                'confirmation_code' => \Ramsey\Uuid\Uuid::uuid4(),
                'confirmed' => true,
                'national_id' => '0987',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Test Tenant',
                'email' => 'tenant.laravel@irent.com',
                'password' => bcrypt('tenant'),
                'active' => true,
                'confirmation_code' => \Ramsey\Uuid\Uuid::uuid4(),
                'confirmed' => true,
                'national_id' => '7890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($users);

        $this->enableForeignKeys();
    }
}
