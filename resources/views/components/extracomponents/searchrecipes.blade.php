<script src="https://cdn.polyfill.io/v3/polyfill.min.js?features=JSON"></script>
<!-- Search Form -->
<form action="{{ route('recipes.searchbar') }}" method="GET" class="flex items-center" id="search-recipes">
    <input type="text" name="query" placeholder="Search recipes..." id="search-input"
           class="p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
    <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-r-lg focus:outline-none focus:shadow-outline">Search
    </button>
</form>



<script>
        $(document).ready(function () {
            $('#search-input').on('input', function () {
                var query = $(this).val().trim();

                $.ajax({
                    type: 'GET',
                    url: "{{ route('recipes.searchbar') }}",
                    data: { query: query },
                    success: function (response) {
                        var rec=JSON.encode(response.recipe_cards)
                        $('#recipes-grid-2').html(rec); // Update recipes grid with fetched recipe cards
                    },
                    error: function () {
                        alert('Error fetching search results.');
                    }
                });
            });
        });
    </script>

