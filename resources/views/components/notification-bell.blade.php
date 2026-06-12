<div x-data="notificationBell()" x-init="startPolling()" class="relative mr-4">
    <button @click="open = !open; if(open && unreadCount > 0) markAllAsRead()" @click.away="open = false" type="button" class="relative p-2 text-slate-400 hover:text-slate-500 focus:outline-none transition-colors rounded-full hover:bg-slate-100">
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        
        <!-- Badge -->
        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full" style="display: none;"></span>
    </button>

    <!-- Dropdown -->
    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
        <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-xl">
            <p class="text-sm font-bold text-slate-800">Notifikasi</p>
            <span x-show="unreadCount > 0" class="text-xs font-bold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full" x-text="unreadCount + ' Baru'"></span>
        </div>
        
        <div class="max-h-96 overflow-y-auto custom-scrollbar">
            <template x-if="notifications.length === 0">
                <div class="px-4 py-8 text-center text-slate-500 text-sm">
                    Belum ada notifikasi baru.
                </div>
            </template>
            
            <template x-for="notif in notifications" :key="notif.id">
                <a :href="notif.data.url" 
                   :class="notif.read_at ? 'bg-white hover:bg-slate-50' : 'bg-blue-50/50 hover:bg-blue-50'"
                   class="block px-4 py-3 border-b border-slate-50 transition-colors">
                    <p class="text-sm font-bold text-slate-800" x-text="notif.data.title"></p>
                    <p class="text-xs text-slate-500 mt-0.5" x-text="notif.data.message"></p>
                    <p class="text-[10px] font-bold mt-1.5" :class="notif.read_at ? 'text-slate-400' : 'text-blue-500'" x-text="notif.created_at"></p>
                </a>
            </template>
        </div>
        
        <div class="px-4 py-2 border-t border-slate-100 bg-slate-50 rounded-b-xl text-center">
            <a href="#" class="text-xs font-bold text-slate-500 hover:text-blue-600">Lihat Semua Riwayat</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notificationBell', () => ({
            open: false,
            notifications: [],
            unreadCount: 0,
            pollingInterval: null,
            
            startPolling() {
                this.fetchNotifications();
                // Poll every 10 seconds
                this.pollingInterval = setInterval(() => {
                    this.fetchNotifications();
                }, 10000);
            },
            
            fetchNotifications() {
                fetch('/api/notifications/unread')
                    .then(res => res.json())
                    .then(data => {
                        this.notifications = data.recent;
                        this.unreadCount = data.count;
                    })
                    .catch(err => console.error('Error fetching notifications:', err));
            },
            
            markAllAsRead() {
                if (this.unreadCount === 0) return;
                
                // Update UI immediately (mark all as read locally)
                this.unreadCount = 0;
                this.notifications = this.notifications.map(n => {
                    n.read_at = new Date().toISOString();
                    return n;
                });
                
                fetch('/api/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).catch(err => console.error('Error marking as read:', err));
            }
        }));
    });
</script>
