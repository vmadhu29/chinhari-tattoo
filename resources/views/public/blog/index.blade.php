@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden" aria-label="Blog Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-verli/60"></div>
            <span class="text-verli text-xs tracking-[0.4em] uppercase font-semibold">Tattoo Insights</span>
            <div class="w-8 h-px bg-verli/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            CHINHARI <span class="text-verli-gradient">JOURNAL</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Tips on tattoo aftercare, healing timelines, custom design ideas, and news from our studio in Raipur.
        </p>
    </div>
</section>

<section class="py-20 bg-studio-darker border-t border-studio-border" aria-label="Blog Feed">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($blogs->isEmpty())
            <div class="text-center py-20 bg-studio-black border border-studio-border rounded-2xl" data-reveal>
                <span class="text-5xl block mb-4" aria-hidden="true">📝</span>
                <h3 class="text-studio-white font-medium mb-1">Journal Is Empty</h3>
                <p class="text-studio-muted text-xs">Our artists are busy working on tattoo journals. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $i => $post)
                    <article class="group card p-0 rounded-2xl border border-studio-border bg-studio-darker hover:border-verli/50 hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col h-full shadow-lg" data-reveal data-delay="{{ $i * 100 }}">
                        <div class="flex-1 flex flex-col">
                            {{-- Featured Image placeholder/actual --}}
                            <div class="aspect-video bg-studio-black overflow-hidden relative">
                                <img 
                                    src="{{ $post->featured_image ? (Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/'.$post->featured_image)) : 'https://picsum.photos/600/400?random='.$i }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                >
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-4 text-xs text-studio-faint mb-3">
                                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->reading_time_minutes ?? 5 }} min read</span>
                                </div>
                                @php
                                    $postUrl = $post->external_url ?? route('blog.show', $post->slug);
                                    $targetAttr = $post->external_url ? 'target="_blank" rel="noopener"' : '';
                                @endphp
                                <h3 class="text-studio-white font-serif text-xl font-bold mb-3 group-hover:text-verli transition-colors line-clamp-2">
                                    <a href="{{ $postUrl }}" {!! $targetAttr !!}>{{ $post->title }}</a>
                                </h3>
                                <p class="text-studio-muted text-sm leading-relaxed line-clamp-3">{{ $post->excerpt }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-4 border-t border-studio-border/20 mt-auto flex items-center justify-between">
                            <span class="text-xs text-verli uppercase tracking-wider font-semibold">{{ optional($post->category)->name ?? 'General' }}</span>
                            <a href="{{ $postUrl }}" {!! $targetAttr !!} class="text-xs text-studio-white group-hover:text-verli transition-colors font-semibold">Read Article →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
