<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
        'login_id'=>'admin',
        'password'=>'pass'
        ];
        DB::table('admin')->insert($param);
    }
}
