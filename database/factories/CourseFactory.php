<?php

namespace Database\Factories;

use App\Models\Course;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    private array $courseNames = [
        'Mathematics',
        'Physics',
        'Chemistry',
        'Biology',
        'History',
        'Literature',
        'Computer Science',
        'Art',
        'Music',
        'Geography'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (count($this->courseNames) === 0) {
            throw new Exception("No more available course names.");
        }
        $name = $this->faker->randomElement($this->courseNames);
        $key = array_search($name, $this->courseNames);
        unset($this->courseNames[$key]);
        return [
            "name" => $name,
        ];
    }
}
