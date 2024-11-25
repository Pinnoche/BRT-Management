<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Ensure the database is reset after each test

    /**
     * Test if a User can be created.
     *
     * @return void
     */
    public function test_user_creation()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /**
     * Test user attribute casting.
     *
     * @return void
     */
    public function test_user_password_is_hashed()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password', // raw password
        ]);

        $this->assertNotEquals('password', $user->password); // Ensure the password is hashed
    }

    /**
     * Test user relationship with Brt.
     *
     * @return void
     */
    public function test_user_has_brts()
    {
        $user = User::factory()->create();
        $brt = $user->brts()->create([
            'brt_code' => 'BRT-1234',
            'reserved_amount' => 100.00,
            'status' => 'active',
        ]);

        $this->assertCount(1, $user->brts); // Ensure the user has 1 BRT
    }
}
