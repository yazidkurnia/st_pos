@extends('index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Pages /</span>
            Suppliers
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Table rows -->
                <div class="card mb-4">
                    <h5 class="card-header">Data Suppliers</h5>
                    <div class="card-body">
                        @include('components.templates.message')
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-3">
                                <button type="button" class="btn rounded btn-primary" onclick="add()">
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
                                    @foreach ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $no++ }}.</td>
                                        <td id="data_nama" data-nama="{{ $vendor->nama }}">{{ $vendor->nama }}</td>
                                        <td id="data_telp" data-telp="{{ $vendor->telp }}">{{ $vendor->telp }}</td>
                                        <td id="data_alamat" data-alamat="{{ $vendor->alamat }}">{{ $vendor->alamat }}</td>
                                        <td>
                                            <button type="button" data-id="{{ $vendor->id }}" data-alamat="{{ $vendor->alamat }}" data-nama="{{ $vendor->nama }}" data-phone="{{ $vendor->telp }}" data-id="{{ $vendor->id }}" class="btn rounded-pill btn-icon btn-warning submit" onclick="edit('{{ $vendor->id }}')">
                                                <i class='bx bx-edit'></i>
                                            </button>
                                            {{-- <a href="{{ route('supplier.edit', $vendor->id ) }}" class="btn rounded-pill btn-icon btn-primary"><i class="tf-icons bx bx-edit"></i></a> --}}
                                            <button type="button" class="btn rounded-pill btn-icon btn-danger" onclick="confirm_delete('{{ $vendor->id }}')">
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
                <!--/ Hoverable Table rows -->
            </div>
        </div>

        {{-- modal tambah --}}
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Tambah Data Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="add()"></button>
                    </div>
                    <form id="add-form" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Input nama suplier" aria-describedby="floatingInputHelp" required />
                                <label for="floatingInput">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="telp" class="form-control" id="telp" placeholder="Input telp suplier" aria-describedby="floatingInputHelp" required />
                                <label for="floatingInput">Telp</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="alamat" class="form-control" id="alamat" aria-describedby="floatingInputHelp" rows="2"></textarea>
                                <label for="floatingInput">Alamat</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="save()" class="btn btn-primary" id="saveButton">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            {{-- modal hapus --}}

    <div class="modal fade" id="delModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="delete_form">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <input name="id_todalate" type="hidden">
                        <p id="confirm_message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="button" name="save" class="btn btn-danger" onclick="deleteData()">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- end modal hapus --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}

    <script>

        var nama = $('.submit').data("nama");
        var telp = $('.submit').data("data-telp");
        var alamat = $('.submit').data("data-alamat");
        var toAction = '';

        console.log(nama);

        function checkTime() {
            var now = new Date();
            console.log(now);
            var formattedTime = now.toLocaleTimeString(); // Format the time
            $('#currentTime').text(formattedTime); // Display the current time

            // Your logic to check the time or perform actions
            // Example: Check if it's a specific time
            if (now.getHours() === 17 && now.getMinutes() === 30 && now.getSeconds() === 0) {
                console.log('It\'s 5:30 PM!');
                // Perform your action here
            }

            // Example: Check if it's the start of a new hour
            if (now.getMinutes() === 0 && now.getSeconds() === 0) {
                console.log('New hour has started!');
                // Perform your action here
            }
        }

        function add(){
            toAction = 'save';
            console.log(toAction);
            $('#modalCenter').modal('show');
            resetForm();
        }

        // fungsi berikut akan secara otomatis mengosongkan setiap form yang sebelumnya telah diisi
        function resetForm()
        {
            $('#nama').val('');
            $('#telp').val('');
            $('#alamat').val('');
        }

        // pada saat melakukan edit data fungsi berikut akan secara otomatis mengisi setiap fill yang ada
        function autoFillForm(){
            $('#nama').val(nama);
            $('#telp').val(telp);
            $('#alamat').val(alamat);
        }

        // menjalankan load indicator
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

        // fungsi berikut akan menjalankan proses penyimpanan data dengan melalui ajax
        function save() {
            if (toAction == 'save') {
                $('#modalCenter').modal('hide');
                loadIndicator();
    
                // Simulate a delay (e.g., 2 seconds) before executing the save process
                setTimeout(function() {
                    // This is where the actual save process should be executed
                    var formData = $('#add-form').serialize();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('supplier.store') }}',
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
                                    title: "Your work has been saved",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Error adding data",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Error adding data",
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
                update();
            }
        }

                
        function edit(id){ 
            toAction = 'edit';
            // console.log($('#btnEdit').data('id'));
            resetForm();
            $('#modalCenter').modal('show');
            $('#modalCenterTitle').html('Edit Data');
            $('#saveButton').html('Edit Data');
        
            $.ajax({
                type: 'GET',
                url: '{{ 'supplieredit' }}/' + id,
                success: function(data){
                    if (data) {
                        console.log(data.message);
                        $('#nama').val(data.data.nama);
                        $('#telp').val(data.data.telp);
                        $('#alamat').val(data.data.alamat);
                        $('#id').val(data.data.id);
                    }else{
                        console.log(data);
                    }
                },
                error: function(data){
                    console.log(data.message)
                }
            })
        }

        // menjalankan controller ketika function berjalan
        function update(){
            $('#modalCenter').modal('hide');
                loadIndicator();
    
                // Simulate a delay (e.g., 2 seconds) before executing the save process
                setTimeout(function() {
                    // This is where the actual save process should be executed
                    var formData = $('#add-form').serialize();
                    $.ajax({
                        type: 'put',
                        url: '{{ route('supplier.update') }}',
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
                                    title: "Your work has been saved",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Error adding data",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Error adding data",
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

        function confirm_delete(supplierid)
        {
            $('input[name="id_todalate"]').val(supplierid)
            $('#delModal').modal('show');
            $('#confirm_message').html('Apakah anda yakin ingin menghapus data berikut');
            console.log(supplierid);
        }    
        
        function deleteData(){
            var id = $('input[name="id_todalate"]').val();
            $('#delModal').modal('hide');
            loadIndicator();
                            // Simulate a delay (e.g., 2 seconds) before executing the save process
            setTimeout(function() {
                console.log(id);

                var formData = $('#delete_form').serialize();
                    $.ajax({
                        type: 'delete',
                        url: '{{ route('supplier.destroy') }}',
                        data: formData,
                        success: function(data) {
                            if (data.success) {
                                // Hide modal
                                $('#delModal').modal('hide');
                                resetForm();
                                // Show success message
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Your work has been saved",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Error adding data",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Error adding data",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });

                // Swal.fire({
                //     position: "top-end",
                //     icon: "success",
                //     title: "Your work has been saved",
                //     showConfirmButton: false,
                //     timer: 1500
                // });
            }, 2000); // 2000 milliseconds delay
        }

        // dom(document.ready fucntion) : digunakan untuk menjalankan fungsi javascript yang akan dipanggil secara berulang 
        // secara otomatis
        $(document).ready(function() {
            console.log(Date());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#add-form').on('submit', function(e) {
                e.preventDefault();
                save();
            });

            function resetForm() {
                $('#add-form')[0].reset();
            }
        });

    </script>
    </div>
@endsection
