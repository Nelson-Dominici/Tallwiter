<div class='mt-4'>

    <livewire:comment.create :$post/>

    <div class='mt-2 flex flex-col-reverse' x-cloak x-show="openComments" x-transition>

        @foreach ($comments as $comment)

            <livewire:components.comment :$comment :$post :key='$comment["id"]'/>

        @endforeach

    </div>

</div>
