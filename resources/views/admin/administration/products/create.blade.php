@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Cadastro de Produto
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                        <li class="breadcrumb-item">
                            Cadastro de Produto
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
                <form action="{{ route('admin.products.store') }}" data-type="POST" method="POST" enctype="multipart/form-data">

                    <div class="push">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Título" value="{{ old('title') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sku">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="{{ old('sku') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Preço</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Preço" value="{{ old('price') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stock">Estoque</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Estoque mínimo" value="{{ old('stock') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="active">Status?</label>
                                <select name="active" id="active" class="form-control">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="image">Imagem</label>
                                <input type="file" name="image[]" id="image" class="form-control" multiple>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" cols="25" rows="5" placeholder="Descrição" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 text-right p-0">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
@endsection
