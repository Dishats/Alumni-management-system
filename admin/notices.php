<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
            transform: scale(1.5);
            padding: 10px;
        }
    </style>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Notices</b>
                        <span>
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_notice">
                                <i class="fa fa-plus"></i> New Notice
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="25%">
                                <col width="45%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $notices =  $conn->query("SELECT * FROM notices ORDER BY id DESC");
                                while($row=$notices->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><b><?php echo ucwords($row['title']) ?></b></td>
                                    <td><p class="truncate"><?php echo $row['description'] ?></p></td>
                                    <td><b><?php echo date('Y-m-d H:i', strtotime($row['date_created'])) ?></b></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary edit_notice" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete_notice" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>    
</div>

<!-- New Notice Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">New Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="noticeForm">
                    <input type="hidden" id="notice_id" name="notice_id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Notice</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }
    td p {
        margin: unset;
    }
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
    $(document).ready(function() {
        $('table').dataTable();

        // Show the new notice modal
        $('#new_notice').click(function() {
            $('#noticeModalLabel').text("New Notice");
            $('#noticeForm')[0].reset();
            $('#notice_id').val('');
            $('#noticeModal').modal('show');
        });

        // Save or update notice
        $('#noticeForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'ajax.php?action=save_notice',
                method: 'POST',
                data: formData,
                success: function(resp) {
                    alert_toast("Notice successfully saved!", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            });
        });

        // Edit notice
        $('.edit_notice').click(function() {
            const id = $(this).attr('data-id');
            $.ajax({
                url: 'ajax.php?action=get_notice',
                method: 'POST',
                data: {id: id},
                success: function(resp) {
                    const data = JSON.parse(resp);
                    $('#noticeModalLabel').text("Edit Notice");
                    $('#notice_id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    $('#noticeModal').modal('show');
                }
            });
        });

        // Delete notice
        $('.delete_notice').click(function() {
            const id = $(this).attr('data-id');
            _conf("Are you sure to delete this notice?", "delete_notice", [id]);
        });

        function delete_notice(id) {
            start_load();
            $.ajax({
                url: 'ajax.php?action=delete_notice',
                method: 'POST',
                data: {id: id},
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Notice successfully deleted", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        }
    });
</script>
