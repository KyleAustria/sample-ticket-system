<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <style>
/* https://www.youtube.com/watch?v=NuYMMNK4wzA */
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400&display=swap');

.grid-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  padding: 10px;
}

.card {
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    padding: 30px;
    align-items: center;
    width: 400px;
}

.card .text{
    display: flex;
    flex-direction: column;
    align-items: center;
}


.card .text h3{
    font-size: 40px;
    font-weight: 400;
}


a{
   text-decoration:none;
   color:#fff;
}

a:hover{
   color:#2ecc71;
}



/*Button One*/
.button-one {
  width: 150px;
  font-size: 20px;
  outline: none;
  background-color: #276dae;
  border: none;
  color: white;
  border-radius:5px;
  box-shadow: 0 9px #747474;
}

.button-one:hover{
  background-color: #032646;
}

.button-one:active {
  background-color: #5ed1ff;
  box-shadow: 0 5px #303030;
  transform: translateY(4px);
}

.button-two {
    width: 150px;
  font-size: 20px;
  outline: none;
  background-color: #890F0D;
  border: none;
  color: white;
  border-radius:5px;
  box-shadow: 0 9px #747474;
}

.button-two:hover{
  background-color: #630606 ;
}

.button-two:active {
  background-color: #630606 ;
  box-shadow: 0 5px #303030;
  transform: translateY(4px);
}

    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     <a href="{{ route('my.tickets.create') }}" class="btn btn-dark" style="float:right; display:inline;">Create a Ticket</a>
                     <form action="">
                     <input type="text" class="" id="searchbox" name="searchbox" style="border-radius: 10px;" placeholder="Search">
                    <button type="submit" class="btn btn-warning" >Search</button>
                    </form>
                <hr>




                    @foreach ($tickets as $ticket)
                    <div class="grid-container">
                    <div class="card ">

                    <div class="text">

                        <h3>{{ $ticket->name }}</h3>
                        <h5>Priority: {{$ticket->priority}}</h5>
                        <h6 style="color: rgb(72, 185, 255);">
                            {{ $ticket->status }}
                        </h6>
                    </div>
                    <div class="links">
                        <div class="sub-main">
                        <a href ='/tickets/{{$ticket->id}}' ><button class="button-one">View Ticket</button></a><br><br>
                        <form method="POST" action="/tickets/{{$ticket->id}}">
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
