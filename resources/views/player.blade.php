<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(isset($data['team_id'])? "Edit Player" : $data['name'].' | Add Player') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="ml-4" >
                <a href="{{route('teamPlayers',isset($data['team_id'])?$data['team_id']:$data['id'])}}">Back </a>
                <pre>  |  </pre>
                <a href="{{route('dashboard')}}"> Dashboard</a>
            </x-button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <li style="color: green;">{{ session()->get('message') }}</li>
                        </div>
                    @endif
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" id="team" action="{{(isset($data['team_id']))?url("player/{$data['id']}"):url('create/players')}}" enctype="multipart/form-data">
                    @csrf

                    <!-- First Name -->
                        <div>
                            <x-label for="first_name" :value="__('First Name')" />
                            @if(isset($data['team_id']))
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{old('first_name', $data['first_name'])}}"  required autofocus />
                            @else
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"  required autofocus />
                            @endif
                        </div>

                    <!-- Last Name -->
                        <div>
                            <x-label for="last_name" :value="__('Last Name')" />
                            @if(isset($data['team_id']))
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{old('last_name', $data['last_name'])}}"  required autofocus />
                            @else
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"  required autofocus />
                            @endif
                        </div>

                        <!-- File -->
                        <div class="mt-4">
                            <x-label for="image" :value="__('Image')" />

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>

                        <input name="team" type="hidden" value="{{isset($data['team_id'])?$data['team_id']:$data['id']}}">

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color: red;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('script')
{{--                <script type="text/javascript">--}}
{{--                    $(document).ready(function () {--}}
{{--                        $('#team').on('submit', function(e) {--}}
{{--                            e.preventDefault();--}}
{{--                            var name = $('#name').val();--}}
{{--                            var logo = $('#logo').val();--}}
{{--                            $.ajax({--}}
{{--                                type: "POST",--}}
{{--                                url: '/team',--}}
{{--                                data: {name:name, logo:logo},--}}
{{--                                success: function( msg ) {--}}
{{--                                    alert( msg );--}}
{{--                                }--}}
{{--                            });--}}
{{--                        });--}}
{{--                    });--}}
{{--                </script>--}}
    @stop

</x-app-layout>
