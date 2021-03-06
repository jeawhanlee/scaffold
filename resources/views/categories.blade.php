
@extends("layouts.app")

@section("title","Categories")

@section("content")
    <div class="container">
        <h3>Product Categories</h3>
        
        <div class="row">
            @if($categories->count())
                @foreach($categories as $cat)
                    <div class="col-md-3">
                        <div class="card mb-2" style="width: 19rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$cat->name}}</h5>
                                <a href="{{route('category',$cat->id)}}" class="card-link">View Products</a>
                                <a href="{{route('subcat',$cat->id)}}" class="card-link">Sub Categories</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="text-center text-muted">No Categories at the moment</div>
                </div>
            @endif
        </div>
    </div>
@endsection
