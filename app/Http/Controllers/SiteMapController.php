<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use App\Meds;

class SiteMapController extends Controller
{

    public function index()
    {
       
        return response()->view('sitemapIndex')->header('Content-Type', 'text/xml');
       
    }
    public function med()
    {
        $meds = Meds::select('slug','created_at')->distinct('slug')->orderBy('slug','asc')->get()->toarray();
        return response()->view('sitemapMed', compact('meds'))->header('Content-Type', 'text/xml');
       
    }
    public function activePrinc()
    {
        $active_princs = Meds::select('active_princ','slug_AP','created_at')->distinct('active_princ')->orderBy('active_princ','asc')->get()->toarray();
        return response()->view('sitemapActive_princ', compact('active_princs'))->header('Content-Type', 'text/xml');
       
    }
}


