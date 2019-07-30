<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => '恶灵猫',
            'username' => 'easycat',
            'email' => '3499999910@qq.com',
            'tel' => 17715273200,
            'is_super' => 1,
            'password' => bcrypt('sherlock'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
