<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_user')->insert([
            'name' => 'Nguyen Tuan Anh',
            'email' =>'anhnt9@smartosc.com',
            'password' => bcrypt('12345678'),
            'phone' => '0966607094',
            'avatar' => 'avatar.png',
        ],[
                'name' => 'Nguyen Dinh Dang',
                'email' =>'dangnd@smartosc.com',
                'password' => bcrypt('12345678'),
                'phone' => '0966607094',
                'avatar' => 'avatar.png',
            ]
        );
    }
}
