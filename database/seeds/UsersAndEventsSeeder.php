<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersAndEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\User::class)
            ->create()
            ->events()
            ->save(
                factory(\App\Model\Event::class)->make()
            );
    }
}
