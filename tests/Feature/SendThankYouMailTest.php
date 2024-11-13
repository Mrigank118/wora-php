<?php

// tests/Feature/SendThankYouMailTest.php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouMail;

class SendThankYouMailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can send a thank you email.
     */
    public function test_authenticated_user_can_send_thank_you_mail()
    {
        // Fake the mail sending
        Mail::fake();

        // Create an authenticated user
        $user = User::factory()->create();

        // Simulate the user clicking the send mail button (POST request to the route)
        $response = $this->actingAs($user)->post('/send-thank-you-mail');

        // Assert that the response status is 200 (or whatever success status you return)
        $response->assertStatus(200);

        // Check that the ThankYouMail was sent
        Mail::assertSent(ThankYouMail::class, 1);
    }

    /**
     * Test that a guest user cannot send a thank you email.
     */
    public function test_guest_user_cannot_send_thank_you_mail()
    {
        // Fake the mail sending
        Mail::fake();

        // Attempt to send a thank you mail as a guest
        $response = $this->post('/send-thank-you-mail');

        // Assert that the guest is redirected to the login page
        $response->assertRedirect(route('login'));

        // Assert that no email was sent
        Mail::assertNotSent(ThankYouMail::class);
    }
}
