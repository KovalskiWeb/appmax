@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Produtos
                </h1>

                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                @if (count($products) > 0)

                <form class="d-inline-block float-right mb-5 ajax_off" action="{{ route('admin.products.search') }}" method="POST">
                    @csrf

                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Procurar.." id="page-header-search-input2" name="filter" value="{{ $filters['filter'] ?? '' }}">
                        <div class="input-group-append">
                            <button type="submit" class="border-0 p-0">
                                <span class="input-group-text bg-body border-0">
                                    <i class="si si-magnifier"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

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
                                <th class="text-center" style="width: 100px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr id="{{ $product->id }}">
                                    <td class="text-center">
                                        @if (!empty($product->image()->first()->path))
                                            <img src="{{ url("storage/{$product->image()->first()->path}") }}" alt="{{ $product->title }}" height="100">
                                        @else
                                            <img src="{{ asset('media/various/img-off.png') }}" alt="{{ $product->title }}" height="100">
                                        @endif
                                    </td>
                                    <td class="text-center font-size-sm">{{ $product->sku }}</td>
                                    <td class="text-center font-w600 font-size-sm">
                                        <a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->title }}</a>
                                    </td>
                                    <td class="text-center font-size-sm">R$ {{ $product->price }}</td>
                                    <td class="text-center font-size-sm">{{ $product->stock }}</td>
                                    <td class="text-center font-size-sm"><span class="badge badge-{{ $product->active == 'Ativo' ? 'success' : 'danger' }}">{{ $product->active }}</span></td>
                                    <td class="text-center">{{ $product->added_via }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.products.edit', $product->id) }}">
                                                <button type="button" class="btn btn-sm btn-secondary m-1" title="Editar">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                            </a>
                                            {{-- <form action="{{ route('admin.users.destroy', $user->uuid) }}" method="POST" class="ajax_off">
                                                @csrf
                                                @method('DELETE') --}}
                                            <button type="submit" class="btn btn-sm btn-danger m-1 button-delete"
                                                title="Excluir" data-id="{{ $product->id }}"
                                                data-route="{{ route('admin.products.destroy', $product->id) }}">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                            {{-- </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        @if (isset($filters))
                            {!! $products->appends($filters)->links() !!}
                        @else
                            {!! $products->links() !!}
                        @endif
                    </div>
                </div>
                @else
                    <div class="alert alert-info py-2 mb-0 text-center">Produto não cadastrado!</div>
                @endif
            </div>
        </div>
        <!-- END Basic -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script>
        $(document).on('click', '.button-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var routeUrl = $(this).data('route');

            Swal.fire({
                title: 'Deseja deletar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5c80d1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Quero!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: routeUrl,
                        data: {
                            id: id,
                            "_method": "DELETE",
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                window.location.href = data.redirect;
                            }
                        },
                        error: function(data) {
                            console.log('Error!');
                        }
                    });
                }
            });
        });
    </script>
@endsection
