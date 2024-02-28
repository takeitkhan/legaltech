<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        // \App\Models\User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'phone'=>'01613997592',
        //     'password' => bcrypt('12345678'),
        //     'type'=>'superadmin',
        //     'avatar'=>'avatar_8Utzq.jpg'
        // ]);
        // \App\Models\EntityType::factory(2)->create();
        // \App\Models\Entity::factory(5)->create();

        // \App\Models\Role::insert([[
        //     'role_name' => 'Admin'
        //     ],
        //     [
        //         'role_name' => 'Manager'
        //     ],
        //     [
        //         'role_name' => 'Data Entry Specialist',
        //     ],
        //     [
        //         'role_name' => 'User',
        //     ],
        // ]);
        // \App\Models\Module::factory(10)->create();

        // \App\Models\ModulePermission::insert([
        //     ['title'=>'read'],
        //     ['title'=>'write'],
        //     ['title'=>'create'],
        //     ['title'=>'delete'],
        // ]);

        // return
        // \App\Models\Employee::factory(20)->create();
        // \App\Models\Contact::factory(30)->create();
        // // \App\Models\Contact::factory(10)->create();
        // \App\Models\ATRate::factory(30)->create();
        // \App\Models\SdRate::factory(30)->create();
        // // \App\Models\Document::factory(30)->create();
        // \App\Models\TaxRate::factory(30)->create();
        // \App\Models\DocumentType::factory(20)->create();
        // \App\Models\Bank::factory(20)->create();

        //  \App\Models\DocumentType::insert([
        //     [
        //       'title'  => 'Invoice'
        //     ],
        //     [
        //         'title' => 'Bill'
        //     ],
        //     [
        //         'title' => 'TIN',
        //     ],
        //     [
        //         'title' => 'OTHER',
        //     ],
        // ]);
        //  \App\Models\TransactionType::insert([
        //     [
        //       'title'  => 'Purchase'
        //     ],
        //     [
        //         'title' => 'Sell'
        //     ],
        //     [
        //         'title' => 'OTHER',
        //     ],
        // ]);
        \App\Models\ProductNature::insert([
            [
              'title'  => 'Convenience'
            ],
            [
                'title' => 'Specialty products'
            ],
            [
                'title' => 'Unsought goods',
            ],
        ]);

    }
}
