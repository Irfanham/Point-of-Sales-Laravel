@extends('admin.layout_admin')

@section('content')
<div class="row page-header">
    <div class="col-lg-12">
        <h1>Tambah Pengguna</h1>
    </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-4">
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm" onclick='$("#myModal").modal();buttonAction("add");'>
            Tambah
          </button>
        </div>
      </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Data Pengguna</h4>
          </div>
          <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                  <input type="text" class="form-control" id="status" placeholder="Jabatan">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kontak</label>
                  <input type="text" class="form-control" id="contact" placeholder="Nomor Telepon">
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
</div>
<!-- /.row -->
<div class="form-group">
  <div class="row">
    <div class="col-lg-12 tab-content">
      <div class="panel panel-default">
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
                    <th >Nama</th>
                    <th >Email</th>
                    <th >Password</th>
                    <th >Status</th>
                    <th >Kontak</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                {{--  @foreach($warehouse as $warehouses)
                <tbody>
                    <tr class="gradeA odd" role="row">
                      <td class="sorting_1">{{$warehouses->id}}</td>
                      <td>{{$warehouses->name}}</td>
                      <td>{{$warehouses->qty}}</td>
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
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    var urlApi='http://localhost:8000/api/employee/';
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
                         "title": "Nama","data": "name"
                     }, {
                         "title": "Email","data": "email"
                     }, {
                         "title": "Password","data": "password"
                     }, {
                         "title": "Status","data": "status"
                     }, {
                         "title": "Kontak","data": "contact"
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

                $("#name").val(dataGet.name);
                $("#email").val(dataGet.email);
                $("#password").val(dataGet.password);
                $("#status").val(dataGet.status);
                $("#contact").val(dataGet.contact);

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
            $("#name").val('');
            $("#email").val('');
            $("#password").val('');
            $("#status").val('');
            $("#contact").val('');
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
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var status = $("#status").val();
            var contact = $("#contact").val();


            if (name && email && password && status && contact) {
                return $.ajax({
                    method: "POST",
                    url: urlApi,
                    data: { name, email, password, status, contact },
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
          var name = $("#name").val();
          var email = $("#email").val();
          var password = $("#password").val();
          var status = $("#status").val();
          var contact = $("#contact").val();
          console.log(dataGet.id);

            if (name && email && password && status && contact) {
                $.ajax({
                    method: "PUT",
                    url: urlApi + dataGet.id,
                    data: { name, email, password, status, contact },
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
