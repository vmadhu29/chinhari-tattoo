<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Faq;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Roles & Permissions ──
        $this->call(RolesAndPermissionsSeeder::class);

        // ── 2. Main Branch ──
        $branch = Branch::firstOrCreate(['slug' => 'raipur-main'], [
            'name'           => 'Chinhari Tattoo Studio — Raipur',
            'slug'           => 'raipur-main',
            'address'        => 'Chinhari Tattoo Studio, Raipur',
            'city'           => 'Raipur',
            'state'          => 'Chhattisgarh',
            'pincode'        => '492001',
            'phone'          => '+91 9285001719',
            'whatsapp'       => '+91 9285001719',
            'email'          => 'info@chinharitattoostudio.com',
            'google_maps_url'=> 'https://maps.app.goo.gl/FthHoox4rfMViKoLA',
            'is_active'      => true,
            'is_main_branch' => true,
            'working_hours'  => [
                'monday'    => ['open' => '10:00', 'close' => '21:00'],
                'tuesday'   => ['open' => '10:00', 'close' => '21:00'],
                'wednesday' => ['open' => '10:00', 'close' => '21:00'],
                'thursday'  => ['open' => '10:00', 'close' => '21:00'],
                'friday'    => ['open' => '10:00', 'close' => '21:00'],
                'saturday'  => ['open' => '10:00', 'close' => '21:00'],
                'sunday'    => ['open' => '10:00', 'close' => '21:00'],
            ],
        ]);

        // ── 3. Super Admin User ──
        $admin = User::firstOrCreate(['email' => 'admin@chinharitattoostudio.com'], [
            'name'      => 'Chinhari Admin',
            'email'     => 'admin@chinharitattoostudio.com',
            'password'  => bcrypt('Admin@2026!'),
            'branch_id' => $branch->id,
            'phone'     => '+91 9285001719',
            'is_active' => true,
        ]);
        $admin->assignRole('super-admin');

        // ── 4. Service Categories ──
        $categories = [
            ['name' => 'Realism & Portrait',    'slug' => 'realism-portrait',     'icon' => '🎭', 'color_hex' => '#D4AF37'],
            ['name' => 'Blackwork & Tribal',     'slug' => 'blackwork-tribal',      'icon' => '⬛', 'color_hex' => '#333333'],
            ['name' => 'Geometric & Mandala',    'slug' => 'geometric-mandala',     'icon' => '◻️', 'color_hex' => '#8B0000'],
            ['name' => 'Neo Traditional',        'slug' => 'neo-traditional',       'icon' => '🦅', 'color_hex' => '#B8961E'],
            ['name' => 'Minimalist & Fine Line', 'slug' => 'minimalist-fine-line',  'icon' => '✦',  'color_hex' => '#D3D3D3'],
            ['name' => 'Cover Up',               'slug' => 'cover-up',              'icon' => '🔄', 'color_hex' => '#8B0000'],
            ['name' => 'Religious & Spiritual',  'slug' => 'religious-spiritual',   'icon' => '🕉️', 'color_hex' => '#D4AF37'],
            ['name' => 'Custom Design',          'slug' => 'custom-design',         'icon' => '✏️', 'color_hex' => '#B22222'],
        ];

        foreach ($categories as $i => $cat) {
            ServiceCategory::firstOrCreate(['slug' => $cat['slug']], array_merge($cat, [
                'is_active'   => true,
                'sort_order'  => $i,
                'description' => "Premium {$cat['name']} tattoos by expert artists.",
            ]));
        }

        // ── 5. FAQs ──
        $faqs = [
            ['question' => 'How much does a tattoo cost?',         'answer' => 'Prices vary based on size, complexity, and placement. Small tattoos start from ₹2,000. We offer free consultations for accurate pricing.', 'category' => 'pricing'],
            ['question' => 'Is the studio hygienic and safe?',     'answer' => 'Absolutely. All needles are single-use, equipment is autoclave sterilized, and our artists maintain strict safety protocols throughout.', 'category' => 'safety'],
            ['question' => 'How do I book an appointment?',        'answer' => 'Book online, WhatsApp us at +91 9285001719, or visit us directly. Walk-ins are welcome based on artist availability.', 'category' => 'booking'],
            ['question' => 'How long does healing take?',          'answer' => 'Surface healing takes 2–4 weeks. Full healing (deeper layers) takes 2–6 months. We provide complete aftercare instructions.', 'category' => 'aftercare'],
            ['question' => 'Can you do cover-up tattoos?',         'answer' => 'Yes! Our artists specialize in cover-ups. Share a photo of your existing tattoo and we\'ll design the perfect solution.', 'category' => 'services'],
            ['question' => 'How painful is getting a tattoo?',     'answer' => 'Pain varies by placement. Most describe it as a scratching sensation. We use numbing options on request.', 'category' => 'general'],
            ['question' => 'Do you accept walk-in customers?',     'answer' => 'Yes! Walk-ins are welcome based on artist availability. We recommend booking in advance for guaranteed slots.', 'category' => 'booking'],
            ['question' => 'What payment methods do you accept?',  'answer' => 'We accept cash, UPI, credit/debit cards, and online payment via Razorpay. A deposit is required to confirm online bookings.', 'category' => 'payment'],
        ];

        foreach ($faqs as $i => $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], array_merge($faq, [
                'is_published' => true,
                'sort_order'   => $i,
            ]));
        }

        // ── 6. Sample Testimonials ──
        $testimonials = [
            ['customer_name' => 'Amit Verma',   'customer_location' => 'Raipur',    'rating' => 5, 'content' => 'Dharam Sahu is an absolute genius! Got a hyper-realistic lion portrait on my forearm, and the level of detail is mind-blowing. The studio is extremely clean and hygienic. Best place in Chhattisgarh for custom tattoos!', 'tattoo_style' => 'Realism', 'is_featured' => true, 'is_approved' => true],
            ['customer_name' => 'Sneha Dewangan',    'customer_location' => 'Bhilai',  'rating' => 5, 'content' => 'Absolutely in love with my mandala sleeve. The dotwork and geometric precision is perfect. Dharam took his time to understand my vision and custom-designed the pattern. Highly professional!', 'tattoo_style' => 'Mandala', 'is_featured' => true, 'is_approved' => true],
            ['customer_name' => 'Vikram Singh',     'customer_location' => 'Raipur',    'rating' => 5, 'content' => 'Got my first tattoo here, a custom spiritual Shiva design. The shading and fine lines are incredibly clean. The team makes you feel very comfortable throughout. Highly recommend Chinhari!', 'tattoo_style' => 'Spiritual', 'is_featured' => true, 'is_approved' => true],
        ];

        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['customer_name' => $t['customer_name']], $t);
        }

        // ── 7. Seed Services ──
        $realismCat = ServiceCategory::where('slug', 'realism-portrait')->first();
        $blackworkCat = ServiceCategory::where('slug', 'blackwork-tribal')->first();
        $geometricCat = ServiceCategory::where('slug', 'geometric-mandala')->first();
        $minimalistCat = ServiceCategory::where('slug', 'minimalist-fine-line')->first();

        $servicesData = [
            [
                'category_id' => $realismCat->id,
                'name' => 'Premium Portrait / Realism Tattoo',
                'slug' => 'premium-portrait-realism',
                'description' => 'Detailed hyper-realistic portrait or custom realism art.',
                'short_description' => 'Detailed hyper-realistic custom realism art.',
                'pricing_type' => 'hourly',
                'price_min' => 1500.00,
                'price_max' => 2000.00,
                'deposit_amount' => 1000.00,
                'estimated_duration_minutes' => 240,
                'healing_days' => 14,
                'touch_up_eligible_days' => 45,
                'requires_consultation' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $blackworkCat->id,
                'name' => 'Custom Blackwork / Tribal Tattoo',
                'slug' => 'custom-blackwork-tribal',
                'description' => 'Bold dark lines and tribal patterns, custom mapped to body geometry.',
                'short_description' => 'Bold dark lines and custom tribal patterns.',
                'pricing_type' => 'fixed',
                'price_min' => 4000.00,
                'price_max' => 12000.00,
                'deposit_amount' => 1500.00,
                'estimated_duration_minutes' => 180,
                'healing_days' => 14,
                'touch_up_eligible_days' => 45,
                'requires_consultation' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $geometricCat->id,
                'name' => 'Geometric Mandala & Sacred Geometry',
                'slug' => 'geometric-mandala-sacred',
                'description' => 'Intricate geometric outlines and custom mandala patterns.',
                'short_description' => 'Intricate geometric outlines and mandalas.',
                'pricing_type' => 'fixed',
                'price_min' => 3500.00,
                'price_max' => 15000.00,
                'deposit_amount' => 1000.00,
                'estimated_duration_minutes' => 180,
                'healing_days' => 10,
                'touch_up_eligible_days' => 30,
                'requires_consultation' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $minimalistCat->id,
                'name' => 'Minimalist Fine Line Art',
                'slug' => 'minimalist-fine-line-art',
                'description' => 'Delicate, clean, single-needle style minimalist design.',
                'short_description' => 'Delicate and clean minimalist single-needle tattoos.',
                'pricing_type' => 'fixed',
                'price_min' => 2000.00,
                'price_max' => 5000.00,
                'deposit_amount' => 500.00,
                'estimated_duration_minutes' => 90,
                'healing_days' => 7,
                'touch_up_eligible_days' => 30,
                'requires_consultation' => false,
                'is_active' => true,
            ],
        ];

        foreach ($servicesData as $serv) {
            Service::firstOrCreate(['slug' => $serv['slug']], $serv);
        }

        // ── 8. Seed Artists ──
        $artistsData = [
            [
                'email' => 'dharam@chinharitattoostudio.com',
                'name' => 'Dharam Sahu',
                'display_name' => 'Dharam Sahu',
                'tagline' => 'Founder & Master Artist',
                'bio' => 'Founder and Master Artist of Chinhari Tattoo Studio. Dharam Sahu is Raipur\'s premier tattoo artist with over 10 years of experience. He is internationally acclaimed for hyper-realistic portraits, bold blackwork, custom geometric mandalas, and intricate spiritual designs, turning personal stories into premium life-long body art.',
                'experience_years' => 10,
                'specializations' => ['Realism', 'Portrait', 'Blackwork', 'Geometric', 'Mandala'],
                'awards' => [
                    'Best Realism Artist - Central India Tattoo Expo 2024',
                    'Master Tattooist of the Year - Raipur Art Festival 2025'
                ],
                'base_hourly_rate' => 1500.00,
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'work_start_time' => '10:00:00',
                'work_end_time' => '21:00:00',
                'slot_duration_minutes' => 60,
                'break_duration_minutes' => 15,
                'is_active' => true,
                'accepts_walk_ins' => true,
                'slug' => 'dharam-sahu',
                'profile_photo' => 'images/dharam_sahu.jpg',
            ],
        ];

        foreach ($artistsData as $art) {
            $user = User::firstOrCreate(['email' => $art['email']], [
                'name' => $art['name'],
                'email' => $art['email'],
                'password' => bcrypt('Artist@2026!'),
                'branch_id' => $branch->id,
                'phone' => '+91 9285001719',
                'is_active' => true,
            ]);
            $user->assignRole('artist');

            \App\Models\Artist::firstOrCreate(['user_id' => $user->id], [
                'user_id' => $user->id,
                'branch_id' => $branch->id,
                'display_name' => $art['display_name'],
                'slug' => $art['slug'],
                'tagline' => $art['tagline'],
                'bio' => $art['bio'],
                'experience_years' => $art['experience_years'],
                'specializations' => $art['specializations'],
                'awards' => $art['awards'],
                'base_hourly_rate' => $art['base_hourly_rate'],
                'working_days' => $art['working_days'],
                'work_start_time' => $art['work_start_time'],
                'work_end_time' => $art['work_end_time'],
                'slot_duration_minutes' => $art['slot_duration_minutes'],
                'break_duration_minutes' => $art['break_duration_minutes'],
                'is_active' => $art['is_active'],
                'accepts_walk_ins' => $art['accepts_walk_ins'],
                'sort_order' => 1,
                'profile_photo' => $art['profile_photo'] ?? null,
            ]);
        }

        // ── 9. Seed Portfolio Items ──
        $artists = \App\Models\Artist::all();
        foreach ($artists as $artist) {
            $portfolioData = [
                [
                    'title' => 'Hyper-Realistic Lion Portrait',
                    'slug' => 'hyper-realistic-lion-portrait',
                    'description' => 'Detailed hyper-realistic portrait of a lion on the forearm, showcasing fine fur details and dramatic shading.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Realism',
                    'body_placement' => 'Forearm',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'realism-portrait')->first()->id,
                    'thumbnail_path' => 'https://www.thefashionisto.com/wp-content/uploads/2023/11/Lion-Forearm-Tattoo-Men.jpg',
                    'file_path' => 'https://www.thefashionisto.com/wp-content/uploads/2023/11/Lion-Forearm-Tattoo-Men.jpg',
                ],
                [
                    'title' => 'Sacred Geometry Mandala Sleeve',
                    'slug' => 'sacred-geometry-mandala-sleeve',
                    'description' => 'Complex geometric layout with intricate dotwork and mandala patterns flowing with the forearm anatomy.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Mandala',
                    'body_placement' => 'Sleeve',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'geometric-mandala')->first()->id,
                    'thumbnail_path' => 'https://herway.net/wp-content/uploads/2024/08/Ornamental-Geometric-Mandala-Sleeve.jpg',
                    'file_path' => 'https://herway.net/wp-content/uploads/2024/08/Ornamental-Geometric-Mandala-Sleeve.jpg',
                ],
                [
                    'title' => 'Dark Ornamental Blackwork Backpiece',
                    'slug' => 'dark-ornamental-blackwork-backpiece',
                    'description' => 'Heavy black ornamental patterns and linework featuring a striking snake design designed to accentuate back geometry.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Blackwork',
                    'body_placement' => 'Back',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'blackwork-tribal')->first()->id,
                    'thumbnail_path' => 'https://tattoobnb.com/cdn/shop/files/Big-Blackwork-Snake-and-Circles-on-Men-Back-Tattoo-by-ahn_ttt-Tattoobnb.webp?v=1760683712&width=533',
                    'file_path' => 'https://tattoobnb.com/cdn/shop/files/Big-Blackwork-Snake-and-Circles-on-Men-Back-Tattoo-by-ahn_ttt-Tattoobnb.webp?v=1760683712&width=533',
                ],
                [
                    'title' => 'Delicate Fine Line Rose',
                    'slug' => 'delicate-fine-line-rose',
                    'description' => 'Clean single-needle fine line rose with micro-shading on the wrist, presenting a minimalist elegance.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Fine Line',
                    'body_placement' => 'Wrist',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'minimalist-fine-line')->first()->id,
                    'thumbnail_path' => 'https://91tattoos.com/wp-content/uploads/2025/07/Classic-Outline-Rose-Wrist-Tattoo-With-Blush-Pink-Short-Nails-For-Soft-Floral-Tattoo-Designs-1229x1536.jpg',
                    'file_path' => 'https://91tattoos.com/wp-content/uploads/2025/07/Classic-Outline-Rose-Wrist-Tattoo-With-Blush-Pink-Short-Nails-For-Soft-Floral-Tattoo-Designs-1229x1536.jpg',
                ],
                [
                    'title' => 'Buddha Spiritual Backpiece',
                    'slug' => 'buddha-spiritual-backpiece',
                    'description' => 'Custom religious backpiece depicting a serene Buddha portrait with realistic background details.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Religious',
                    'body_placement' => 'Back',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'religious-spiritual')->first()->id,
                    'thumbnail_path' => 'https://i.pinimg.com/736x/59/c5/97/59c597ad941b79839b5139ccd0aff3a8.jpg',
                    'file_path' => 'https://i.pinimg.com/736x/59/c5/97/59c597ad941b79839b5139ccd0aff3a8.jpg',
                ],
                [
                    'title' => 'Neo-Traditional Snake Tattoo',
                    'slug' => 'neo-traditional-snake-tattoo',
                    'description' => 'Bold color shading and clean line work depicting a snake on the neck in a stunning neo-traditional art style.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Neo Traditional',
                    'body_placement' => 'Neck',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'neo-traditional')->first()->id,
                    'thumbnail_path' => 'https://inkpicks.com/wp-content/uploads/2024/11/snake-neck-tattoo-761614.webp',
                    'file_path' => 'https://inkpicks.com/wp-content/uploads/2024/11/snake-neck-tattoo-761614.webp',
                ],
                [
                    'title' => 'Geometric Floral Arm Tattoo',
                    'slug' => 'geometric-floral-arm-tattoo',
                    'description' => 'Geometric lines combined with a soft stippled black flower on the arm.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Geometric',
                    'body_placement' => 'Arm',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'geometric-mandala')->first()->id,
                    'thumbnail_path' => 'https://i.pinimg.com/originals/8e/11/eb/8e11eb8cb3a9a1e4011d855d45217ea9.jpg',
                    'file_path' => 'https://i.pinimg.com/originals/8e/11/eb/8e11eb8cb3a9a1e4011d855d45217ea9.jpg',
                ],
                [
                    'title' => 'Polynesian Tribal Leg Sleeve',
                    'slug' => 'polynesian-tribal-leg-sleeve',
                    'description' => 'Polynesian style tribal leg sleeve with detailed geometric patterns.',
                    'media_type' => 'image',
                    'tattoo_style' => 'Tribal',
                    'body_placement' => 'Leg',
                    'is_featured' => true,
                    'is_published' => true,
                    'category_id' => ServiceCategory::where('slug', 'cover-up')->first()->id,
                    'thumbnail_path' => 'https://cdn2.stylecraze.com/wp-content/uploads/2024/08/Polynesian-Tribal-Leg-Tattoo.jpg',
                    'file_path' => 'https://cdn2.stylecraze.com/wp-content/uploads/2024/08/Polynesian-Tribal-Leg-Tattoo.jpg',
                ],
            ];
            foreach ($portfolioData as $p) {
                \App\Models\Portfolio::firstOrCreate(['slug' => $p['slug']], array_merge($p, [
                    'artist_id' => $artist->id,
                ]));
            }
        }

        // ── 10. Seed Blog Categories & Blogs ──
        $blogCat = \App\Models\BlogCategory::firstOrCreate(['slug' => 'aftercare-guides'], [
            'name' => 'Aftercare Guides',
            'slug' => 'aftercare-guides',
            'description' => 'Guides on how to take care of your tattoos.',
        ]);

        $author = User::whereHas('roles', fn($q) => $q->where('name', 'super-admin'))->first();

        $blogsData = [
            [
                'category_id' => $blogCat->id,
                'author_id' => $author->id,
                'title' => 'Tattoo Aftercare Guide: Keeping Your Ink Vibrant',
                'slug' => 'tattoo-aftercare-guide-keeping-ink-vibrant',
                'excerpt' => 'Proper aftercare is crucial for tattoo healing. Learn how to clean, hydrate, and protect your new ink.',
                'content' => 'Getting a tattoo is only half the battle; how you take care of it during the first few weeks determines how it will look for years to come. Here is our step-by-step instructions on cleaning, hydrating, and preserving your custom body art...',
                'status' => 'published',
                'published_at' => now(),
                'reading_time_minutes' => 5,
            ],
            [
                'category_id' => $blogCat->id,
                'author_id' => $author->id,
                'title' => 'Selecting the Perfect Placement for Your First Tattoo',
                'slug' => 'selecting-perfect-placement-first-tattoo',
                'excerpt' => 'Where should you put your first tattoo? Explore the most popular placements, pain factors, and longevity.',
                'content' => 'Deciding on a tattoo design is exciting, but deciding where to place it on your body is just as important. Some areas are more sensitive, while others are more visible or prone to stretching. Read our guide to making the right choice...',
                'status' => 'published',
                'published_at' => now(),
                'reading_time_minutes' => 4,
            ]
        ];

        foreach ($blogsData as $blog) {
            \App\Models\Blog::firstOrCreate(['slug' => $blog['slug']], $blog);
        }

        $this->command->info('✅ Chinhari Tattoo Studio seeded successfully!');
        $this->command->info('📧 Admin: admin@chinharitattoostudio.com');
        $this->command->info('🔑 Password: Admin@2026!');
    }
}
