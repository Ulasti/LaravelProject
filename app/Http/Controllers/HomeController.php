<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $featuredProducts = Product::where('status', 1)->inRandomOrder()->limit(4)->get();
        $latestProducts = Product::where('status', 1)->latest()->limit(8)->get();
        $sliderProducts = Product::where('status', 1)->inRandomOrder()->limit(5)->get();

        return view('welcome', compact('categories', 'featuredProducts', 'latestProducts', 'sliderProducts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        session()->flash('contact_sent', true);

        return redirect()->route('contact');
    }

    public function shop(Request $request)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $query = Product::where('status', 1);

        if ($request->filled('category')) {
            $category = Category::find($request->category);
            if ($category) {
                $ids = $category->children->pluck('id')->push($category->id);
                $query->whereIn('category_id', $ids);
            }
        }

        $products = $query->latest()->paginate(12);

        return view('pages.shop', compact('categories', 'products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'images')->firstOrFail();

        return view('pages.product-detail', compact('product'));
    }
}
