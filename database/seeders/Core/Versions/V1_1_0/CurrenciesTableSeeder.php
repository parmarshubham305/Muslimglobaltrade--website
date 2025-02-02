<?php

namespace Modules\Dummy\Database\Seeders\Core\Versions\V1_1_0;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('currencies')->where('name', 'KES')->update(['symbol' => 'KSh']);
    }
}
