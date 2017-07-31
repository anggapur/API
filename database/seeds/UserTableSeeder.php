<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
    	

    	$users = factory(App\User::class, 10)->create();
        $product = factory(App\product::class,10)->create()->each(function($u){
        		$u->fav()->save(factory(App\favorite::class)->make());
        	for($i= 0; $i<=5+(int)str_random(2);$i++)
        		$u->rate()->save(factory(App\rate::class)->make());
        	for($i= 0; $i<=5+(int)str_random(2);$i++)
        		$u->seen()->save(factory(App\seen::class)->make());
        	for($i= 0; $i<=2+(int)str_random(2);$i++)
        		$u->childImage()->save(factory(App\image::class)->make());
        });
        $category = factory(App\category::class,20)->create();
    }
}
