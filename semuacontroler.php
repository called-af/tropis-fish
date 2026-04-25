<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Gallery extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery', [
            'fishGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'fish')
                ->orderBy('order')
                ->get(),
            'farmGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'farm')
                ->orderBy('order')
                ->get(),
            'qualityGalleries' => GalleryModel::where('is_active', true)
                ->where('category', 'quality')
                ->orderBy('order')
                ->get(),
        ]);
    }
}<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryFarm extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Farm Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-farm', [
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'farm')
                ->orderBy('order')
                ->get(),
        ]);
    }
}<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryFish extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Fish Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-fish', [
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'fish')
                ->orderBy('order')
                ->get(),
        ]);
    }
}<?php

namespace App\Livewire\Pages;

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class GalleryQuality extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Quality Control Gallery - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.gallery-quality', [
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'quality')
                ->orderBy('order')
                ->get(),
        ]);
    }
}<?php

namespace App\Livewire\Pages;

use App\Models\AboutSection;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\StockList;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Landing extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public function render()
    {
        $downloadType = Setting::get('stock_list_download_type', 'link');
        $downloadUrl = null;

        if ($downloadType === 'link') {
            $downloadUrl = Setting::get('stock_list_download_link');
        } else {
            $filePath = Setting::get('stock_list_download_file');
            if ($filePath) {
                $downloadUrl = asset('storage/'.$filePath);
            }
        }

        $statsTitle = Setting::get('stats_title', 'Trusted by Thousands of Customers');
        $statsDescription = Setting::get('stats_description', 'Our experience and dedication in the ornamental fish industry');

        // Stock list query with search
        $stockListsQuery = StockList::query();

        if ($this->search) {
            $stockListsQuery->where(function ($query) {
                $query->where('code', 'like', '%'.$this->search.'%')
                    ->orWhere('common_name', 'like', '%'.$this->search.'%')
                    ->orWhere('scientific_name', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.pages.landing', [
            'heroes' => Hero::where('is_active', true)
                ->orderBy('order')
                ->limit(3)
                ->get(),
            'galleries' => Gallery::where('is_active', true)
                ->where('category', 'fish')
                ->orderBy('order')
                ->limit(8)
                ->get(),
            'stockLists' => $stockListsQuery->orderBy('code')->paginate(8),
            'stats' => Stat::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'statsTitle' => $statsTitle,
            'statsDescription' => $statsDescription,
            'downloadLink' => $downloadUrl,
            'aboutSection' => AboutSection::where('is_active', true)
                ->orderBy('order')
                ->first(),
        ])->layout('components.layouts.app');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
}<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use App\Models\StockList as StockListModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StockList extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public string $viewMode = 'grid'; // 'grid' or 'table'

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = $mode;
    }

    #[Layout('components.layouts.app')]
    #[Title('Stock List - PT. Tropis Fish Indonesia')]
    public function render()
    {
        $downloadType = Setting::get('stock_list_download_type', 'link');
        $downloadUrl = null;

        if ($downloadType === 'link') {
            $downloadUrl = Setting::get('stock_list_download_link');
        } else {
            $filePath = Setting::get('stock_list_download_file');
            if ($filePath) {
                $downloadUrl = asset('storage/'.$filePath);
            }
        }

        return view('livewire.pages.stock-list', [
            'stockLists' => StockListModel::query()
                ->when($this->search, fn ($query) => $query->where('code', 'like', "%{$this->search}%")
                    ->orWhere('common_name', 'like', "%{$this->search}%")
                    ->orWhere('scientific_name', 'like', "%{$this->search}%"))
                ->orderBy('code')
                ->paginate(12),
            'downloadLink' => $downloadUrl,
        ]);
    }
}<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        $contactEmail = Setting::get('contact_email', 'sales@tropisfish.com');

        try {
            config([
                'mail.mailers.smtp.host' => Setting::get('mail_host', 'smtp.gmail.com'),
                'mail.mailers.smtp.port' => Setting::get('mail_port', '587'),
                'mail.mailers.smtp.username' => Setting::get('mail_username', ''),
                'mail.mailers.smtp.password' => Setting::get('mail_password', ''),
                'mail.mailers.smtp.encryption' => Setting::get('mail_encryption', 'tls'),
            ]);

            Mail::to($contactEmail)->send(new ContactFormMail(
                senderName: $this->name,
                senderEmail: $this->email,
                senderPhone: $this->phone ?? 'Not provided',
                emailSubject: $this->subject,
                messageContent: $this->message
            ));

            session()->flash('contact_success', 'Thank you for contacting us! Your message has been sent successfully. We will get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Contact form email failed', [
                'error' => $e->getMessage(),
                'sender' => $this->email,
                'subject' => $this->subject,
            ]);

            session()->flash('contact_success', 'Thank you for contacting us! Your message has been received and saved. We will respond to you shortly.');
        }

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $validated = $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        if (! Auth::guard('admin')->attempt($validated, $this->remember)) {
            $this->addError('email', 'The provided credentials do not match our records.');

            return;
        }

        session()->regenerate();

        $this->redirect(route('admin.dashboard'), navigate: true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Login - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AboutSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AboutSections extends Component
{
    use WithFileUploads, WithPagination;

    public string $title = '';

    public string $description1 = '';

    public string $description2 = '';

    public $image;

    public ?string $currentImagePath = null;

    public string $feature1Title = '';

    public string $feature1Description = '';

    public string $feature1Icon = 'check-circle';

    public string $feature2Title = '';

    public string $feature2Description = '';

    public string $feature2Icon = 'currency-dollar';

    public string $feature3Title = '';

    public string $feature3Description = '';

    public string $feature3Icon = 'truck';

    public string $feature4Title = '';

    public string $feature4Description = '';

    public string $feature4Icon = 'heart';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function getAvailableIcons(): array
    {
        return [
            'check-circle' => 'Check Circle',
            'currency-dollar' => 'Currency Dollar',
            'truck' => 'Truck',
            'heart' => 'Heart',
            'star' => 'Star',
            'shield-check' => 'Shield Check',
            'sparkles' => 'Sparkles',
            'bolt' => 'Bolt',
            'fire' => 'Fire',
            'globe-alt' => 'Globe',
            'light-bulb' => 'Light Bulb',
            'rocket-launch' => 'Rocket',
            'trophy' => 'Trophy',
            'academic-cap' => 'Academic Cap',
            'beaker' => 'Beaker',
            'chart-bar' => 'Chart Bar',
            'clock' => 'Clock',
            'cog-6-tooth' => 'Settings',
            'gift' => 'Gift',
            'hand-thumb-up' => 'Thumbs Up',
            'wrench-screwdriver' => 'Tools',
            'users' => 'Users',
            'user-group' => 'User Group',
            'pencil' => 'Pencil',
            'photo' => 'Photo',
            'video-camera' => 'Video',
            'musical-note' => 'Music',
            'phone' => 'Phone',
            'envelope' => 'Envelope',
            'map-pin' => 'Map Pin',
            'building-office' => 'Office Building',
            'home' => 'Home',
            'briefcase' => 'Briefcase',
            'banknotes' => 'Banknotes',
            'credit-card' => 'Credit Card',
            'calculator' => 'Calculator',
            'presentation-chart-line' => 'Presentation',
            'document-text' => 'Document',
            'clipboard-document-check' => 'Clipboard Check',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'image' => $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168',
            'feature1Title' => 'nullable|string|max:255',
            'feature1Description' => 'nullable|string',
            'feature1Icon' => 'nullable|string|max:255',
            'feature2Title' => 'nullable|string|max:255',
            'feature2Description' => 'nullable|string',
            'feature2Icon' => 'nullable|string|max:255',
            'feature3Title' => 'nullable|string|max:255',
            'feature3Description' => 'nullable|string',
            'feature3Icon' => 'nullable|string|max:255',
            'feature4Title' => 'nullable|string|max:255',
            'feature4Description' => 'nullable|string',
            'feature4Icon' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'description_1' => $validated['description1'],
            'description_2' => $validated['description2'],
            'feature_1_title' => $validated['feature1Title'],
            'feature_1_description' => $validated['feature1Description'],
            'feature_1_icon' => $validated['feature1Icon'],
            'feature_2_title' => $validated['feature2Title'],
            'feature_2_description' => $validated['feature2Description'],
            'feature_2_icon' => $validated['feature2Icon'],
            'feature_3_title' => $validated['feature3Title'],
            'feature_3_description' => $validated['feature3Description'],
            'feature_3_icon' => $validated['feature3Icon'],
            'feature_4_title' => $validated['feature4Title'],
            'feature_4_description' => $validated['feature4Description'],
            'feature_4_icon' => $validated['feature4Icon'],
            'is_active' => $this->isActive,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('about', 'public');
        }

        // If setting this section to active, deactivate all others
        if ($this->isActive) {
            AboutSection::query()->update(['is_active' => false]);
        }

        if ($this->editingId) {
            $aboutSection = AboutSection::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if (isset($data['image_path']) && $aboutSection->image_path && \Storage::disk('public')->exists($aboutSection->image_path)) {
                \Storage::disk('public')->delete($aboutSection->image_path);
            }

            $aboutSection->update($data);
            session()->flash('message', 'About section updated successfully.');
        } else {
            $maxOrder = AboutSection::query()->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
            AboutSection::create($data);
            session()->flash('message', 'About section created successfully.');
        }

        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
        $this->feature1Icon = 'check-circle';
        $this->feature2Icon = 'currency-dollar';
        $this->feature3Icon = 'truck';
        $this->feature4Icon = 'heart';
        $this->isActive = true;
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $aboutSection = AboutSection::findOrFail($id);

        $this->editingId = $id;
        $this->title = $aboutSection->title;
        $this->description1 = $aboutSection->description_1;
        $this->description2 = $aboutSection->description_2 ?? '';
        $this->currentImagePath = $aboutSection->image_path;
        $this->feature1Title = $aboutSection->feature_1_title ?? '';
        $this->feature1Description = $aboutSection->feature_1_description ?? '';
        $this->feature1Icon = $aboutSection->feature_1_icon ?? 'check-circle';
        $this->feature2Title = $aboutSection->feature_2_title ?? '';
        $this->feature2Description = $aboutSection->feature_2_description ?? '';
        $this->feature2Icon = $aboutSection->feature_2_icon ?? 'currency-dollar';
        $this->feature3Title = $aboutSection->feature_3_title ?? '';
        $this->feature3Description = $aboutSection->feature_3_description ?? '';
        $this->feature3Icon = $aboutSection->feature_3_icon ?? 'truck';
        $this->feature4Title = $aboutSection->feature_4_title ?? '';
        $this->feature4Description = $aboutSection->feature_4_description ?? '';
        $this->feature4Icon = $aboutSection->feature_4_icon ?? 'heart';
        $this->isActive = $aboutSection->is_active;

        $this->showFormModal = true;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description1', 'description2', 'image', 'currentImagePath', 'feature1Title', 'feature1Description', 'feature1Icon', 'feature2Title', 'feature2Description', 'feature2Icon', 'feature3Title', 'feature3Description', 'feature3Icon', 'feature4Title', 'feature4Description', 'feature4Icon', 'isActive', 'editingId']);
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

        AboutSection::findOrFail($this->deletingId)->delete();
        session()->flash('message', 'About section deleted successfully.');
        $this->deletingId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'About Sections Management'])]
    #[Title('About Sections Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.about-sections', [
            'aboutSections' => AboutSection::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}<?php

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
            'image1' => 'nullable|image|max:7168',
            'image2' => 'nullable|image|max:7168',
            'image3' => 'nullable|image|max:7168',
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
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Hero;
use App\Models\Stat;
use App\Models\StockList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public ?int $viewingMessageId = null;

    public bool $showMessageModal = false;

    public string $messageSearch = '';

    public function markAsRead(int $id): void
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
    }

    public function viewMessage(int $id): void
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
        $this->viewingMessageId = $id;
        $this->showMessageModal = true;
    }

    public function deleteMessage(int $id): void
    {
        ContactMessage::findOrFail($id)->delete();
        session()->flash('message', 'Message deleted successfully.');
        $this->showMessageModal = false;
        $this->viewingMessageId = null;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return $this->redirect(route('admin.login'), navigate: true);
    }

    #[Layout('components.layouts.admin', ['heading' => 'Dashboard'])]
    #[Title('Dashboard - PT. Tropis Fish Indonesia')]
    public function render()
    {
        $stats = [
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_heroes' => Hero::count(),
            'total_galleries' => Gallery::count(),
            'total_stock_lists' => StockList::count(),
            'total_stats' => Stat::count(),
        ];

        $messages = ContactMessage::query()
            ->when($this->messageSearch, fn ($query) => $query->where('name', 'like', "%{$this->messageSearch}%")
                ->orWhere('email', 'like', "%{$this->messageSearch}%")
                ->orWhere('subject', 'like', "%{$this->messageSearch}%"))
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $viewingMessage = $this->viewingMessageId ? ContactMessage::find($this->viewingMessageId) : null;

        return view('livewire.pages.admin.dashboard', [
            'stats' => $stats,
            'messages' => $messages,
            'viewingMessage' => $viewingMessage,
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\FooterSection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class FooterSections extends Component
{
    public string $type = 'company';

    public string $description = '';

    public array $links = [];

    public string $copyrightText = '';

    public bool $isActive = true;

    public ?int $editingId = null;

    public bool $showFormModal = false;

    public function mount(): void
    {
        $this->links = [];
        $this->loadCompanySection();
    }

    protected function loadCompanySection(): void
    {
        $section = FooterSection::where('type', 'company')->first();
        if ($section) {
            $this->editingId = $section->id;
            $this->description = $section->description ?? '';
            $this->copyrightText = $section->copyright_text ?? '';
            $this->isActive = $section->is_active;
        }
    }

    public function openModal(string $type): void
    {
        if ($type === 'company') {
            $this->loadCompanySection();
            $this->type = 'company';
            if (! $this->editingId) {
                $this->description = 'Premium quality tropical ornamental fish supplier for your aquarium';
                $this->copyrightText = 'All rights reserved';
            }
        } else {
            $section = FooterSection::where('type', $type)->first();
            $this->type = $type;
            $this->editingId = $section?->id;
            $this->links = $section?->links ?? [];

            if (! $section) {
                $this->setDefaultsByType($type);
            }
        }

        $this->showFormModal = true;
    }

    protected function setDefaultsByType(string $type): void
    {
        match ($type) {
            'menu' => $this->setMenuDefaults(),
            'information' => $this->setInformationDefaults(),
            'social' => $this->setSocialDefaults(),
            default => null,
        };
    }

    protected function setMenuDefaults(): void
    {
        $this->links = [
            ['text' => 'Home', 'url' => '/'],
            ['text' => 'Company Profile', 'url' => '/#company-profile'],
            ['text' => 'Stock List', 'url' => '/#stock-list'],
            ['text' => 'Gallery', 'url' => '/#gallery'],
        ];
    }

    protected function setInformationDefaults(): void
    {
        $this->links = [
            ['text' => 'How to Order', 'url' => '#'],
            ['text' => 'Privacy Policy', 'url' => '#'],
            ['text' => 'Terms & Conditions', 'url' => '#terms'],
        ];
    }

    protected function setSocialDefaults(): void
    {
        $this->links = [
            ['text' => 'Facebook', 'url' => '#', 'icon' => 'facebook'],
            ['text' => 'Twitter', 'url' => '#', 'icon' => 'twitter'],
            ['text' => 'Instagram', 'url' => '#', 'icon' => 'instagram'],
        ];
    }

    public function addLink(): void
    {
        $this->links[] = [
            'text' => '',
            'url' => '',
            'icon' => $this->type === 'social' ? 'facebook' : null,
        ];
    }

    public function removeLink(int $index): void
    {
        unset($this->links[$index]);
        $this->links = array_values($this->links);
    }

    public function save(): void
    {
        if ($this->type === 'company') {
            $validated = $this->validate([
                'description' => 'required|string',
                'copyrightText' => 'required|string|max:255',
            ]);

            $data = [
                'type' => 'company',
                'title' => 'Company Info',
                'description' => $validated['description'],
                'links' => [],
                'copyright_text' => $validated['copyrightText'],
                'order' => 0,
                'is_active' => $this->isActive,
            ];

            if ($this->editingId) {
                FooterSection::findOrFail($this->editingId)->update($data);
                session()->flash('message', 'Company info updated successfully.');
            } else {
                FooterSection::create($data);
                session()->flash('message', 'Company info created successfully.');
            }
        } else {
            $validated = $this->validate([
                'type' => 'required|in:menu,information,social',
                'links' => 'required|array|min:1',
                'links.*.text' => 'required|string|max:255',
                'links.*.url' => 'required|string|max:255',
                'links.*.icon' => 'nullable|string|max:255',
            ]);

            $titleMap = [
                'menu' => 'Menu',
                'information' => 'Information',
                'social' => 'Follow Us',
            ];

            $orderMap = [
                'menu' => 1,
                'information' => 2,
                'social' => 3,
            ];

            $data = [
                'type' => $validated['type'],
                'title' => $titleMap[$validated['type']],
                'description' => null,
                'links' => $this->links,
                'copyright_text' => null,
                'order' => $orderMap[$validated['type']],
                'is_active' => $this->isActive,
            ];

            if ($this->editingId) {
                FooterSection::findOrFail($this->editingId)->update($data);
                session()->flash('message', ucfirst($this->type).' section updated successfully.');
            } else {
                FooterSection::create($data);
                session()->flash('message', ucfirst($this->type).' section created successfully.');
            }
        }

        $this->reset(['type', 'description', 'links', 'copyrightText', 'isActive', 'editingId']);
        $this->showFormModal = false;
        $this->loadCompanySection();
    }

    public function cancelEdit(): void
    {
        $this->reset(['type', 'description', 'links', 'copyrightText', 'isActive', 'editingId']);
        $this->showFormModal = false;
        $this->loadCompanySection();
    }

    #[Layout('components.layouts.admin', ['heading' => 'Footer Management'])]
    #[Title('Footer Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        $companySection = FooterSection::where('type', 'company')->first();
        $menuSection = FooterSection::where('type', 'menu')->first();
        $informationSection = FooterSection::where('type', 'information')->first();
        $socialSection = FooterSection::where('type', 'social')->first();

        return view('livewire.pages.admin.footer-sections', [
            'companySection' => $companySection,
            'menuSection' => $menuSection,
            'informationSection' => $informationSection,
            'socialSection' => $socialSection,
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Galleries extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $title = '';

    public string $description = '';

    public string $category = 'fish';

    public $image;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public string $categoryFilter = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:fish,farm,quality',
            'image' => $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('galleries', 'public');
        }

        if ($this->editingId) {
            $gallery = Gallery::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if ($imagePath && $gallery->image_path && \Storage::disk('public')->exists($gallery->image_path)) {
                \Storage::disk('public')->delete($gallery->image_path);
            }

            $gallery->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'image_path' => $imagePath ?? $gallery->image_path,
            ]);

            session()->flash('message', 'Gallery updated successfully.');
        } else {
            $maxOrder = Gallery::where('category', $validated['category'])->max('order') ?? 0;

            Gallery::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'order' => $maxOrder + 1,
                'is_active' => true,
                'image_path' => $imagePath,
            ]);

            session()->flash('message', 'Gallery created successfully.');
        }

        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->category = 'fish';
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $gallery = Gallery::findOrFail($id);
        $this->editingId = $gallery->id;
        $this->title = $gallery->title;
        $this->description = $gallery->description ?? '';
        $this->category = $gallery->category;
        $this->showFormModal = true;
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

        $gallery = Gallery::findOrFail($this->deletingId);

        if ($gallery->image_path && \Storage::disk('public')->exists($gallery->image_path)) {
            \Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
        session()->flash('message', 'Gallery deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description', 'category', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Gallery Management'])]
    #[Title('Gallery Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.galleries', [
            'galleries' => Gallery::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->when($this->categoryFilter, fn ($query) => $query->where('category', $this->categoryFilter))
                ->orderBy('category')
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Hero;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Heroes extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $title = '';

    public string $description = '';

    public $image;

    public $video;

    public string $youtubeUrl = '';

    public string $courtesyText = '';

    public string $backgroundType = 'image';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $heroCount = Hero::count();

        if (! $this->editingId && $heroCount >= 3) {
            session()->flash('error', 'Maximum 3 heroes allowed. Please delete one first.');

            return;
        }

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'backgroundType' => 'required|in:image,video,youtube',
            'isActive' => 'boolean',
        ];

        if ($this->backgroundType === 'image') {
            $rules['image'] = $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168';
        } elseif ($this->backgroundType === 'video') {
            $rules['video'] = 'required|mimes:mp4,mov,avi,wmv|max:51200';
            $rules['image'] = 'nullable|image|max:7168';
        } elseif ($this->backgroundType === 'youtube') {
            $rules['youtubeUrl'] = 'required|url';
            $rules['courtesyText'] = 'nullable|string|max:255';
            $rules['image'] = 'nullable|image|max:7168';
        }

        $validated = $this->validate($rules);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('heroes', 'public');
        }

        $videoPath = null;
        if ($this->video && $this->backgroundType === 'video') {
            $videoPath = $this->video->store('heroes/videos', 'public');
        }

        $youtubeUrl = null;
        $courtesyText = null;
        if ($this->backgroundType === 'youtube') {
            $youtubeUrl = $this->youtubeUrl;
            $courtesyText = $this->courtesyText;
        }

        if ($this->editingId) {
            $hero = Hero::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if ($imagePath && $hero->image_path && \Storage::disk('public')->exists($hero->image_path)) {
                \Storage::disk('public')->delete($hero->image_path);
            }

            // Delete old video if new video uploaded or type changed
            if (($videoPath || $this->backgroundType !== 'video') && $hero->video_path && \Storage::disk('public')->exists($hero->video_path)) {
                \Storage::disk('public')->delete($hero->video_path);
            }

            $hero->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'background_type' => $validated['backgroundType'],
                'image_path' => $imagePath ?? $hero->image_path,
                'video_path' => $videoPath,
                'youtube_url' => $youtubeUrl,
                'courtesy_text' => $courtesyText,
                'is_active' => $validated['isActive'],
            ]);

            session()->flash('message', 'Hero updated successfully.');
        } else {
            $maxOrder = Hero::max('order') ?? 0;

            Hero::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'background_type' => $validated['backgroundType'],
                'image_path' => $imagePath,
                'video_path' => $videoPath,
                'youtube_url' => $youtubeUrl,
                'courtesy_text' => $courtesyText,
                'is_active' => $validated['isActive'],
                'order' => $maxOrder + 1,
            ]);

            session()->flash('message', 'Hero created successfully.');
        }

        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'courtesyText', 'backgroundType', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->backgroundType = 'image';
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $heroCount = Hero::count();

        if ($heroCount >= 3) {
            session()->flash('error', 'Maximum 3 heroes allowed. Please delete one first.');

            return;
        }

        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'courtesyText', 'backgroundType', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->backgroundType = 'image';
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $hero = Hero::findOrFail($id);
        $this->editingId = $hero->id;
        $this->title = $hero->title;
        $this->description = $hero->description ?? '';
        $this->backgroundType = $hero->background_type ?? 'image';
        $this->youtubeUrl = $hero->youtube_url ?? '';
        $this->courtesyText = $hero->courtesy_text ?? '';
        $this->isActive = $hero->is_active;
        $this->showFormModal = true;
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

        $hero = Hero::findOrFail($this->deletingId);

        if ($hero->image_path && \Storage::disk('public')->exists($hero->image_path)) {
            \Storage::disk('public')->delete($hero->image_path);
        }

        if ($hero->video_path && \Storage::disk('public')->exists($hero->video_path)) {
            \Storage::disk('public')->delete($hero->video_path);
        }

        $hero->delete();
        session()->flash('message', 'Hero deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'description', 'image', 'video', 'youtubeUrl', 'courtesyText', 'backgroundType', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Hero Management'])]
    #[Title('Hero Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.heroes', [
            'heroes' => Hero::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function mount(): void
    {
        Auth::guard('admin')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.admin.logout');
    }
}<?php

namespace App\Livewire\Pages\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    public string $currentPassword = '';

    public string $newPassword = '';

    public string $newPasswordConfirmation = '';

    public bool $showPasswordFields = false;

    public function mount(): void
    {
        $admin = Auth::guard('admin')->user();
        $this->name = $admin->name;
        $this->email = $admin->email;
    }

    public function updateProfile(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,'.Auth::guard('admin')->id(),
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (! Hash::check($validated['currentPassword'], $admin->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');

            return;
        }

        $admin->update([
            'password' => Hash::make($validated['newPassword']),
        ]);

        $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation', 'showPasswordFields']);
        session()->flash('message', 'Password updated successfully.');
    }

    public function togglePasswordFields(): void
    {
        $this->showPasswordFields = ! $this->showPasswordFields;

        if (! $this->showPasswordFields) {
            $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation']);
            $this->resetErrorBag();
        }
    }

    #[Layout('components.layouts.admin', ['heading' => 'Profile Settings'])]
    #[Title('Profile Settings - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.profile');
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Setting;
use App\Models\Stat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Stats extends Component
{
    use WithPagination;

    public string $label = '';

    public string $value = '';

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public string $statsTitle = '';

    public string $statsDescription = '';

    public function mount(): void
    {
        $this->statsTitle = Setting::get('stats_title', 'Trusted by Thousands of Customers') ?? 'Trusted by Thousands of Customers';
        $this->statsDescription = Setting::get('stats_description', 'Our experience and dedication in the ornamental fish industry') ?? 'Our experience and dedication in the ornamental fish industry';
    }

    public function saveSettings(): void
    {
        $this->validate([
            'statsTitle' => 'required|string|max:255',
            'statsDescription' => 'required|string|max:500',
        ]);

        Setting::set('stats_title', $this->statsTitle);
        Setting::set('stats_description', $this->statsDescription);

        session()->flash('message', 'Stats section settings saved successfully.');
    }

    public function save(): void
    {
        $validated = $this->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        if ($this->editingId) {
            $stat = Stat::findOrFail($this->editingId);
            $stat->update([
                'label' => $validated['label'],
                'value' => $validated['value'],
            ]);

            session()->flash('message', 'Stat updated successfully.');
        } else {
            // Check if we already have 4 stats
            $statsCount = Stat::count();
            if ($statsCount >= 4) {
                session()->flash('error', 'Maximum 4 stats allowed. Please delete an existing stat first.');
                $this->showFormModal = false;

                return;
            }

            $maxOrder = Stat::max('order') ?? 0;

            Stat::create([
                'label' => $validated['label'],
                'value' => $validated['value'],
                'order' => $maxOrder + 1,
                'is_active' => true,
            ]);

            session()->flash('message', 'Stat created successfully.');
        }

        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $statsCount = Stat::count();
        if ($statsCount >= 4) {
            session()->flash('error', 'Maximum 4 stats allowed. Please delete an existing stat first.');

            return;
        }

        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $stat = Stat::findOrFail($id);
        $this->editingId = $stat->id;
        $this->label = $stat->label;
        $this->value = $stat->value;
        $this->showFormModal = true;
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

        $stat = Stat::findOrFail($this->deletingId);
        $stat->delete();
        session()->flash('message', 'Stat deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['label', 'value', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Stats Management'])]
    #[Title('Stats Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.stats', [
            'stats' => Stat::query()
                ->when($this->search, fn ($query) => $query->where('label', 'like', "%{$this->search}%")
                    ->orWhere('value', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Setting;
use App\Models\StockList;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StockLists extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $code = '';

    public string $commonName = '';

    public string $scientificName = '';

    public string $size = '';

    public string $length = '';

    public $image;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public string $downloadType = 'link';

    public ?string $downloadLink = '';

    public $downloadFile;

    public function mount(): void
    {
        $this->downloadType = Setting::get('stock_list_download_type', 'link') ?? 'link';
        $this->downloadLink = Setting::get('stock_list_download_link', '') ?? '';
    }

    public function getCurrentFileProperty()
    {
        return Setting::get('stock_list_download_file');
    }

    public function saveDownloadLink(): void
    {
        if ($this->downloadType === 'link') {
            $this->validate([
                'downloadLink' => 'required|url',
            ]);

            Setting::set('stock_list_download_type', 'link');
            Setting::set('stock_list_download_link', $this->downloadLink);
            Setting::set('stock_list_download_file', null);
        } else {
            $this->validate([
                'downloadFile' => 'required|mimes:pdf,xlsx,xls,csv|max:10240',
            ]);

            // Delete old file if exists
            $oldFile = Setting::get('stock_list_download_file');
            if ($oldFile && \Storage::disk('public')->exists($oldFile)) {
                \Storage::disk('public')->delete($oldFile);
            }

            $filePath = $this->downloadFile->store('downloads', 'public');

            Setting::set('stock_list_download_type', 'file');
            Setting::set('stock_list_download_file', $filePath);
            Setting::set('stock_list_download_link', null);
        }

        session()->flash('message', 'Download settings saved successfully.');
        $this->reset(['downloadFile']);
    }

    public function save(): void
    {
        $validated = $this->validate([
            'code' => 'required|string|max:255|unique:stock_lists,code,'.$this->editingId,
            'scientificName' => 'required|string|max:255',
            'commonName' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'length' => 'required|string|max:255',
            'image' => $this->editingId ? 'nullable|image|max:7168' : 'required|image|max:7168',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('stock-lists', 'public');
        }

        if ($this->editingId) {
            $stockList = StockList::findOrFail($this->editingId);

            // Delete old image if new image uploaded
            if ($imagePath && $stockList->image_path && \Storage::disk('public')->exists($stockList->image_path)) {
                \Storage::disk('public')->delete($stockList->image_path);
            }

            $stockList->update([
                'code' => $validated['code'],
                'scientific_name' => $validated['scientificName'],
                'common_name' => $validated['commonName'],
                'size' => $validated['size'],
                'length' => $validated['length'],
                'image_path' => $imagePath ?? $stockList->image_path,
            ]);

            session()->flash('message', 'Stock list updated successfully.');
        } else {
            StockList::create([
                'code' => $validated['code'],
                'scientific_name' => $validated['scientificName'],
                'common_name' => $validated['commonName'],
                'size' => $validated['size'],
                'length' => $validated['length'],
                'image_path' => $imagePath,
            ]);

            session()->flash('message', 'Stock list created successfully.');
        }

        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $stockList = StockList::findOrFail($id);
        $this->editingId = $stockList->id;
        $this->code = $stockList->code;
        $this->scientificName = $stockList->scientific_name;
        $this->commonName = $stockList->common_name;
        $this->size = $stockList->size;
        $this->length = $stockList->length;
        $this->showFormModal = true;
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

        $stockList = StockList::findOrFail($this->deletingId);

        if ($stockList->image_path && \Storage::disk('public')->exists($stockList->image_path)) {
            \Storage::disk('public')->delete($stockList->image_path);
        }

        $stockList->delete();
        session()->flash('message', 'Stock list deleted successfully.');

        $this->reset(['deletingId']);
        $this->showDeleteModal = false;
    }

    public function cancelEdit(): void
    {
        $this->reset(['code', 'commonName', 'scientificName', 'size', 'length', 'image', 'editingId']);
        $this->showFormModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Stock List Management'])]
    #[Title('Stock List Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.stock-lists', [
            'stockLists' => StockList::query()
                ->when($this->search, fn ($query) => $query->where('code', 'like', "%{$this->search}%")
                    ->orWhere('common_name', 'like', "%{$this->search}%")
                    ->orWhere('scientific_name', 'like', "%{$this->search}%"))
                ->orderBy('code')
                ->paginate(10),
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Term;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Terms extends Component
{
    use WithPagination;

    public string $title = '';

    public string $content = '';

    public bool $isActive = true;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $search = '';

    public bool $showFormModal = false;

    public bool $showDeleteModal = false;

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'is_active' => $this->isActive,
        ];

        if ($this->editingId) {
            $term = Term::findOrFail($this->editingId);
            $term->update($data);
            session()->flash('message', 'Term updated successfully.');
        } else {
            $maxOrder = Term::query()->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
            Term::create($data);
            session()->flash('message', 'Term created successfully.');
        }

        $this->reset(['title', 'content', 'isActive', 'editingId']);
        $this->showFormModal = false;
    }

    public function openCreateModal(): void
    {
        $this->reset(['title', 'content', 'isActive', 'editingId']);
        $this->isActive = true;
        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $term = Term::findOrFail($id);

        $this->editingId = $id;
        $this->title = $term->title;
        $this->content = $term->content;
        $this->isActive = $term->is_active;

        $this->showFormModal = true;
    }

    public function cancelEdit(): void
    {
        $this->reset(['title', 'content', 'isActive', 'editingId']);
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

        Term::findOrFail($this->deletingId)->delete();
        session()->flash('message', 'Term deleted successfully.');
        $this->deletingId = null;
        $this->showDeleteModal = false;
    }

    #[Layout('components.layouts.admin', ['heading' => 'Terms Management'])]
    #[Title('Terms Management - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.terms', [
            'terms' => Term::query()
                ->when($this->search, fn ($query) => $query->where('title', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(10),
        ]);
    }
}<?php

namespace App\Livewire\Pages\Admin;

use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebsiteSettings extends Component
{
    use WithFileUploads;

    public string $websiteName = '';

    public string $companyName = '';

    public string $companyDescription = '';

    public string $contactEmail = '';

    public string $mailHost = '';

    public string $mailPort = '';

    public string $mailUsername = '';

    public string $mailPassword = '';

    public string $mailEncryption = '';

    public $logo;

    public string $seoTitle = '';

    public string $seoDescription = '';

    public string $seoKeywords = '';

    public $ogImage;

    public function mount(): void
    {
        $this->websiteName = Setting::get('website_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyName = Setting::get('company_name', 'PT. Tropis Fish Indonesia') ?? 'PT. Tropis Fish Indonesia';
        $this->companyDescription = Setting::get('company_description', 'Export of Ornamental Freshwater Fish') ?? 'Export of Ornamental Freshwater Fish';
        $this->contactEmail = Setting::get('contact_email', 'sales@tropisfish.com') ?? 'sales@tropisfish.com';
        $this->mailHost = Setting::get('mail_host', 'smtp.gmail.com') ?? 'smtp.gmail.com';
        $this->mailPort = Setting::get('mail_port', '587') ?? '587';
        $this->mailUsername = Setting::get('mail_username', '') ?? '';
        $this->mailPassword = Setting::get('mail_password', '') ?? '';
        $this->mailEncryption = Setting::get('mail_encryption', 'tls') ?? 'tls';
        $this->seoTitle = Setting::get('seo_title', '') ?? '';
        $this->seoDescription = Setting::get('seo_description', '') ?? '';
        $this->seoKeywords = Setting::get('seo_keywords', '') ?? '';
    }

    public function getCurrentLogoProperty()
    {
        return Setting::get('company_logo');
    }

    public function getCurrentOgImageProperty()
    {
        return Setting::get('og_image');
    }

    public function testEmail(): void
    {
        try {
            config([
                'mail.mailers.smtp.host' => $this->mailHost,
                'mail.mailers.smtp.port' => $this->mailPort,
                'mail.mailers.smtp.username' => $this->mailUsername,
                'mail.mailers.smtp.password' => $this->mailPassword ?: Setting::get('mail_password', ''),
                'mail.mailers.smtp.encryption' => $this->mailEncryption,
            ]);

            Mail::to($this->contactEmail)->send(new ContactFormMail(
                senderName: 'Test Email System',
                senderEmail: $this->contactEmail,
                senderPhone: 'N/A',
                emailSubject: 'SMTP Configuration Test',
                messageContent: 'This is a test email to verify your SMTP settings are working correctly. If you received this email, your configuration is successful!'
            ));

            session()->flash('test_email_success', "Test email sent successfully! Please check your inbox at {$this->contactEmail}");
        } catch (\Exception $e) {
            session()->flash('test_email_error', "Failed to send test email: {$e->getMessage()}");
            \Log::error('SMTP test failed', [
                'error' => $e->getMessage(),
                'host' => $this->mailHost,
                'port' => $this->mailPort,
                'username' => $this->mailUsername,
            ]);
        }
    }

    public function save(): void
    {
        $this->validate([
            'websiteName' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'companyDescription' => 'required|string|max:255',
            'contactEmail' => 'required|email|max:255',
            'mailHost' => 'required|string|max:255',
            'mailPort' => 'required|numeric',
            'mailUsername' => 'nullable|string|max:255',
            'mailPassword' => 'nullable|string|max:255',
            'mailEncryption' => 'required|string|in:tls,ssl',
            'logo' => 'nullable|image|max:7168',
            'seoTitle' => 'nullable|string|max:255',
            'seoDescription' => 'nullable|string|max:500',
            'seoKeywords' => 'nullable|string|max:500',
            'ogImage' => 'nullable|image|max:7168',
        ]);

        Setting::set('website_name', $this->websiteName);
        Setting::set('company_name', $this->companyName);
        Setting::set('company_description', $this->companyDescription);
        Setting::set('contact_email', $this->contactEmail);
        Setting::set('mail_host', $this->mailHost);
        Setting::set('mail_port', $this->mailPort);
        Setting::set('mail_username', $this->mailUsername);

        if ($this->mailPassword) {
            Setting::set('mail_password', $this->mailPassword);
        }

        Setting::set('mail_encryption', $this->mailEncryption);
        Setting::set('seo_title', $this->seoTitle);
        Setting::set('seo_description', $this->seoDescription);
        Setting::set('seo_keywords', $this->seoKeywords);

        if ($this->logo) {
            $oldLogo = Setting::get('company_logo');
            if ($oldLogo && \Storage::disk('public')->exists($oldLogo)) {
                \Storage::disk('public')->delete($oldLogo);
            }

            $logoPath = $this->logo->store('settings', 'public');
            Setting::set('company_logo', $logoPath);
            $this->reset('logo');
        }

        if ($this->ogImage) {
            $oldOgImage = Setting::get('og_image');
            if ($oldOgImage && \Storage::disk('public')->exists($oldOgImage)) {
                \Storage::disk('public')->delete($oldOgImage);
            }

            $ogImagePath = $this->ogImage->store('settings', 'public');
            Setting::set('og_image', $ogImagePath);
            $this->reset('ogImage');
        }

        session()->flash('message', 'Website settings saved successfully.');
    }

    #[Layout('components.layouts.admin', ['heading' => 'Website Settings'])]
    #[Title('Website Settings - PT. Tropis Fish Indonesia')]
    public function render()
    {
        return view('livewire.pages.admin.website-settings');
    }
}