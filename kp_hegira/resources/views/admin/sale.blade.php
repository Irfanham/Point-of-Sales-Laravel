@extends('admin.layout_admin')

@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="form-group" style="margin-top:20px;">
      <div class="well" id="leftdiv">
        <div id="lefttop" style="margin-bottom:5px;">      
          <div class="form-group" style="margin-bottom:5px;">
            <input type="text" name="customer" value="" id="pelanggan" class="form-control kb-text" placeholder="Masukkan  Id Pelanggan">
          </div>
          <div class="form-group" style="margin-bottom:5px;">
            <input type="text" name="code" id="add_item" class="form-control ui-autocomplete-input" placeholder=" Nama barang atau scan barcode" autocomplete="off">
          </div>
        </div>
        <div id="print" class="fixed-table-container">
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
            <div id="list-table-div" style="overflow: hidden; width: auto; height: au;">
              <div class="fixed-table-header">
                <table class="table table-striped table-condensed table-hover list-table" style="margin:0;">
                <thead>
                <tr class="success">
                  <th>Product</th>
                  <th style="width: 15%;text-align:center;">Price</th>
                  <th style="width: 15%;text-align:center;">Qty</th>
                  <th style="width: 20%;text-align:center;">Subtotal</th>
                  <th style="width: 20px;" class="satu">
                    <i class="fa fa-trash-o"></i>
                  </th>
                </tr>
                </thead>
                </table>
              </div>          
            </div>
            <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 282px;"></div>
            <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
          </div>
          <div style="clear:both;"></div>
          <div id="totaldiv">
            <table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px;">
            <tbody>
            <tr class="info">
              <td width="25%">Total Items</td>
              <td class="text-right" style="padding-right:10px;">
                <span id="count">0 (0.00)</span>
              </td>
              <td width="25%">Total</td>
              <td class="text-right" colspan="2">
                <span id="total">0.00</span>
              </td>
            </tr>
            <tr class="info">
              <td width="25%">
                <a href="#" id="add_discount">Discount</a>
              </td>
              <td class="text-right" style="padding-right:10px;">
                <span id="ds_con">(0.00) 0.00</span>
              </td>
              <td width="25%">
                <a href="#" id="add_tax">Order Tax</a>
              </td>
              <td class="text-right">
                <span id="ts_con">0.00</span>
              </td>
            </tr>
            <tr class="success">
              <td colspan="2" style="font-weight:bold;">
                 Total Payable <a role="button" data-toggle="modal" data-target="#noteModal"><i class="fa fa-comment"></i></a>
              </td>
              <td class="text-right" colspan="2" style="font-weight:bold;">
                <span id="total-payable">0.00</span>
              </td>
            </tr>
            </tbody>
            </table>
          </div>
        </div>
      <div id="botbuttons" class="col-xs-12 text-center">
        <div class="row">
          <div class="col-xs-4" style="padding: 0;">
            <div class="btn-group-vertical btn-block">
              <button type="button" class="btn btn-warning btn-block btn-flat" id="suspend">Hold</button>
              <button type="button" class="btn btn-danger btn-block btn-flat" id="reset">Cancel</button>
            </div>
          </div>
          <div class="col-xs-4" style="padding: 0 5px;">
            <div class="btn-group-vertical btn-block">
              <button type="button" class="btn bg-purple btn-block btn-flat" id="print_order">Print Order</button>
              <button type="button" class="btn bg-navy btn-block btn-flat" id="print_bill">Print Bill</button>
            </div>
          </div>
          <div class="col-xs-4" style="padding: 0;">
            <button type="button" class="btn btn-success btn-block btn-flat" id="payment" style="height:67px;">Payment</button>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <span id="hidesuspend"></span>
      <input type="hidden" name="spos_note" value="" id="spos_note">
      <div id="payment-con">
        <input type="hidden" name="amount" id="amount_val" value="">
        <input type="hidden" name="balance_amount" id="balance_val" value="">
        <input type="hidden" name="paid_by" id="paid_by_val" value="cash">
        <input type="hidden" name="cc_no" id="cc_no_val" value="">
        <input type="hidden" name="paying_gift_card_no" id="paying_gift_card_no_val" value="">
        <input type="hidden" name="cc_holder" id="cc_holder_val" value="">
        <input type="hidden" name="cheque_no" id="cheque_no_val" value="">
        <input type="hidden" name="cc_month" id="cc_month_val" value="">
        <input type="hidden" name="cc_year" id="cc_year_val" value="">
        <input type="hidden" name="cc_type" id="cc_type_val" value="">
        <input type="hidden" name="cc_cvv2" id="cc_cvv2_val" value="">
        <input type="hidden" name="balance" id="balance_val" value="">
        <input type="hidden" name="payment_note" id="payment_note_val" value="">
      </div>
      <input type="hidden" name="customer" id="customer" value="3">
      <input type="hidden" name="order_tax" id="tax_val" value="5%">
      <input type="hidden" name="order_discount" id="discount_val" value="0">
      <input type="hidden" name="count" id="total_item" value="">
      <input type="hidden" name="did" id="is_delete" value="0">
      <input type="hidden" name="eid" id="is_delete" value="0">
      <input type="hidden" name="total_items" id="total_items" value="0">
      <input type="hidden" name="total_quantity" id="total_quantity" value="0">
      <input type="submit" id="submit" value="Submit Sale" style="display: none;">
    </div>
  </div>  
</div>

  <!-- asjdlk -->
  <div class="col-md-7">
    <div class="form-group" style="margin-top:20px;">
      <div class="well" id="leftdiv">
        <div class="contents" id="right-col">
          <div id="item-list">
            <div class="items">
              <div>
                <button type="button" data-name="Minion Hi" id="product-0101" type="button" value='TOY01' class="btn btn-both btn-flat product">
                  <span class="bg-img">
                    <img src="https://spos.tecdiary.com/uploads/thumbs/6988655f95602f9394f9315165f920fe.png" alt="Minion Hi" style="width: 100px; height: 100px;">
                  </span>
                  <span>
                    <span>Minion Hi</span>
                  </span>
                </button>
                <button type="button" data-name="Minion Banana" id="product-0102" type="button" value='TOY02' class="btn btn-both btn-flat product">
                  <span class="bg-img">
                    <img src="https://spos.tecdiary.com/uploads/thumbs/213c9e007090ca3fc93889817ada3115.png" alt="Minion Banana" style="width: 100px; height: 100px;">
                  </span>
                  <span>
                    <span>Minion Banana</span>
                  </span>
                </button>
              </div>
            </div>
          </div>
          <div class="product-nav">
            <div class="btn-group btn-group-justified">
              <div class="btn-group">
                <button style="z-index:10002;" class="btn btn-warning pos-tip btn-flat" type="button" id="previous"><i class="fa fa-chevron-left"></i></button>
              </div>
              <div class="btn-group">
                <button style="z-index:10003;" class="btn btn-success pos-tip btn-flat" type="button" id="sellGiftCard"><i class="fa fa-credit-card" id="addIcon"></i> Sell Gift Card</button>
              </div>
              <div class="btn-group">
                <button style="z-index:10004;" class="btn btn-warning pos-tip btn-flat" type="button" id="next"><i class="fa fa-chevron-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>    
  </div>
</div>


@endsection


                                             
@section('script')
<script>
    var urlApi='http://localhost:8000/api/sale/';
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
                         "title": "Nama Pemasok","data": "name"
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