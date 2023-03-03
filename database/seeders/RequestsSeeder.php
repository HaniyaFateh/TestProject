<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Faker\Generator;

class RequestsSeeder extends Seeder
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
        $requestId = DB::table('users')->pluck('id');

        foreach (range(1,50) as $index) {
            DB::table('requests')->insert([
            'sender_id' => $this->faker->randomElement($requestId),
            'receiver_id' => $this->faker->randomElement($requestId),
            'status' =>  0
            ]);
        }   

    }
}
