<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Notifications')]
class Index extends Component
{
    public function render()
    {
        $user = auth()->user();

        if ($user->notification) {
            $user->update(['notification' => false]);
        }

        $notifications = Notification::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.notification.index', compact('notifications'));
    }
}
