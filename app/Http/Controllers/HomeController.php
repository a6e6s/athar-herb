<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->limit(8)
            ->get();

        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $posts = Post::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.home', compact('banners', 'featuredProducts', 'testimonials', 'faqs', 'posts'));
    }

    public function switchLocale($locale)
    {
        $locale = in_array($locale, ['en', 'ar']) ? $locale : 'en';
        session(['locale' => $locale]);
        app()->setLocale($locale);
        return redirect()->back();
    }
}
