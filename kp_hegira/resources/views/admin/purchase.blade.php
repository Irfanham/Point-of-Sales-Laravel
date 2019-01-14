@extends('admin.layout_admin')

@section('content')
<div class="row page-header">
    <div class="col-lg-12">
        <h1 class="">Data Pembelian</h1>
    </div>
</div>
<div class="">
  <div class="row form-group">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Transaksi Pembelian
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <div class="panel-body">
                          <div class="form-horizontal">
                            <div class="form-group">
                              <label for="exampleInputEmail1" class="col-sm-4 control-label">No Bukti</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="id" placeholder="No Bukti" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Tgl Bukti</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="date_time" placeholder="Tanggal Bukti" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Cari Barang</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="cari" placeholder="Cari...">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Nama Barang</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="name" placeholder="Nama Barang">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Harga Beli</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="unitPrice" placeholder="Harga Beli" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Harga Jual</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="unitSale" placeholder="Harga Jual">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Jumlah Beli</label>
                              <div class="col-sm-3">
                                <input type="email" class="form-control" id="quantity" placeholder="0">
                              </div>
                              <div class="col-sm-5">
                                <input type="email" class="form-control" placeholder="Buah" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Potongan</label>
                              <div class="col-sm-3">
                                <input type="email" class="form-control" id="disc" placeholder="0">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Total</label>
                              <div class="col-sm-3">
                                <input type="email" class="form-control" id="total" placeholder="0" readonly>
                              </div>
                            </div>
                            <div class="form-group text-right">
                              <button type="button" onclick="dataCreate()" id="modal_add" class="btn btn-primary">Simpan</button>
                              <button type="button" class="btn btn-default" onclick="clearForm()">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="panel-body">
                          <div class="form-horizontal">
                            <div class="form-group">
                              <label for="exampleInputEmail1" class="col-sm-4 control-label">Kategori</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="category" placeholder="Kategori" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Produk</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="product" placeholder="Nama Barang" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Harga Barang</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="unitPrice" placeholder="Email" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Stok Barang</label>
                              <div class="col-sm-8">
                                <input type="email" class="form-control" id="stock" placeholder="Stok Barang" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- /.table-responsive -->
              </div>
              <div class="panel panel-info">
                  <div class="panel-heading">
                    Tabel Detail Barang
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                            <tr role="row">
                              <th >ID Barang</th>
                              <th >Nama Barang</th>
                              <th >Harga Barang</th>
                              <th >Jumlah Barang</th>
                              <th >Jenis Barang</th>
                              <th >Tanggal Update Barang</th>
                              <th width="10%">Aksi</th>
                            </tr>
                          </thead>
                          {{--  @foreach($warehouse as $warehouses)
                          <tbody>
                              <tr class="gradeA odd" role="row">
                                <td class="sorting_1">{{$warehouses->id}}</td>
                                <td>{{$warehouses->name}}</td>
                                td>{{$warehouses->unitPrice}}</td>
                                <td>{{$warehouses->stock}}</td>
                                <td class="center">{{$warehouses->type}}</td>
                                <td class="center">{{$warehouses->data_update}}</td>
                                <td class="center">
                                    <!-- Button trigger modal -->
                                    <a href="{{route('warehouse.edit',$warehouses->id)}}" class="btn btn-success" data-toggle="modal" data-target="#ModalEdit">Edit</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDel">Hapus</button>
                                </td>
                              </tr>
                          </tbody>
                          @endforeach  --}}
                        </table>
                      </div>
                    </div>
                      <!-- /.table-responsive -->
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
