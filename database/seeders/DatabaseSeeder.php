<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@unicourse.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Regular User
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Create Sample Courses
        $courses = [
            [
                'title' => 'Full-Stack Web Development Bootcamp',
                'description' => 'Kuasai pengembangan web dari nol hingga mahir dalam kursus komprehensif ini. Anda akan mempelajari HTML5, CSS3, JavaScript ES6+, dan framework modern seperti React dan Vue.js untuk frontend. Di sisi backend, Anda akan mendalami PHP, Laravel, Node.js, dan Express. Kursus ini juga mencakup database MySQL dan MongoDB, REST API development, autentikasi & otorisasi, deployment ke cloud, serta best practices dalam version control dengan Git. Cocok untuk pemula yang ingin menjadi web developer profesional dengan portfolio proyek nyata.',
                'price' => 1500000,
                'quota' => 30,
                'start_date' => now()->addDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Data Science & Machine Learning dengan Python',
                'description' => 'Pelajari ilmu data dan machine learning dari dasar hingga advanced dalam kursus intensif ini. Materi mencakup Python programming, library NumPy dan Pandas untuk manipulasi data, Matplotlib dan Seaborn untuk visualisasi data, serta Scikit-learn untuk algoritma machine learning. Anda juga akan mempelajari deep learning dengan TensorFlow dan Keras, natural language processing (NLP), dan computer vision. Kursus ini dilengkapi dengan 10+ proyek hands-on menggunakan dataset real-world dari Kaggle. Sertifikat diberikan setelah menyelesaikan capstone project.',
                'price' => 2000000,
                'quota' => 25,
                'start_date' => now()->addDays(14),
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development dengan Flutter',
                'description' => 'Bangun aplikasi mobile cross-platform untuk Android dan iOS dalam satu codebase menggunakan Flutter dan Dart. Kursus ini mencakup dasar-dasar Dart programming, widget system Flutter, state management (Provider, Bloc, GetX), navigasi dan routing, integrasi REST API dan Firebase, push notification, local storage, dan animasi. Anda akan membangun 5 aplikasi lengkap termasuk e-commerce app, social media app, dan productivity app. Di akhir kursus, Anda akan belajar cara publish aplikasi ke Google Play Store dan Apple App Store.',
                'price' => 1800000,
                'quota' => 20,
                'start_date' => now()->addDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Design Masterclass',
                'description' => 'Kuasai seni desain antarmuka pengguna (UI) dan pengalaman pengguna (UX) dalam kursus komprehensif ini. Pelajari prinsip-prinsip desain visual, teori warna, tipografi, dan layout. Anda akan menguasai Figma dari dasar hingga advanced termasuk prototyping, auto-layout, components, dan design systems. Materi UX mencakup user research, persona creation, user journey mapping, wireframing, usability testing, dan accessibility (WCAG). Kursus dilengkapi dengan studi kasus redesign aplikasi populer dan portfolio review dari mentor industri.',
                'price' => 1200000,
                'quota' => 35,
                'start_date' => now()->addDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'DevOps Engineering & Cloud Architecture',
                'description' => 'Jadilah DevOps Engineer profesional dengan menguasai tools dan praktik modern. Kursus ini mencakup Linux administration, shell scripting, containerization dengan Docker, orchestration dengan Kubernetes, CI/CD pipeline dengan Jenkins dan GitHub Actions, Infrastructure as Code dengan Terraform dan Ansible, monitoring dengan Prometheus dan Grafana, serta logging dengan ELK Stack. Anda juga akan mempelajari cloud platforms AWS, Google Cloud, dan Azure termasuk EC2, S3, Lambda, Cloud Functions, dan Kubernetes Engine. Sertifikasi AWS Cloud Practitioner preparation included.',
                'price' => 2500000,
                'quota' => 15,
                'start_date' => now()->addDays(21),
                'is_active' => true,
            ],
            [
                'title' => 'Cybersecurity & Ethical Hacking',
                'description' => 'Pelajari keamanan siber dan ethical hacking untuk melindungi sistem dan jaringan dari serangan. Materi mencakup networking fundamentals, Linux untuk security, cryptography, web application security (OWASP Top 10), penetration testing methodology, vulnerability assessment, social engineering, dan incident response. Anda akan menggunakan tools professional seperti Kali Linux, Burp Suite, Metasploit, Wireshark, dan Nmap. Kursus ini mempersiapkan Anda untuk sertifikasi CEH (Certified Ethical Hacker) dan CompTIA Security+. Lab praktik dengan environment virtual yang aman.',
                'price' => 2200000,
                'quota' => 20,
                'start_date' => now()->addDays(18),
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing & SEO Mastery',
                'description' => 'Kuasai strategi digital marketing modern untuk mengembangkan bisnis online. Kursus mencakup Search Engine Optimization (SEO) on-page dan off-page, Google Ads dan Facebook Ads, email marketing automation, content marketing strategy, social media marketing, analytics dan data-driven marketing, conversion rate optimization, dan affiliate marketing. Anda akan belajar menggunakan tools seperti Google Analytics, Google Search Console, SEMrush, Ahrefs, dan Mailchimp. Dilengkapi dengan studi kasus campaign nyata dan template marketing yang bisa langsung digunakan.',
                'price' => 900000,
                'quota' => 50,
                'start_date' => now()->addDays(3),
                'is_active' => true,
            ],
            [
                'title' => 'Artificial Intelligence & Deep Learning',
                'description' => 'Dalami kecerdasan buatan dan deep learning dalam kursus advanced ini. Materi mencakup neural networks dari perceptron hingga deep networks, Convolutional Neural Networks (CNN) untuk image recognition, Recurrent Neural Networks (RNN) dan LSTM untuk sequence data, Transformers dan attention mechanism, Generative AI termasuk GANs dan diffusion models, serta Large Language Models (LLM). Anda akan membangun proyek AI nyata seperti image classifier, chatbot, dan recommendation system menggunakan PyTorch dan TensorFlow. Prerequisites: Python dan dasar machine learning.',
                'price' => 2800000,
                'quota' => 15,
                'start_date' => now()->addDays(28),
                'is_active' => true,
            ],
            [
                'title' => 'Business Analysis & Product Management',
                'description' => 'Pelajari skill Business Analyst dan Product Manager yang sangat dicari di industri tech. Materi mencakup requirements gathering dan documentation, user story writing, agile dan scrum methodology, product roadmap planning, stakeholder management, data analysis untuk product decisions, A/B testing, product metrics dan KPIs, competitive analysis, dan go-to-market strategy. Anda akan menggunakan tools seperti Jira, Confluence, Miro, dan analytics platforms. Kursus dilengkapi dengan mock interviews dan mentorship dari PM senior di perusahaan tech unicorn.',
                'price' => 1600000,
                'quota' => 25,
                'start_date' => now()->addDays(12),
                'is_active' => true,
            ],
            [
                'title' => 'Game Development dengan Unity',
                'description' => 'Wujudkan impian menjadi game developer dengan menguasai Unity Engine. Kursus ini mencakup C# programming untuk game development, Unity interface dan workflow, 2D dan 3D game development, physics dan collision system, animation dan particle effects, audio implementation, UI/UX untuk games, multiplayer networking, monetization strategies, dan publishing ke Steam dan mobile stores. Anda akan membangun 4 game lengkap: platformer 2D, first-person shooter, puzzle game, dan mobile casual game. Portfolio-ready projects untuk melamar ke game studio.',
                'price' => 1700000,
                'quota' => 20,
                'start_date' => now()->addDays(15),
                'is_active' => true,
            ],
            [
                'title' => 'Blockchain & Web3 Development',
                'description' => 'Masuki dunia blockchain dan Web3 dengan kursus komprehensif ini. Pelajari fundamental blockchain technology, cryptocurrency mechanics, smart contract development dengan Solidity, Ethereum ecosystem, DeFi (Decentralized Finance) protocols, NFT creation dan marketplace, Web3.js dan Ethers.js untuk frontend integration, IPFS untuk decentralized storage, dan DAO governance. Anda akan membangun DApps (Decentralized Applications) lengkap termasuk token, NFT collection, dan DeFi protocol sederhana. Memahami security best practices untuk smart contracts.',
                'price' => 2300000,
                'quota' => 18,
                'start_date' => now()->addDays(25),
                'is_active' => true,
            ],
            [
                'title' => 'Cloud Computing dengan AWS',
                'description' => 'Kuasai Amazon Web Services (AWS), platform cloud terbesar di dunia. Kursus mencakup EC2 untuk compute, S3 untuk storage, RDS dan DynamoDB untuk database, Lambda untuk serverless, API Gateway, CloudFront CDN, VPC networking, IAM security, CloudWatch monitoring, CloudFormation untuk IaC, dan cost optimization strategies. Hands-on labs dengan real AWS environment. Kursus ini mempersiapkan Anda untuk sertifikasi AWS Solutions Architect Associate dan AWS Developer Associate. Free tier account provided untuk praktik.',
                'price' => 1900000,
                'quota' => 22,
                'start_date' => now()->addDays(9),
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['title' => $courseData['title']],
                $courseData
            );
        }
    }
}
