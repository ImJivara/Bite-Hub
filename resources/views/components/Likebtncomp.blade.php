<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern like Icon</title>
    <script src="{{asset('js\ErrorHandle.js')}}"></script>
    <style>
        .like-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s ease;
        }

        .like-icon {
            width: 24px;
            height: 24px;
            fill: none;
            transition: fill 0.3s ease;
        }

        .like-btn.liked .like-icon {
            fill: red; /* Change fill color when liked */
        }

        .like-btn:hover {
            transform: scale(1.3); /* Scale up on hover */
        }

        @keyframes likeAnimation {
            0% { transform: scale(1); }
            50% { transform: scale(1.5); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
@props(['recipeId'])
<button class="like-btn" onclick="toggleLike(this,'{{ $recipeId }}')">
        <svg class="like-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
</button>
<script>
    function toggleLike(button, recipeId) 
    {
        
        var likeButton = $('#' + recipeId);
        var isLiked = button.classList.contains('liked');
        if (!button.classList.contains('liked'))
             {
                //la taaml l pop-up animation
                button.querySelector('.like-icon').style.animation = 'likeAnimation 0.5s ease';
                setTimeout(() => {
                    button.querySelector('.like-icon').style.animation = '';
                }, 500);
            }
        
        if (isLiked) {
            decrementLikes(recipeId);
        } else {
            incrementLikes(recipeId);
        }
        function incrementLikes(recipeId) {
            button.classList.toggle('liked');

            $.ajax({
                type: 'get',
                url: '/Like/' + recipeId,
                success: function(data) {
                    $('#txt_' + recipeId).html(data.NbLikes);
                },
                error: function() {
                    showError("An error occurred. Please try again later.");
                }
            });
        }

        function decrementLikes(recipeId) {
            button.classList.toggle('liked');
           
            $.ajax({
                type: 'get',
                url: '/Dislike/' + recipeId,
                success: function(data) {
                    $('#txt_' + recipeId).html(data.NbLikes);
                },
                error: function() {
                    showError("An error occurred. Please try again later.");
                }
            });
        }
    }

</script>   
</body>
</html>
