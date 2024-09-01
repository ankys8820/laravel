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
            <h3 class="text-white text-center">Product Updation</h3>
        </div>
        <div class="container">
        <a href="{{ route('product.index') }}" class="btn btn-dark mt-2">Home</a>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-3">
                        <div class="card-header bg-success">
                            <h3 class="text-white ">Edit</h3>
                        </div>
                        <div class="card-body">
                          <form enctype="multipart/form-data" action="{{ route('product.update',$product->id) }}" method="post">
                            @method('put')
                              @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Name</label>
                                    <input type="text" value="{{ old('name',$product->name)  }}" class=" @error('name') @enderror is-invalid form-control form-control-lg" placeholder="Name" name="name" />
                              @error('name')

                                 <p class="invalid-feedback">{{ $message }}</p>
                              @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Sku</label>
                                    <input type="text" value="{{ old('sku',$product->sku)  }}" class="@error('sku') @enderror is-invalid form-control form-control-lg" placeholder="Sku" name="sku" />
                                    @error('sku')

                                            <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Price</label>
                                    <input type="text" value="{{ old('price',$product->price)  }}" class="form-control  @error('price') @enderror is-invalid  form-control-lg" placeholder="Price" name="price" />
                                    @error('price')

<p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Image</label>
                                    <input {{old('description',$product->description)}} type="file" class="form-control form-control-lg" placeholder="Image" name="image" />
                                    @if($product->image != "")
                                        <img  class="w-50 my-3"  src="{{asset('uploads/products/'.$product->image)  }}" alt="">

                                    @endif
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-lg btn-dark">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
