<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Auth::user()->update($validated);

        return redirect()->route('profile')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pages.orders.show', compact('order'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
