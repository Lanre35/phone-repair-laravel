<?php

namespace Database\Factories;

use App\Models\Repair;
use App\Models\Status;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    protected $model = Repair::class;

    public function definition()
    {
        return [
            'status_id' => Status::factory(),
            'customer_id' => Customer::factory(),
            'completion_date' => null,
            'final_cost' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
