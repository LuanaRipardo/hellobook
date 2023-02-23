<?php

namespace Database\Seeders;

use App\Models\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReadersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $readers = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => bcrypt('password'),
                'birthdate' => '1990-01-01',
                'is_blocked' => false,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'password' => bcrypt('password'),
                'birthdate' => '1991-01-01',
                'is_blocked' => false,
            ],
            [
                'name' => 'John Smith',
                'email' => 'johnsmith@example.com',
                'password' => bcrypt('password'),
                'birthdate' => '1992-01-01',
                'is_blocked' => false,
            ],
        ];

        foreach ($readers as $reader) {
            Reader::create($reader);
        }
    }
}
