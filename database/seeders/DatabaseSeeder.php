<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ClassTypesTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        // $this->call(MyClassesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(UsersTableSeeder2::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(StudentRecordsTableSeeder::class); 
        // $this->call(WritteTypesTableSeeder::class);
        // $this->call(StudentWrittesTableSeeder::class);
        
        $this->call(GiftTableSeeder::class);
        $this->call(CuaHangTableSeeder::class);
        
    }
}
