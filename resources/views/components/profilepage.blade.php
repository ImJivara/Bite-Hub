<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Tailwind CSS -->
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('js\ErrorHandle.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #FFFFFF;
            border-right: 1px solid #E5E7EB;
            padding-top: 4rem;
        }
        .sidebar-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: #F3F4F6;
        }
        /* Main Content Styles */
        .main-content {
            margin-left: 250px; /* Adjust according to sidebar width */
            padding: 2rem;
        }
        .back-button {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #777;
        }
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
                    url: '/profile/update/{{ $id }}',
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
                        'id':'{{$id}}',
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
    
    // Fetch account details using AJAX
    fetch('/Account/{{ $id }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('name_sidebar').innerHTML=data.account.name;
                $('#name').val(data.account.name);
                $('#email').val(data.account.email);
                $('#location').val(data.account.location);
                $('#password').val(data.account.password);
                document.getElementById('Name').innerHTML =data.account.name;
                document.getElementById('Email').innerHTML =data.account.email;
                document.getElementById('Location').innerHTML =data.account.location;
               
            } else {
                console.error('Failed to fetch account details:', data.message);
            }
        })
        .catch(error => console.error('Error fetching account details:', error));
</script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar">
    <div class="p-4">
        <a href="/Recipes" class="block py-2 px-4 bg-gray-800 text-white rounded-lg shadow-lg hover:bg-gray-700 transition duration-300 text-center">
            Back
        </a>
    </div>   
        
        <!-- Profile Image -->
        <div class="p-4">
            <img class="w-16 h-16 rounded-full mx-auto" src="{{ asset('imgs/3.jpg') }}" alt="Profile Picture">
            <p class="text-center text-gray-800 mt-2" id="name_sidebar" >John Doe</p>
        </div>
        <!-- Sidebar Items -->
        <div class="mt-4">
            <div class="sidebar-item">
                <a href="h" class="text-gray-800 font-semibold">Edit Profile</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Change Password</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Account Settings</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Logout</a>
            </div>
        </div>
    </div>
    
        
    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Information -->
        <div class="bg-white shadow-md rounded-lg p-8 mb-8">
            <h1 class="text-2xl font-semibold mb-4">Profile Information</h1>
            <div>
                <p class="text-gray-700"><span class="font-semibold">Name:</span> <span id="Name"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> <span id="Email"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Location:</span> <span id="Location"></span></p>
            </div>
        </div>
<div id="accountDetails"></div>
        <!-- Edit Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>
<!-- form  -->
          <form id="updateProfileForm" onsubmit="event.preventDefault(); updateProfile();" method="POST"> 
                @csrf
                <!-- Form Inputs -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="text" id="password" name="password" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" name="location" class="border border-gray-300 rounded-md p-2 w-full">
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
