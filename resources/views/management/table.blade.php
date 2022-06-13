@extends("layouts.app") @section('content')

<div class="container">
    <div class="row justify-content-center">
       @include('management.inc.sidebar')
        <div class="col-md-8">
            <i class="fa-solid fa-chair"></i> Table
            <a class="btn btn-success btn-sm float-right" href="table/create"><i class="fas fa-plus"></i> Create Table</a>
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
                        <th scope="col">Table</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
           
        </div>       
@endsection
