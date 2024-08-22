@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="nav-align-top mb-6">  
                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  <div class="container bg-primary rounded-top py-3">
                    <h1 class="text-white bold fs-4">Transaksi</h1>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table card-table">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kasir</th>
                                  <th>Total Pembayaran</th>
                                  <th>Status</th>
                                  <th>Tanggal Transaksi</th>
                                  <th>Tindakan</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0 tbl-transction">

                              </tbody>
                            </table>
                        </div>
                          <div class="" id="paginate-transaction"></div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <script>
        function getDataTransaction(){
            $.ajax({
                url: '{{ route('load.data.transaction') }}',
                type: 'GET',
                success: function(data){
                  var paginator = data.paginator;
                  var transactions = data.data;
                    // console.log(parse.json(data.data[0]));
                    $.each(data.data, function(index, transaction) {
                        var number = index + 1;
                        var row = '<tr>';
                        row += '<td>' + number + '</td>'; // Project
                        row += '<td>' + transaction.user.name+ '</td>'; // Client
                        row += '<td>' + transaction.jumlahbayar + '</td>'; // Users
                        row += '<td>' + (transaction.statuspembayaran === 1 ? 'Active' : 'Inactive') + '</td>'; // Status
                        row += '<td>' + transaction.created_at + '</td>'
                        row += '<td>' + '<a href="' + '{{ url('/detail/transaction') }}/' + transaction.id + '" class="btn btn-sm btn-secondary">' +'Detail'+ '</a>' + '</td>'
                        row += '</tr>';
                        
                        $('.tbl-transction').append(row);
                    });
                    // Update pagination links
                    var paginationHtml = '';
                    for (var i = 1; i <= paginator.last_page; i++) {
                      paginationHtml += '<div class"row"><div class="col-lg-6"><div class="demo-inline-spacing"><nav aria-label="Page navigation"><ul class="pagination"><li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li></ul></nav></div></div></div>';

                      // paginationHtml += ''
                    }
                    // $('#paginate-transaction').html(paginationHtml);
                    // $paginate += '${$data->links()}'
                    $('#paginate-transaction').html(data.data.links());
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        $(document).ready(function(){
            getDataTransaction();
        })
    </script>
@endsection