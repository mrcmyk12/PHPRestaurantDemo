@extends("layouts.app") @section('content')

<div class="container">
    <div class="row justify-content-center">
       @include('management.inc.sidebar')
        <div class="col-md-8">
            <i class="fa-solid fa-bars"></i> Category
            <a class="btn btn-success btn-sm float-right" href="category/create"><i class="fas fa-plus"></i> Create Category</a>
            <hr>
            @if(Session()->has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button aria-label="Close" type="button" data-bs-dismiss="alert" class="btn-close"></button>
                    {{Session()->get('status')}}
                </div>
            @endif
            <table class="table-bordered table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th>{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                <a class="btn btn-warning" href="/management/category/{{$category->id}}/edit">Edit</a>
                            </td>
                            <td>
                                <form action="/management/category/{{$category->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>       
@endsection
