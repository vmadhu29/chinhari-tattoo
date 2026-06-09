<?php

return [
    'name'             => env('APP_NAME', 'Chinhari Tattoo Studio'),
    'phone'            => env('STUDIO_PHONE', '+91 9285001719'),
    'whatsapp'         => env('STUDIO_WHATSAPP', '+91 9285001719'),
    'whatsapp_number'  => '919285001719', // without +, for wa.me links
    'email'            => env('STUDIO_EMAIL', 'info@chinharitattoostudio.com'),
    'address'          => env('STUDIO_ADDRESS', 'Chinhari Tattoo Studio, Raipur, Chhattisgarh 492001, India'),
    'city'             => 'Raipur',
    'state'            => 'Chhattisgarh',
    'pincode'          => '492001',
    'country'          => 'India',

    // Social Media
    'instagram'        => env('STUDIO_INSTAGRAM', 'https://www.instagram.com/chinhari_tattoo_raipur'),
    'youtube'          => env('STUDIO_YOUTUBE', 'https://www.youtube.com/@ChinhariTattoo'),
    'facebook'         => env('STUDIO_FACEBOOK', 'https://www.facebook.com/ChinhariTattooStudio'),

    // Maps
    'google_maps_url'       => env('STUDIO_GOOGLE_MAPS_URL', 'https://maps.app.goo.gl/FthHoox4rfMViKoLA'),
    'google_maps_embed_url' => env('STUDIO_GOOGLE_MAPS_EMBED_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.549083148285!2d81.6050091!3d21.2497222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a28dda23be28229%3A0x1634f1ec7e584f16!2sChinhari%20Tattoo%20Studio!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin'),
    'google_maps_api_key'   => env('GOOGLE_MAPS_API_KEY', ''),

    // Coordinates
    'latitude'  => 21.2514,
    'longitude' => 81.6296,

    // Business Hours
    'hours' => [
        'display'     => 'Mon – Sun: 10:00 AM – 10:00 PM',
        'open'        => '10:00',
        'close'       => '21:00',
        'days'        => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
        'timezone'    => 'Asia/Kolkata',
    ],

    // Booking Settings
    'deposit_amount'           => 500,   // INR - default deposit
    'min_booking_notice_hours' => 24,    // hours before appointment
    'max_advance_booking_days' => 60,    // days in advance
    'slot_duration_minutes'    => 60,    // default slot size

    // Loyalty Points
    'points_per_booking'       => 100,
    'points_per_rupee'         => 0.1,   // earn 0.1 points per ₹1
    'points_redemption_rate'   => 100,   // 100 points = ₹1 discount

    // Aftercare Schedule (days after booking completion)
    'aftercare_days'           => [1, 3, 7, 14, 30],

    // GST
    'gstin'                    => '',
    'gst_rate'                 => 18.0,
    'hsn_code'                 => '999799',

    // Razorpay
    'razorpay_currency'        => env('RAZORPAY_CURRENCY', 'INR'),
];
