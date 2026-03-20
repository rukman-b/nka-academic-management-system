<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" title="Notifications">
        <i class="far fa-bell"></i>
        @php $count = auth()->user()?->unreadNotifications->count(); @endphp
        @if($count)
            <span class="badge badge-warning navbar-badge">{{ $count }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $count }} Notification{{ $count !== 1 ? 's' : '' }}</span>
        @foreach(auth()->user()?->unreadNotifications->take(5) ?? [] as $notification)
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-info-circle mr-2"></i>
                <div style="white-space: normal; word-wrap: break-word; max-width: 250px;">
                    {{ $notification->data['message'] ?? 'No message' }}
                </div>
                <span class="float-right text-muted text-sm">
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </a>
        @endforeach

        @if($count > 0)
            <div class="dropdown-divider"></div>
            <a href="{{ route('notifications.markAllRead') }}" class="dropdown-item dropdown-footer text-center">
                Mark all as read
            </a>
        @endif
    </div>
</li>
