<?php

namespace App\Livewire\Forum;

use Livewire\Component;
use App\Models\Topic;

class CreateTopic extends Component
{
    public $title;
    public $content;

    public function submit()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        Topic::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Topic created successfully!');

        return redirect()->route('forum.index');
    }

    public function render()
    {
        return view('livewire.forum.create-topic');
    }
}
