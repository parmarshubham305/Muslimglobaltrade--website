<?php

namespace Database\Seeders;

use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;

class GeoLocaleDatabaseSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (\DB::connection() instanceof SQLiteConnection) {
            \DB::statement('PRAGMA FOREIGN_KEYS=0');
        } elseif (\DB::connection() instanceof PostgresConnection) {
            \DB::statement("SET session_replication_role = 'replica';");
        } else {
            \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        ini_set('memory_limit', '512M'); //allocate memory
        \DB::disableQueryLog(); //disable log

        $this->call(AdminMenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(GeoLocaleContinentsTableSeeder::class);
        $this->call(GeoLocaleCountriesTableSeeder::class);
        $this->call(GeoLocaleDivisionsTableSeeder::class);
        $this->call(GeoLocaleCitiesTableSeeder::class);

        if (\DB::connection() instanceof SQLiteConnection) {
            \DB::statement('PRAGMA FOREIGN_KEYS=1');
        } elseif (\DB::connection() instanceof PostgresConnection) {
            \DB::statement("SET session_replication_role = 'origin';");
        } else {
            \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
