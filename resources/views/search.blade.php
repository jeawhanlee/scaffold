
@extends("layouts.app")

@section("title","Category Products")

@section("content")
    <div class="container">
        @if($products->count())
            <h3>Search result for <strong><i>"{{ $search }}"</i></strong></h3>
        @endif
        
        <div class="row">
            @if($products->count())
                @foreach($products as $prod)
                    <div class="col-md-3">
                        <div class="card mb-2" style="width: 19rem;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{$prod->name}}</h5>
                                <h5 class="card-title">&#163;{{number_format($prod->price, 2)}}</h5>
                                <a href="{{route('product',$prod->id)}}" class="card-link">Product Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-5 px-2">
                    {{ $products->links() }}
                </div>
            @else
                <div class="col-md-12">
                    <div class="text-center text-muted mt-4">There are no products for your search <strong><i>"{{ $search }}"</i></strong></div>
                </div>
            @endif
        </div>
    </div>
@endsection
