    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <li class="nav-item dropdown pt-2">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Notifications ({{ $unreadCount }})</a>
        <ul class="dropdown-menu">
            @foreach ($notifications as $notification)
                <li @class(['py-0','my-0','light-gray-bg' => $notification->read_at != null])>
                    <a href="{{ $notification->data['link'] }}?nid={{ $notification->id }}"
                        @class(['dropdown-item','py-3'])>{{ $notification->data['body'] }}
                        <br>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider py-0 my-0">
                </li>
            @endforeach

        </ul>
    </li>
