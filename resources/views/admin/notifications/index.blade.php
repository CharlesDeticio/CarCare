<h2>Admin Notifications</h2>

    @forelse ($notifications as $notification)
        <div style="margin-bottom: 15px; border-bottom: 1px solid #ddd; padding: 10px;">
            <p>{{ $notification->message }}</p>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p>No notifications.</p>
    @endforelse

    {{ $notifications->links() }}