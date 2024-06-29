@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Suppliers
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Supplier</h5>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <form action="{{ route('supplier.update', $vendor->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $vendor->nama ? $vendor->nama : '' }}" placeholder="Nama Supplier" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Telp</label>
                                        <input type="number" name="telp" class="form-control" value="{{ $vendor->telp ? $vendor->telp : '' }}" placeholder="Telp Supplier" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="2">{{ $vendor->alamat ? $vendor->alamat : '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ route('supplier') }}" class="btn btn-secondary"><i class='tf-icons bx bx-chevron-left-circle'></i> Back</a>
                                        <button type="submit" name="submit" class="btn btn-primary"><i class='bx bx-save'></i> Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection