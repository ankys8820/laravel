<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Product Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    </head>
    <body>
        <div class="bg-dark py-3">
            <h3 class="text-white text-center">Product List</h3>
        </div>
        <div class="container">
            <a href="{{ route('product.create') }}" class="btn btn-dark mt-2">Create</a>
            <div class="row d-flex justify-content-center">
            @if(Session::has('success'))
            
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">

                    {{Session::get('success')}}
                </div>
            </div>
            @endif
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-3">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Created Product</h3>
                        </div>
                   <div class="card-body">
                    <table class="table">
                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Create at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if($products->isNotEmpty())
                        @foreach($products as $product)
                        <tbody>
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    @if($product->image != "")
                                        <img width="50" src="{{asset('uploads/products/'.$product->image)  }}" alt="">

                                    @endif
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->sku}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('product.edit',$product->id)}}" class="btn btn-dark">Edit</a>
                                    <a href="#" onClick="deleteProduct({{$product->id}});"  class="btn btn-danger">Delete</a>
                                    <form id="delete-product-from-{{$product->id}}" action="{{route('product.delete',$product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                       
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                            @endif
                    </table>
                   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure want to delete the product ?")){
            document.getElementById("delete-product-from-"+id).submit();
        }
    }
</script>