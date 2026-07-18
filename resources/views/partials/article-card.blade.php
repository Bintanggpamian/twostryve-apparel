<a href="{{ route('article.show', $article->slug) }}" class="article-card">
    <div class="article-card-image">
        <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" loading="lazy">
    </div>
    <div class="article-card-body">
        <span class="article-card-tag">{{ $article->tag }}</span>
        <h3 class="article-card-title">{{ $article->title }}</h3>
        <p class="article-card-excerpt">{{ $article->excerpt }}</p>
        <div class="article-card-meta">
            <span>{{ $article->published_at?->format('Y-m-d') ?? '' }}</span>
            <span>&middot;</span>
            <span>{{ $article->read_time }}</span>
        </div>
    </div>
</a>
