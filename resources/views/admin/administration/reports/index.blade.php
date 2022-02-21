@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Relatório Diário de <span class="badge badge-pill badge-info">{{ $currentDate }}</span>
                </h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3">
                            <i class="fa fa-box-open fa-2x"></i>
                        </div>
                        <span class="badge badge-secondary">{{ $productCreatedAt->count() }}</span>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Produtos Cadastrados</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="200"
                data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3 text-danger">
                            <i class="fa fa-box-open fa-2x"></i>
                        </div>
                        <span class="badge badge-secondary">{{ $productDeletedAt->count() }}</span>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Produtos Deletados</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="200"
                data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3">
                            <i class="fa fa-box-open fa-2x"></i>
                        </div>
                        <span class="badge badge-secondary">{{ $productCreateInSystem->count() }}</span>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Produtos Cadastro via Sistema</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="200"
                data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3">
                            <i class="fa fa-box-open fa-2x"></i>
                        </div>
                        <span class="badge badge-secondary">{{ $productCreateInApi->count() }}</span>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Produtos Cadastro via API</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- Page Content -->
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Produtos com estoque abaixo de 100 unid.</h3>
            </div>
            <div class="block-content block-content-full">
                @if (count($productLowStock) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter ajax_off">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th class="text-center" style="width: 15%;">SKU</th>
                                    <th class="text-center" style="width: 15%;">Título</th>
                                    <th class="text-center" style="width: 15%;">Preço</th>
                                    <th class="text-center" style="width: 15%;">Quantidade</th>
                                    <th class="text-center" style="width: 15%;">Status</th>
                                    <th class="text-center" style="width: 15%;">Criado via</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productLowStock as $productStock)
                                    <tr id="{{ $productStock->id }}">
                                        <td class="text-center">
                                            @if (!empty($productStock->image()->first()->path))
                                                <img src="{{ url("storage/{$productStock->image()->first()->path}") }}"
                                                    alt="{{ $productStock->title }}" height="100">
                                            @else
                                                <img src="{{ asset('media/various/img-off.png') }}"
                                                    alt="{{ $productStock->title }}" height="100">
                                            @endif
                                        </td>
                                        <td class="text-center font-size-sm">{{ $productStock->sku }}</td>
                                        <td class="text-center font-w600 font-size-sm">
                                            <a
                                                href="javascript:void(0)">{{ $productStock->title }}</a>
                                        </td>
                                        <td class="text-center font-size-sm">R$ {{ $productStock->price }}</td>
                                        <td class="text-center font-size-sm">{{ $productStock->stock }}</td>
                                        <td class="text-center font-size-sm"><span
                                                class="badge badge-{{ $productStock->active == 'Ativo' ? 'success' : 'danger' }}">{{ $productStock->active }}</span>
                                        </td>
                                        <td class="text-center">{{ $productStock->added_via }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Produtos Adicionados</h3>
            </div>
            <div class="block-content block-content-full">
                @if (count($productCreatedAt) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter ajax_off">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th class="text-center" style="width: 15%;">SKU</th>
                                    <th class="text-center" style="width: 15%;">Título</th>
                                    <th class="text-center" style="width: 15%;">Preço</th>
                                    <th class="text-center" style="width: 15%;">Quantidade</th>
                                    <th class="text-center" style="width: 15%;">Status</th>
                                    <th class="text-center" style="width: 15%;">Criado via</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productCreatedAt as $productCreate)
                                    <tr id="{{ $productCreate->id }}">
                                        <td class="text-center">
                                            @if (!empty($productCreate->image()->first()->path))
                                                <img src="{{ url("storage/{$productCreate->image()->first()->path}") }}"
                                                    alt="{{ $productCreate->title }}" height="100">
                                            @else
                                                <img src="{{ asset('media/various/img-off.png') }}"
                                                    alt="{{ $productCreate->title }}" height="100">
                                            @endif
                                        </td>
                                        <td class="text-center font-size-sm">{{ $productCreate->sku }}</td>
                                        <td class="text-center font-w600 font-size-sm">
                                            <a
                                                href="javascript:void(0)">{{ $productCreate->title }}</a>
                                        </td>
                                        <td class="text-center font-size-sm">R$ {{ $productCreate->price }}</td>
                                        <td class="text-center font-size-sm">{{ $productCreate->stock }}</td>
                                        <td class="text-center font-size-sm"><span
                                                class="badge badge-{{ $productCreate->active == 'Ativo' ? 'success' : 'danger' }}">{{ $productCreate->active }}</span>
                                        </td>
                                        <td class="text-center">{{ $productCreate->added_via }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Produtos Removidos</h3>
            </div>
            <div class="block-content block-content-full">
                @if (count($productDeletedAt) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter ajax_off">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th class="text-center" style="width: 15%;">SKU</th>
                                    <th class="text-center" style="width: 15%;">Título</th>
                                    <th class="text-center" style="width: 15%;">Preço</th>
                                    <th class="text-center" style="width: 15%;">Quantidade</th>
                                    <th class="text-center" style="width: 15%;">Status</th>
                                    <th class="text-center" style="width: 15%;">Criado via</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productDeletedAt as $productDeleted)
                                    <tr id="{{ $productDeleted->id }}">
                                        <td class="text-center">
                                            @if (!empty($productDeleted->image()->first()->path))
                                                <img src="{{ url("storage/{$productDeleted->image()->first()->path}") }}"
                                                    alt="{{ $productDeleted->title }}" height="100">
                                            @else
                                                <img src="{{ asset('media/various/img-off.png') }}"
                                                    alt="{{ $productDeleted->title }}" height="100">
                                            @endif
                                        </td>
                                        <td class="text-center font-size-sm">{{ $productDeleted->sku }}</td>
                                        <td class="text-center font-w600 font-size-sm">
                                            <a
                                                href="javascript:void(0)">{{ $productDeleted->title }}</a>
                                        </td>
                                        <td class="text-center font-size-sm">R$ {{ $productDeleted->price }}</td>
                                        <td class="text-center font-size-sm">{{ $productDeleted->stock }}</td>
                                        <td class="text-center font-size-sm"><span
                                                class="badge badge-{{ $productDeleted->active == 'Ativo' ? 'success' : 'danger' }}">{{ $productDeleted->active }}</span>
                                        </td>
                                        <td class="text-center">{{ $productDeleted->added_via }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js_after')
@endsection
