<?php

namespace App\Livewire\Forum;

use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class TopicList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    // Listen for the topic created event
    protected $listeners = ['topicCreated' => '$refresh'];
    
    public function mount()
    {
        // Listen for broadcast events from Echo
        $this->dispatch('listen-for-new-topic');
    }
    
    public function render()
    {
        $topics = Topic::with('user')
            ->withCount('comments', 'likes')
            ->latest()
            ->paginate(10);
            
        return view('livewire.forum.topic-list', [
            'topics' => $topics
        ]);
    }
}