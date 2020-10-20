<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($active_princs as $active_princ)
        <url>
            <loc>https://qualremedium.com.br/principio-ativo/{{$active_princ['slug_AP']}}</loc>
            <lastmod>{{date('Y-m-d', strtotime($active_princ['created_at']))}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>