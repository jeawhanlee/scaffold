
@extends("layouts.app")

@section("title","Sub Categories")

@section("content")
    <div class="container">
        <h3>Sub Categories from {{$parent_cat}}</h3>
        
        <div class="row">
            @if($sub_cats->count())
                @foreach($sub_cats as $sub_cat)
                    <div class="col-md-3">
                        <div class="card mb-2" style="width: 19rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$sub_cat->name}}</h5>
                                <a href="{{route('category',$sub_cat->id)}}" class="card-link">View Products</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="text-center text-muted">No sub categories found.</div>
                </div>
            @endif
        </div>
    </div>
@endsection
