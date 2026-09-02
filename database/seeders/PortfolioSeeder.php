<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            'frontend-developer@swapskill.test' => [
                [
                    'title' => 'E-commerce Modern UI',
                    'description' => 'A fully responsive e-commerce storefront built with modern web technologies focusing on performance and accessibility.',
                    'category' => 'Web Development',
                    'technologies' => ['React', 'Tailwind CSS', 'HTML', 'JavaScript'],
                    'project_url' => 'https://example.com/ecommerce-ui',
                    'github_url' => 'https://github.com/example/ecommerce',
                    'demo_url' => 'https://demo.example.com/ecommerce',
                    'featured' => true,
                    'views_count' => rand(100, 5000),
                ],
                [
                    'title' => 'Admin Analytics Dashboard',
                    'description' => 'Complex data visualization dashboard with interactive charts and real-time updates.',
                    'category' => 'Web Application',
                    'technologies' => ['React', 'Chart.js', 'CSS'],
                    'project_url' => 'https://example.com/dashboard',
                    'github_url' => 'https://github.com/example/dashboard',
                    'demo_url' => 'https://demo.example.com/dashboard',
                    'featured' => false,
                    'views_count' => rand(100, 2000),
                ],
                [
                    'title' => 'Product Landing Page',
                    'description' => 'High-conversion landing page with smooth scroll animations.',
                    'category' => 'Landing Page',
                    'technologies' => ['HTML', 'CSS', 'JavaScript'],
                    'project_url' => 'https://example.com/landing',
                    'github_url' => 'https://github.com/example/landing',
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(50, 1000),
                ],
            ],
            'ui-designer@swapskill.test' => [
                [
                    'title' => 'Fintech Mobile App Redesign',
                    'description' => 'Complete UX research and UI redesign for a personal finance mobile application.',
                    'category' => 'UI/UX Design',
                    'technologies' => ['Figma', 'UI Design', 'Prototyping'],
                    'project_url' => 'https://dribbble.com/example/fintech',
                    'github_url' => null,
                    'demo_url' => 'https://figma.com/proto/example',
                    'featured' => true,
                    'views_count' => rand(500, 10000),
                ],
                [
                    'title' => 'SaaS Project Management Dashboard',
                    'description' => 'Clean and intuitive dashboard interface for managing agile software projects.',
                    'category' => 'UI/UX Design',
                    'technologies' => ['Figma', 'UI Design'],
                    'project_url' => 'https://behance.net/example/saas',
                    'github_url' => null,
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(200, 3000),
                ],
            ],
            'backend-developer@swapskill.test' => [
                [
                    'title' => 'High-Performance RESTful API',
                    'description' => 'Scalable microservice API serving 10M+ requests daily for a logistics platform.',
                    'category' => 'Backend Development',
                    'technologies' => ['Laravel', 'PHP', 'MySQL', 'Redis'],
                    'project_url' => 'https://api-docs.example.com',
                    'github_url' => 'https://github.com/example/rest-api',
                    'demo_url' => null,
                    'featured' => true,
                    'views_count' => rand(300, 4000),
                ],
                [
                    'title' => 'Payment Gateway Integration',
                    'description' => 'Secure multi-provider payment processing engine with robust error handling.',
                    'category' => 'Backend Development',
                    'technologies' => ['PHP', 'MySQL', 'Stripe API'],
                    'project_url' => null,
                    'github_url' => 'https://github.com/example/payment-engine',
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(100, 1500),
                ],
            ],
            'full-stack-developer@swapskill.test' => [
                [
                    'title' => 'Interactive E-Learning Platform',
                    'description' => 'End-to-end LMS with video streaming, quizzes, and progress tracking.',
                    'category' => 'Full Stack Web App',
                    'technologies' => ['Vue', 'Laravel', 'MySQL', 'Tailwind CSS'],
                    'project_url' => 'https://elearning.example.com',
                    'github_url' => 'https://github.com/example/lms',
                    'demo_url' => 'https://demo.elearning.example.com',
                    'featured' => true,
                    'views_count' => rand(1000, 8000),
                ],
                [
                    'title' => 'Real-Time Chat Application',
                    'description' => 'WebSocket-powered chat application with typing indicators and read receipts.',
                    'category' => 'Full Stack Web App',
                    'technologies' => ['React', 'Laravel Reverb', 'MySQL'],
                    'project_url' => 'https://chat.example.com',
                    'github_url' => 'https://github.com/example/chat-app',
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(500, 3000),
                ],
                [
                    'title' => 'Headless CMS Engine',
                    'description' => 'Custom content management system with flexible content modeling.',
                    'category' => 'Full Stack Web App',
                    'technologies' => ['Vue', 'Laravel', 'MySQL'],
                    'project_url' => null,
                    'github_url' => 'https://github.com/example/headless-cms',
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(100, 2000),
                ],
            ],
            'graphic-designer@swapskill.test' => [
                [
                    'title' => 'Tech Startup Brand Identity',
                    'description' => 'Complete logo, typography, color palette, and brand guidelines for a new AI startup.',
                    'category' => 'Branding',
                    'technologies' => ['Illustrator', 'Photoshop'],
                    'project_url' => 'https://behance.net/example/branding',
                    'github_url' => null,
                    'demo_url' => null,
                    'featured' => true,
                    'views_count' => rand(800, 6000),
                ],
                [
                    'title' => 'Social Media Campaign Assets',
                    'description' => 'Set of 30 cohesive Instagram and Twitter templates for a summer marketing push.',
                    'category' => 'Social Media Graphics',
                    'technologies' => ['Photoshop', 'Canva'],
                    'project_url' => 'https://dribbble.com/example/social',
                    'github_url' => null,
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(300, 2500),
                ],
            ],
            'digital-marketing-specialist@swapskill.test' => [
                [
                    'title' => 'B2B SaaS SEO Campaign',
                    'description' => 'Comprehensive SEO strategy that increased organic traffic by 300% in 6 months.',
                    'category' => 'SEO',
                    'technologies' => ['Digital Marketing', 'Copywriting', 'Ahrefs'],
                    'project_url' => 'https://example.com/case-study-seo',
                    'github_url' => null,
                    'demo_url' => null,
                    'featured' => true,
                    'views_count' => rand(400, 4000),
                ],
                [
                    'title' => 'Product Launch Email Sequence',
                    'description' => 'High-converting 7-day email drip campaign for a new software tool.',
                    'category' => 'Email Marketing',
                    'technologies' => ['Copywriting', 'Mailchimp'],
                    'project_url' => 'https://example.com/email-marketing',
                    'github_url' => null,
                    'demo_url' => null,
                    'featured' => false,
                    'views_count' => rand(200, 1800),
                ],
            ],
        ];

        foreach ($portfolios as $email => $userPortfolios) {
            $user = User::where('email', $email)->first();
            if (!$user) continue;

            foreach ($userPortfolios as $portfolio) {
                Portfolio::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => $portfolio['title'],
                    ],
                    $portfolio
                );
            }
        }
    }
}
