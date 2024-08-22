@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
              {{ session('error') }}
              @if (session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
              @endif
                <div class="nav-align-top mb-6">
                  <ul class="nav nav-pills mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">Transaction</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false" tabindex="-1">Transaction Detail</button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table card-table">
                              <thead>
                                <tr>
                                  <th>Project</th>
                                  <th>Client</th>
                                  <th>Users</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0 tbl-transction">

                              </tbody>
                            </table>
                          </div>
                          <div class="" id="paginate-transaction"></div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table card-table">
                              <thead>
                                <tr>
                                  <th>Project</th>
                                  <th>Client</th>
                                  <th>Users</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                <tr>
                                  <td><i class="bx bxl-angular bx-md text-danger me-4"></i> <span>Angular Project</span></td>
                                  <td>Albert Cook</td>
                                  <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge bg-label-primary me-1">Active</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="bx bxl-react bx-md text-info me-4"></i> <span>React Project</span></td>
                                  <td>Barry Hunter</td>
                                  <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge bg-label-success me-1">Completed</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="bx bxl-vuejs bx-md text-success me-4"></i> <span>VueJs Project</span></td>
                                  <td>Trevor Baker</td>
                                  <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="bx bxl-bootstrap bx-md text-primary me-4"></i> <span>Bootstrap Project</span></td>
                                  <td>Jerry Milton</td>
                                  <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                      </li>
                                    </ul>
                                  </td>
                                  <td><span class="badge bg-label-warning me-1">Pending</span></td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table card-table">
                                <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Client</th>
                                    <th>Users</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <tr>
                                    <td><i class="bx bxl-angular bx-md text-danger me-4"></i> <span>Angular Project</span></td>
                                    <td>Albert Cook</td>
                                    <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">Active</span></td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bx bxl-react bx-md text-info me-4"></i> <span>React Project</span></td>
                                    <td>Barry Hunter</td>
                                    <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                    </td>
                                    <td><span class="badge bg-label-success me-1">Completed</span></td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bx bxl-vuejs bx-md text-success me-4"></i> <span>VueJs Project</span></td>
                                    <td>Trevor Baker</td>
                                    <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                    </td>
                                    <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bx bxl-bootstrap bx-md text-primary me-4"></i> <span>Bootstrap Project</span></td>
                                    <td>Jerry Milton</td>
                                    <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                    </td>
                                    <td><span class="badge bg-label-warning me-1">Pending</span></td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                    </td>
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
                        var row = '<tr>';
                        row += '<td>' + transaction.id + '</td>'; // Project
                        row += '<td>' + transaction.kasir_id + '</td>'; // Client
                        row += '<td>' + transaction.jumlahbayar + '</td>'; // Users
                        row += '<td>' + (transaction.statuspembayaran === 1 ? 'Active' : 'Inactive') + '</td>'; // Status
                        row += '<td>';
                        row += '<div class="dropdown">';
                        row += '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>';
                        row += '<div class="dropdown-menu">';
                        row += '<a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
                        row += '<a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>';
                        row += '</div>';
                        row += '</div>';
                        row += '</td>'; // Actions
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