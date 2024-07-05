<div class='flex h-screen'>

    <section class='hidden lg:flex items-center flex-col justify-center w-full h-full bg-primary'>

        <div class='flex items-center flex-col justify-center'>

            <img class="w-1/2 object-cover" src="{{asset('/images/logo.png')}}" >

            <p class="text-white mt-3 text-lg font-semibold w-10/12 text-center">
                A community-powered open source blog updated with the latest news about TALLStack, offering insights and updates on new features and best practices.
            </p>
        </div>

        <a class='flex items-center justify-center text-white border-2 w-60 text-center rounded-full mt-8 p-3 font-bold' target='_blank' href='https://github.com/Nelson-Dominici/TALLBlog'>
            <x-bi-github class='mr-2'/>
            GitHub
        </a>

    </section>

    <section class='flex items-center bg-background justify-center w-full h-full'>

        <form wire:submit='login' class='px-6 flex flex-col items-center justify-center w-full'>

            <h1 class="
                mb-3 bg-secondary text-white font-semibold rounded-lg p-1 text-center phone:w-96 w-full phone:h-8 h-auto transition-opacity
                {{ $errors->any() ? 'opacity-100' : 'opacity-0' }}"
            >
                @if($errors->has('email'))
                    {{ $errors->first('email') }}

                @elseif($errors->has('Incorrect Credentials'))

                    {{ $errors->first('Incorrect Credentials') }}

                @elseif($errors->has('password'))

                    {{ $errors->first('password') }}

                @endif
            </h1>

            <h1 class='font-semibold mb-6 text-primary phone:text-4xl text-2xl'>🤙Login in</h1>

            <input wire:model='email' id='email' required placeholder='Email' class='outline-0 p-3 border rounded-md mb-5 phone:w-96 w-full' type='email' name='email'>

            <input wire:model='password' id='password' required placeholder='Password' class='outline-0 p-3 border rounded-md mb-6 phone:w-96 w-full' type='password' name='password'>

            <input wire:loading.class="opacity-75" type='submit' class='transition-all text-white font-semibold text-xl cursor-pointer phone:w-60 w-full rounded-full p-3 bg-primary' value='Login'>

            <p class="mt-5 font-semibold text-commonTextColor">
                Don't have an <a wire:navigate class="text-primary decoration-1" href='{{ route("users.create") }}'>account</a>  yet?
            </p>

        </form>

    </section>

</div>
