@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <h4 class="pb-2">
            Liked by
        </h4>
        @foreach($usr_liked as $user)
            <div class="row-4 d-flex mt-4">
                <div class="mr-3">
                    <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 60px">
                </div>

                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="ml-2">
                        <div>
                            <a href="/profile/{{ $user->username }}">
                                <p class="font-weight-bold text-dark m-0">{{ $user->username }}</p>
                            </a>
                        </div>
                        <div>
                            <p class="m-0" style="color: gray">{{ $user->profile->title }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        @cannot('update', $user->profile)
                            <form class="form-horizontal" action="{{route('follow', array('user' => $user->id))}}" method="POST">
                                @csrf
                                @if((auth()->user()) && auth()->user()->following->contains('user_id', $user->id))
                                    <button class="btn btn-outline-dark ml-4" name="follow" value="following">Following</button>
                                @else
                                    <button class="btn btn-primary ml-4" name="follow" value="following">Follow</button>
                                @endif
                            </form>
                        @endcannot
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
