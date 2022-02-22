@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Edição de Produto
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                        <li class="breadcrumb-item">
                            Edição de Produto
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('admin.products.update', $product->id) }}" data-type="PUT" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <div class="push">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                @if (!empty($product->image()->first()->path))
                                    <br>
                                    <img id="img-product" src="{{ url("storage/{$product->image()->first()->path}") }}" alt="{{ $product->title }}" height="100">
                                @else
                                    <img id="img-product" src="{{ asset('media/various/img-off.png') }}" alt="{{ $product->title }}" height="100">
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Título" value="{{ $product->title ?? old('title') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sku">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="{{ $product->sku ?? old('sku') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Preço</label>
                                <input type="text" class="form-control mask-money" id="price" name="price" placeholder="Preço" value="{{ $product->price ?? old('price') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stock">Estoque</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Estoque" value="{{ $product->stock ?? old('stock') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="active">Status?</label>
                                <select name="active" id="active" class="form-control">
                                    <option {{ $product->active == 'Ativo' ? 'selected' : '' }} value="1">Ativo</option>
                                    <option {{ $product->active == 'Inativo' ? 'selected' : '' }} value="0">Inativo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="image">Imagem</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" cols="25" rows="5" placeholder="Descrição" class="form-control">{{ $product->description ?? old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 text-right p-0">
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('backend/assets/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>
        $(".mask-money").mask('R$ 000.000.000.000.000,00', {reverse: true, placeholder: "R$ 0,00"});
    </script>
@endsection
