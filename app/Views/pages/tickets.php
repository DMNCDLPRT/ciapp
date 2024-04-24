<?= $this->extend('template/admin_template') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1>Ticket Management</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalform"><i class="fa fa-plus mr-2"></i>Add Ticket</button>
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
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>State</th>
                            <th>Severity</th>
                            <th>Office</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
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

                        <?php if (auth()->loggedIn() && auth()->user()->inGroup('admin')) { ?>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select type="text" class="form-control" id="state" name="state" placeholder="Enter Ticket State"> 
                                <option value="">Select ticket state</option>
                                <option value="closed">Closed</option>
                                <option value="open">Open</option>
                            </select>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>

                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>

                        <div class="form-group">
                            <label for="office_id">Offices</label>
                            <select type="text" class="form-control" id="office_id" name="office_id" placeholder="Enter Office" required>
                                <option value=" "> Select Office</option>

                                <?php foreach ($offices as $office) : ?>
                                    <option value="<?= $office['id'] ?>"><?= $office['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>

                        <div class="form-group">
                            <label for="severity">Severity</label>
                            <select type="text" class="form-control" id="severity" name="severity" placeholder="Enter Ticket Severity" required>
                                <option value="high">high</option>
                                <option value="low">low</option>
                                <option value="medium">medium</option>
                            </select>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" rows="4" id="description" name="description" placeholder="Enter Ticket Description" required> </textarea>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>

                        <?php if (auth()->loggedIn() && auth()->user()->inGroup('admin')) { ?>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea type="text" class="form-control" rows="4" id="remarks" name="remarks" placeholder="Enter Ticket Remarks"></textarea>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">Please enter a valid code</div>
                        </div>
                        <?php } ?>
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
                        url: "<?= base_url('tickets') ?>",
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
                        url: "<?= base_url('tickets') ?>/" + formdata.id,
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
        lengthMenu: [10, 20, 50],
        searching: true,
        ordering: true,
        autoWidth: false,
        ajax: {
            url: '<?= base_url('tickets/list') ?>',
            type: 'POST',
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'fullname'
            },
            {
                data: 'email'
            },
            {
                data: 'state'
            },
            {
                data: 'severity'
            },
            {
                data: 'office_name'
            },
            {
                data: 'description',
                render: function(data, type, row) {
                    // Limit description to 100 characters
                    return type === 'display' && data.length > 80 ?
                        data.substr(0, 80) + '...' :
                        data;
                }
            },
            {
                data: 'created_at'
            },
            {
            data: null,
            render: function(data, type, row) {
                // Check severity and render buttons accordingly
                if (row.state === 'open') {
                    return `
                        <td class="d-flex">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-warning mr-2" id="editBtn">Edit</button>
                                <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                            </div>
                        </td>
                    `;
                } else {
                    return `<td>No Action Needed</td>`;
                }
            }
        }
        ],
        createdRow: function(row, data, dataIndex) {
            if (data.severity == 'low') {
                $(row).children("td:eq(4)").addClass('bg-success');
            } else if (data.severity == 'medium') {
                $(row).children("td:eq(4)").addClass('bg-warning');
            } else if (data.severity == 'high') {
                $(row).children("td:eq(4)").addClass('bg-danger');
            }
        }
    });

    $(document).on("click", "#editBtn", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        $.ajax({
            url: "<?= base_url('tickets'); ?>/" + id,
            type: "GET",
            success: function(response) {
                $("#modalform").modal('show');
                $("#id").val(response.id);
                $("#first_name").val(response.first_name);
                $("#last_name").val(response.last_name);
                $("#email").val(response.email);
                $("#state").val(response.state);
                $("#office_id").val(response.office_id);
                $("#severity").val(response.severity);
                $("#description").val(response.description);
                $("#remarks").val(response.remarks);
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
                url: "<?= base_url('tickets'); ?>/" + id,
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
        $("#first_name").val('');
        $("#last_name").val('');
        $("#email").val('');
        $("#office_id").val('');
        $("#state").val('');
        $("#severity").val('');
        $("#description").val('');
        $("#remarks").val('');
    }
</script>
<?= $this->endSection() ?>