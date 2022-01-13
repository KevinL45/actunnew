<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Provider\fr_FR\Person;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private Person $faker;

    public function __construct(Person $faker)
    {
            $this->$faker = $faker;

    }
    public function fakeCreate()
    {
        //$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        $user = new User();
        $user->firstname = $this->faker->firstname();
        $user->lastname = $this->faker->lastname();
        $user->email = $this->faker->unique()->email;
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $user->save();

        return redirect('/');

    }
}
