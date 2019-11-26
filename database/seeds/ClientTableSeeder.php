<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => 'dashbard',
            'secret' => 'zO5znG43MAvr75AvSu3HhnnuRMesskKuxtKLT86V',
            'redirect' => env('APP_URL',''),
            'password_client' => 1,
            'personal_access_client' => 0,
            'revoked' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
