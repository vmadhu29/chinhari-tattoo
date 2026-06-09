<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

// Ensure storage link exists
if (!file_exists(public_path('storage'))) {
    app('files')->link(storage_path('app/public'), public_path('storage'));
}

Storage::disk('public')->makeDirectory('blogs');

$images = [
    'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?q=80&w=1200',
    'https://images.unsplash.com/photo-1611501275019-9b5cda994e8d?q=80&w=1200',
    'https://images.unsplash.com/photo-1562962230-16e4623d36e6?q=80&w=1200',
    'https://images.unsplash.com/photo-1550537687-c91072c4792d?q=80&w=1200',
    'https://images.unsplash.com/photo-1578301978018-3005759f48f7?q=80&w=1200',
    'https://images.unsplash.com/photo-1552858725-2758b5fb1286?q=80&w=1200',
    'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?q=80&w=1200'
];

$paths = $images;

foreach($paths as $index => $path) {
    echo "Using external image " . ($index + 1) . "\n";
}

$user = User::first();
if (!$user) {
    $user = User::create([
        'name' => 'Madhu Verma',
        'email' => 'admin@chinhari.com',
        'password' => bcrypt('password')
    ]);
}

$category1 = BlogCategory::firstOrCreate(['name' => 'Tattoo Care', 'slug' => 'tattoo-care']);
$category2 = BlogCategory::firstOrCreate(['name' => 'Tattoo Styles', 'slug' => 'tattoo-styles']);
$category3 = BlogCategory::firstOrCreate(['name' => 'First Timers', 'slug' => 'first-timers']);
$category4 = BlogCategory::firstOrCreate(['name' => 'Design & Concepts', 'slug' => 'design-concepts']);

Blog::truncate(); // Clear existing

Blog::create([
    'category_id' => $category1->id,
    'author_id' => $user->id,
    'title' => 'The Ultimate Guide to Tattoo Aftercare',
    'slug' => 'ultimate-guide-tattoo-aftercare',
    'excerpt' => 'Proper aftercare is crucial for your new tattoo. Learn the best practices for healing and preserving your ink for years to come.',
    'content' => 'Getting a new tattoo is exciting, but the process does not end when you leave the studio. Proper aftercare is essential to ensure your new ink heals perfectly and looks vibrant for years to come.

<h3 class="text-xl font-bold text-white mt-8 mb-4">1. Keep It Covered Initially</h3>
Your artist will wrap your tattoo before you leave. Leave this covering on for the recommended time, usually 2 to 4 hours. This protects the open wound from airborne bacteria and physical irritation on your way home.

<h3 class="text-xl font-bold text-white mt-8 mb-4">2. Wash Gently</h3>
Once you remove the wrap, gently wash the area with lukewarm water and a mild, fragrance-free antibacterial soap. Do not use a washcloth or sponge; your clean hands are best.

<img src="/storage/'.$paths[1].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Aftercare">

<h3 class="text-xl font-bold text-white mt-8 mb-4">3. Pat Dry</h3>
Never rub your new tattoo. Gently pat it dry with a clean paper towel. Regular cloth towels can harbor bacteria and snag on peeling skin. Allow it to air dry for a few minutes before proceeding to the next step.

<h3 class="text-xl font-bold text-white mt-8 mb-4">4. Moisturize Lightly</h3>
Apply a very thin layer of an artist-recommended ointment or unscented lotion. Less is more – your tattoo needs to breathe to heal properly. Over-moisturizing can lead to clogged pores and breakouts, which can pull the ink out.

<h3 class="text-xl font-bold text-white mt-8 mb-4">5. Avoid Sun and Water</h3>
Keep your new tattoo out of direct sunlight for at least 3-4 weeks. Additionally, avoid swimming pools, hot tubs, and baths. Showers are fine, but do not soak the tattoo under the water stream for long.',
    'featured_image' => $paths[0], 
    'status' => 'published',
    'published_at' => now(),
    'reading_time_minutes' => 5,
]);

Blog::create([
    'category_id' => $category2->id,
    'author_id' => $user->id,
    'title' => 'Choosing the Right Tattoo Style for You',
    'slug' => 'choosing-right-tattoo-style',
    'excerpt' => 'From Traditional to Realism, exploring the various tattoo styles to find the perfect match for your next piece.',
    'content' => 'With so many tattoo styles out there, choosing the right one for your next piece can be overwhelming. Each style has its own unique history, aesthetic, and technique. In this guide, we will break down some of the most popular tattoo styles to help you find your perfect match.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Traditional (Old School)</h3>
Characterized by bold black outlines, a limited color palette, and iconic imagery like anchors, roses, and skulls. This style is timeless and ages beautifully.

<img src="/storage/'.$paths[2].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Artist Working">

<h3 class="text-xl font-bold text-white mt-8 mb-4">Realism</h3>
As the name suggests, realism tattoos look like photographs on the skin. They require immense skill to capture fine details, shading, and lighting. Realism can be done in black and grey or full color.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Minimalist / Fine Line</h3>
Delicate, elegant, and understated. Fine line tattoos use single needles to create intricate, subtle designs. They are perfect for those who want something discreet and sophisticated.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Geometric</h3>
Using shapes, lines, and patterns to create mesmerizing designs. Geometric tattoos often incorporate elements of sacred geometry and mandalas. Precision is key for this style.',
    'featured_image' => $paths[2], 
    'status' => 'published',
    'published_at' => now()->subDays(1),
    'reading_time_minutes' => 4,
]);

Blog::create([
    'category_id' => $category3->id,
    'author_id' => $user->id,
    'title' => 'Tattoo Pain Levels: What to Expect',
    'slug' => 'tattoo-pain-levels',
    'excerpt' => 'A comprehensive guide to tattoo pain, mapping out the most and least painful spots on the body.',
    'content' => 'One of the most common questions we get is: "How much does it hurt?" The truth is, all tattoos hurt to some degree, but the level of pain varies wildly depending on placement, size, and your personal pain tolerance.

<h3 class="text-xl font-bold text-white mt-8 mb-4">The Least Painful Spots</h3>
Generally, areas with more fat and fewer nerve endings are the easiest to get tattooed. This includes the outer shoulder, calves, forearms, and outer thighs.

<img src="/storage/'.$paths[3].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Pain Map">

<h3 class="text-xl font-bold text-white mt-8 mb-4">The Most Painful Spots</h3>
Areas where the skin is thin and close to the bone are notoriously spicy. The ribs, spine, kneecaps, feet, and hands will definitely test your endurance. The armpit and inner bicep are also extremely sensitive due to the high density of nerve endings.

<h3 class="text-xl font-bold text-white mt-8 mb-4">How to Manage the Pain</h3>
Make sure you get a good night\'s sleep, eat a solid meal before your appointment, and stay hydrated. Do not drink alcohol the night before or take blood thinners. We also recommend bringing headphones or a friend to distract you during longer sessions.',
    'featured_image' => $paths[1], 
    'status' => 'published',
    'published_at' => now()->subDays(3),
    'reading_time_minutes' => 6,
]);

Blog::create([
    'category_id' => $category4->id,
    'author_id' => $user->id,
    'title' => 'The Custom Design Process Explained',
    'slug' => 'custom-design-process',
    'excerpt' => 'Ever wondered how an idea turns into a masterpiece? Here is a behind-the-scenes look at how we create custom tattoos.',
    'content' => 'At Chinhari Tattoo Studio, we pride ourselves on creating unique, custom pieces for every client. Our design process is collaborative, ensuring you get exactly what you want.

<h3 class="text-xl font-bold text-white mt-8 mb-4">1. The Consultation</h3>
It all starts with a conversation. We discuss your ideas, themes, preferred styles, and placement. Feel free to bring reference images, but remember, we don\'t copy other artists\' work—we use it as inspiration to create something uniquely yours.

<h3 class="text-xl font-bold text-white mt-8 mb-4">2. The Concept Sketch</h3>
Once we have the details, your artist will create a rough digital or hand-drawn sketch to lock in the composition, flow, and sizing.

<img src="/storage/'.$paths[4].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Sketching">

<h3 class="text-xl font-bold text-white mt-8 mb-4">3. Refinement and Stencil</h3>
After your feedback, the sketch is refined into the final line-art that will become the stencil. Any final adjustments can be made on the day of the appointment before the needle touches the skin.

Trust the process and trust your artist. We are here to make your vision a reality.',
    'featured_image' => $paths[4], 
    'status' => 'published',
    'published_at' => now()->subDays(5),
    'reading_time_minutes' => 3,
]);

Blog::create([
    'category_id' => $category4->id,
    'author_id' => $user->id,
    'title' => 'Cover-Ups vs. Blast-Overs: What is the Difference?',
    'slug' => 'cover-ups-vs-blast-overs',
    'excerpt' => 'Got an old tattoo you are not happy with? Learn about the different techniques artists use to transform unwanted ink.',
    'content' => 'We all have regrets, and sometimes that regret comes in the form of an old, faded, or poorly executed tattoo. Luckily, you have options.

<h3 class="text-xl font-bold text-white mt-8 mb-4">The Cover-Up</h3>
A traditional cover-up completely hides the old tattoo beneath a new design. This process requires the new tattoo to be significantly larger and darker than the original. Artists often use heavy shading, textures, and specific color palettes to mask the old ink. It is highly technical work.

<img src="'.$paths[4].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Cover Up">

<h3 class="text-xl font-bold text-white mt-8 mb-4">The Blast-Over</h3>
A blast-over is a completely different approach. Instead of trying to hide the old tattoo, a blast-over simply places a bold, heavy blackwork design directly over it, allowing the old tattoo to peek through the negative spaces. It is a raw, punk-rock aesthetic that embraces the history of the old tattoo rather than erasing it.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Which is Right for You?</h3>
This heavily depends on how dark and dense your original tattoo is. Sometimes, laser removal is recommended to lighten the old tattoo before a successful cover-up can be applied.',
    'featured_image' => $paths[4], 
    'status' => 'published',
    'published_at' => now()->subDays(7),
    'reading_time_minutes' => 4,
]);

Blog::create([
    'category_id' => $category3->id,
    'author_id' => $user->id,
    'title' => '5 Things to Do Before Your First Tattoo Session',
    'slug' => 'prep-for-first-tattoo',
    'excerpt' => 'Nervous about your first tattoo? Follow these 5 essential tips to ensure a smooth, comfortable experience in the chair.',
    'content' => 'Getting your first tattoo is a major milestone. It is completely normal to feel a mix of excitement and anxiety. To help you prepare, we\'ve compiled a list of the 5 most important things to do before you sit in the chair.

<h3 class="text-xl font-bold text-white mt-8 mb-4">1. Hydrate and Moisturize</h3>
Start drinking plenty of water and moisturizing the area you plan to get tattooed a week in advance. Healthy, hydrated skin takes ink much better and heals faster.

<h3 class="text-xl font-bold text-white mt-8 mb-4">2. Eat a Heavy Meal</h3>
Never get tattooed on an empty stomach. Your body will experience an adrenaline dump and a drop in blood sugar. Eating a solid, carb-heavy meal beforehand prevents you from passing out or feeling sick.

<img src="'.$paths[5].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Tattoo Studio">

<h3 class="text-xl font-bold text-white mt-8 mb-4">3. Dress Comfortably</h3>
Wear loose, comfortable clothing that allows easy access to the tattoo area. Remember that ink and blood can occasionally stain clothes, so don\'t wear your favorite white shirt.

<h3 class="text-xl font-bold text-white mt-8 mb-4">4. Bring Entertainment</h3>
Tattooing can be a long process. Bring headphones, download a movie, or bring a book. Distracting your mind is one of the best ways to manage pain.

<h3 class="text-xl font-bold text-white mt-8 mb-4">5. Breathe</h3>
When the needle hits, the instinct is to tense up and hold your breath. This actually makes the pain worse. Focus on taking slow, deep breaths to relax your muscles.',
    'featured_image' => $paths[5], 
    'status' => 'published',
    'published_at' => now()->subDays(10),
    'reading_time_minutes' => 5,
]);

$category5 = BlogCategory::firstOrCreate(['name' => 'Astrology', 'slug' => 'astrology']);

Blog::create([
    'category_id' => $category5->id,
    'author_id' => $user->id,
    'title' => 'Aligning Your Ink: The Ultimate Guide to Zodiac Tattoos',
    'slug' => 'zodiac-sign-tattoos',
    'excerpt' => 'Discover the perfect tattoo inspiration based on your astrological sign. From bold Leo lions to intuitive Pisces water motifs.',
    'content' => 'Astrology and tattoos have a long, intertwined history. Getting inked with elements representing your sun, moon, or rising sign is a powerful way to wear your identity on your sleeve. But a zodiac tattoo doesn\'t just have to be a simple glyph. 

Here is our unique guide on how to represent your astrological sign through custom tattoo art.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Fire Signs: Aries, Leo, Sagittarius</h3>
Fire signs are passionate, dynamic, and bold. Your tattoos should reflect that intense energy.
For **Aries** (The Ram), consider bold neo-traditional rams, striking red linework, or symbols of Mars (their ruling planet). 
For **Leo** (The Lion), grand realism lion portraits, sun motifs, or crowns emphasize your regal nature. 
For **Sagittarius** (The Archer), detailed bow and arrow designs, compasses, or world maps reflect your adventurous, wandering spirit.

<img src="'.$paths[6].'" class="my-8 rounded-2xl w-full shadow-lg border border-studio-border" alt="Zodiac Tattoos">

<h3 class="text-xl font-bold text-white mt-8 mb-4">Earth Signs: Taurus, Virgo, Capricorn</h3>
Grounded, practical, and deeply connected to the physical world, earth signs thrive with nature-inspired ink.
**Taurus** (The Bull) pairs perfectly with botanical sleeves, delicate vines, or powerful bull skulls decorated with emeralds.
**Virgo** (The Maiden) is detail-oriented, making fine-line geometric shapes, wheat stalks, or intricate mandalas an ideal choice.
**Capricorn** (The Sea-Goat) represents discipline and ambition. Think strong architectural tattoos, mountain ranges, or clocks symbolizing time.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Air Signs: Gemini, Libra, Aquarius</h3>
Intellectual, communicative, and free-spirited, air signs need tattoos that capture motion and thought.
**Gemini** (The Twins) is beautifully represented by dual-faced art, mirror-image tattoos, or soaring birds.
**Libra** (The Scales) seeks balance and beauty. Symmetrical designs, intricate scales of justice, or Venus-inspired aesthetic pieces are perfect.
**Aquarius** (The Water Bearer) is the visionary. Space motifs, alien elements, or flowing cosmic water designs match their eccentric vibe.

<h3 class="text-xl font-bold text-white mt-8 mb-4">Water Signs: Cancer, Scorpio, Pisces</h3>
Deeply emotional, intuitive, and mysterious, water signs connect best with fluid, meaningful designs.
**Cancer** (The Crab) is ruled by the moon. Lunar phases, tide tattoos, or delicate silver linework capture their shifting emotions.
**Scorpio** (The Scorpion) is intense and transformative. Dark blackwork scorpions, snakes shedding their skin, or Pluto symbols represent their depth.
**Pisces** (The Fish) is dreamy and artistic. Watercolor style tattoos, koi fish swimming in a circle, or ocean waves perfectly encapsulate their boundless imagination.',
    'featured_image' => $paths[6], 
    'status' => 'published',
    'published_at' => now()->subDays(12),
    'reading_time_minutes' => 6,
]);

echo "Blogs created successfully.\n";
