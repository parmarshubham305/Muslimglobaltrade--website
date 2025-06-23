<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Free'],
            ['name' => 'Basic'],
            ['name' => 'Gold'],
            ['name' => 'Platinum'],
        ];

        foreach ($roles as $role) {
            \Modules\MenuBuilder\Http\Models\AdminMenus::updateOrCreate(
                ['name' => $role['name']], // match by name
                $role // data to update or insert
            );
        }
    }
}
