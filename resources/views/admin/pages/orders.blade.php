@extends("admin.admin_app")
@section("content")
<!-- Page Content -->
<div class="content">
    <h1 class="user-head">
        Orders
    </h1>
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header">                            
        </div>
        <div class="block-content">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
            @endif
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table class="table table-bordered table-striped users-dataTable-full">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Price</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <?php $user = DB::table('users')->where('id',$order->user_id)->first(); ?>
                        <td>{{ isset($user->username) ? $user->username : null}}</td>
                        <?php $subcat = DB::table('study_material_subcat')->where('id',$order->subcat)->first();
                              $cat = DB::table('study_material_cat')->where('id',$subcat->cat_id)->first(); ?>
                        <td>{{ isset($cat->name) ? $cat->name : null}}</td>
                        <td>{{ isset($subcat->name) ? $subcat->name : null}}</td>
                        <td>{{ isset($order->price) ? $order->price : null}}</td>
                        <td>{{ isset($order->txnid) ? $order->txnid : null}}</td>
                        <td>{{ isset($order->status) ? $order->status : null}}</td>
                        <td>{{ isset($order->created_at) ? $order->created_at : null}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection