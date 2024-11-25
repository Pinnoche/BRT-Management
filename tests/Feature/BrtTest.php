<?php

namespace Tests\Feature;

use App\Models\Brt;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrtTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test BRT creation functionality.
     *
     * @return void
     */
    public function test_create_brt()
    {
        $user = User::factory()->create(); // Create a user
        $token = JWTAuth::fromUser($user); // Generate token for authentication

        $response = $this->postJson('/api/brts', [
            'reserved_amount' => 100.00
        ], [
            'Authorization' => "Bearer $token" // Add token to authenticate the user
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'data' => ['brt_code', 'reserved_amount', 'status']]);
    }

    /**
     * Test BRT update functionality.
     *
     * @return void
     */
    public function test_update_brt()
    {
        $user = User::factory()->create();
        $brt = $user->brts()->create([
            'brt_code' => Str::uuid(),
            'reserved_amount' => 100.00,
            'status' => 'active',
        ]);
        $token = JWTAuth::fromUser($user);

        $response = $this->patchJson("/api/brts/{$brt->id}", [
            'reserved_amount' => 150.00
        ], [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your BRT has been updated successfully']);
    }

    /**
     * Test BRT deletion functionality.
     *
     * @return void
     */
    public function test_delete_brt()
    {
        $user = User::factory()->create();
        $brt = $user->brts()->create([
            'brt_code' => Str::uuid(),
            'reserved_amount' => 100.00,
            'status' => 'active',
        ]);
        $token = JWTAuth::fromUser($user);

        $response = $this->deleteJson("/api/brts/{$brt->id}", [], [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'This BRT has been deleted successfully']);
    }
}
