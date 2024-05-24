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
            <p class="text-center text-gray-800 mt-2" id="name_sidebar" >{{Auth::user()->name}}</p>
        </div>
        <!-- Sidebar Items -->
        <div class="mt-4">
            <div class="sidebar-item">
                <a href="Edit Profile/{{Auth::user()->id}}" class="text-gray-800 font-semibold">Edit Profile</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Change Password</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Account Settings</a>
            </div>
            <div class="sidebar-item">
                <a href="/profile/recent-activities/all" class="text-gray-800 font-semibold">Recent Activities</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Logout</a>
            </div>
        </div>
    </div>
    
        <div>
            @yield('content')
        </div>
    
        
           
   
</body>
</html>
