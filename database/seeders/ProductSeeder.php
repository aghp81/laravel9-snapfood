<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now()->add( -rand(1, 30), 'day'); // ایجاد تاریخ رندم - از یک تا سی روز از تاریخ امروز کم می کند.
        DB::table('products')->insert([
            'shop_id' => rand(9, 11),
            'title' => Str::random(30),
            'price' => rand(10, 100) * 1000,
            'discount' => rand(0, 5) * 5,
            'description' => Str::random(rand(1, 4) * 50),
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
