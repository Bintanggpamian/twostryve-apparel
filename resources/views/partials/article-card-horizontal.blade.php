<a href="{{ route('article.show', $article->slug) }}" class="article-card-horizontal">
    <div class="article-card-horizontal-image">
        <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" loading="lazy">
    </div>
    <div class="article-card-horizontal-body">
        <span class="article-card-tag">{{ $article->tag ?? 'Blogs' }}</span>
        <h3 class="article-card-title">{{ $article->title }}</h3>
        
        <div class="article-card-author-meta">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="author-icon"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            <span>@twostryve</span>
        </div>

        <p class="article-card-excerpt">{{ Str::limit(strip_tags($article->excerpt), 120) }}</p>
    </div>
</a>
