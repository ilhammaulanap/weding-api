<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Aplication; 

class ApikeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Aplication::create([
            'api_key'      => 'c20ad4d76fe97759aa27a0c99bff6710',
            'client_app_nm'     => 'wed-story',
            'ip_address_whitelist'  => '*'
        ]);
    }
}
