<?php

namespace Database\Seeders;

use App\Jobs\Client\UpdatePhoneJob;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dispatch(new UpdatePhoneJob());
    }
}
