
@extends("layouts.app")

@section("title","Category Products")

@section("content")
    <div class="container">
        @if($products->count())
            <div class="d-flex justify-content-between mb-4">
                <h3>Search result for <strong><i>"{{ $search }}"</i></strong></h3>
                <form method="get" action="{{route('search')}}" class="d-flex">
                    <input type="hidden" name="search" value="{{$search}}" />
                    <select class="form-select rounded-0" name="sort" required>
                        <option selected>Sort By</option>
                        <option value="name_asc" {{$sort == "name_asc" ? "selected" : ""}}>Name - Ascending</option>
                        <option value="name_desc" {{$sort == "name_desc" ? "selected" : ""}}>Name - Descending</option>
                        <option value="price_asc" {{$sort == "price_asc" ? "selected" : ""}}>Price - Ascending</option>
                        <option value="price_desc" {{$sort == "price_desc" ? "selected" : ""}}>Price - Descending</option>
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
                    <div class="text-center text-muted mt-4">There are no products for your search <strong><i>"{{ $search }}"</i></strong></div>
                </div>
            @endif
        </div>
    </div>
@endsection
