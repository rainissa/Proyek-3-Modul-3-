<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller{
    public function index(): View{
        $categories = Category::withCount('activities')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }
    public function destroy(Category $category, CategoryService $service): RedirectResponse{
        try {
            $service->delete($category);
        } catch (DomainException $exception) {
            return redirect()->route('categories.index')
                ->with('error', $exception->getMessage());
        }
        return redirect()->route('categories.index')
            ->with('success', "Kategori {$category->name} berhasil dihapus.");
    }
}