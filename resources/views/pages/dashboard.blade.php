@extends('layouts.dashboard')

@section('title', 'Dashboard - Your Best Marketplace')
    
@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">
                Look what you have made today!
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                <div class="col-md-4">
                    <div class="card mb-2">
                    <div class="card-body">
                        <div class="dashboard-card-title">
                        Customer
                        </div>
                        <div class="dashboard-card-subtitle">
                        {{ number_format($customer) }}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                    <div class="card-body">
                        <div class="dashboard-card-title">
                        Revenue
                        </div>
                        <div class="dashboard-card-subtitle">
                        Rp {{ number_format($revenue) }}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                    <div class="card-body">
                        <div class="dashboard-card-title">
                        Transaction
                        </div>
                        <div class="dashboard-card-subtitle">
                        {{ number_format($transaction_count) }}
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Seller Transactions</h5>
                    @forelse ($transaction_data as $transaction)
                        <a
                            class="card card-list d-block"
                            href="{{ route('dashboard-transactions-details', $transaction->id)}}"
                            >
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-1 inline-block align-middle">
                                    <img
                                    {{-- src="/images/dashboard-icon-product-1.png" --}}
                                    src="{{ Storage::url($transaction->product->galleries->first()->photos) ?? '' }}"
                                    class="w-100"
                                    />
                                </div>
                                <div class="col-md-2 text-center">
                                    {{ $transaction->product->name ?? ''}}
                                </div>
                                <div class="col-md-2 text-center">
                                    @if ( $transaction->transaction->transaction_status == 'PENDING')
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                    @elseif ( $transaction->transaction->transaction_status == 'SUCCESS')
                                        <span class="badge badge-pill badge-success">Success</span>
                                    @endif
                                </div>
                                <div class="col-md-3 text-center">
                                    {{ explode(" ", $transaction->transaction->user->name)[0] ?? '' }}
                                </div>
                                <div class="col-md-3 text-center">
                                    {{ $transaction->created_at }}
                                </div>
                                <div class="col-md-1 d-none d-md-block text-right">
                                    <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                    />
                                </div>
                                </div>
                            </div>
                        </a>
                    @empty 
                        <p style="color: #ff7158" class="empty-cart text-center">No Transaction Data</p>
                    @endforelse
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection