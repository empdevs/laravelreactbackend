<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i <= 100 ; $i++){
            DB::table('contacts')->insert([
                'name'=>$faker->name(),
                'phone'=>$faker->phoneNumber()
            ]);
        }
        //
    }
}
