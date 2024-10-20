<div class='flex w-full'>

    <livewire:components.menu/>

    <div class='border-r w-[600px] min-h-screen	h-fit pt-2'>

        <h1 class="pl-5 text-2xl font-bold border-b pb-2 text-secondary">Bookmarks</h1>

        @foreach ($posts as $post)

            <livewire:components.post :$post :key='$post->id'/>

        @endforeach

        @if (!$posts->toArray())

            <h1 class="text-3xl mt-10 text-secondary font-bold text-center">Save posts for later</h1>
            <p class="text-center text-slate-500">
                Bookmark posts to easily find them again in the future
            </p>

        @endif

    </div>

</div>
