@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
    <x-extracomponents.Backbtn To="to Blog" Url="/Recipes"/> 
        {{ $heading }} 
    </h1>
    

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>

            <ul>
                <li>
                    <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">All Posts</a>
                </li>

                <li>
                    <a href="/admin/users" class="{{ request()->is('admin/users') ? 'text-blue-500' : '' }}">All Users</a>
                </li>

                
                <li>
                    <a href="/admin/users/create" class="{{ request()->is('admin/users/create') ? 'text-blue-500' : '' }}">New User</a>
                </li>
                <li>
                    <a href="/fetch" class=" text-red-500 font-bold">Automatic Fetch</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
