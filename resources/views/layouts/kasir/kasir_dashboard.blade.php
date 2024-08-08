@extends('index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      {{-- Grid untuk menampilkan item --}}
        <div class="col-lg-8">
          <div class="container-fluid">
            <div class="row">
              {{-- Start::loop data item --}}
              {{-- {{ dd($items->id) }} --}}
              @foreach($items as $item)
                <div class="col-md-3 mb-4">
                  <div class="card h-80">
                      <img src="{{ $item->image_url }}" class="card-img-top img-fluid" alt="...">
                      {{-- <span>{{ $item->id }}</span> --}}
                      <div class="card-body p-3">
                          <h5 class="card-title">{{ $item->nama_barang }}</h5>
                          <div class="d-flex justify-content-between">
                              <button class="btn btn-primary btn-sm" id="btn_add_tochart" data-itemId="{{ $item->id }}" data-itemName="{{ $item->nama_barang }}" data-harga-jual="{{ $item->harga_jual }}" onclick="add_tochart('{{ $item->id }}', '{{ $item->nama_barang }}', '{{ $item->harga_jual }}', 1)">
                                  +
                              </button>
                              <span class="text-primary"><strong>{{ $item->harga_jual }}</strong></span>
                          </div>
                      </div>
                  </div>
                </div>
              @endforeach
              {{-- End::loop data item --}}
            </div>
          </div>
        </div>
      {{-- End grid untuk menampilkan item --}}
        <div class="col-lg-4">
          {{-- <h3 class="text-secondary">No Item</h3> --}}
          <div class="card bg-white rounded">
            <div class="card-body">
                <div class="col chart-list">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Item Name</span>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary">+</button>
                            <span class="mx-3">0</span>
                            <button class="btn btn-sm btn-danger">-</button>
                        </div>
                    </div>
                </div>
                <h4 class="text-center py-3">Your Bill</h4>
                <div class="row justify-content-between">
                    <div class="col">
                        Total
                    </div>
                    <div class="col text-end">
                        Rp. <strong class="text-primary" id="total-price">0</strong>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="btn w-100 btn-primary rounded-pill" onclick="pay_order()">
                            <span class="fw-bold">Pay</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>
  </div>   
  
<script>
    let cartItems = [];
    let itemId = ''
    let itemName = ''
    let itemPrice = ''
    let itemQuantity = ''
    var csrfToken = '{{ csrf_token() }}';
    // ambil elemen dengan class chart-list
    const chartList = document.querySelector('.chart-list');

    function setVarToEmpty(){
        itemId = ''
        itemName = ''
        itemPrice = ''
        itemQuantity = ''
    }

    function add_tochart(itemId, itemName, itemPrice, itemQty){
        // Ambil data dari atribut button
        itemId = itemId;
        itemName = itemName;
        itemPrice = itemPrice;
        itemQty = itemQty;
        
        let itemExists = cartItems.find(item => item.barang_id === itemId);
        if (itemExists) {
            itemExists.jumlahbeli++;
        } else {
            cartItems.push({ barang_id: itemId, name: itemName, hargaitemxqty: itemPrice, jumlahbeli: itemQty });
        }

        console.log(JSON.stringify(cartItems, null, 2));
        renderCartItems();
        updateCartList();
        updateTotalPrice();
    }

    function updateCartList() {
        $('#cart-list').html('');
        cartItems.forEach(item => {
            $('#cart-list').append(`<li>${item.name} x ${item.jumlahbeli} = Rp. ${item.hargaitemxqty * item.jumlahbeli}</li>`);
        });
    }

    function updateTotalPrice() {
        let totalPrice = 0;
        cartItems.forEach(item => {
            totalPrice += item.hargaitemxqty * item.jumlahbeli;
        });
        $('#total-price').text(totalPrice.toLocaleString());
    }

    /**
     * fungsi ini digunakan untuk mengupdate quantity dari cartlist
     * baik itu menambah quantity atau mengurangi quantity 
     * dari item yang telah dipilih sebelumnya 
    **/
    // Example of the updateQty function
    function updateQty(action, barangId) {
        console.log(`Action: ${action}, Barang ID: ${barangId}`);
        // Your logic to update the quantity
        let itemExists = cartItems.find(item => item.barang_id === barangId);
        if (itemExists) {
            console.log('data ditemukan');
            console.log('jumlah beli saat ini : ' + itemExists.jumlahbeli)
            if (action == 'tambah') {
                itemExists.jumlahbeli++;
            }else{
                itemExists.jumlahbeli--;
            }
        }else{
            
            console.log('data tidak ditemukan');
        }
        renderCartItems();
        updateTotalPrice();
    }

    function renderCartItems() {
        // hapus semua elemen yang ada di dalam chartList
        chartList.innerHTML = '';

        // loop data cartItems
        cartItems.forEach((item) => {
            // Sanitize and escape item.barang_id
            const sanitizedBarangId = encodeURIComponent(item.barang_id);

            // buat elemen baru untuk setiap item
            const itemElement = document.createElement('div');
            itemElement.innerHTML = `
            <div class="d-flex justify-content-between mb-3">
                <span>${item.name}</span>
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" onclick="updateQty('tambah', '${sanitizedBarangId}')">+</button>
                    <span class="mx-3">${item.jumlahbeli}</span>
                    <button class="btn btn-sm btn-danger" onclick="updateQty('kurang', '${sanitizedBarangId}')">-</button>
                </div>
            </div>
            `;

            // tambahkan elemen baru ke dalam chartList
            chartList.appendChild(itemElement);
        });
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

    /// function untuk melakukan order item dari cart
    function pay_order(){
        /// jalankan load indicator
        loadIndicator();
        console.log(cartItems.itemExists);
        console.log(cartItems);
        if (cartItems) {
            /// set timeout dalam satu proses pengiriman
            setTimeout(function() {
                /// init ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('pay.order') }}',
                    data: {
                        _token: csrfToken,
                        items: cartItems
                    },
                    success: function(data) {
                        if (data.success) {
                            console.log(data.data);
                            cartItems = [];
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            renderCartItems();
                            updateTotalPrice();
                        } else {
                            Swal.fire({
                                position: "top-center",
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            position: "top-center",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }, 2000);
        }else{
            setTimeout(function(){
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Anda belum memilih item",
                    showConfirmButton: false,
                    timer: 1500
                });
            }, 2000);
        }

    }

</script>

@endsection