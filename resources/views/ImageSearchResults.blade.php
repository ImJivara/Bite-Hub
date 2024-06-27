@extends('ImageSearchForm')

@section('content_body')
<div class="container mx-auto p-6">
        <form id="image-form" class="space-y-4" action="{{route('save.image')}}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($images as $image)
                    <div class="grid-item bg-white rounded-md overflow-hidden relative">
                        <img src="{{ $image['thumbnail'] }}" alt="{{ $image['title'] }}" class="w-full h-auto object-cover object-center">
                        <div class="absolute top-2 right-2">
                            <input type="radio" name="selected_image" value="{{ $image['original'] }}" class="form-radio h-5 w-5 text-blue-600">
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        <div class="mt-4">
        {{ $images->links() }}
    </div>
</div>

    <script>
        function confirmDownload() {
            const selectedImage = document.querySelector('input[name="selected_image"]:checked');
            if (selectedImage) {
                const imageUrl = selectedImage.value;
                const confirmation = confirm('Are you sure you want to download this image?');
                if (confirmation) {
                    downloadImage(imageUrl);
                }
            } else {
                alert('Please select an image first.');
            }
        }

        function downloadImage(imageUrl) {
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = true;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endsection
