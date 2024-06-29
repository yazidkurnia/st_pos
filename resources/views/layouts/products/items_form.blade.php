@php
    if ($pages == 'create'){
        $barcode = '';
        $nama = '';
        $harga_jual = '';
        $harga_modal = '';
        $satuan_id = '';
        $vendor_id = '';
        $kategori_id = '';
    }
@endphp

@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Items /</span>
            {{ $pages }}
        </h4>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h5 class="card-header">{{ $pages }} Items</h5>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <form action="{{ route('items.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" value="{{ $barcode ? $barcode : '' }}" placeholder="Barcode..." required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $nama ? $nama : '' }}" placeholder="Nama..." required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga Jual</label>
                                        <input type="number" name="harga_jual" class="form-control" value="{{ $harga_jual ? $harga_jual : '' }}" placeholder="Harga Jual..." required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga Modal</label>
                                        <input type="number" name="harga_modal" class="form-control" value="{{ $harga_modal ? $harga_modal : '' }}" placeholder="Harga Modal..." required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select name="satuan" class="form-control" required>
                                            <option value="">- Pilih Satuan -</option>
                                            @foreach ($satuan as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
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