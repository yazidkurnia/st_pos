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
                          <h5 class="card-title">{{ $item->name }}</h5>
                          {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                          {{-- <a href="#" class="card-link">Card link</a> --}}
                          <div class="d-flex justify-content-between">
                              <button class="btn btn-primary btn-sm" id="btn_add_tochart" data-item-id="{{ $item->id }}" data-nama-barang="{{ $item->nama_barang }}" data-harga-jual="{{ $item->harga_jual }}" onclick="add_tochart('{{ $item->id }}')">
                                  +
                              </button>
                              <span class="text-primary"><strong>{{ $item->price }}</strong></span>
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
                <div class="d-flex justify-content-between mb-3">
                    <span>Item Name</span>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary">+</button>
                        <span class="mx-3">0</span>
                        <button class="btn btn-sm btn-danger">-</button>
                    </div>
                </div>
                <h4 class="text-center py-3">Your Bill</h4>
                <div class="row justify-content-between">
                    <div class="col">
                        Total
                    </div>
                    <div class="col text-end">
                        Rp.<strong class="text-primary" id="total-price">0</strong>
                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>
  </div>   
  
{{-- <script>
  let cartItems = [];

  function add_tochart(id){
    console.log(id);
    let itemId = $('#btn_add_tochart').data('item-id');
    let itemName = $('#btn_add_tochart').data('nama-barang');
    let itemPrice = $('#btn_add_tochart').data('harga-jual');
    let itemQuantity = 1;

    let itemExists = cartItems.find(item => item.id === itemId);
    if (itemExists) {
      itemExists.quantity++;
    } else {
      cartItems.push({ id: itemId, name: itemName, price: itemPrice, quantity: itemQuantity });
    }

    console.log(cartItems);
  }

  function updateCartList() {
    $('#cart-list').html('');
    cartItems.forEach(item => {
      $('#cart-list').append(`<li>${item.name} x ${item.quantity} = Rp. ${item.price * item.quantity}</li>`);
    });
  }

  function updateTotalPrice() {
    let totalPrice = 0;
    cartItems.forEach(item => {
      totalPrice += item.price * item.quantity;
    });
    $('#total-price').text(totalPrice.toLocaleString());
  }
</script> --}}

@endsection