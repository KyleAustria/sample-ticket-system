<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('my.tickets.create') }}" class="btn btn-dark" style="float:right; display:inline;">Create a Ticket</a>
                    <form class="form my-2 my-md-0" action="">
                    <input type="text"  class="" id="searchbox" class="form-control" name="searchbox" placeholder="Search" style="border-radius: 10px;">
                    <button type="submit" class="btn btn-warning" >Search</button>
                    </form>
                <hr>



                    @foreach ($tickets as $ticket)


                    <div class="grid-container">
                    <div class="card ">

                    <div class="text">

                        <h3>{{ $ticket->name }}</h3>
                        <h6>{{$ticket->label}}</h6>
                        <h5 class="priority">{{$ticket->priority}}</h5>
                        <h6 style="color: rgb(72, 185, 255);">
                       {{$ticket->status }}
                        </h6>
                    </div>
                    <div class="links">
                        <div class="sub-main">
                        <a href ='./my/tickets/{{$ticket->id}}' ><button type="button" class="button-one">Edit</button></a><br> <br>
                        <form method="POST" action="./my/tickets/{{$ticket->id}}">
                        @method('DELETE')
                        @csrf
                        <a href = ''><button type="submit" class="button-two" >Delete</button></a>
                        </form>
                    </div>
                    </div>
                    </div>
                    </div>




                    @endforeach



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
