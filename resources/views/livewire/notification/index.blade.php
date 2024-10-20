<div class='flex w-full'>

    <livewire:components.menu/>

    <div class='border-r w-[600px] min-h-screen	h-fit pt-2'>

        <h1 class="pl-5 text-2xl font-bold border-b pb-2 text-secondary">Notifications</h1>

        @foreach ($notifications as $notification)

            <div class="border-b flex p-5">

                @if ($notification->type == 'comment')

                    <x-heroicon-s-chat-bubble-oval-left class='w-6 mr-1'/>

                @else
                    <img class="w-6 h-6" src="{{asset('/images/logo-icon.png')}}">
                @endif

                <div class="ml-4">

                    <div class="size-12 rounded-md overflow-hidden">
                        <x-cld-image public-id="{{$notification->image}}" crop="crop" gravity="faces"></x-cld-image>
                    </div>

                    <h1 class="font-bold text-secondary text-xl mt-2">
                        {{$notification->title}}
                    </h1>

                    <p class="text-slate-500">{{$notification->text}}</p>
                </div>

            </div>

        @endforeach

        @if (!$notifications->toArray())

            <h1 class="text-3xl mt-10 text-secondary font-bold text-center px-5">You don't have any notifications yet</h1>
            <p class="text-center text-slate-500 px-5 pt-2">
                Notifications appear when someone comments on your post, or when you get a new follower
            </p>

        @endif


    </div>

</div>
