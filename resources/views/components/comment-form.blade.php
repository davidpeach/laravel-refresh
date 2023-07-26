@props(['post'])
<form method="POST" action="/posts/{{ $post->slug }}/comments">
    @csrf
    <h2>Add Comment</h2>

    <div>
    <textarea name="body">

    </textarea>
    </div>

    <button type="submit">Save</button>
</form>
