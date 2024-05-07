@extends('test3tem')

@section('content_body')
<div class="flex gap-8">
    <div class=" flex-1 flex flex-col justify-between p-8 bg-gray-200 rounded-lg">
        <div class="flex-grow p-8">
            <h1 class="text-5xl font-bold">{{ $rec->RecipeName}}'s Steps</h1>
            <ol class="list-decimal mt-4">
                @foreach($steps as $step)
                    <li class="text-xl ">{{ $step }}</li>
                @endforeach
            </ol>
            <a href="/Recipes" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Go to Recipes</a>
        </div>
    </div>

    <div class="flex-1 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
    <img class="w-full h-auto object-cover" src="{{ asset('imgs/'.$rec->id.'.jpg') }}" alt="Card image">
    </div>
</div>
@endsection


@section('content_head')

<script>
        function updateLike(id) 
        {
            $("#Like_"+id).click(function()
             {    
                $(this).attr('disabled', 'disabled');
                $.ajax
                ({  type: 'get',
                    url: '/like/'+id,                   
                    data:{
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                    success: function(output) 
                    { alert("khlst");
                          //$(this).removeAttr('disabled');
                          $("#Like_" + id).removeAttr('disabled');
                          $("#Number_Of_Likes_" + id).html(output.NbLikes);
                        
                    }
                });
            });
        }
    </script>
@endsection
