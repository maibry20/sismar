function Mark() {
    var table;
    this.init = function () {
        table = this.table();
        $("#btnNew").click(this.new);
        $("#btnSave").click(this.save);
        $("#btnSavePermission").click(this.savePermission);
    }

    this.new = function () {
        $(".input-mark").cleanFields();
        $("#modalNew").modal("show");
    }

    this.savePermission = function () {
        toastr.remove();
        var data = {};
        data.arr = ($('#treeview-container').treeview('selectedValues')).join();
        $.ajax({
            url: 'mark/savePermission/' + $("#frm #id").val(),
            method: 'PUT',
            data: data,
            dataType: 'JSON',
            success: function (data) {
                toastr.success("Process Ok");
            }
        })
    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-mark").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "mark";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "mark/" + id;
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
        var url = "/mark/" + id + "/edit";
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

    this.delete = function (id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var token = $("input[name=_token]").val();
            var url = "/mark/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                method: "DELETE",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        table.ajax.reload();
                        toastr.warning("Ok");
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
            "ajax": "/api/listMark",
            columns: [
                {data: "id"},
                {data: "description"}
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.showModal(' + full.id + ')">' + data + '</a>';
                    }
                },
                {
                    targets: [2],
                    searchable: false,
                    mData: null,
                    mRender: function (data, type, full) {
                        html = '<button type="button" class="close" aria-label="Close" onclick="obj.delete(' + data.id + ')"><span aria-hidden="true">&times;</span></button>';
                        html += '<button class="btn btn-primary btn-xs" onclick="obj.showPermission(' + data.id + ')"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>';
                        return html;
                    }
                }
            ],
        });
    }

}

var obj = new Mark();
obj.init();