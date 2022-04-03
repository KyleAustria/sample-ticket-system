<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Tickets / Create') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form  method="POST" action="{{ route('users.store') }}">
                @csrf

                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>

                <div>
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" id="role" name="role">
                    <option>Open this select menu</option>
                    <option value="Member">Member</option>
                    <option value="Admin">Admin</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>


                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn btn-success">Create User</button>
                </div>

                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
