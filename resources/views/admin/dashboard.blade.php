@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
                {{-- <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                    </ol>
                </nav> --}}
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Categories-->
    <div class="content content-boxed overflow-hidden">
        <div class="row">
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3">
                            <i class="fa fa-box-open fa-2x"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Produtos</span>
                        <span class="badge badge-secondary">23</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="200" data-class="animated fadeInDown">
                <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full border-bottom text-center">
                        <div class="py-3">
                            <i class="fa fa-cogs fa-2x"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <span class="font-w600 text-uppercase font-size-sm">Configurações</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- END Categories -->
@endsection
