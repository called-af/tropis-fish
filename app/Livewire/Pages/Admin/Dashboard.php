<?php

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
}
