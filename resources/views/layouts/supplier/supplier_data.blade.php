@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Suppliers
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- Table rows -->
                <div class="card mb-4">
                    <h5 class="card-header">Data Suppliers</h5>
                    <div class="card-body">
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-2">
                                <button type="button" class="btn rounded btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <i class='bx bx-add-to-queue'></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($vendors as $data)
                                    <tr>
                                        <td>{{ $no++ }}.</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->telp }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn rounded-pill btn-icon btn-primary"><i class="tf-icons bx bx-edit"></i></a>
                                                <a href="#" class="btn rounded-pill btn-icon btn-danger"><i class="tf-icons bx bx-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/ Hoverable Table rows -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="Input nama suplier"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="telp" class="form-control" id="floatingInput" placeholder="Input telp suplier"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Telp</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="alamat" class="form-control" id="floatingInput" aria-describedby="floatingInputHelp" rows="2"></textarea>
                        <label for="floatingInput">Alamat</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection