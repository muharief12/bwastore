@extends('layouts.dashboard')

@section('title', 'Dashboard - Transaction Detail Page')
    
@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading mb-3">
            <div class="d-flex align-items-end">
                <div class="col-md-1 mr-4 d-print-inline d-md-none d-sm-none d-lg-none d-none">
                    <img src="/images/dashboard-store-logo.svg" alt=""/>
                </div>
                <div class="col-md-11">
                    <h2 class="dashboard-title">{{ $transaction->transaction->code }} / {{ $transaction->code }} </h2>
                    <p class="dashboard-subtitle">
                    Transaction Details
                    </p>
                </div>
            </div>
        </div>
        <div class="dashboard-content" id="transactionDetails">
            <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                    <div class="col-12 col-md-4">
                        <img
                        src="{{ Storage::url($transaction->product->galleries->first()->photos) }}"
                        alt=""
                        class="w-100 mb-3"
                        />
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="product-title">Customer Name</div>
                            <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Product Name</div>
                            <div class="product-subtitle">
                                {{ $transaction->product->name}}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">
                            Date of Transaction
                            </div>
                            <div class="product-subtitle">
                                {{ $transaction->created_at }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Payment Status</div>
                            <div class="product-subtitle {{ $transaction->transaction->transaction_status == 'SUCCESS' ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->transaction->transaction_status }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Total Amount</div>
                            <div class="product-subtitle">Rp {{ number_format($transaction->price) }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="product-title">Mobile</div>
                            <div class="product-subtitle">
                                {{ $transaction->transaction->user->phone_number ?? '-' }}
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <form action="{{ route('dashboard-transactions-update', $transaction->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mt-4">
                                <h5 class="d-flex">
                                    Shipping Informations
                                    <span class="d-print-none">
                                        <a href="" data-toggle="tooltip" data-placement="right" title="You can change the shipping information in the My Account Page!">
                                        <img src="https://buildwithangga.com/themes/front/images/ic_info.svg" class="icon-info-patungan mx-1 d-none d-sm-block" alt="icon">
                                        <img src="https://buildwithangga.com/themes/front/images/mobile/icon/ic_info.svg" class="icon-info-patungan mx-1 d-block d-sm-none" alt="icon">
                                        </a>
                                    </span>
                                    {{-- Reference from BWA --}}
                                    {{-- <div data-tippy-content="<div><p class='title'>Information</p><p class='sub-title'>You can change the shipping information in the My Account Page></a></p>" class="cursor-pointer z-10 tippyTriggerId" aria-expanded="false">
                                    </div> --}}
                                </h5>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Address 1</div>
                                        <div class="product-subtitle">
                                        {{ $transaction->transaction->user->address_one ?? '-'}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Address 2</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->transaction->user->address_two ?? '-'}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">
                                        Province
                                        </div>
                                        <div class="product-subtitle">
                                            {{ $province->name ?? '-'}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">City</div>
                                        <div class="product-subtitle">
                                            {{ $regency->name ?? '-'}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Postal Code</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->zip_code ?? '-'}}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Country</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->transaction->user->country ?? '-'}}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-md-3">
                                            <div class="product-title">Shipping Status</div>
                                            @if ($transaction->product->user->id != Auth::user()->id)
                                                @if ( $transaction->shipping_status == 'PENDING')
                                                    <div class="text-danger product-subtitle">
                                                        {{ $transaction->shipping_status }}
                                                    </div>
                                                @elseif ($transaction->shipping_status == 'SHIPPING')
                                                    <div class="text-warning product-subtitle">
                                                        {{ $transaction->shipping_status }}
                                                    </div>
                                                @elseif ($transaction->shipping_status == 'SUCCESS')
                                                    <div class="text-success product-subtitle">
                                                        {{ $transaction->shipping_status }}
                                                    </div>
                                                @endif
                                            @else
                                                <select name="shipping_status" id="status" class="form-control" v-model="status">
                                                    <option value="PENDING">Pending</option>
                                                    <option value="SHIPPING">Shipping</option>
                                                    <option value="SUCCESS">Success</option>
                                                </select>
                                            @endif
                                            
                                        </div>
                                        
                                        @if ($transaction->transaction->user->id == Auth::user()->id)
                                            <div class="col-md-3 {{ $transaction->shipping_status == 'SHIPPING' ? '' : 'd-none' }}">
                                                <div class="product-title">Resi</div>
                                                <div class="product-subtitle">{{ $transaction->resi }}</div>
                                            </div>
                                        @endif

                                        @if ($transaction->product->user->id == Auth::user()->id)
                                            <template v-if="status == 'SHIPPING'">
                                                <div class="col-md-3">
                                                    <div class="product-title">
                                                        Input Resi
                                                    </div>
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        name="resi"
                                                        id="openStoreTrue"
                                                        v-model="resi"
                                                    />
                                                </div>
                                                <div class="col-md-2">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-success btn-block mt-4"
                                                    >
                                                        Update Resi
                                                    </button>
                                                </div>
                                            </template>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            
                            <div class="col-12 text-right d-print-none">
                                {{-- <a target="_blank" href="{{ route('dashboard-transactions-print', $transaction->id)}}" class="btn btn-primary btn-md">Print PDF</a> --}}
                                <a href="" onclick="window.print()" class="btn btn-primary btn-md mt-4"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Print PDF</a>
                                <button type="submit" class="btn btn-success btn-md mt-4">Save Now</button>
                            </div>
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

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script>
  var transactionDetails = new Vue({
    el: "#transactionDetails",
    data: {
        status: "{{ $transaction->shipping_status }}",
    //   resi: "BDO12308012132",
        resi: "{{ $transaction->resi }}",
    },
  });
</script>    
@endpush