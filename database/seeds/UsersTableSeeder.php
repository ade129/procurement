<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
              'name' => 'General Affairs',
              'email' => 'root@root.com',
              'role' => '2',
              'role_type' => 'GA',
              'role_create' =>  '1',
              'role_update' => '1',
              'role_read' => '1',
              'role_delete' => '1',
              'role_print' => '1',
              'role_approve' => '1',
              'password' => bcrypt('rootroot'),
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'name' => 'Sales',
              'email' => 'sales@gmail.com',
              'role' => '1',
              'role_type' => 'LD',
              'role_create' =>  '1',
              'role_update' => '1',
              'role_read' => '1',
              'role_delete' => '1',
              'role_print' => '1',
              'role_approve' => '1',
              'password' => bcrypt('123456'),
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'name' => 'Marketing',
              'email' => 'marketing@gmail.com',
              'role' => '2',
              'role_type' => 'RO',
              'role_create' =>  '1',
              'role_update' => '1',
              'role_read' => '1',
              'role_delete' => '1',
              'role_print' => '1',
              'role_approve' => '1',
              'password' => bcrypt('1234567'),
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
