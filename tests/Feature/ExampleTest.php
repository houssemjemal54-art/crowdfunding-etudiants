<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_a_campaign_can_be_created(): void
    {
        $student = Student::create([
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'university' => 'ISET Rades',
            'major' => 'Business Computing',
            'bio' => 'Profil de test.',
        ]);

        $response = $this->post('/campaigns', [
            'student_id' => $student->id,
            'title' => 'Projet de test',
            'category' => 'Education',
            'description' => 'Description suffisamment longue pour valider le formulaire de campagne.',
            'goal_amount' => 500,
            'deadline' => now()->addMonth()->toDateString(),
            'status' => 'active',
            'image_url' => null,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('campaigns', ['title' => 'Projet de test']);
    }
}
