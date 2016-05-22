<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      factory(App\User::class,5)->create()
      ->each(function($u) {
        $u->band()->save(factory(App\Band::class)->make());
        //$u->reqjoin()->save(factory(App\Reqjoin::class)->make());
        //$u->bandmember()->save(factory(App\Bandmember::class)->make());
      });
    }
}
