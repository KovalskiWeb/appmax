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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter ajax_off">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th style="width: 15%;">SKU</th>
                                <th style="width: 15%;">Título</th>
                                <th style="width: 15%;">Preço</th>
                                <th style="width: 15%;">Quantidade</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 15%;">Criado via</th>
                                <th class="text-center" style="width: 100px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr id="{{ $product->id }}">
                                    <td class="text-center">
                                        <img class="img-avatar img-avatar48"
                                            src="{{ asset('media/avatars/avatar2.jpg') }}" alt="">
                                    </td>
                                    <td class="font-w600 font-size-sm">
                                        <a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->title }}</a>
                                    </td>
                                    <td class="font-size-sm">{{ $product->price }}</td>
                                    <td class="font-size-sm">20</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $product->added_via == 'system' ? 'success' : 'warning' }}">{{ $product->added_via == 'system' ? 'Sistema' : 'API' }}</span>
                                    </td>
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
                    {{ $products->links() }}
                </div>
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
                            uuid: id,
                            "_method": "DELETE",
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deletado com sucesso!',
                                    icon: 'success',
                                    confirmButtonColor: '#5c80d1',
                                    confirmButtonText: 'Ok',
                                });
                                $("#" + id + "").remove();
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
