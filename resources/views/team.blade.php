<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="ml-4" >
                <a href="{{route('dashboard')}}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" id="team" action="{{(isset($data))?url("team/{$data['id']}"):url('/create/team')}}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />
                            @if(isset($data))
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name', $data['name'])}}"  required autofocus />
                            @else
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  required autofocus />
                            @endif
                        </div>

                        <!-- File -->
                        <div class="mt-4">
                            <x-label for="logo" :value="__('logo')" />

                            <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" />
                        </div>

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
{{--        <script type="text/javascript">--}}
{{--            $(document).ready(function () {--}}
{{--                $('#team').on('submit', function(e) {--}}
{{--                    e.preventDefault();--}}
{{--                    var name = $('#name').val();--}}
{{--                    var logo = $('#logo').val();--}}
{{--                    $.ajax({--}}
{{--                        type: "POST",--}}
{{--                        url: '/team',--}}
{{--                        data: {name:name, logo:logo},--}}
{{--                        success: function( msg ) {--}}
{{--                            alert( msg );--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    @stop

</x-app-layout>
