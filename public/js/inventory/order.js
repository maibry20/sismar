function Order() {
    var table;
    this.init = function () {
        table = this.table();
        $("#btnNew").click(this.new);
        $("#btnSave").click(this.save);

    }

    this.new = function () {
        $(".input-order").cleanFields();
    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-order").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "order";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "order/" + id;
                msg = "Edited Record";
            }

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        $("#modalNew").modal("hide");
                        table.ajax.reload();
                        toastr.success(msg);
                    }
                }
            })
        } else {
            toastr.error("Fields Required!");
        }
    }

    this.showModal = function (id) {
        var frm = $("#frmEdit");
        var data = frm.serialize();
        var url = "/order/" + id + "/edit";
        $("#modalNew").modal("show");
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#frm #id").val(data.id);
                $("#frm #description").val(data.description);
            }
        })
    }

    this.deliveryElement = function (id) {
        toastr.remove();

        if (confirm("Realmente deseas Devolver?")) {
            var token = $("input[name=_token]").val();
            var url = "/order/delivery/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                method: "PUT",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        table.ajax.reload();
                        toastr.success("Ok");
                    }
                }, error: function (err) {
                    toastr.error("No se puede borrra Este registro");
                }
            })
        }
    }

    this.requestElement = function (id) {
        toastr.remove();

        if (confirm("Realmente deseas Solicitarlo?")) {
            var token = $("input[name=_token]").val();
            var url = "/order/reserve/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                method: "PUT",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        table.ajax.reload();
                        toastr.success("Ok");
                    }
                }, error: function (err) {
                    toastr.error("No se puede borrra Este registro");
                }
            })
        }
    }


    this.table = function () {
        var html = "";
        return $('#tbl').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/api/listOrder",
            columns: [
                {data: "id"},
                {data: "device"},
                {data: "serial"},
                {data: "category"},
                {data: "order"},
                {data: "freserve", render: function (data, type, full, meta) {
                        return data;
                    }
                },
                {data: "fdelivery"},
                {data: "status"},
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1, 2, 3, 4, 5],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.showModal(' + full.id + ')">' + data + '</a>';
                    }
                },
                {
                    targets: [8],
                    searchable: false,
                    mData: null,
                    mRender: function (data, type, full) {
                        if (full.status_id == 1) {
                            html = '<button type="button" class="btn btn-primary btn-xs" onclick="obj.requestElement(' + data.id + ')">Reservar</button>';
                        } else {
                            html = '<button type="button" class="btn btn-success btn-xs" onclick="obj.deliveryElement(' + data.id + ')">Devolver</button>';
                        }
                        return html;
                    }
                }
            ],
        });
    }

}

var obj = new Order();
obj.init();