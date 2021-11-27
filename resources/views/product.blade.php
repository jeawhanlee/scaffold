
@extends("layouts.app")

@section("title","$product->name")

@section("content")
    <div class="container">
        <h3>Products</h3>
        
        <div class="row">
            @if($product->count())
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h5 class="card-title">&#163;{{number_format($product->price, 2)}}</h5>
                        <p class="card-text mt-3">
                            @if($product->description)
                                {{$product->description}}
                            @else
                                <span class="text-muted">No description available for this product</span>
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="text-center text-muted mt-4">This product does not exist</div>
                </div>
            @endif
        </div>
    </div>
@endsection
