<div class="ml-2 transition-all hidden md:block w-96 p-5 border-b flex-col">

    <div class="fixed w-96">

        <div class="border p-4 rounded-xl">
            <h1 class="font-bold">Who to follow<h1>

            <div class="mt-3">

                @foreach($users as $user)
                    <a class="p-2 flex">
                        <div class='!size-10 bg-primary mt-1 rounded-full flex items-center justify-center mr-3 overflow-hidden'>

                            @if(!$user->profile_photo_id)
                                <p class='text-white font-bold text-lg'>
                                    {{
                                        strtoupper( substr($user->name, 0, 1) )
                                    }}
                                </p>
                            @else
                                <x-cld-image public-id="{{$user['profile_photo_id']}}" width="300" height="300" crop="scale"></x-cld-image>
                            @endif
                        </div>

                        <div class="flex justify-between grow">
                            <div>
                                <h1 class="font-bold my-auto">{{$user->name}}</h1>
                                <p class="text-slate-500">{{$user->email}}</p>
                            </div>
                            <x-button text='{{ $user->following ? "Unfollow" : "Follow" }}' wire:click='followHandle({{$user}})' round class='ml-auto bg-primary h-8 my-auto text-white font-bold'/>
                        </div>

                    </a>
                @endforeach
            </div>

        </div>

        <div class="border p-4 rounded-xl mt-7">

            <h1 class="font-bold">🌟 Hyped Post of Day<h1>

            @if ($hyped_post)
                <livewire:components.post :post='$hyped_post' :key='$hyped_post->id'/>
            @endif

        </div>


    </div>

</div>
