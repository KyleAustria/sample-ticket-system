<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('User / Edit') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form  method="POST" action="/users/{{$user->id}}">
                @method('PUT')
                @csrf

                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                </div>

                <div>
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" id="role" name="role">
                    <option value="Member" {{($user->role=='Member') ?"selected" :"''"}}>Member</option>
                    <option value="Admin"  {{($user->role=='Admin') ?"selected" :"''"}}>Admin</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>

                <input type="hidden" id="id" name="id" value="{{$user->id}}">

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>


                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
