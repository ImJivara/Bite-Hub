<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<x-setting heading="Create New User">
    <form method="POST" action="/admin/users" enctype="multipart/form-data">
        @csrf

        <x-form.input name="name" label="Name" required />
        <x-form.input name="email" label="Email" type="email" required />
        <x-form.input name="location" label="Location" />
        <x-form.input name="password" label="Password" type="password" required />
        <x-form.input name="UserIsAdmin" label="Is Admin" required />

        <x-form.button>Create</x-form.button>
    </form>

    @if ($errors->any())
        <div class="mt-6">
            <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-setting>
