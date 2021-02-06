<?php


use Phinx\Seed\AbstractSeed;
use Faker\Factory as Faker;

class ObjectsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker::create("ru_RU");
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                "users_id" => $faker->randomDigitNotNull,
                "name" => $faker->company,
                "coordinates" => "{$faker->longitude},{$faker->latitude}",
                "address" => $faker->address,
                "points" => "{$faker->randomFloat(2, 5, 99)};{$faker->randomFloat(2, 1, 99)}"
            ];
        }

        $this->table("objects")->insert($data)->saveData();
    }
}
