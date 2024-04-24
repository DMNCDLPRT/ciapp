<?= $this->extend('template/admin_template') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1>Offiice Mannagement</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalform"><i class="fa fa-plus mr-2"></i>Add Office</button>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row  mb-2">
            <div class="col-12">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CODE</th>
                            <th>NAME</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Office</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="card-body">
                        <input type="hidden" id="id" name="id" />
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Office Code" required>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>

                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Office Name" required>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>



            </div>
            <!-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascripts') ?>
<script>
    $(function() {
        $('form').submit(function(e) {
            e.preventDefault();

            let formdata = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            // alert(JSON.stringify(formdata));
            let jsondata = JSON.stringify(formdata);

            if (this.checkValidity()) {

                if (!formdata.id) {
                    //create
                    $.ajax({
                        url: "<?= base_url('offices') ?>",
                        type: "POST",
                        data: jsondata,
                        success: function(response) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'SUCCESS',
                                body: JSON.stringify(response.message),
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalform").modal('hide');
                            table.ajax.reload();
                            clearform();
                        },
                        error: function(response) {
                            let parseresponse = JSON.parse(response.responseText);
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'ERROR',
                                body: JSON.stringify(parseresponse.message),
                                autohide: true,
                                delay: 3000
                            });
                        },
                    });
                } else {
                    // update
                    $.ajax({
                        url: "<?= base_url('offices') ?>/" + formdata.id,
                        type: "PUT",
                        data: jsondata,
                        success: function(response) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'SUCCESS',
                                body: JSON.stringify(response.message),
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalform").modal('hide');
                            table.ajax.reload();
                            clearform();
                        },
                        error: function(response) {
                            let parseresponse = JSON.parse(response.responseText);
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'ERROR',
                                body: JSON.stringify(parseresponse.message),
                                autohide: true,
                                delay: 3000
                            });
                        },
                    });
                }


            }


        });
    });

    let table = $("#datatable").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        lengthMenu: [5, 10, 20, 50],
        searching: true,
        ordering: true,
        autoWidth: false,
        ajax: {
            url: '<?= base_url('offices/list') ?>',
            type: 'POST',
        },
        columns: [{
            data: 'id',
        }, {
            data: 'code',
        }, {
            data: 'name',
        }, {
            data: '',
            defaultContent: `
                <td>
                <button type="button" class="btn btn-warning" id="editBtn">Edit</button>
                <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                </td>
                `
        }],
    });

    $(document).on("click", "#editBtn", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        $.ajax({
            url: "<?= base_url('offices'); ?>/" + id,
            type: "GET",
            success: function(response) {
                $("#modalform").modal('show');
                $("#id").val(response.id);
                $("#code").val(response.code);
                $("#name").val(response.name);
            },
            error: function(response) {
                let parseresponse = JSON.parse(response.responseText);
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'ERROR',
                    body: JSON.stringify(parseresponse.message),
                    autohide: true,
                    delay: 3000
                });
            },
        });

    });


    $(document).on("click", "#deleteBtn", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        if (confirm("Are you sure you want to delete this item?")) {
            $.ajax({
                url: "<?= base_url('offices'); ?>/" + id,
                type: "DELETE",
                success: function(response) {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'SUCCESS',
                        body: JSON.stringify(response.message),
                        autohide: true,
                        delay: 3000
                    });
                    table.ajax.reload();
                },
                error: function(response) {
                    let parseresponse = JSON.parse(response.responseText);
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'ERROR',
                        body: JSON.stringify(parseresponse.message),
                        autohide: true,
                        delay: 3000
                    });
                },
            });
        }

    });

    $(document).ready(function() {
        'use strict';
        let form = $(".needs-validation");
        form.each(function() {
            $(this).on('submit', function(e) {
                if (this.checkValidity() === false) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    });


    function clearform() {
        $("#id").val('');
        $("#code").val('');
        $("#name").val('');
    }
</script>
<?= $this->endSection() ?>