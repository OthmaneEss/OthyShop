<?php

use App\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AdminUser::create([

            'name'=>'saad',
            'email'=>'saad@gmail.com',
            'password'=>'$2y$10$tAB7a38OCPXNEZxBLKOl3u7ugCNcCRd644o5xl8hcdOEVTfV0/oIa'
        ]);

    }
}
