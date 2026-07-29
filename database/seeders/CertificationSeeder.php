<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $certifications = [
            'frontend-developer@swapskill.test' => [
                [
                    'name' => 'Meta Front-End Developer Certificate',
                    'organization' => 'Coursera',
                    'issue_date' => '2024-05-15',
                    'certificate_url' => 'https://coursera.org/verify/example',
                ],
                [
                    'name' => 'Advanced React patterns',
                    'organization' => 'Frontend Masters',
                    'issue_date' => '2025-01-10',
                    'certificate_url' => null,
                ],
            ],
            'ui-designer@swapskill.test' => [
                [
                    'name' => 'Google UX Design Professional Certificate',
                    'organization' => 'Google',
                    'issue_date' => '2023-11-20',
                    'certificate_url' => 'https://coursera.org/verify/ux-example',
                ],
            ],
            'backend-developer@swapskill.test' => [
                [
                    'name' => 'Laravel Certified Developer',
                    'organization' => 'Laravel',
                    'issue_date' => '2024-08-30',
                    'certificate_url' => 'https://certification.laravel.com/verify',
                ],
            ],
            'full-stack-developer@swapskill.test' => [
                [
                    'name' => 'AWS Certified Developer - Associate',
                    'organization' => 'Amazon Web Services',
                    'issue_date' => '2025-02-14',
                    'certificate_url' => 'https://aws.amazon.com/verification',
                ],
            ],
            'graphic-designer@swapskill.test' => [
                [
                    'name' => 'Adobe Certified Professional in Visual Design',
                    'organization' => 'Adobe',
                    'issue_date' => '2023-09-05',
                    'certificate_url' => 'https://adobe.com/verify/cert',
                ],
            ],
            'digital-marketing-specialist@swapskill.test' => [
                [
                    'name' => 'Google Analytics Certification',
                    'organization' => 'Google Skillshop',
                    'issue_date' => '2024-12-01',
                    'certificate_url' => 'https://skillshop.exceedlms.com/verify',
                ],
            ],
        ];

        foreach ($certifications as $email => $userCertifications) {
            $user = User::where('email', $email)->first();
            if (!$user) continue;

            foreach ($userCertifications as $cert) {
                Certification::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'name' => $cert['name'],
                    ],
                    $cert
                );
            }
        }
    }
}
