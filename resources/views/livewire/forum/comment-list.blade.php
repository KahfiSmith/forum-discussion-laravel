<div class="comment-section">
    @auth
    <form wire:submit.prevent="addComment" class="mb-4">
        <div class="mb-3">
            <textarea 
                wire:model="newComment" 
                class="form-control @error('newComment') is-invalid @enderror" 
                rows="3" 
                placeholder="tulis komentar..."
            ></textarea>
            @error('newComment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Posting Komentar
        </button>
    </form>
    @else
    <div class="alert alert-info">
        <a href="{{ route('login') }}">Log in</a> to post a comment
    </div>
    @endauth

    <div class="comments-list">
        @forelse($comments as $comment)
            <div class="comment mb-3">
                <div class="comment-header d-flex justify-content-between align-items-center">
                    <div class="comment-author">
                        <strong>{{ $comment->user->name }}</strong>
                        <small class="text-muted ml-2">
                            {{ $comment->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
                <div class="comment-body">
                    {{ $comment->content }}
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada komentar</p>
        @endforelse
    </div>
</div>