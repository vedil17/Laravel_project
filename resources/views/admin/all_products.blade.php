@extends('layouts.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php
              $all_products=DB::table('tbl_products')
                              ->get();
              $increment=1;
            ?>
            <?php
              $message=Session::get('message');
            ?>
            @if ($message)
                <p class="alert alert-success">
                    <?php
                        echo $message;
                        Session::put('message',null);   
                    ?>
                </p>
            @endif
          <h4 class="card-title">Products</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order</th>
                        <th>Image</th>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Product category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($all_products as $product)
                      <tr>
                        <td>{{$increment}}</td>
                        <td><img src="/storage/cover_image/{{$product->product_image}}" alt=""></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_category}}</td>
                        <td>
                          @if ($product->status==1)
                              <label class="badge badge-success">Activated</label>
                          @else
                              <label class="badge badge-danger">Unactivated</label>
                          @endif
                        </td>
                        <td>
                          <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_product/'.$product->id)}}">Update</a></button>
                          <button class="btn btn-outline-danger"><a href="{{URL::to('/delete_product/'.$product->id)}}" id="delete">Delete</a></button>
                          @if ($product->status==1)
                          <button class="btn btn-outline-warning"><a href="{{URL::to('/unactivate_product/'.$product->id)}}">Unactivate</a></button>
                          @else
                            <button class="btn btn-outline-success"><a href="{{URL::to('/activate_product/'.$product->id)}}">Activate</a></button>
                          @endif
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
