<?php

namespace App\Services;

use App\Models\Category;
use DomainException;

class CategoryService{
    public function delete(Category $category): void{
        if ($category->activities()->withTrashed()->exists()) {
            throw new DomainException(
                "Kategori {$category->name} tidak bisa dihapus karena masih dipakai oleh kegiatan."
            );
        }
        $category->delete();
    }
}
