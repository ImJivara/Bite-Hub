<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">

<x-setting heading="Manage Posts">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{asset('storage/' . $post->thumbnail)}}" alt="{{ $post->RecipeName }}">
                                            </div>
                                            <div class="ml-4 text-sm font-medium text-gray-900">
                                                <a href="/Recipe/{{ $post->id }}">
                                                    {{ $post->RecipeName }}
                                                </a>
                                                <p class="text-red-500">By: {{ $post->author->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/posts/{{ $post->id }}" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $posts->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-setting>


