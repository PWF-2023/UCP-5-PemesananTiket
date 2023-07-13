<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

<<<<<<< HEAD
/**
=======
/*
>>>>>>> b56f97a882c5d3db0f0dee723b0a3bd5974bed6b
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
<<<<<<< HEAD
    /**
=======
    /*
>>>>>>> b56f97a882c5d3db0f0dee723b0a3bd5974bed6b
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'user_id' => rand(1, 100),
            'tittle' => ucwords(fake()->word(),)
        ];
    }
}
=======
            'user_id' => rand(1,100),
            'title' => ucwords(fake()->sentence())
        ];
    }
}
>>>>>>> b56f97a882c5d3db0f0dee723b0a3bd5974bed6b
