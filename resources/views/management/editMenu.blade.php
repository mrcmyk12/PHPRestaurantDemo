@extends("layouts.app") @section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('management.inc.sidebar')
        <div class="col-md-8">
            <i class="fa-solid fa-burger"></i> Edit Menu
            <hr />
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="/management/menu/{{$menu->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="menuName"> Menu Name </label>
                    <input
                        type="text"
                        name="name"
                        value="{{$menu->name}}"
                        class="form-control mb-3"
                        style="margin-top: 15px"
                    />
                    <label for="menuPrice">Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input
                            type="text"
                            name="price"
                            value="{{$menu->price}}"
                            class="form-control"
                            aria-label="Amount (to nearest dollar)"
                        />
                    </div>
                    <label for="MenuImage">Image</label>
                    <div class="input-group mb-3">
                        <input
                            type="file"
                            name="image"
                            id="inputGroupFile01"
                            class="form-control"
                        />
                        <label for="inputGroupFile01" class="input-group-text"
                            >Choose File</label
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="Description">Description</label>
                        <input
                            type="text"
                            name="description"
                            class="form-control"
                            value="{{$menu->description}}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" id="" class="form-select">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" 
                               {{$menu->category_id === $category->id ? 'selected' : " "}} >
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-warning" style="margin-top: 15px">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
