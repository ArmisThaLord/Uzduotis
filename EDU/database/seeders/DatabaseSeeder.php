<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            $user = User::factory()->create([
                'name'=>"Jogny boi",
                'email'=>'jam@mail.com'
            ]);
        Listing::factory(6)->create([
            'user_id'=> $user->id
        ]);
     /*   Listing::create([
            'title' =>'Laravel Senior Developer',
            'tags' => 'taravel, javascript',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'enaillemait.com',
            'website' => 'website.com',
            'description' => 'Lorem ipsum dolor sit
            minima et i t IO reprehenderit quas possimus
            voluptas repudiandae cum expedita, eveniet
            aliquid, quam ilium quaerat consequatur!
            Expedita ab consectetur tenetur delensiti?
            amet consectetur adipisicing elit. Ipsan'
        ]);*/
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
