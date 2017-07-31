<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if (App::environment() === 'production') exit();

        Eloquent::unguard();

        // Truncate all tables, except migrations
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            if ($table->Tables_in_api_tfl !== 'migrations')
                DB::table($table->Tables_in_api_tfl)->truncate();
        }

        $this->call(UserTableSeeder::class);

    }
}
