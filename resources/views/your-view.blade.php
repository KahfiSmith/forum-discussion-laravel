<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.Echo !== 'undefined') {
            console.log("Pusher Connected!");

            const forumChannel = window.Echo.channel('forum');
            console.log("Forum Channel:", forumChannel);

            forumChannel.listen('NewTopicCreated', (e) => {
                console.log("New topic received:", e);
                Livewire.emit('topicCreated');
            }).error(error => console.error("Pusher Error:", error));
        } else {
            console.error("Pusher / Echo is not defined. Make sure bootstrap.js is loaded correctly.");
        }
    });
</script>
