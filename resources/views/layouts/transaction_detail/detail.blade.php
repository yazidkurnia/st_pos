@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">         
                <div class="nav-align-top mb-6">
                  <div class="container bg-primary rounded-top py-3">
                    <h1 class="text-white bold fs-4">Transaksi</h1>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                      <div class="container row">
                        <div class="col-lg-4">
                          <div class="col">
                            <span>Nama: </span>
                          </div>
                          <div class="col mb-3">
                            <span class="fs-3">{{ $data_kasir->name }}</span>
                          </div>
                          <div class="col">
                            <span>Email: </span>
                          </div>
                          <div class="col">
                            <span class="fs-3">{{ $data_kasir->email }}</span>
                          </div>
                        </div>
                        <div class="col-lg-8">
                          <div>
                            <div class="container row d-flex">
                                <div class="col-xl-12 justify-item-center col-sm-12 mt-3">
                                  <center><span class="text-danger fs-1">LUNAS</span></center>
                                </div>
                            </div>
                            <table class="table-responsive table rounded-top">
                              <tbody>
                                @forelse ($data_detail_transaction as $list)
                                  <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $list->nama_barang }}</td>
                                    <td>{{ $list->jumlahbeli }}</td>
                                    <td>{{ $list->hargaitemxqty }}</td>
                                  </tr>                                    
                                @empty
                                    
                                @endforelse
                                <tr>
                                  <td>Total: <span class="fs-5 ml-3 text-primary">{{ $totalbayar }}</span></td>
                                  {{-- <td></td> --}}
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <script>

    </script>
@endsection