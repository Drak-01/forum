<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class newSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // USERS (20 users)
        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $gender = ($i % 2) ? 'male' : 'female';
            $users[] = [
                'id' => $i,
                'username' => ($gender == 'male' ? 'user' : 'member') . $i,
                'univEmail' => ($gender == 'male' ? 'user' : 'member') . $i . '@univ.edu',
                'password' => Hash::make('password123'),
                'lastName' => ($gender == 'male' ? 'Doe' : 'Smith') . $i,
                'firstName' => ($gender == 'male' ? 'John' : 'Jane') . $i,
                'userPicture' => 'profile_pictures/' . ($gender == 'male' ? 'man' : 'woman') . ($i % 2 + 1) . '.jpeg',
                'createdAt' => $now,
                // 'updatedAt' => $now
            ];
        }
        DB::table('users')->insert($users);

        // GROUPS (10 groups)
        $groups = [];
        $groupNames = [
            'Tech Enthusiasts', 'AI Researchers', 'Cybersecurity Experts', 
            'Web Development', 'Data Science', 'Cloud Computing',
            'Mobile Dev', 'Blockchain', 'Game Dev', 'UI/UX Design'
        ];
        
        for ($i = 1; $i <= 10; $i++) {
            $groups[] = [
                'id' => $i,
                'name' => $groupNames[$i-1],
                'groupPicture' => 'groups/group'.$i.'.jpg',
                'description' => 'Discussion group about '.$groupNames[$i-1],
                'createdAt' => $now,
                'user_id' => rand(1, 20),
                 'createdAt' => $now,
                // 'updated_at' => $now
            ];
        }
        DB::table('groups')->insert($groups);

        // GROUP_USER (50 random memberships)
        $groupUsers = [];
        for ($i = 1; $i <= 50; $i++) {
            $groupUsers[] = [
                'user_id' => rand(1, 20),
                'id' => rand(1, 10),
                'createdAt' => $now,
                // 'updatedAt' => $now
            ];
        }
        DB::table('group_user')->insert($groupUsers);

        // TAGS (15 tags)
        $tags = [];
        $tagNames = [
            'AI', 'Security', 'Web', 'Data', 'Programming',
            'Cloud', 'Mobile', 'Blockchain', 'Games', 'Design',
            'Algorithms', 'Database', 'DevOps', 'Testing', 'Networking'
        ];
        
        $colors = ['#ef4444', '#10b981', '#3b82f6', '#8b5cf6', '#f59e0b',
                  '#ec4899', '#14b8a6', '#0ea5e9', '#84cc16', '#f97316',
                  '#a855f7', '#d946ef', '#06b6d4', '#22c55e', '#eab308'];
        
        for ($i = 1; $i <= 15; $i++) {
            $tags[] = [
                'id' => $i,
                'name' => $tagNames[$i-1],
                'color' => $colors[$i-1],
                'createdAt' => $now,
                // 'updated_at' => $now
            ];
        }
        DB::table('tags')->insert($tags);

        // QUESTIONS (60 questions - 30 with group, 30 without)
        $questions = [];
        $questionTitles = [
            // Tech questions
            'How does machine learning work?', 'Best practices for secure coding',
            'React vs Angular in 2023', 'Big data processing techniques',
            'How to optimize SQL queries?', 'Microservices architecture patterns',
            'Flutter vs React Native', 'Smart contract security issues',
            'Game physics engines', 'UX design principles',
            
            // Programming questions
            'Python async/await best practices', 'TypeScript advantages',
            'Rust memory safety', 'Go concurrency patterns',
            'Java Spring Boot tips', 'C++ modern features',
            'PHP 8 new features', 'Ruby on Rails in 2023',
            'SwiftUI vs UIKit', 'Kotlin coroutines',
            
            // Web dev
            'JWT authentication best practices', 'GraphQL vs REST',
            'WebAssembly use cases', 'Progressive Web Apps',
            'CSS Grid layout tips', 'Web performance optimization',
            'SEO best practices 2023', 'Web accessibility guidelines',
            'Browser storage options', 'WebSockets implementation',
            
            // AI/Data
            'Transformer models explained', 'Computer vision techniques',
            'NLP preprocessing steps', 'Time series forecasting',
            'Reinforcement learning basics', 'GAN practical applications',
            'Data cleaning techniques', 'Feature engineering methods',
            'Model evaluation metrics', 'Hyperparameter tuning',
            
            // Security
            'OWASP Top 10 2023', 'Zero trust architecture',
            'Penetration testing tools', 'Cryptography basics',
            'Secure API design', 'Container security',
            'Incident response plan', 'GDPR compliance checklist',
            'Multi-factor auth options', 'Password hashing algorithms',
            
            // Misc
            'Linux command line tips', 'Docker best practices',
            'Kubernetes networking', 'CI/CD pipeline setup',
            'Agile methodology tips', 'Tech interview preparation',
            'Remote work tools', 'Open source contribution guide',
            'Tech career advice', 'Learning resources for beginners'
        ];
        
        for ($i = 1; $i <= 60; $i++) {
            $hasGroup = $i <= 30 ? rand(1, 10) : null; // First 30 have groups
            
            $questions[] = [
                'id' => $i,
                'title' => $questionTitles[$i-1] ?? 'Question '.$i.' about technology',
                'content' => $this->generateQuestionContent(),
                'datePost' => $now->subDays(rand(0, 60)),
                'contentType' => 'text',
                'user_id' => rand(1, 20),
                'group_id' => $hasGroup,
                'createdAt' => $now,
                // 'updated_at' => $now
            ];
        }
        DB::table('questions')->insert($questions);

        // QUESTION_TAG (3-5 tags per question)
        $questionTags = [];
        foreach (range(1, 60) as $questionId) {
            $tagCount = rand(3, 5);
            $selectedTags = collect(range(1, 15))->random($tagCount);
            
            foreach ($selectedTags as $tagId) {
                $questionTags[] = [
                    'question_id' => $questionId,
                    'tag_id' => $tagId
                ];
            }
        }
        DB::table('question_tag')->insert($questionTags);

        // REPONSES (2-10 per question, some with 0)
        $responses = [];
        $responseId = 1;
        
        foreach (range(1, 60) as $questionId) {
            // 10% chance to have no responses
            if (rand(1, 10) == 1) continue;
            
            $responseCount = rand(2, 10);
            
            for ($i = 1; $i <= $responseCount; $i++) {
                $responses[] = [
                    'id' => $responseId++,
                    'content' => $this->generateResponseContent(),
                    'description' => 'Additional details about this answer',
                    'datePost' => $now->subDays(rand(0, 30)),
                    'contentType' => 'text',
                    'question_id' => $questionId,
                    'user_id' => rand(1, 20),
                    'createdAt' => $now,
                    // 'updated_at' => $now
                ];
            }
        }
        DB::table('reponses')->insert($responses);

        // VOTES (for responses)
        $votes = [];
        $voteId = 1;
        
        foreach ($responses as $response) {
            $voteCount = rand(0, 15); // Some with 0 votes
            
            for ($i = 1; $i <= $voteCount; $i++) {
                $votes[] = [
                    'id' => $voteId++,
                    'nbreVote' => rand(1, 5), // Each vote adds 1-5 points
                    'reponse_id' => $response['id'],
                    'user_id' => rand(1, 20),
                    'createdAt' => $now,
                    // 'updated_at' => $now
                ];
            }
        }
        DB::table('votes')->insert($votes);
    }

    private function generateQuestionContent(): string
    {
        $phrases = [
            "I'm trying to understand how this works.",
            "Can someone explain this concept to me?",
            "What are the best practices for this?",
            "I've encountered this problem in my project.",
            "How do professionals approach this?",
            "Looking for advice on implementing this.",
            "What are the current trends in this area?",
            "Seeking resources to learn more about this.",
            "How does this compare to alternatives?",
            "What are the pros and cons of this approach?"
        ];
        
        return implode(' ', array_rand(array_flip($phrases), rand(2, 5)));
    }

    private function generateResponseContent(): string
    {
        $phrases = [
            "In my experience, the best approach is...",
            "You should consider using...",
            "The documentation says...",
            "I solved this problem by...",
            "This is a common issue that can be addressed by...",
            "Have you tried...",
            "The standard practice is to...",
            "You might want to look at...",
            "I recommend checking out...",
            "The key thing to understand is..."
        ];
        
        return implode(' ', array_rand(array_flip($phrases), rand(3, 6)));
    }
}