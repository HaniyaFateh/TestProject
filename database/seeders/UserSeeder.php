<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Faker\Generator;

class UserSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }
    
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,50) as $index) {

            DB::table('users')->insert([
                'name'                        => $this->faker->name,
                'email'                       => $this->faker->unique()->email,
                'password'                    => bcrypt('secret'),
            ]);
        }
    }
}
