@extends('app')

@section('main')

<div class="container mx-auto max-w-screen-xl p-4">
    <div class="w-full max-w-sm mx-auto">
        <div class="mb-6 flex items-center">
            <a href="{{route('forms')}}" class="p-4">
                <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>                  
            </a>
            <h2 class="text-3xl">{{$form->id ? 'Update' : 'Create New'}} Form</h2>
        </div>

        <form action="{{$form->id ? route('forms.do_update', ['form' => $form->id]) : route('forms.do_create')}}" method="POST" class="flex flex-col gap-4">
            @csrf
            @if($form->id) @method('PATCH') @endif
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter form name" value="{{old('name', $form->name)}}">
                @error('name')
                    <p class="err">{{$message}}</p>
                @enderror
            </div>
            <div class="form-control">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="2" placeholder="Enter form description (optional)">{{old('description', $form->description)}}</textarea>
                @error('description')
                    <p class="err">{{$message}}</p>
                @enderror
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="disabled" name="disabled" type="checkbox" value="1" {{old('disabled', ($form->status == 0 ? '1' : null)) ? 'checked' : ''}}
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                </div>
                <label for="disabled" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disabled</label>
            </div>
            <div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{$form->id ? 'Update' : 'Create'}}</button>
            </div>
        </form>
    </div>
</div>

@endsection