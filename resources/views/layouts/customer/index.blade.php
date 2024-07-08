@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Customers
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Data Customers</h5>
                    <div class="card-body">
                        @include('components.templates.message')
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-2">
                                <button type="button" class="btn rounded btn-primary btn-sm" onclick="setModaltoAdd()">
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
            <td id="dataNik" data-nik="">{{ $customer->nik }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->gender }}</td>
            <td>{{ $dob }}</td>
            <td>{{ $do_join }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->address }}</td>
            <td>
                <button type="button"
                data-id="{{ $customer->id }}"
                class="btn rounded-pill btn-icon btn-primary btnEdit" onclick="edit('{{ $customer->id }}')">
                    <i class='tf-icons bx bx-edit'></i>
                </button>
                <button type="button"
                onclick="choose_datato_delete('{{ $customer->id }}')"
                class="btn rounded-pill btn-icon btn-danger btnDelete">
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
                <form method="post" id="add-form">
                    @csrf
                    <input type="hidden" name="_id" id="_id">
                    <div class="modal-body" id="modal-body-addform">
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
                        <button type="button" name="save" class="btn btn-primary" onclick="saveData()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal tambah --}}

    {{-- modal hapus --}}
        <div class="modal fade" id="delModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Hapus Data Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="del-form">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input name="deletedId" type="hidden" id="deletedId">
                            <p>Apakah kamu yakin akan menghapus data customer?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="button" onclick="deleteData()" name="save" class="btn btn-danger">Yakin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- end modal hapus --}}

    <script>
        var toAction = '';

        function resetForm()
        {
            $('input[name="nik"]').val();
            $('input[name="nama"]').val();
            $('input[name="phone"]').val();
            $('textarea[name="address"]').val();
            $('input[name="dob"]').val();
            $('input[name="do_join"]').val();
            // $('select[name="gender"]').val().attr('sele/cted');
            $('input[name="_id"]').val();
            $('textarea[name="address"]').val();
        }

        function loadIndicator() {
            Swal.fire({
                title: "Processing...",
                html: "Please wait a moment.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function setModaltoAdd(){
            resetForm();
            toAction = 'save';
            $('#addModal').modal('show');
            console.log(toAction);
        }

        function saveData() {
            if (toAction == 'save') {
                $('#modalCenter').modal('hide');
                loadIndicator();

                // Simulate a delay (e.g., 2 seconds) before executing the save process
                setTimeout(function() {
                    // This is where the actual save process should be executed
                    var formData = $('#add-form').serialize();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('customer.store') }}',
                        data: formData,
                        success: function(data) {
                            if (data.success) {
                                // Hide modal
                                $('#modalCenter').modal('hide');
                                resetForm();
                                // Show success message
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });

                    // Simulated successful save process (remove this in actual implementation)
                    
                    // Hide modal
                    // $('#modalCenter').modal('hide');
                    resetForm();
                    // Show success message
                }, 2000); // 2000 milliseconds delay
                
            }else{
                console.log(toAction);
                updateData();
            }
        }

        function edit(id){
            console.log($('#btnEdit').data('id'));
            resetForm();
            toAction = 'edit';
            $('#addModal').modal('show');
            $('#modalCenterTitle').html('Edit Data');
        
            $.ajax({
                type: 'GET',
                url: '{{ 'customer/edit' }}/' + id,
                success: function(data){
                    if (data) {
                        // console.log(data);
                        $('input[name="nik"]').val(data.nik);
                        $('input[name="nama"]').val(data.name);
                        $('input[name="phone"]').val(data.phone);
                        $('textarea[name="address"]').val(data.ddress);
                        $('input[name="dob"]').val(data.dob);
                        $('input[name="do_join"]').val(data.do_join);
                        $('select[name="gender"]').val(data.gender).attr('selected');
                        $('#_id').val(data.id);
                    }else{
                        console.log(data);
                    }
                },
            })
        }

        function updateData(){
            $('#modalCenter').modal('hide');
            loadIndicator();

            // Simulate a delay (e.g., 2 seconds) before executing the save process
            setTimeout(function() {
                // This is where the actual save process should be executed
                $('#addModal').modal('hide');
                var formData = $('#add-form').serialize();
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('customer.update') }}',
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            // Hide modal
                            $('#modalCenter').modal('hide');
                            resetForm();
                            // Show success message
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });

                // Simulated successful save process (remove this in actual implementation)
                
                // Hide modal
                // $('#modalCenter').modal('hide');
                resetForm();
                // Show success message
            }, 2000); // 2000 milliseconds delay
        }

        function deleteData()
        {
            $('#delModal').modal('hide');
            loadIndicator();

            // Simulate a delay (e.g., 2 seconds) before executing the save process
            setTimeout(function() {
                // This is where the actual save process should be executed
                $('#addModal').modal('hide');
                var formData = $('#del-form').serialize();
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route('customer.destroy') }}',
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            // Hide modal
                            $('#modalCenter').modal('hide');
                            resetForm();
                            // Show success message
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });

                // Simulated successful save process (remove this in actual implementation)
                
                // Hide modal
                // $('#modalCenter').modal('hide');
                resetForm();
                // Show success message
            }, 2000); // 2000 milliseconds delay
        }

        // @param [encryption string] customerId
        function choose_datato_delete($customerId)
        {
            $('#delModal').modal('show');
            console.log($customerId);
            $('#deletedId').val($customerId);
        }

    </script>

@endsection