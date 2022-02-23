<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($data['name'].' | Players') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-button class="ml-4" >
                <a href="{{route('dashboard')}}">Back To Dashboard </a>
                <pre>  |  </pre>
                <a href="{{route('createPlayer',$data['id'])}}"> Add Player</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <li style="color: green;">{{ session()->get('message') }}</li>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!empty($data['player']))

                        <table id="players_table" class="display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Image</th>
                                @if(isset($admin) && $admin)
                                <th>Edit</th>
                                <th>Delete</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['player'] as $count => $player)
                                <tr>
                                    <td>{{$count+1}}</td>
                                    <td>{{$player['first_name']}}</td>
                                    <td>{{$player['last_name']}}</td>
                                    <td><img src="{{$player['image']}}" alt="{{$player['image']}}" width="50" height="70"></td>
                                    @if(isset($admin) && $admin)
                                    <td><a href="{{route('editPlayer',$player['id'])}}">Edit</a></td>
                                    <td><a href="{{route('deletePlayer',$player['id'])}}">Delete</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>There is no player added to this team, Please add a player!</span>
                    @endif
                </div>


            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#players_table').DataTable({

                });
            });
        </script>
    @stop

</x-app-layout>
