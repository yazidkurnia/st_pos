@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Customers
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Data Customers</h5>
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
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Date of Join</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($customers as $customer)
                                        @php
                                            $dob = date('d-m-Y', strtotime($customer->dob));
                                            $do_join = date('d-m-Y', strtotime($customer->do_join));
                                        @endphp
                                        <tr>
                                            <td>{{ $no++ }}.</td>
                                            <td>{{ $customer->nik }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->gender }}</td>
                                            <td>{{ $dob }}</td>
                                            <td>{{ $do_join }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>
                                                <button type="button" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $customer->id }}">
                                                    <i class='tf-icons bx bx-edit'></i>
                                                </button>
                                                <button type="button" class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delModal{{ $customer->id }}">
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Customers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customer.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input name="nik" type="number" min="0" class="form-control" placeholder="Input NIK" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="Input Nama" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input name="dob" type="date" class="form-control" placeholder="Input tanggal lahir" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bergabung</label>
                            <input name="do_join" type="date" class="form-control" placeholder="Input Tanggal Bergabung" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telp</label>
                            <input name="phone" type="number" min="0" class="form-control" placeholder="Input Telp" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2"></textarea>
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
    @foreach ($customers as $customer)
        <div class="modal fade" id="editModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Data Customers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('customer.update', $customer->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input name="nik" type="number" min="0" value="{{ $customer->nik }}" class="form-control" placeholder="Input NIK" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control" value="{{ $customer->name }}" placeholder="Input Nama" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <option value="L" {{ $customer->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $customer->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input name="dob" type="date" class="form-control" value="{{ $customer->dob }}" placeholder="Input tanggal lahir" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Bergabung</label>
                                <input name="do_join" type="date" class="form-control" value="{{ $customer->do_join }}" placeholder="Input Tanggal Bergabung" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telp</label>
                                <input name="phone" type="number" min="0" value="{{ $customer->phone }}" class="form-control" placeholder="Input Telp" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $customer->address }}</textarea>
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
    @foreach ($customers as $customer)
        <div class="modal fade" id="delModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Hapus Data Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input name="id" type="hidden" value="{{ $customer->id }}">
                            <p>Apakah kamu yakin akan menghapus data customer <b>{{ $customer->name }}</b>?</p>
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