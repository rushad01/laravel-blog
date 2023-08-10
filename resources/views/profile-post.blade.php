<x-layout>
<div class="container py-md-5 container--narrow">
      <h2>
        <img class="avatar-small" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" /> {{$username}}
        @auth
            @if(!$currentlyFollowing && auth()->user()->username != $username)
            <form class="ml-2 d-inline" action="/new_follow/{{$username}}" method="POST">
          @csrf
          <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
        </form>
            @endif
            @if ($currentlyFollowing)
            <form class="ml-2 d-inline" action="/remove_follow/{{$username}}" method="POST">
          @csrf
          <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button>
        </form>
            @endif
        @endauth
        
      </h2>

      <div class="profile-nav nav nav-tabs pt-2 mb-4">
        <a href="#" class="profile-nav-link nav-item nav-link active">Posts: {{$postsCount}}</a>
        <a href="#" class="profile-nav-link nav-item nav-link">Followers: 3</a>
        <a href="#" class="profile-nav-link nav-item nav-link">Following: 2</a>
      </div>

      <div class="list-group">
        @foreach ($posts as $post)
        <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
          <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
          <strong>{{$post->title}}</strong> on {{$post->created_at->format('d/m/Y')}}
        </a>
        @endforeach
      </div>
    </div>

</x-layout>