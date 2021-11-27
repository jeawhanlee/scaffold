
@extends("layouts.app")

@section("content")
    <div class="container">
        <h3>This is the categories page</h3>
        
        @if($categories->count())
            @foreach($categories as $cat)
                <div>{{$cat->name}}</div>
            @endforeach
        @else
            <div class="text-center text-muted">No Categories at the moment</div>
        @endif
    </div>
@endsection
