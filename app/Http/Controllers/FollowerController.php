<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function newFollow(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return back()->with('failure', 'You cannot follow yourself!');
        }

        $exsistingFollower = Follower::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->count();
        if ($exsistingFollower) {
            return back()->with('failure', 'You are already following this profile');
        }

        $newFollower = new Follower;
        $newFollower->user_id = auth()->user()->id;
        $newFollower->followedUser = $user->id;
        $newFollower->save();

        return back()->with('success', 'You are now following this profile');
    }

    public function removeFollow(User $user)
    {
        Follower::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->delete();
        return back()->with('success', 'You successfully unfollowed the user.');
    }
}
