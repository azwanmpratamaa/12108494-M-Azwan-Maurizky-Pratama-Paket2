@extends('layouts._main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 style="color: #3F51B5">Product Data</h2>
                        @if (Auth::user()->role == 'petugas')
                            <form action="{{ route('produk-petugas') }}" method="GET">
                                <input type="text" name="search" placeholder="Search Products">
                                <button type="submit">Search</button>
                            </form>
                        @endif
                        {{-- <a href="{{ route('search.pdf', ['id'=>$value->id])}}" class="btn btn-success">ExportPdf</a> --}}
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            {{-- <button class="btn btn-sm btn-danger" style="float: right">export PDF</button> --}}
                        </form>
                        @if (Auth::user()->role == 'admin')
                            <a href="" class="btn btn-success mb-4" data-bs-toggle="modal"
                                data-bs-target="#modalCreate">Add Product</a>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th scope="col" style="text-align: center"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->stock }}</td>
                                        <td>{{ format_rupiah($value->price) }}</td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <button class="btn btn-success mx-4" data-bs-toggle="modal"
                                                        data-bs-target="#modalStock-{{ $value->id }}">
                                                        <i class='bx bx-plus'></i>Add Stock
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-{{ $value->id }}">
                                                        <i class='bx bxs-pencil'></i>
                                                    </button>
                                                    <form action="{{ route('deleteProduct', ['id' => $value->id]) }}"
                                                        class="px-4" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class='bx bx-trash'></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                   <!-- Modal Edit-->
                                   <div class="modal fade" id="modalEdit-{{ $value->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="margin-top: -20px;">
                                                <form action="{{ route('updateProduct', ['id' => $value->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <d  iv class="row g-3">
                                                            <div class="col">
                                                                <label class="col-md-12">Product Name<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="name" aria-label="Name Product"
                                                                    value="{{ $value->name }}">
                                                            </div>
                                                            <div class="col">
                                                                <label class="col-md-12">Product Stock<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" class="form-control"
                                                                    name="stock" value="{{ $value->stock }}"
                                                                    aria-label="stock" disabled>
                                                            </div>
                                                        </div><br>
                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <label class="col-md-12">Product Price<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text"  class="form-control"
                                                                    name="price" id="" value="{{ $value->price }}"
                                                                    aria-label="price">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"
                                                        style="margin-bottom: -20px; margin-top:20px;">
                                                        <button type="submit" class="btn btn-primary">Save

                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                     <!-- Modal Stock-->
                                     <div class="modal fade" id="modalStock-{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="margin-top: -20px;">
                                                    <form action="{{ route('updateStock', ['id' => $value->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12">Name Product <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" aria-label="Name Product"
                                                                        value="{{ $value->name }}" disabled>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="col-md-12">Stock<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" aria-label="stock">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="margin-bottom: -30px; margin-top:20px;">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                                    <!-- Modal Create-->
                                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="margin-top: -20px;">
                                                <form action="{{ route('createProduct') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="name"
                                                                    placeholder="Name Product" aria-label="Name Product">
                                                            </div>
                                                            <div class="col">
                                                                <input type="number" class="form-control" name="stock"
                                                                    placeholder="stock" aria-label="stock">
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col">
                                                                <input type="text" class="form-control" id="rupiah2" name="price"
                                                                    placeholder="price" aria-label="price">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php

    function format_rupiah($angka)
    {
        $jadi = 'Rp ' . number_format($angka, 2, ',', '.');
        return $jadi;
    }
    ?>
@endsection
