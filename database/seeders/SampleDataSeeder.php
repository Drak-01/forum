<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // USERS
        DB::table('users')->insert([
            ['id' => 1, 'username' => 'johndoe', 'univEmail' => 'johndoe@example.com', 'password' => 'password123', 'lastName' => 'Doe', 'firstName' => 'John', 'userPicture' => 'profile1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'username' => 'janedoe', 'univEmail' => 'janedoe@example.com', 'password' => 'password123', 'lastName' => 'Doe', 'firstName' => 'Jane', 'userPicture' => 'profile2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'username' => 'michael', 'univEmail' => 'michael@example.com', 'password' => 'password123', 'lastName' => 'Smith', 'firstName' => 'Michael', 'userPicture' => 'profile3.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'username' => 'emily', 'univEmail' => 'emily@example.com', 'password' => 'password123', 'lastName' => 'Johnson', 'firstName' => 'Emily', 'userPicture' => 'profile4.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'username' => 'david', 'univEmail' => 'david@example.com', 'password' => 'password123', 'lastName' => 'Brown', 'firstName' => 'David', 'userPicture' => 'profile5.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // QUESTIONS
        DB::table('questions')->insert([
            ['id' => 1, 'title' => 'What is Artificial Intelligence?', 'content' => 'Can someone explain what AI is?', 'datePost' => now(), 'contentType' => 'text', 'user_id' => 1],
            ['id' => 2, 'title' => 'How to secure my website?', 'content' => 'What are the best practices to secure a website?', 'datePost' => now(), 'contentType' => 'text', 'user_id' => 2],
            ['id' => 3, 'title' => 'What are the benefits of data science?', 'content' => 'How can data science be applied in real life?', 'datePost' => now(), 'contentType' => 'text', 'user_id' => 3],
            ['id' => 4, 'title' => 'How to protect against ransomware?', 'content' => 'What are the best strategies to avoid ransomware attacks?', 'datePost' => now(), 'contentType' => 'text', 'user_id' => 4],
            ['id' => 5, 'title' => 'What programming languages should I learn for web development?', 'content' => 'Which programming languages should I learn first for web development?', 'datePost' => now(), 'contentType' => 'text', 'user_id' => 5],
        ]);

        // GROUPS
        DB::table('groups')->insert([
            ['id' => 1, 'name' => 'Tech Enthusiasts', 'groupPicture' => 'group1.jpg', 'description' => 'A group for technology lovers', 'createdAt' => now(), 'user_id' => 1, 'quest_id' => null],
            ['id' => 2, 'name' => 'AI Researchers', 'groupPicture' => 'group2.jpg', 'description' => 'A group focused on AI discussions and research', 'createdAt' => now(), 'user_id' => 2, 'quest_id' => null],
            ['id' => 3, 'name' => 'Cybersecurity Experts', 'groupPicture' => 'group3.jpg', 'description' => 'A group for cybersecurity professionals and learners', 'createdAt' => now(), 'user_id' => 3, 'quest_id' => null],
            ['id' => 4, 'name' => 'Web Development', 'groupPicture' => 'group4.jpg', 'description' => 'A group for web development enthusiasts', 'createdAt' => now(), 'user_id' => 4, 'quest_id' => null],
            ['id' => 5, 'name' => 'Data Science Lovers', 'groupPicture' => 'group5.jpg', 'description' => 'A group for data science enthusiasts and professionals', 'createdAt' => now(), 'user_id' => 5, 'quest_id' => null],
        ]);

        // GROUP_USER (Pivot table)
        DB::table('group_user')->insert([
            ['id' => 1, 'user_id' => 1, 'group_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 2, 'group_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 3, 'group_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'user_id' => 4, 'group_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'user_id' => 5, 'group_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'user_id' => 1, 'group_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'user_id' => 2, 'group_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'user_id' => 3, 'group_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'user_id' => 4, 'group_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'user_id' => 5, 'group_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // REPONSES
        DB::table('reponses')->insert([
            ['id' => 1, 'content' => 'AI is a field of computer science focused on creating systems that can perform tasks that normally require human intelligence.', 'description' => 'AI encompasses machine learning, deep learning, and natural language processing.', 'datePost' => now(), 'contentType' => 'text', 'quest_id' => 1, 'user_id' => 2],
            ['id' => 2, 'content' => 'To secure your website, you should implement SSL, use strong passwords, update software regularly, and consider using a web application firewall (WAF).', 'description' => 'Web security involves multiple layers of protection.', 'datePost' => now(), 'contentType' => 'text', 'quest_id' => 2, 'user_id' => 3],
            ['id' => 3, 'content' => 'Data science can be used to make data-driven decisions, predict trends, and optimize business processes.', 'description' => 'In fields like marketing, healthcare, and finance, data science provides valuable insights.', 'datePost' => now(), 'contentType' => 'text', 'quest_id' => 3, 'user_id' => 4],
            ['id' => 4, 'content' => 'Ransomware can be avoided by regularly backing up data, keeping systems updated, and being cautious with email attachments.', 'description' => 'Security awareness is key to preventing ransomware attacks.', 'datePost' => now(), 'contentType' => 'text', 'quest_id' => 4, 'user_id' => 5],
            ['id' => 5, 'content' => 'For web development, learning HTML, CSS, JavaScript, and frameworks like React or Angular is essential for building modern websites.', 'description' => 'Backend development with Node.js or Python can also be beneficial.', 'datePost' => now(), 'contentType' => 'text', 'quest_id' => 5, 'user_id' => 1],
        ]);

        // VOTES
        DB::table('votes')->insert([
            ['id' => 1, 'nbreVote' => 5, 'reponse_id' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nbreVote' => 3, 'reponse_id' => 2, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nbreVote' => 4, 'reponse_id' => 3, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nbreVote' => 2, 'reponse_id' => 4, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nbreVote' => 1, 'reponse_id' => 5, 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
