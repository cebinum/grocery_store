@extends('layouts.admin.argon')

@section('title' , 'Orders')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">@yield('title')</h3>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    @include('flash::message')
                </div>

                @if ($orders->isNotEmpty())
                    <div class="table-responsive py-4">
                        <table class="table align-items-center table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Order Number</th>
                                    <th>Order By</th>
                                    <th class="text-center">Number of Items</th>
                                    <th>Grand Total</th>
                                    <th>Order Status</th>
                                    <th>Received</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Order Number</th>
                                    <th>Order By</th>
                                    <th class="text-center">Number of Items</th>
                                    <th>Grand Total</th>
                                    <th>Order Status</th>
                                    <th>Received</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration}}</td>
                                        <td class="text-success"><b>{{$order->order_number }}</b></td>
                                        <td>{{$order->user->name }}</td>
                                        <td class="text-center">{{$order->orderItems->count() }}</td>
                                        <td>$ {{ number_format($order->grand_total,2) }}</td>
                                        <td>
                                            @switch($order->status)
                                                    @case(\App\Models\Order::ORDER_RECEIVED)
                                                        <span class="text-info">Order Received</span>
                                                        @break
                                                    @case(\App\Models\Order::ORDER_IN_PROCESS)
                                                        <span class="">Order In Process</span>
                                                        @break
                                                    @case(\App\Models\Order::DELIVERY_IN_PROGRESS)
                                                        <span class="text-primary">Delivery In progress</span>
                                                        @break
                                                    @case(\App\Models\Order::PACKAGE_DELIVERED)
                                                        <span class="text-success">Package Delivered</span>
                                                        @break
                                                    @default
                                                    <span class="text-danger">Pending</span>
                                                @endswitch
                                        </td>
                                        <td>{{$order->date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center m-5">
                        <img src="{{ asset('argon/img/images.png')}}" alt="" width="50%" >
                        <h2 class="text-center mt-5 text-muted">All orders will appear here</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
