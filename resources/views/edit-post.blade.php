<x-layout>
    <div class="container py-md-5 container--narrow">
      <form action="/{{$post->id}}/update-post" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input value="{{$post->title}}" name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
        </div>

        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea name="content" id="post-body" class="body-content tall-textarea form-control" type="text">{{$post->content}}</textarea>        
        </div>

        <button class="btn btn-primary">Edit Post</button>
</x-layout>