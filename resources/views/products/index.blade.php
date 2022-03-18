{{-- @extends('products.layout') --}}
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch</h2>
            </div>
            <div class="pull-right">
                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md mr-md-3 my2 my-md-0"
                 method="GET" action="{{route('products.index')}}">

                 <div class="input-group">
                     <input
                        class="form-control"
                        type="text" placeholder="Search Product..."
                        aria-label="Search" aria-describedby="basic-addon2"
                        name = "keyword"
                        value="{{request()->get('keyword')}}"
                     />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                 </div>
                </form>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            <div class="pull-right">
                @if(request()->status == 'deleted')

                <a href="{{ route('products.index') }}" class="btn btn-info btn-sm">View All Post</a>

                <a href="{{ route('products.restore-all') }}" class="btn btn-success btn-sm">Restore All</a>

                @else

                <a href="{{ route('products.index', ['status' => 'deleted']) }}" class="btn btn-success btn-sm">View Deleted Post</a>

                @endif
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Details</th>
            <th width="290px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->detail }}</td>
            <td>

                @if (!$product->deleted_at)
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @else
                    <form action="{{ route('products.restore',$product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
        
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                @endif

            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection