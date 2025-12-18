<?php

namespace App\Livewire\Pages\Admin;

use App\Models\CompanySection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanySections extends Component
{
    use WithFileUploads;

    public string $search = '';

    public string $type = '';

    public string $title = '';

    public string $subtitle = '';

    public string $imageLayout = 'slider';

    public $image1;

    public $image2;

    public $image3;

    public ?string $currentImage1Path = null;

    public ?string $currentImage2Path = null;

    public ?string $currentImage3Path = null;

    public array $contentBlocks = [];

    public array $processSteps = [];

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function mount(): void
    {
        $this->contentBlocks = [];
        $this->processSteps = [];
    }

    public function openCreateModal(string $type): void
    {
        // Check if section already exists
        $exists = CompanySection::where('type', $type)->exists();
        if ($exists) {
            session()->flash('error', 'This section type already exists. Please edit the existing section.');

            return;
        }

        $this->reset(['title', 'subtitle', 'imageLayout', 'image1', 'image2', 'image3', 'currentImage1Path', 'currentImage2Path', 'currentImage3Path', 'contentBlocks', 'processSteps', 'isActive', 'editingId']);
        $this->type = $type;
        $this->isActive = true;
        $this->imageLayout = 'slider';
        $this->setDefaultsByType($type);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $section = CompanySection::findOrFail($id);

        $this->editingId = $id;
        $this->type = $section->type;
        $this->title = $section->title;
        $this->subtitle = $section->subtitle ?? '';
        $this->imageLayout = $section->image_layout ?? 'slider';
        $this->contentBlocks = $section->content_blocks ?? [];
        $this->processSteps = $section->process_steps ?? [];
        $this->isActive = $section->is_active;

        // Load existing images
        $images = $section->images ?? [];
        $this->currentImage1Path = $images[0]['path'] ?? null;
        $this->currentImage2Path = $images[1]['path'] ?? null;
        $this->currentImage3Path = $images[2]['path'] ?? null;

        $this->showFormModal = true;
    }

    protected function setDefaultsByType(string $type): void
    {
        match ($type) {
            'about' => $this->setAboutDefaults(),
            'farm' => $this->setFarmDefaults(),
            'quality' => $this->setQualityDefaults(),
        };
    }

    protected function setAboutDefaults(): void
    {
        $this->title = 'Company Profile';
        $this->subtitle = 'Leading Ornamental Fish Exporter';
        $this->contentBlocks = [
            [
                'title' => 'Established in 1986',
                'description' => 'PT. Tropis Fish was established in 1986...',
            ],
            [
                'title' => 'Extensive Collection',
                'description' => 'Our fishes collection consist of...',
            ],
        ];
    }

    protected function setFarmDefaults(): void
    {
        $this->title = 'Our Farm';
        $this->subtitle = 'State-of-the-Art Facilities in Bekasi';
        $this->contentBlocks = [
            [
                'title' => 'Strategic Location',
                'description' => 'Our Fishes Farm is located in Bekasi...',
            ],
            [
                'title' => 'Extensive Infrastructure',
                'description' => 'We have hundreds of aquarium and tanks...',
            ],
        ];
    }

    protected function setQualityDefaults(): void
    {
        $this->title = 'Quality Control';
        $this->subtitle = 'Ensuring Excellence in Every Shipment';
        $this->contentBlocks = [
            [
                'title' => 'High Quality Standards',
                'description' => 'We only supply high quality of tropical fishes...',
            ],
            [
                'title' => 'Rigorous Inspection Process',
                'description' => 'After we check in the quality control room...',
            ],
        ];
        $this->processSteps = [
            [
                'number' => '1',
                'title' => 'Initial Selection',
                'description' => 'Careful selection of healthy specimens',
            ],
            [
                'number' => '2',
                'title' => 'Quality Control Room',
                'description' => 'Thorough health and size inspection',
            ],
            [
                'number' => '3',
                'title' => 'Quarantine Area',
                'description' => 'Special care before shipment',
            ],
            [
                'number' => '4',
                'title' => 'Final Preparation',
                'description' => 'Ready for safe shipment worldwide',
            ],
        ];
    }

    public function addContentBlock(): void
    {
        $this->contentBlocks[] = [
            'title' => '',
            'description' => '',
        ];
    }

    public function removeContentBlock(int $index): void
    {
        unset($this->contentBlocks[$index]);
        $this->contentBlocks = array_values($this->contentBlocks);
    }

    public function addProcessStep(): void
    {
        $this->processSteps[] = [
            'number' => (string) (count($this->processSteps) + 1),
            'title' => '',
            'description' => '',
        ];
    }

    public function removeProcessStep(int $index): void
    {
        unset($this->processSteps[$index]);
        $this->processSteps = array_values($this->processSteps);

        // Renumber steps
        foreach ($this->processSteps as $i => $step) {
            $this->processSteps[$i]['number'] = (string) ($i + 1);
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'type' => 'required|in:about,farm,quality',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'imageLayout' => 'required|in:grid,slider',
            'image1' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'contentBlocks.*.title' => 'required|string|max:255',
            'contentBlocks.*.description' => 'required|string',
            'processSteps.*.title' => 'nullable|string|max:255',
            'processSteps.*.description' => 'nullable|string',
        ]);

        $images = [];

        // Handle image 1
        if ($this->image1) {
            $images[] = ['path' => $this->image1->store('company', 'public'), 'alt' => 'Company Image'];
        } elseif ($this->currentImage1Path) {
            $images[] = ['path' => $this->currentImage1Path, 'alt' => 'Company Image'];
        }

        // Handle image 2
        if ($this->image2) {
            $images[] = ['path' => $this->image2->store('company', 'public'), 'alt' => 'Company Image'];
        } elseif ($this->currentImage2Path) {
            $images[] = ['path' => $this->currentImage2Path, 'alt' => 'Company Image'];
        }

        // Handle image 3
        if ($this->image3) {
            $images[] = ['path' => $this->image3->store('company', 'public'), 'alt' => 'Company Image'];
        } elseif ($this->currentImage3Path) {
            $images[] = ['path' => $this->currentImage3Path, 'alt' => 'Company Image'];
        }

        $data = [
            'type' => $validated['type'],
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'main_description_1' => '',
            'main_description_2' => '',
            'main_title_1' => '',
            'main_title_2' => '',
            'images' => $images,
            'image_layout' => $validated['imageLayout'],
            'content_blocks' => $this->contentBlocks,
            'process_steps' => $this->processSteps,
            'is_active' => $this->isActive,
        ];

        if ($this->editingId) {
            $section = CompanySection::findOrFail($this->editingId);
            $section->update($data);
            session()->flash('message', ucfirst($this->type).' section updated successfully.');
        } else {
            CompanySection::create($data);
            session()->flash('message', ucfirst($this->type).' section created successfully.');
        }

        $this->reset(['type', 'title', 'subtitle', 'imageLayout', 'image1', 'image2', 'image3', 'currentImage1Path', 'currentImage2Path', 'currentImage3Path', 'contentBlocks', 'processSteps', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['type', 'title', 'subtitle', 'imageLayout', 'image1', 'image2', 'image3', 'currentImage1Path', 'currentImage2Path', 'currentImage3Path', 'contentBlocks', 'processSteps', 'isActive', 'editingId']);
        $this->showFormModal = false;
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

        CompanySection::findOrFail($this->deletingId)->delete();
        session()->flash('message', 'Section deleted successfully.');
        $this->deletingId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Company Profile Sections'])]
    #[Title('Company Sections - PT. Tropis Fish Indonesia')]
    public function render()
    {
        $aboutSection = CompanySection::where('type', 'about')->first();
        $farmSection = CompanySection::where('type', 'farm')->first();
        $qualitySection = CompanySection::where('type', 'quality')->first();

        return view('livewire.pages.admin.company-sections', [
            'aboutSection' => $aboutSection,
            'farmSection' => $farmSection,
            'qualitySection' => $qualitySection,
        ]);
    }
}
