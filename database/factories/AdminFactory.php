<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

$roleNames = (new Role)->getAllRoleNames();
$key = array_search('Owner', $roleNames);
unset($roleNames[$key]);

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ADmin>
 */
class AdminFactory extends Factory
{

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Admin $admin) {
        })->afterCreating(function (Admin $admin) {
            
            $roleNames = (new Role)->getAllRoleNames();
            $key = array_search('Owner', $roleNames);
            unset($roleNames[$key]);
            
            $countOfRoles = rand(1, 3);
            $randomIndexes = array_rand($roleNames, $countOfRoles);

            if(is_array($randomIndexes)){
                foreach($randomIndexes as $index){
                    $admin->assignRole($roleNames[$index]);
                }
            }else{
                $admin->assignRole($randomIndexes);
            }

        });
    }


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
        ];
    }
}
