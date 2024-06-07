@extends('Profile Folder.ProfileLayout')
@section('content')
    <!-- Include Tailwind CSS -->
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('js\ErrorHandle.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        /* Sidebar Styles */
        
        /* Main Content Styles */
       
    </style>
    <script>
        $(document).ready(function() {
            $('#updateProfileForm').submit(function(e) 
            {
                e.preventDefault();
                var email = $('#email').val();
                var name = $('#name').val();
                var location = $('#location').val();
                var password = $('#password').val();
                $.ajax({
                    type: 'POST',
                    url: '/profile/update/{{ $user->id }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email,
                        'password': password,
                        'name': name,
                        'location': location
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update profile information displayed on the page
                            $("#name").text(name);
                            $("#email").text(email);
                            $("#location").text(location);
                            $("#password").text(password);
                            
                            document.getElementById('Name').innerHTML =name;
                            document.getElementById('Email').innerHTML =email;
                            document.getElementById('Location').innerHTML = location;
                            showToast('Profile updated successfully', 'green');
                        } else {
                            showToast('Failed to update profile. Please try again', 'red');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        showToast('Failed to update profile. Please try again', 'red');
                    }
                });
            });
        });
    
        function deleteAccount() {
            if (confirm('Are you sure you want to delete your account?'))
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

</head>
<body class="bg-gray-100">    
    <!-- Main Content -->
    <div class="main-content ml-64 px-8 py-8">
        <!-- Profile Information -->
        <div class="bg-white shadow-md rounded-lg p-8 mb-8">
            <h1 class="text-2xl font-semibold mb-4">Profile Information</h1>
            <div>
                <p class="text-gray-700"><span class="font-semibold">Name:</span> {{$user->name}}<span id="Name"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> {{$user->email}} <span id="Email"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Location:</span> {{$user->location}}<span id="Location"></span></p>
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
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{$user->email}}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="text" id="password" name="password" value="{{$user->password}}" class="border border-gray-300 rounded-md p-2 w-full">
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
</html>
@endsection
