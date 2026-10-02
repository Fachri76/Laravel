<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->withCount('activities')
            ->orderBy('name')
            ->get();

        return view(
            'categories.index',
            compact('categories')
        );
    }

    public function destroy(
        Category $category
    ): RedirectResponse {
        if ($category->activities()->exists()) {
            return back()->withErrors([
                'category' =>
                    'Kategori masih digunakan oleh Activity dan tidak dapat dihapus.',
            ]);
        }

        $category->delete();

        return back()->with(
            'success',
            'Kategori berhasil dihapus.'
        );
    }
}