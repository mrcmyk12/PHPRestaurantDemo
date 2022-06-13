@extends("layouts.app") @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="list-group">
                <a
                    href="/management/category"
                    class="list-group-item list-group-item-action"
                    ><i class="fa-solid fa-bars"></i> Category</a
                >
                <a href="" class="list-group-item list-group-item-action"
                    ><i class="fa-solid fa-burger"></i> Menu</a
                >
                <a href="" class="list-group-item list-group-item-action"
                    ><i class="fa-solid fa-chair"></i> Table</a
                >
                <a href="" class="list-group-item list-group-item-action"
                    ><i class="fa-solid fa-users-line"></i> User</a
                >
            </div>
        </div>
        <div class="col-md-8">
            <i class="fa-solid fa-bars"></i> Edit A Category
            <hr />
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form action="/management/category/{{$category->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="categoryName"> Category Name </label>
                    <input
                        type="text"
                        name="name"
                        value="{{$category->name}}"
                        placeholder="Category..."
                        class="form-control"
                        style="margin-top: 15px;"
                    />
                    <button class="btn btn-primary" style="margin-top: 15px;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
