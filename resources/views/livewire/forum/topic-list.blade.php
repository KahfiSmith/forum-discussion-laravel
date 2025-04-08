<div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof window.Echo !== 'undefined') {
                console.log("Pusher Connected!");
                
                window.Echo.channel('forum')
                    .listen('NewTopicCreated', (e) => {
                        console.log("New topic received:", e);
                        Livewire.dispatch('topicCreated');
                    })
                    .error(error => console.error("Pusher Error:", error));
            } else {
                console.error("Pusher / Echo is not defined. Make sure bootstrap.js is loaded correctly.");
            }
        });
    </script>

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Forum Discussions</h1>
            <a href="{{ route('topics.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                New Topic
            </a>
        </div>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @forelse ($topics as $topic)
                <div class="p-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                    <div class="flex justify-between items-start">
                        <div>
                            <a href="{{ route('topics.show', $topic) }}" class="text-xl font-semibold text-blue-600 hover:text-blue-800">
                                {{ $topic->title }}
                            </a>
                            <p class="text-gray-500 text-sm mt-1">
                                Posted by {{ $topic->user->name }} • {{ $topic->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                {{ $topic->comments_count }}
                            </div>
                            
                            {{-- Like Button --}}
                            <livewire:forum.like-button 
                                :model="$topic" 
                                :wire:key="'topic-like-'.$topic->id" 
                            />
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No topics yet. Be the first to start a discussion!
                </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $topics->links() }}
        </div>
    </div>
</div>