<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<x-setting heading="Manage Users">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('profileimgs/'.$user->id.'.jpg') }}" alt="{{ $user->name }}">
                                            </div>
                                            <div class="ml-4 text-sm font-medium text-gray-900">
                                                <a href="#">
                                                    {{ $user->name }}
                                                </a>
                                                <p class="text-red-500">Email: {{ $user->email }}</p>

                                                <p class="text-red-500">Admin: {{$user->UserIsAdmin ? 'True' : 'False'}}</p>
                                                

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/users/{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $users->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-setting>


