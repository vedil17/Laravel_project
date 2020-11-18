@extends('layouts.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php
              $orders=DB::table('tbl_orders')
                              ->get();

              $orders->transform(function($order,$key){
                $order->cart=unserialize($order->cart);
                return $order;  
              });
              $increment=1;
            ?>
            <?php
              $error=Session::get('error');
            ?>
            @if ($error)
                <p class="alert alert-danger">
                    <?php
                        echo $error;
                        Session::put('error',null);   
                    ?>
                </p>
            @endif
          <h4 class="card-title">Orders</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order</th>
                        <th>Client name</th>
                        <th>Adresse</th>
                        <th>Cart</th>
                        <th>Payment_id</th>
                        <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($orders as $order)
                      
                        <tr>
                          <td>{{$increment}}</td>
                          <td>{{$order->name}}</td>
                          <td>{{$order->adress}}</td>
                          <td>
                            @foreach ($order->cart->items as $item)
                              {{$item['product_name'].' , '}}
                            @endforeach
                          </td>
                          <td>{{$order->payment_id}}</td>
                          <td>
                            <button class="btn btn-outline-primary"><a href="{{URL::to('/view_pdf/'.$order->id)}}">View PDF</a></button>
                          </td>

                        </tr>
                      <?php
                        $increment+=1;
                      ?>
                    @endforeach
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
