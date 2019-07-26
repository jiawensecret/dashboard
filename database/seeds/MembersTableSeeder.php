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
            'public_key' => Storage::url('rsa_public_key.pem'),
        ]);
    }
}
