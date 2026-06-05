@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-16 overflow-hidden bg-studio-darker" aria-label="Blog Article">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <a href="{{ route('blog') }}" class="inline-flex items-center text-sm text-verli hover:text-verli-light mb-8 group transition-colors">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Blog
        </a>

        <article class="space-y-8" data-reveal>
            {{-- Meta Tags --}}
            <div class="space-y-4">
                <span class="badge-verli text-xs px-2.5 py-1">{{ $blog->category->name }}</span>
                <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider leading-tight">
                    {{ $blog->title }}
                </h1>
                <div class="flex items-center gap-4 text-xs text-studio-faint">
                    <span>Published {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                    <span>•</span>
                    <span>By {{ $blog->author->name }}</span>
                    <span>•</span>
                    <span>{{ $blog->reading_time_minutes ?? 5 }} min read</span>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="rounded-2xl overflow-hidden border border-studio-border bg-studio-black">
                <img 
                    src="{{ $blog->featured_image ? asset('storage/'.$blog->featured_image) : 'https://picsum.photos/800/500?random=1' }}" 
                    alt="{{ $blog->title }}"
                    class="w-full h-auto object-cover max-h-[500px]"
                >
            </div>

            {{-- Excerpt --}}
            <p class="text-studio-white text-lg font-medium leading-relaxed italic border-l-4 border-verli pl-6">
                {{ $blog->excerpt }}
            </p>

            {{-- Content --}}
            <div class="text-studio-muted text-sm md:text-base leading-relaxed space-y-6 pt-4">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </article>
    </div>
</section>

{{-- Recent Articles --}}
<section class="py-20 bg-studio-black border-t border-studio-border" aria-labelledby="recent-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Fresh Reads</div>
            <h2 id="recent-heading" class="section-title">Recent <span class="text-verli-gradient">Articles</span></h2>
        </div>

        @if($recent->isEmpty())
            <p class="text-center text-studio-muted text-sm">No recent articles found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recent as $i => $post)
                    <article class="card p-0 rounded-2xl border border-studio-border bg-studio-darker overflow-hidden flex flex-col justify-between" data-reveal data-delay="{{ $i * 100 }}">
                        <div>
                            <div class="aspect-video bg-studio-card overflow-hidden relative">
                                <img 
                                    src="{{ $post->featured_image ? asset('storage/'.$post->featured_image) : 'https://picsum.photos/600/400?random='.$i }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-4 text-xs text-studio-faint mb-3">
                                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->reading_time_minutes ?? 5 }} min read</span>
                                </div>
                                <h3 class="text-studio-white font-serif text-lg font-bold mb-3 hover:text-verli transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-studio-muted text-xs leading-relaxed line-clamp-3">{{ $post->excerpt }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 border-t border-studio-border/20 mt-4 flex items-center justify-between">
                            <span class="text-xs text-verli uppercase tracking-wider font-semibold">{{ $post->category->name }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-xs text-studio-white hover:text-verli transition-colors font-semibold">Read Article →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
