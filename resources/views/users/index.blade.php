<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('users.create') }}" class="btn btn-dark" style="float:right; display:inline;">Create a User</a>
                     <form action="">
                     <input type="text" class="" id="searchbox" name="searchbox" style="border-radius: 10px;" placeholder="Search" >
                    <button type="submit" class="btn btn-warning" >Search</button>
                    </form>
                <hr>
                <table class="table table-striped">
                       <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                       </tr>

                    @foreach ($users as $user)
                       <tr>
                        <td>{{ $user->id }} </td>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->email }} </td>
                        <td>{{ $user->role }} </td>
                        <td>{{ date('M d, Y h:i',strtotime($user->created_at)) }}</td>
                        <td>{{ date('M d, Y h:i',strtotime($user->updated_at)) }}</td>

                        <td><a href ='/users/{{$user->id}}' ><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                        <form method="POST" action="/users/{{$user->id}}">
                        @method('DELETE')
                        @csrf
                        <a href = ''><button type="submit" class="btn btn-danger btn-sm" >Delete</button></a>
                        </form>
                        </td>

                       </tr>
                    @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
