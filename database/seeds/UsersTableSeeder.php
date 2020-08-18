<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('es_ES');
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->publications()->save(factory(App\Models\Publication::class)->make());
        });
    }
}
