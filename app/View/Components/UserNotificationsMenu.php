<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserNotificationsMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications;
    public $unreadCount;
    public function __construct()
    {
        //
        $user = Auth::user();
        $this->notifications = $user->notifications;
        $this->unreadCount = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-notifications-menu');
    }
}
