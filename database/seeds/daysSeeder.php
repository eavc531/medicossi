<?php

use Illuminate\Database\Seeder;

class daysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('days')->insert([
     'name'=>'1',
     'month_id'=>'1',
     ]);

     DB::table('days')->insert([
    'name'=>'2',
    'month_id'=>'1',
    ]);

    DB::table('days')->insert([
   'name'=>'3',
   'month_id'=>'1',
   ]);
    }
}
