<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'admin' => true
        ]);

        $users = [
            'Rob',
            'Ryan',
            'Ian',
            'Arthur',
            'Larry C',
            'Larry D',
            'Nick',
            'Brian',
            'Jonas',
            'Cody',
        ];

        foreach($users as $user)
        {
            $fake = factory(App\User::class)->make();

            \App\User::create([
                'name' => $user,
                'email' => $fake->email,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
