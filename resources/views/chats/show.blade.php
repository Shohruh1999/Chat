<x-chats.index>
<!-- Left -->
<div class="w-1/3 border flex flex-col">

    <!-- Header -->
   

        <!-- Search -->
        <div class="py-2 px-2 bg-grey-lightest">
            <input type="text" class="w-full px-2 py-2 text-sm" placeholder="Search or start new chat" />
        </div>

        <!-- Contacts -->
        <div class="bg-grey-lighter flex-1 overflow-auto">
            @foreach ($users as $user)
                @if (Auth::user()->id != $user->id)
                    <a href="{{ route('messages.show', $user->id) }}"
                        class="bg-white px-3 flex items-center hover:bg-grey-lighter cursor-pointer">
                        <div>
                            @if ( $user->photo == 'avatar.png')
                            <img  class="h-12 w-12 rounded-full" src="/img/{{ $user->photo }}" alt="">                  
                            @else
                            <img class="h-12 w-12 rounded-full" src="/storage/{{ $user->photo }}" />
                            @endif
                        </div>
                        <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
                            <div class="flex items-bottom justify-between">
                                <p class="text-grey-darkest">
                                    {{ Str::substr($user->name, 0, 10) }}
                                </p>
                                
                            </div>
                            <p class="text-grey-dark mt-1 text-sm">
                                {{ Str::substr($user->getChat(), 0, 10) }}
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach

        </div>

    </div>


    <!-- Right -->
    <div class="w-2/3 border flex flex-col">

        <!-- Header -->
        <div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
            <div class="flex items-center">
                <div>
                    <img class="w-10 h-10 rounded-full"
                        src="https://darrenjameseeley.files.wordpress.com/2014/09/expendables3.jpeg" />
                </div>
                <div class="ml-4">
                    <p class="text-grey-darkest">
                        {{ $show->name }}
                    </p>
                    <p class="text-grey-darker text-xs mt-1">
                        Andrés, Tom, Harrison, Arnold, Sylvester
                    </p>
                </div>
            </div>

            <div class="flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#263238" fill-opacity=".5"
                            d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z">
                        </path>
                    </svg>
                </div>
                <div class="ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#263238" fill-opacity=".5"
                            d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z">
                        </path>
                    </svg>
                </div>
                <div class="ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#263238" fill-opacity=".6"
                            d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-auto" style="background-color: #DAD3CC">
            <div class="py-2 px-3">
                @foreach ($messages as $message)
                    @if ($message->date($show->id) != null)
                        <div class="flex justify-center mb-2">
                            <div class="rounded py-2 px-4" style="background-color: #DDECF2">
                                <p class="text-sm uppercase">
                                    {{ $message->date($show->id) }}
                                </p>
                            </div>
                        </div>
                    @endif
                    @if ($message->user_id == Auth::user()->id)
                        <div class="flex justify-end mb-2">
                            <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                                <p class="text-sm mt-1">
                                    {{ $message->message }}
                                </p>
                                <p class="text-right text-xs text-grey-dark mt-1">
                                    {{ $message->hour() }}
                                </p>
                                @if ($message->confirmed)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                @endif
                                <a href='{{ route('messages.edit', $message->id) }}'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex mb-2">
                            <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                                <p class="text-sm mt-1">
                                    {{ $message->message }}
                                </p>
                                <p class="text-right text-xs text-grey-dark mt-1">
                                    {{ $message->hour() }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Input -->
        <div class="bg-grey-lighter px-4 py-4 flex items-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path opacity=".45" fill="#263238"
                        d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z">
                    </path>
                </svg>
            </div>
            <form class=" flex" action="{{ route('messages.store', ['user' => $show]) }}" method="POST">
                @csrf

                <div class="flex-1 mx-4">
                    <input name="send" class=" w-50" required class="w-full border rounded px-2 py-2"
                        type="text" />
                </div>
                <button type="submit" style="margin-left: 20px">
                    <svg type="submit" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </form>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="#263238" fill-opacity=".45"
                        d="M11.999 14.942c2.001 0 3.531-1.53 3.531-3.531V4.35c0-2.001-1.53-3.531-3.531-3.531S8.469 2.35 8.469 4.35v7.061c0 2.001 1.53 3.531 3.53 3.531zm6.238-3.53c0 3.531-2.942 6.002-6.237 6.002s-6.237-2.471-6.237-6.002H3.761c0 4.001 3.178 7.297 7.061 7.885v3.884h2.354v-3.884c3.884-.588 7.061-3.884 7.061-7.885h-2z">
                    </path>
                </svg>
            </div>
        </div>
    </div>


</x-chats.index>
