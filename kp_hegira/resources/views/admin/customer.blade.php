@extends('admin.layout_admin')

@section('content')
<div class="row page-header">
    <div class="col-lg-8">
        <h1 class="">Data Pelanggan</h1>
    </div>
</div>
<div class="">
  <div class="row form-group">
    <div class="col-sm-4">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm" onclick='$("#myModal").modal();buttonAction("add");'>
        Tambah
      </button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" onclick="clearModalHide()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Tambah Data Pelanggan</h4>
            </div>
            <div class="modal-body">
             <!--  <form class="" action="{{URL::to('customer')}}" method="post"> -->
                {{csrf_field()}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pelanggan</label>
                  <input type="text" name="name" id="nama" class="form-control"  placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat</label>
                  <textarea class="form-control" id="alamat" name="address" rows="3" placeholder="Alamat"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nomor Telepon</label>
                  <input type="text" name="contact"  class="form-control" id="no" placeholder="Nomor Telepon">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div id="modal_error_message"></div>
                <div class="modal-footer">
              <button type="button" onclick="dataCreate()" id="modal_add" class="btn btn-primary">Simpan</button>
              <button type="button" onclick="dataUpdate()" id="modal_edit" class="btn btn-primary">Ubah</button>
              <button type="button" class="btn btn-default" onclick="clearModalHide()">Batal</button>

            </div>
             <!--  </form> -->
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
                  Daftar Data Pelanggan
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="row">
                        <div class="col-sm-12">

                              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th >Id</th>
                                          <th >Nama</th>
                                          <th >Alamat</th>
                                          <th >Telepon</th>
                                          <th >Email</th>
                                          <th width="10%">Aksi</th>
                                      </tr>
                                  </thead>

                                  {{--  @foreach($customers as $customer)
                                  <tbody>
                                      <tr class="gradeA odd" role="row">
                                          <td class="sorting_1">{{$customer->name}}</td>
                                          <td>{{$customer->address}}</td>
                                          <td>{{$customer->contact}}</td>
                                          <td class="center">{{$customer->email}}</td>
                                          <td class="center">
                                              <!-- Button trigger modal -->
                                              <a href="{{route('customer.edit',$customer->id)}}" class="btn btn-success" data-toggle="modal" data-target="#ModalEdit">Edit</a>

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
    var urlApi='http://localhost:8000/api/customer/';
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
                         "title": "Alamat","data": "address"
                     }, {
                         "title": "No HP","data": "contact"
                     }, {
                         "title": "Email","data": "email"
                     }, {
                         "title": "Aksi", "searchable": false, "sortable": false, "data": "id",
                         "render": function (data, type, full, meta) {
                             return '<center><button class="btn btn-warning btn-sm btn-edit" type="button"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger btn-sm btn-delete"  type="button"><i class="fa fa-trash-o"></i></button></center>'
                         }
                     }]
            });
            table.column(0).visible(false);
            $('#dataTables-example tbody').on("click","button.btn-edit",function(){
                dataGet = table.row($(this).parents('tr')).data();

                $("#nama").val(dataGet.name);
                $("#email").val(dataGet.email);
                $("#no").val(dataGet.contact);
                $("#alamat").val(dataGet.address);

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
            $("#email").val('');
            $("#no").val('');
            $("#alamat").val('');
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
            var address = $("#alamat").val();
            var contact = $("#no").val();


            if (name && email && address && contact ) {
                return $.ajax({
                    method: "POST",
                    url: urlApi,
                    data: { name, email, address, contact },
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
            var address = $("#alamat").val();
            var email = $("#email").val();
            var contact = $("#no").val();
            console.log(dataGet.id);

            if (name && address && email && contact ) {
                $.ajax({
                    method: "PUT",
                    url: urlApi + dataGet.id,
                    data: { name,email,address,contact},
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
