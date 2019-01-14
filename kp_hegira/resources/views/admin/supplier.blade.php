@extends('admin.layout_admin')

@section('content')
<div class="row page-header">
    <div class="col-lg-8">
        <h1 class="">Data Pemasok</h1>
    </div>
</div>
<div class="">
  <div class="row form-group">
    <div class="col-sm-4">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm" onclick='$("#myModal").modal();buttonAction("add")'>
        Tambah
      </button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" onclick="clearModalHide()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Tambah Data Pemasok</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pemasok</label>
                  <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Pemasok">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="email"></input>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nomor Telepon</label>
                  <input type="text" class="form-control" id="no" name="contact" placeholder="No. Telepon">
                </div>
                <div id="modal_error_message"></div>
                <div class="modal-footer">
                  <button type="button" onclick="dataCreate()" id="modal_add" class="btn btn-primary">Simpan</button>
                  <button type="button" onclick="dataUpdate()" id="modal_edit" class="btn btn-primary">Update</button>
                  <button type="button" class="btn btn-default" onclick="clearModalHide()">Batal</button>
                </div>
            </div>            
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>
<!-- /.row -->
<div class="">
    <div class="row form-group">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Data Pemasok
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th >Id</th>
                                          <th >Nama Pemasok</th>
                                          <th >Email Pemasok</th>
                                          <th >No. Telepon Pemasok</th>
                                          <th width="10%">Aksi</th>
                                      </tr>
                                  </thead>

                                  {{--  @foreach($suppliers as $supplier)
                                  <tbody>
                                      <tr class="gradeA odd" role="row">
                                          <td class="sorting_1">{{$supplier->Id Pemasok}}</td>
                                          <td>{{$supplier->Nama Pemasok}}</td>
                                          <td>{{$supplier->Email Pemasok}}</td>
                                          <td class="center">{{$supplier->No. Telepon Pemasok}}</td>
                                          <td class="center">
                                              <!-- Button trigger modal -->
                                              <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-success" data-toggle="modal" data-target="#ModalEdit">Edit</a>

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
</div>
@endsection


                                             
@section('script')
<script>
    var urlApi='http://localhost:8000/api/supplier/';
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
                         "title": "Nama ","data": "name"
                     }, {
                         "title": "Email","data": "email"
                     }, {
                         "title": "No. Telepon","data": "contact"
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
                $("#email").val(dataGet.email);
                $("#no").val(dataGet.contact);

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
            $("#id").val('');
            $("#nama").val('');
            $("#email").val('');
            $("#no").val('');
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
            var email = $("#email").val();
            var contact = $("#no").val();


            if (name && email && contact ) {
                return $.ajax({
                    method: "POST",
                    url: urlApi,
                    data: {name, email, contact },
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
            var email = $("#email").val();
            var contact = $("#no").val();
            console.log(dataGet.id);

            if (name && email && contact ) {
                $.ajax({
                    method: "PUT",
                    url: urlApi + dataGet.id,
                    data: {name,email,contact},
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
                type: "DELETE",
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