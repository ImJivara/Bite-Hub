@extends('Profile Folder.ProfileLayout')

@section('content')
    <!-- Include jQuery and Tailwind CSS -->
    <script src="{{ asset('jquery-3.7.1.js') }}"></script>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">>>>

    <!-- Additional styles for modal and card -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .card {
            overflow: hidden;
            background-color: #ffffff;
            text-align: left;
            border-radius: 0.5rem;
            max-width: 290px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .header {
            padding: 1.25rem 1rem 1rem 1rem;
            background-color: #ffffff;
        }

        .image {
            display: flex;
            margin-left: auto;
            margin-right: auto;
            background-color: #fee2e2;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
        }

        .image svg {
            color: #dc2626;
            width: 1.5rem;
            height: 1.5rem;
        }

        .content {
            margin-top: 0.75rem;
            text-align: center;
        }

        .title {
            color: #111827;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.5rem;
        }

        .message {
            margin-top: 0.5rem;
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .actions {
            margin: 0.75rem 1rem;
            background-color: #f9fafb;
        }

        .deactivate {
            display: inline-flex;
            padding: 0.5rem 1rem;
            background-color: #dc2626;
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.5rem;
            font-weight: 500;
            justify-content: center;
            width: 100%;
            border-radius: 0.375rem;
            border-width: 1px;
            border-color: transparent;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .cancel {
            display: inline-flex;
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background-color: #ffffff;
            color: #374151;
            font-size: 1rem;
            line-height: 1.5rem;
            font-weight: 500;
            justify-content: center;
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
    </style>

    <!-- Main Content -->
    <div class="container mx-auto px-8 py-8">
        <!-- Edit Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>
            <form id="updateProfileForm">
                @csrf
                <!-- Form Inputs -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" name="location" value="{{ $user->location }}" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <!-- Submit Button -->
                <div>
                    <button id="btnSubmit" type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Save Changes</button>
                    <!-- Button for deleting the account -->
                    <button id="btnDeleteAccount" type="button" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600">Delete Account</button>
                </div>
            </form>
            <!-- Toast div for notifications -->
            <div id="toast" class="fixed bottom-0 right-0 m-8 p-4 bg-gray-900 text-white rounded shadow-lg hidden"></div>
        </div>

        <!-- Delete Account Modal -->
        @include('components.extracomponents.deactivateaccount')
        <!-- End Delete Account Modal -->

    </div>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#updateProfileForm').submit(function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var name = $('#name').val();
                var location = $('#location').val();
                $.ajax({
                    type: 'POST',
                    url: '/profile/update/{{ $user->id }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email,
                        'name': name,
                        'location': location
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update profile information displayed on the page
                            $("#name").text(name);
                            $("#email").text(email);
                            $("#location").text(location);
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

            // Handle Delete Account button click
            $('#btnDeleteAccount').click(function() {
                $('#deleteAccountModal').addClass('active');
            });

            // Handle Cancel button in the modal
            $('#cancelDeleteBtn').click(function() {
                closeModal();
            });

            // Function to close modal
            function closeModal() {
                $('#deleteAccountModal').removeClass('active');
            }
        });

        function deleteAccount() {
            $.ajax({
                type: 'POST',
                url: '/account/delete',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': '{{ $user->id }}'
                },
                success: function(response) {
                    if (response.success) {
                        showToast(response.message, 'green');
                        // Redirect to a confirmation page or login page
                        setTimeout(() => {
                            window.location.href = '/Login';
                        }, 3000); // Give a little delay for the toast message to be visible
                    } else {
                        showToast(response.message, 'red');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    showToast('Failed to delete account. Please try again later.', 'red');
                }
            });
        }

        function showToast(message, color) {
            var toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.backgroundColor = color;
            toast.classList.remove('hidden');
            setTimeout(function() {
                toast.classList.add('hidden');
            }, 3000);
        }
    </script>
@endsection
