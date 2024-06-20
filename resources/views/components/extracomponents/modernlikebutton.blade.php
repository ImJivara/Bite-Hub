@props(['recipeId', 'IsLiked'])

<style>
    label.container {
        background-color: white;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 15px 10px 10px;
        cursor: pointer;
        user-select: none;
        border-radius: 10px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        color: black;
    }

    input {
        display: none;
    }

    input:checked + label svg {
        fill: hsl(0deg 100% 50%);
        stroke: hsl(0deg 100% 50%);
        animation: heartButton 1s;
    }

    @keyframes heartButton {
        0% {
            transform: scale(1);
        }
        25% {
            transform: scale(1.3);
        }
        50% {
            transform: scale(1);
        }
        75% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }

    input + label .action {
        position: relative;
        overflow: hidden;
        display: grid;
    }

    input + label .action span {
        grid-column-start: 1;
        grid-column-end: 1;
        grid-row-start: 1;
        grid-row-end: 1;
        transition: all 0.5s;
    }

    input + label .action span.option-1 {
        transform: translate(0px, 0%);
        opacity: 1;
    }

    input:checked + label .action span.option-1 {
        transform: translate(0px, -100%);
        opacity: 0;
    }

    input + label .action span.option-2 {
        transform: translate(0px, 100%);
        opacity: 0;
    }

    input:checked + label .action span.option-2 {
        transform: translate(0px, 0%);
        opacity: 1;
    }
</style>

<input type="checkbox" id="like-btn-{{ $recipeId }}" {{ $IsLiked ? 'checked' : '' }}>
<label for="like-btn-{{ $recipeId }}" class="container m-0 like-btn {{ $IsLiked ? 'liked' : '' }}"  onclick="toggleLike(this, {{ $recipeId }})">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
    </svg>
    <div class="action">
        <span class="option-1">Like the post</span>
        <span class="option-2">Added to likes</span>
    </div>
</label>

<script>
    function toggleLike(button, recipeId) {
        var isLiked = button.classList.contains('liked');
        
        // Toggle like state and apply animation
        button.style.animation = isLiked ? '' : 'heartButton 0.5s ease';
        setTimeout(() => {
            button.querySelector('.feather-heart').style.animation = '';
        }, 500);
        
        button.classList.toggle('liked');

        // AJAX request to like/unlike the recipe
        var url = isLiked ? '/Dislike/' : '/Like/';
        $.ajax({
            type: 'GET',
            url: url + recipeId,
            success: function(data) {
                $('#txt_' + recipeId).html(data.NbLikes);
                if (data.success == false) showError(data.error);
            },
            error: function() {
                showError("An error occurred. Please try again later.");
            }
        });
    }

    function showError(message) {
        var errorMessage = document.getElementById('error-message');
        errorMessage.textContent = message;
        errorMessage.classList.add('show');
        setTimeout(() => {
            errorMessage.classList.remove('show');
        }, 3000);
    }
</script>
