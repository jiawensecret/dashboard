<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'member_user' => 'test',
            'member_key' => Str::random(20),
            'public_key' => 'rsa_public_key.pem',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
