<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Make sure the Role model is imported

class RolesTableSeeder extends Seeder
{
    /**
     * Seed the roles table using Eloquent with update or insert logic.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'super-admin',
                'type' => 'global',
                'description' => 'Super admin description',
                'vendor_id' => null,
                'updated_at' => '2021-10-10 08:41:07',
            ],
            [
                'id' => 2,
                'name' => 'Vendor Admin',
                'slug' => 'vendor-admin',
                'type' => 'vendor',
                'description' => 'Vendor admin description',
                'vendor_id' => null,
                'updated_at' => '2021-10-11 08:41:07',
            ],
            [
                'id' => 3,
                'name' => 'Customer',
                'slug' => 'customer',
                'type' => 'global',
                'description' => 'Customer description',
                'vendor_id' => null,
                'updated_at' => '2021-10-11 09:41:07',
            ],
            [
                'id' => 4,
                'name' => 'Guest',
                'slug' => 'guest',
                'type' => 'global',
                'description' => 'Guest description',
                'vendor_id' => null,
                'updated_at' => '2021-10-11 09:42:07',
            ],
            [
                'id' => 5,
                'name' => 'Free',
                'slug' => 'free',
                'type' => 'vendor',
                'description' => 'Vendor admin Free Plan',
                'vendor_id' => null,
                'updated_at' => '2025-05-21 20:55:07',
            ],
            [
                'id' => 6,
                'name' => 'Basic',
                'slug' => 'basic',
                'type' => 'vendor',
                'description' => 'Vendor admin Basic Plan',
                'vendor_id' => null,
                'updated_at' => '2025-05-21 20:55:07',
            ],
            [
                'id' => 7,
                'name' => 'Gold',
                'slug' => 'gold',
                'type' => 'vendor',
                'description' => 'Vendor admin Gold Plan',
                'vendor_id' => null,
                'updated_at' => '2025-05-21 20:55:07',
            ],
            [
                'id' => 8,
                'name' => 'Platinum',
                'slug' => 'platinum',
                'type' => 'vendor',
                'description' => 'Vendor admin Platinum Plan',
                'vendor_id' => null,
                'updated_at' => '2025-05-21 20:55:07',
            ],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::updateOrCreate(
                ['id' => $role['id']],
                $role
            );
        }
    }
}
