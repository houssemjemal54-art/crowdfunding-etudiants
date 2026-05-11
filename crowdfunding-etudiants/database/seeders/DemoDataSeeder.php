<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Contribution;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = collect([
            [
                'name' => 'Amira Ben Salem',
                'email' => 'amira.bensalem@example.com',
                'university' => 'ISET Rades',
                'major' => 'Business Computing',
                'bio' => 'Etudiante passionnee par les solutions numeriques inclusives.',
            ],
            [
                'name' => 'Youssef Trabelsi',
                'email' => 'youssef.trabelsi@example.com',
                'university' => 'ISET Rades',
                'major' => 'Business Intelligence',
                'bio' => 'Porteur de projets autour de la data et de la vie associative.',
            ],
            [
                'name' => 'Nour Chebbi',
                'email' => 'nour.chebbi@example.com',
                'university' => 'ISET Rades',
                'major' => 'Systemes d information',
                'bio' => 'Interessee par les plateformes collaboratives et la gestion de communaute.',
            ],
        ])->map(fn (array $data) => Student::create($data));

        $campaigns = collect([
            [
                'student_id' => $students[0]->id,
                'title' => 'Atelier coding pour lyceens',
                'category' => 'Education',
                'description' => 'Financer du materiel pedagogique et des supports pour animer des ateliers gratuits de programmation destines aux lyceens.',
                'goal_amount' => 1800,
                'deadline' => now()->addDays(45)->toDateString(),
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'student_id' => $students[1]->id,
                'title' => 'Dashboard data pour association',
                'category' => 'Data',
                'description' => 'Construire un tableau de bord de suivi des dons pour une association et acheter les ressources cloud necessaires.',
                'goal_amount' => 2400,
                'deadline' => now()->addDays(60)->toDateString(),
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'student_id' => $students[2]->id,
                'title' => 'Bibliotheque solidaire campus',
                'category' => 'Vie etudiante',
                'description' => 'Lancer une bibliotheque de pret de livres techniques et financer les premiers ouvrages utiles aux etudiants.',
                'goal_amount' => 1200,
                'deadline' => now()->addDays(30)->toDateString(),
                'status' => 'funded',
                'image_url' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=80',
            ],
        ])->map(fn (array $data) => Campaign::create($data));

        collect([
            [
                'campaign_id' => $campaigns[0]->id,
                'student_id' => $students[1]->id,
                'donor_name' => 'Club Informatique',
                'donor_email' => 'club.info@example.com',
                'amount' => 350,
                'message' => 'Excellent projet pour initier les jeunes.',
                'anonymous' => false,
                'paid_at' => now()->subDays(4)->toDateString(),
            ],
            [
                'campaign_id' => $campaigns[1]->id,
                'student_id' => null,
                'donor_name' => 'Entreprise partenaire',
                'donor_email' => 'contact@partenaire.test',
                'amount' => 700,
                'message' => 'Soutien au projet data.',
                'anonymous' => false,
                'paid_at' => now()->subDays(2)->toDateString(),
            ],
            [
                'campaign_id' => $campaigns[2]->id,
                'student_id' => $students[0]->id,
                'donor_name' => 'Ancien etudiant',
                'donor_email' => null,
                'amount' => 1250,
                'message' => 'Pour encourager la lecture sur campus.',
                'anonymous' => true,
                'paid_at' => now()->subDays(8)->toDateString(),
            ],
        ])->each(fn (array $data) => Contribution::create($data));
    }
}
