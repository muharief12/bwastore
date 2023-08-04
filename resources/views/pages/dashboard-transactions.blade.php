@extends('layouts.dashboard')

@section('title', 'Dashboard - Transactions Page')
    
@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">Transactions</h2>
        <p class="dashboard-subtitle">
            Big result start from the small one
        </p>
        </div>
        <div class="dashboard-content">
        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item {{ Auth::user()->store_status == '0' ? 'd-none' : ''  }}" role="presentation">
            <a
                class="nav-link {{ Auth::user()->store_status == '1' ? 'active' : ''  }}"
                id="sell-tab"
                data-toggle="tab"
                href="#sell"
                role="tab"
                aria-controls="sell"
                aria-selected="{{ Auth::user()->store_status == '1' ? 'true' : 'false'  }}"
                >Sell Product</a
            >
            </li>
            <li class="nav-item" role="presentation">
            <a
                class="nav-link {{ Auth::user()->store_status == '0' ? 'active' : ''  }}"
                id="buy-tab"
                data-toggle="tab"
                href="#buy"
                role="tab"
                aria-controls="buy"
                aria-selected="{{ Auth::user()->store_status == '1' ? 'false' : 'true'  }}"
                >Buy Product</a
            >
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show {{ Auth::user()->store_status == '0' ? 'd-none' : 'active'  }}"
                id="sell"
                role="tabpanel"
                aria-labelledby="sell-tab"
                >
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        @forelse ($sellTransactions as $transaction)
                            <a
                                class="card card-list d-block"
                                href="{{ route('dashboard-transactions-details', $transaction->id)}}"
                                >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                        <img
                                            src="{{ Storage::url($transaction->product->galleries->first()->photos) ?? ''}}"
                                            alt=""
                                            class="w-100"
                                        />
                                        </div>
                                        <div class="col-md-2  text-center">
                                        {{ ($transaction->product->name)}}
                                        </div>
                                        <div class="col-md-2  text-center">
                                            @if ( $transaction->transaction->transaction_status == 'PENDING')
                                                <span class="badge badge-pill badge-warning">Pending</span>
                                            @elseif ( $transaction->transaction->transaction_status == 'SUCCESS')
                                                <span class="badge badge-pill badge-success">Success</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3  text-center">
                                        {{ explode(" ", $transaction->transaction->user->name)[0] }}
                                        </div>
                                        <div class="col-md-3  text-center">
                                        {{ $transaction->created_at }}
                                        </div>
                                        <div class="col-md-1 d-none d-md-block">
                                        <img
                                            src="/images/dashboard-arrow-right.svg"
                                            alt=""
                                        />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p style="color: #ff7158" class="empty-cart text-center">You Don't have any Transaction Data</p>
                        @endforelse
                        {{-- <a
                                class="card card-list d-block"
                                href="/dashboard-transactions-details.html"
                            >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="/images/dashboard-icon-product-2.png"
                                    alt=""
                                />
                                </div>
                                <div class="col-md-4">
                                LeBrone X
                                </div>
                                <div class="col-md-3">
                                Masayoshi
                                </div>
                                <div class="col-md-3">
                                11 January, 2020
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                />
                                </div>
                            </div>
                            </div>
                        </a>
                        <a
                                class="card card-list d-block"
                                href="/dashboard-transactions-details.html"
                            >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="/images/dashboard-icon-product-3.png"
                                    alt=""
                                />
                                </div>
                                <div class="col-md-4">
                                Soffa Lembutte
                                </div>
                                <div class="col-md-3">
                                Shayna
                                </div>
                                <div class="col-md-3">
                                11 January, 2020
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                />
                                </div>
                            </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
            <div
                class="tab-pane fade show {{ Auth::user()->store_status == '0' ? 'active' : ''  }}"
                id="buy"
                role="tabpanel"
                aria-labelledby="buy-tab"
                >
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                    @forelse ($buyTransactions as $transaction)
                            <a
                                class="card card-list d-block"
                                href="{{ route('dashboard-transactions-details', $transaction->id)}}"
                                >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                        <img
                                            src="{{ Storage::url($transaction->product->galleries->first()->photos) ?? ''}}"
                                            alt=""
                                            class="w-100"
                                        />
                                        </div>
                                        <div class="col-md-2  text-center">
                                        {{ $transaction->product->name}}
                                        </div>
                                        <div class="col-md-2  text-center">
                                            @if ( $transaction->transaction->transaction_status == 'PENDING')
                                                <span class="badge badge-pill badge-warning">Pending</span>
                                            @elseif ( $transaction->transaction->transaction_status == 'SUCCESS')
                                                <span class="badge badge-pill badge-success">Success</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3  text-center">
                                        {{ $transaction->product->user->store_name }}
                                        </div>
                                        <div class="col-md-3  text-center">
                                        {{ $transaction->created_at }}
                                        </div>
                                        <div class="col-md-1 d-none d-md-block">
                                        <img
                                            src="/images/dashboard-arrow-right.svg"
                                            alt=""
                                        />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p style="color: #ff7158" class="empty-cart text-center">You Don't have any Transaction Data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection