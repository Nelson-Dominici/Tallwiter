<div class='flex w-full'>

    <livewire:components.menu/>

    <div class='border-r w-[600px] min-h-screen	h-fit'>

        <div class='flex text-secondary w-full border-b justify-around items-end pt-4'>

            <a wire:navigate href='{{ route("home", ["filter" => "for-you"]) }}' class="{{ $selectedFilter == 'for-you' ? 'border-b-4 border-primary' : 'mb-1' }} pb-2 cursor-pointer">
                For you
            </a>

            <a wire:navigate href='{{ route("home", ["filter" => "following"]) }}' class='{{ $selectedFilter == "following" ? "border-b-4 border-primary" : "mb-1" }} pb-2 cursor-pointer'>
                Following
            </a>

        </div>

        <livewire:post.create/>

        @foreach ($posts as $post)

            <livewire:components.post :$post :key='$post->id'/>

        @endforeach

    </div>

</div>
