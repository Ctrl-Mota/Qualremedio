<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($meds as $med)
        <url>
            <loc>https://qualremedium.com.br/medicamento/{{$med['slug']}}</loc>
            <lastmod>{{date('Y-m-d', strtotime($med['created_at']))}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>