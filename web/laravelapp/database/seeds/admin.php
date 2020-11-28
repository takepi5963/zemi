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
        //adminの部分を管理者のログインIDにしてください
        $param=[
        'login_id'=>'admin',
        ];
        DB::table('admin')->insert($param);
    }
}
