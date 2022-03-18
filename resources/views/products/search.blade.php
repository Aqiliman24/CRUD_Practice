
@extends('layouts.app')
  
@section('content')
    <div class="row">
        <div class="container">
            @if(isset($Product))
                <p> The Search results for your query <b> {{ $query }} </b> are :</p>
            <h2>Sample Products</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Product as $Product)
                    <tr>
                        <td>{{$Product->name}}</td>
                        <td>{{$Product->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection