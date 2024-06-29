@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Categories
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Data Categories</h5>
                    <div class="card-body">
                        @include('components.templates.message')
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-2">
                                <button type="button" class="btn rounded btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="bx bx-add-to-queue"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width='5%'>No.</th>
                                        <th>Nama</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $no++ }}.</td>
                                            <td>{{ $category->nama }}</td>
                                            <td>
                                                <button type="button" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                                    <i class='tf-icons bx bx-edit'></i>
                                                </button>
                                                <button type="button" class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delModal{{ $category->id }}">
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

    {{-- modal tambah --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="Input Nama" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal tambah --}}

    {{-- modal edit --}}
    @foreach ($categories as $category)
        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Data Customers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control" value="{{ $category->nama }}" placeholder="Input Nama" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

    {{-- modal hapus --}}
    @foreach ($categories as $category)
        <div class="modal fade" id="delModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Hapus Data Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input name="id" type="hidden" value="{{ $category->id }}">
                            <p>Apakah kamu yakin akan menghapus data kategory <b>{{ $category->nama }}</b>?</p>
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