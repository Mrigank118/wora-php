<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class NotesAccessTest extends TestCase
{
    use RefreshDatabase;
    public function test_authenticated_user_can_access_notes()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('notes'));
        $response->assertStatus(200);
    }

    public function test_guest_user_cannot_access_notes()
    {
        $response = $this->get(route('notes'));
        $response->assertRedirect(route('login'));
    }
}
