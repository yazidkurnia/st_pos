@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Items
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Data Items</h5>
                    <div class="card-body">
                        @include('components.templates.message')
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-2">
                                <a href="{{ route('items.create') }}" class="btn rounded btn-primary">
                                    <i class="bx bx-add-to-queue"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Modal</th>
                                        <th>Satuan</th>
                                        <th>Vendor</th>
                                        <th>Kategori</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $no++ }}.</td>
                                            <td>{{ $item->barcode }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->harga_jual }}</td>
                                            <td>{{ $item->harga_modal }}</td>
                                            <td><span class="badge rounded-pill bg-info">{{ $item->satuan }}</span></td>
                                            <td><span class="badge rounded-pill bg-warning">{{ $item->vendor }}</span></td>
                                            <td><span class="badge rounded-pill bg-danger">{{ $item->kategori }}</span></td>
                                            <td>
                                                <button type="button" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class='tf-icons bx bx-edit'></i>
                                                </button>
                                                <button type="button" class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delModal{{ $item->id }}">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal hapus --}}
    @foreach ($items as $item)
        <div class="modal fade" id="delModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Hapus Data Items</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('items.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input name="id" type="hidden" value="{{ $item->id }}">
                            <p>Apakah kamu yakin akan menghapus data item <b>{{ $item->nama }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" name="save" class="btn btn-danger">Yakin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal hapus --}}
@endsection