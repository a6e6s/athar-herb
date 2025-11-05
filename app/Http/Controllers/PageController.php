<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy')->first();
        return view('pages.privacy', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms')->first();
        return view('pages.terms', compact('page'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Save contact message to database
        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('contact')
            ->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
    }
}
