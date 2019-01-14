@extends('admin.layout_admin')

@section('content')
<div class="row page-header">
    <div class="col-lg-8">
        <h1 class="">Data Gudang</h1>
    </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-sm-12">
      <!-- Button trigger modal -->
      <ul class="nav navbar-nav">
        <li>
          <button type="button" class="btn btn-primary btn-sm" onclick='$("#myModal").modal();buttonAction("add");'>
            Tambah
          </button>
        </li>
      </ul>
      <ul class="nav nav-pills navbar-nav navbar-right">
        <li class="active">
          <a href="#th-list" data-toggle="pill" class="btn btn-default glyphicon glyphicon-th-list" role="button"></a>
        </li>
        <li>
          <a href="#th" data-toggle="pill" class="btn btn-default glyphicon glyphicon-th" role="button"></a>
        </li>
      </ul>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Data Gudang</h4>
        </div>
        <div class="modal-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Barang</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama Barang">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Harga Barang</label>
                <input type="text" class="form-control" id="unitPrice" placeholder="Harga Barang">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Jumlah Barang</label>
                <input type="text" class="form-control" id="stock" placeholder="Jumlah Barang">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Jenis Barang</label>
                <input type="text" class="form-control" id="type" placeholder="Jenis Barang">
              </div>
              <div class="form-group">
                <!-- Calender Picker -->
                <label for="exampleInputPurchase1">Tanggal Update Barang</label>
                <input type="date" id="date" class="form-control" placeholder="DD/MM/YYYY">
              </div>
            <div class="form-group">
              <label for="exampleInputFile">Unggang Gambar</label>
              <input type="file" id="avatar">
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" onclick="dataCreate()" id="modal_add" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="dataUpdate()" id="modal_edit" class="btn btn-primary">Ubah</button>
            <button type="button" class="btn btn-default" onclick="clearModalHide()">Batal</button>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
<div class="form-group">
  <div class="row">
    <div class="col-lg-12 tab-content">
      <div class="panel panel-default tab-pane fade active in" id="th-list">
        <div class="panel-heading">
                  Daftar Data Gudang
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
        </div>
      <!-- /.table-responsive -->
      </div>
      <div class="panel panel-default tab-pane fade" id="th">
        <div class="panel-heading">
                  Daftar Data Gudang
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            @foreach($warehouse as $warehouses)
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="{{$warehouses->img}}" alt="produk">
                <div class="caption">
                  <p><b>ID: </b><span>{{$warehouses->id}}</span></p>

                  <p><b>Nama:</b> <span>{{$warehouses->name}}</span></p>
                  <p><b>Jumlah:</b> <span>{{$warehouses->unitPrice}}</span></p>
                  <p><b>Jumlah:</b> <span>{{$warehouses->stock}}</span></p>

                  <p><b>Jenis:</b> {{$warehouses->type}}</p>

                  <p><b>Tanggal Update:</b> <span>{{$warehouses->date_update}}</span></p>

                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      <!-- /.table-responsive -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    var urlApi='http://localhost:8000/api/warehouse/';
    var data=[];
    var dataGet;
    var table;
         $(document).ready(function(){
             table = $('#dataTables-example').DataTable({
                     "processing": true,
                     "serverSide": false,
                     "info": true,
                     "stateSave": true,
                     "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                     "ajax": {
                         "url": urlApi,
                         "type": "GET",
                         "dataSrc" : "data"
                     },
                     "language": {
                         "search": "",
                         "searchPlaceholder": "Search..."
                     },
                     "columns": [{
                         "title": "Id","data": "id"
                     }, {
                         "title": "Nama","data": "name"
                     }, {
                         "title": "Harga Barang","data": "unitPrice"
                     },{
                         "title": "Jumlah","data": "stock"
                     }, {
                         "title": "Jenis","data": "type"
                     }, {
                         "title": "Tanggal Update","data": "date_update"
                     }, {
                         "title": "Aksi", "searchable": false, "sortable": false, "data": "id",
                         "render": function (data, type, full, meta) {
                             return '<center><button class="btn btn-warning btn-sm btn-edit" type="button"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger btn-sm btn-delete"  type="button"><i class="fa fa-trash-o"></i></button></center>'
                         }
                     }]
            });
            table.column(0).visible(true);
            $('#dataTables-example tbody').on("click","button.btn-edit",function(){
                dataGet = table.row($(this).parents('tr')).data();

                $("#id").val(dataGet.id);
                $("#nama").val(dataGet.name);
                $("#unitPrice").val(dataGet.unitPrice);
                $("#stock").val(dataGet.stock);
                $("#type").val(dataGet.type);
                $("#date").val(dataGet.date_update);

                buttonAction("edit");

                $("#myModal").modal();
            });

            $('#dataTables-example tbody').on('click', 'button.btn-delete', function () {
                dataGet = table.row($(this).parents('tr')).data();

                if (confirm("Apakah anda yakin hapus data ")) {
                    dataDelete()
                } else {
                    console.log('nooo')
                }
            });


         });

         function reloadDataTable() {
             clearModalHide();
             $.ajax({
                 method: "GET",
                 url: urlApi,
                 success: function (val) {
                     table.clear().draw();
                     table.rows.add(val.data).draw();
                 }
             })
         }

        function clearModalHide() {
            dataGet = {}
            $("#nama").val('');
            $("#unitPrice").val('');
            $("#stock").val('');
            $("#type").val('');
            $("#date").val('');
            $("#avatar").val('');
            $('#myModal').modal('hide');
        }

        function buttonAction(params) {
            if (params === 'add') {
                $('#modal_add').show();
                $('#modal_edit').hide();
            } else if (params === 'edit') {
                $('#modal_add').hide();
                $('#modal_edit').show();
            }
        }

        function dataCreate() {
            var name = $("#nama").val();
            var unitPrice = $("#unitPrice").val();
            var stock = $("#unitPrice").val();
            var type = $("#type").val();
            var date = $("#date").val();
            var avatar = $("#avatar").val();


            if (nama && unitPrice && stock && type && date && avatar) {
                return $.ajax({
                    method: "POST",
                    url: urlApi,
                    data: { name, unitPrice, stock, type, date, avatar },
                    success: function (data) {
                        if (data.error) {
                            return messageError(data.error)
                        }

                        reloadDataTable();
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        clearModalHide()
                        return alert('coba lagi nanti!')
                    }
                });
            } else {
                return messageError('harus diisi semua!')
            }
        }

        function dataUpdate() {
          var name = $("#nama").val();
          var unitPrice = $("#unitPrice").val();
          var stock = $("#unitPrice").val();
          var type = $("#type").val();
          var date = $("#date").val();
          var avatar = $("#avatar").val();
          console.log(dataGet.id);

            if (nama && unitPrice && stock && type && date && avatar) {
                $.ajax({
                    method: "PUT",
                    url: urlApi + dataGet.id,
                    data: { name, unitPrice, stock, type, date, avatar },
                    success: function (data) {
                        console.log(data, 'sukses')
                        reloadDataTable();
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        clearModalHide()
                        return alert('coba lagi nanti!')
                    }
                });
            } else {
                return messageForm('harus diisi semua!')
            }
        }

        function dataDelete() {
            $.ajax({
                url: urlApi + dataGet.id,
                type: 'DELETE',
                success: function (result) {
                    console.log(result, ' delete data')
                    if (result.error) {
                        return messageError(result.error)
                    }
                    reloadDataTable();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    clearModalHide()
                    return alert('coba lagi nanti!')
                }
            });
        }

        function messageError(params) {
            setTimeout(() => {
                $('#modal_error_message').hide(300);
                $('#modal_error_message').text('');
            }, 3000);
            $('#modal_error_message').show();
            $('#modal_error_message').text(params);
        }
</script>
@endsection
