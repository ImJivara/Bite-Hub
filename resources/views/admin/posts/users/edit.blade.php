<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<script src="{{asset('jquery-3.7.1.js')}}"></script>
<script src="{{ asset('js\ErrorHandle.js') }}"></script>

<x-setting :heading="'Edit User: ' . $user->name">
<script>
   
        $(document).ready(function() {
            $('#updateProfileForm').submit(function(e) 
            {
                e.preventDefault();
                var email = $('#email').val();
                var name = $('#name').val();
                var username = $('#username').val();
                var location = $('#location').val();
                $.ajax({
                    type: 'POST',
                    url: '/profile/update/{{ $user->id }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email,
                        'name': name,
                        'username':username,
                        'location': location
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('Profile updated successfully', 'green');
                            // Update profile information displayed on the page
                            $("#name").text(name);
                            $("#username").text(username);
                            $("#email").text(email);
                            $("#location").text(location);

                            $("#Name").text(response.name);
                            $("#Username").text(response.username);
                            $("#Email").text(response.email);
                            $("#Location").text(response.location);
                            
                            
                           
                            
                        } else {
                            showToast(response.message, 'red');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        showToast(error, 'red');
                    }
                });
            });
        });
    
        function deleteAccount() {
            if (confirm('Are you sure you want to delete this account?'))
             {
                $.ajax({
                    type: 'POST',
                    url: '/account/delete',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id':'{{$user->id }}',
                    },
                    success: function(response) {
                        if (response.success) 
                        { 
                            showToast(response.message, 'green');
                            // Redirect to a confirmation page or login page
                            window.location.href = '/Login';
                        } else {
                            showToast(response.message, 'red');
                        }
                    },
                   
                });
            }
        }
</script>
<body class="bg-gray-100">    
    <!-- Main Content -->
    <div class="main-content ">
        <!-- Profile Information -->
        <div class="bg-white shadow-md rounded-lg p-8 mb-8">
            <h1 class="text-2xl font-semibold mb-4">Profile Information</h1>
            <div>
                <p class="text-gray-700"><span class="font-semibold">Name:</span> <span id="Name"> {{ $user->name }}</span></p>
                <p class="text-gray-700"><span class="font-semibold">User Name:</span> <span id="Username"> {{ $user->username }}</span></p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> <span id="Email"> {{ $user->email }}</span></p>
                <p class="text-gray-700"><span class="font-semibold">Location:</span> <span id="Location"> {{ $user->location }}</span></p>
            </div>
        </div>
        <!-- Edit Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>
<!-- form  -->
          <form id="updateProfileForm" onsubmit="event.preventDefault(); updateProfile();" method="POST"> 
                @csrf
                <!-- Form Inputs -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name"  value="{{$user->name}}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-semibold mb-2">User Name</label>
                    <input type="text" id="username" name="username"  value="{{$user->username}}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{$user->email}}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" name="location" value="{{$user->location}}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <!-- Submit Button -->
                <div>
                    
                    <!-- <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Save Changes</button> -->
                    <button id="btnSubmit" type="submit"
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Save
                        Changes</button>
                    <!-- Button for deleting the account -->
                    <button id="btnDeleteAccount" type="button"
                        class="bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600"
                        onclick="deleteAccount()">Delete Account</button>
                </div>
            </form>
                <!--Toast div here t3et l confirmation --><div id="toast" class="fixed bottom-0 right-0 m-8 p-4 bg-gray-900 text-white rounded shadow-lg hidden"> </div>
        </div>
    </div>
</body>
</x-setting>
    

