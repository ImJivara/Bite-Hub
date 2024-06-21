@extends('Profile Folder.ProfileLayout')
@section('content')
<head>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
</head>
<script>
    $(document).ready(function() {
        $('#changePasswordForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#form-messages').html('<div class="alert alert-success text-green-500">' + response.success + '</div>');
                    $('#changePasswordForm')[0].reset(); // Reset form fields
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;

                    var errorHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function(key, value) {
                        errorHtml += '<p>' + value + '</p>';
                    });

                    errorHtml += '</ul></div>';

                    $('#form-messages').html(errorHtml);
                }
            });
        });
    });
</script>
<body class="bg-gray-300">
    <div class="container  px-4 py-8">
        <div class="max-w-xlg max-h-xlg  bg-white rounded-md shadow-md overflow-hidden">
            <div class="bg-gray-200 px-4 py-2 mb-6">
                <h2 class="text-xl font-bold text-center">Change Password</h2>
            </div>
            <div class="p-6">
                <div id="form-messages" class="text-red-500 p-0 m-0 ">
                    <!-- AJAX response messages will be displayed here -->
                    
                </div>
                <form id="changePasswordForm" method="POST" action="{{ route('password.change') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input id="current_password" type="password" class="form-input mt-1 block w-full" name="current_password" required>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input id="new_password" type="password" class="form-control block w-full" name="new_password" required>
                    </div>
                    <div class="mb-6 form-group">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input id="confirm_password" type="password" class="form-control block w-full" name="confirm_password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


@endsection
