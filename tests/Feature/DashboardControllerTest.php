<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Status;
use App\Models\Repair;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_correct_stats()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $completedStatus = Status::factory()->create(['name' => 'completed']);
        $pendingStatus = Status::factory()->create(['name' => 'pending']);

        Repair::factory()->create([
            'status_id' => $completedStatus->id,
            'completion_date' => now(),
            'final_cost' => 100
        ]);
        Repair::factory()->create([
            'status_id' => $pendingStatus->id
        ]);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewHas('stats');
        $stats = $response->viewData('stats');
        $this->assertEquals(1, $stats['completed_today']);
        $this->assertEquals(1, $stats['active_repairs']);
    }
}
