<?php

use Illuminate\Database\Seeder;
use Database\Seeders\BloodTableSeeder;
use Database\Seeders\GenderTableSeeder;
use Database\Seeders\ReligionTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\NationalityTableSeeder;
use Database\Seeders\SpecializtionTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecializtionTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
