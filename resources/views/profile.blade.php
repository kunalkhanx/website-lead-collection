@extends('app')

@section('main')
    <div class="container mx-auto max-w-screen-xl p-4">
        <div class="mb-6 flex items-center">
            <a href="{{route('users')}}" class="p-4">
                <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>                  
            </a>
            <h2 class="text-3xl">Update Account</h2>
        </div>
        <form action="{{route('profile.do_update')}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Enter user's full name" name="name" value="{{$user->name}}">
                    @error('name')
                        <p class="err">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Enter unique username" name="username" value="{{$user->username}}">
                    @error('username')
                        <p class="err">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter users email address" name="email" value="{{$user->email}}">
                    @error('email')
                        <p class="err">{{$message}}</p>
                    @enderror
                </div>
                <div></div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter secret password" name="password">
                    @error('password')
                        <p class="err">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" placeholder="Type the password again" name="confirm_password">
                    @error('confirm_password')
                        <p class="err">{{$message}}</p>
                    @enderror
                </div>
               
                
                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
