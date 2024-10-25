@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ url('/articles') }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ url('/category') }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    @foreach($articles as $article)
        <url>
            <loc>{{ url('/articles/' . $article->slug) }}</loc>
            <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($article->updated_at)))->toIso8601String() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach($categories as $category)
        <url>
            <loc>{{ url('/category/' . $category->slug) }}</loc>
            <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($category->updated_at)))->toIso8601String() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach($tags as $tag)
        <url>
            <loc>{{ url('/tag/' . $tag->slug) }}</loc>
            <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($tag->updated_at)))->toIso8601String() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
