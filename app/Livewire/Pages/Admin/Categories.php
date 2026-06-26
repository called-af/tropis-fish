<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $name = '';

    public string $slug = '';

    public string $description = '';

    public $image;

    public string $currentImagePath = '';

    public string $detailTitle = '';

    public string $detailDescription = '';

    public $detailImage;

    public string $currentDetailImagePath = '';

    public int $sortOrder = 0;

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function updatedName(string $value): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$this->editingId,
            'description' => 'nullable|string',
            'detailTitle' => 'nullable|string|max:255',
            'detailDescription' => 'nullable|string',
            'sortOrder' => 'required|integer|min:0',
            'isActive' => 'required|boolean',
            'image' => $this->image ? 'nullable|image|max:7168' : 'nullable',
            'detailImage' => $this->detailImage ? 'nullable|image|max:7168' : 'nullable',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
        }

        $detailImagePath = null;
        if ($this->detailImage) {
            $detailImagePath = $this->detailImage->store('categories', 'public');
        }

        if ($this->editingId) {
            $category = Category::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if ($imagePath && $category->image_path && \Storage::disk('public')->exists($category->image_path)) {
                \Storage::disk('public')->delete($category->image_path);
            }

            // Delete old detail image if new detail image uploaded
            if ($detailImagePath && $category->detail_image_path && \Storage::disk('public')->exists($category->detail_image_path)) {
                \Storage::disk('public')->delete($category->detail_image_path);
            }

            $category->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
                'description' => $validated['description'],
                'detail_title' => $validated['detailTitle'],
                'detail_description' => $validated['detailDescription'],
                'sort_order' => $validated['sortOrder'],
                'is_active' => $validated['isActive'],
                'image_path' => $imagePath ?? $category->image_path,
                'detail_image_path' => $detailImagePath ?? $category->detail_image_path,
            ]);

            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
                'description' => $validated['description'],
                'detail_title' => $validated['detailTitle'],
                'detail_description' => $validated['detailDescription'],
                'sort_order' => $validated['sortOrder'],
                'is_active' => $validated['isActive'],
                'image_path' => $imagePath,
                'detail_image_path' => $detailImagePath,
            ]);

            session()->flash('message', 'Category created successfully.');
        }

        $this->resetFields();
        $this->showFormModal = false;
        Cache::forget('navbar_categories');
    }

    public function openCreateModal(): void
    {
        $this->resetFields();
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->editingId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description ?? '';
        $this->detailTitle = $category->detail_title ?? '';
        $this->detailDescription = $category->detail_description ?? '';
        $this->currentImagePath = $category->image_path ?? '';
        $this->currentDetailImagePath = $category->detail_image_path ?? '';
        $this->sortOrder = $category->sort_order;
        $this->isActive = $category->is_active;
        $this->showFormModal = true;
    }

    public function toggleStatus(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->update([
            'is_active' => ! $category->is_active,
        ]);
        Cache::forget('navbar_categories');
        session()->flash('message', 'Category status updated successfully.');
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (! $this->deletingId) {
            return;
        }

        $category = Category::findOrFail($this->deletingId);

        // Delete associated image files
        if ($category->image_path && \Storage::disk('public')->exists($category->image_path)) {
            \Storage::disk('public')->delete($category->image_path);
        }

        if ($category->detail_image_path && \Storage::disk('public')->exists($category->detail_image_path)) {
            \Storage::disk('public')->delete($category->detail_image_path);
        }

        // Set category_id to null for associated stock lists (handled by nullOnDelete in migration, but let's be sure)
        $category->stockLists()->update(['category_id' => null]);

        $category->delete();
        session()->flash('message', 'Category deleted successfully.');

        $this->deletingId = null;
        $this->showDeleteModal = false;
        Cache::forget('navbar_categories');
    }

    public function cancelEdit(): void
    {
        $this->resetFields();
        $this->showFormModal = false;
    }

    private function resetFields(): void
    {
        $this->reset(['name', 'slug', 'description', 'image', 'currentImagePath', 'detailTitle', 'detailDescription', 'detailImage', 'currentDetailImagePath', 'sortOrder', 'isActive', 'editingId']);
        $this->sortOrder = 0;
        $this->isActive = true;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Categories Management'])]
    #[Title('Categories Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.categories', [
            'categories' => Category::query()
                ->when($this->search, fn ($query) => $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('slug', 'like', "%{$this->search}%"))
                ->orderBy('sort_order')
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
