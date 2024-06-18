@extends('index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8">
          <div class="container-fluid">
            <div class="row">
                <div class="col">
                  <div class="card mb-3" style="width: 10rem;">
                    <img class="mx-3 my-3 rounded" src="https://plus.unsplash.com/premium_photo-1682091872078-46c5ed6a006d?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      {{-- <a href="#" class="card-link">Card link</a> --}}
                      <div class="row d-flex justify-content-spaceBetween">
                        <div class="col-lg-6">
                          <button class="btn btn-primary btn-sm">
                            +
                          </button>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                          <span class="text-primary"><strong>120K</strong></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card mb-3" style="width: 10rem;">
                    <img class="mx-3 my-3 rounded" src="https://plus.unsplash.com/premium_photo-1682091872078-46c5ed6a006d?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      {{-- <a href="#" class="card-link">Card link</a> --}}
                      <div class="row d-flex justify-content-spaceBetween">
                        <div class="col-lg-6">
                          <button class="btn btn-primary btn-sm">
                            +
                          </button>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                          <span class="text-primary"><strong>120K</strong></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>\<div class="col">
                  <div class="card mb-3" style="width: 10rem;">
                    <img class="mx-3 my-3 rounded" src="https://plus.unsplash.com/premium_photo-1682091872078-46c5ed6a006d?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      {{-- <a href="#" class="card-link">Card link</a> --}}
                      <div class="row d-flex justify-content-spaceBetween">
                        <div class="col-lg-6">
                          <button class="btn btn-primary btn-sm">
                            +
                          </button>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                          <span class="text-primary"><strong>120K</strong></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            {{-- <h3 class="text-secondary">No Item</h3> --}}
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="https://plus.unsplash.com/premium_photo-1682091872078-46c5ed6a006d?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <button class="btn-primary btn-sm">+</button>
                    <span>0</span>
                    <button class="btn-danger btn-sm">-</button>
                  </div>
                </div>
              </div>
            </div>
          <div class="container-fluid bg-white rounded">
            <h4 class="text-center py-3">Your Bill</h4> 
            <div class="row block justify-item-content-spaceBetween">
                <div class="col">
                    Total
                </div>
                <div class="col d-flex justify-content-end">
                    Rp.<Strong class="text-primary">100.000</Strong>
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
@endsection