
@extends("layouts.app")

@section("title","Category Products")

@section("content")
    <div class="container">
        @if($products->count())
            <div class="d-flex justify-content-between mb-4">
                <h3>Products</h3>
                <form method="get" action="{{route('categories')}}{{$sort_action}}" class="d-flex">
                    <select class="form-select rounded-0" name="sort">
                        <option selected>Sort By</option>
                        <option value="name_asc">Name - Ascending</option>
                        <option value="name_desc">Name - Descending</option>
                        <option value="price_asc">Price - Ascending</option>
                        <option value="price_desc">Price - Descending</option>
                    </select>

                    <button type="submit" class="btn btn-primary rounded-0">Sort</button>
                </form>
            </div>
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
                    <div class="text-center text-muted mt-4">There are no products for this category at the moment</div>
                </div>
            @endif
        </div>
    </div>
@endsection
