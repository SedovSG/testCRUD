<?php


use Phinx\Seed\AbstractSeed;
use Faker\Factory as Faker;

class UsersSeeder extends AbstractSeed
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
                "fname" => $faker->firstNameFemale,
                "lname" => $faker->lastName,
                "mname" => $faker->middleNameFemale,
            ];
        }

        $this->table("users")->insert($data)->saveData();
    }
}
