<?php 
// Include the database connection file
include('db_connect.php');
?>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            -ms-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -o-transform: scale(1.5);
            transform: scale(1.5);
            padding: 10px;
        }
    </style>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <!-- Notices Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Notices</b>
                        <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_notice">
                                <i class="fa fa-plus"></i> New
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="20%">
                                <col width="40%">
                                <col width="15%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Title</th>
                                    <th class="">Description</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Fetch notices from the database using the correct connection variable $conn
                                $i = 1;
                                $notices = $conn->query("SELECT * FROM notices ORDER BY created_at DESC");

                                while($row = $notices->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><b><?php echo ucwords($row['title']) ?></b></td>
                                    <td><p class="truncate"><?php echo substr($row['content'], 0, 100) . '...' ?></p></td>
                                    <td class="text-center"><?php echo date('M d, Y', strtotime($row['created_at'])) ?></td>
                                    <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_notice" data-id="<?php echo $row['id'] ?>">Edit</button>
    <button class="btn btn-sm btn-outline-info view_notice" data-id="<?php echo $row['id'] ?>">View</button>
    <button class="btn btn-sm btn-outline-danger delete_notice" data-id="<?php echo $row['id'] ?>">Delete</button>
    


                                       
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Notices Table Panel -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="manage-notice">
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="description" class="control-label">Description</label>
                            <textarea name="description" class="form-control text-jqte" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $('table').dataTable();
});

// Open Modal for New Notice
$('#new_notice').click(function(){
    $('#noticeModal .modal-title').text('New Notice');
    $('#manage-notice')[0].reset();  // Reset the form when adding a new notice
    $('#noticeModal').modal('show');
});

// Handle Submit of Notice Form
$('#manage-notice').submit(function(e){
    e.preventDefault();
    start_load();
    $.ajax({
        url: 'ajax.php?action=save_notice',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp){
            if(resp == 1){
                alert_toast("Notice successfully saved.", 'success');
                $('#noticeModal').modal('hide');
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        }
    });
});

// Edit Notice
$('.edit_notice').click(function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: 'ajax.php?action=get_notice',
        method: 'GET',
        data: {id: id},
        success: function(resp){
            var data = JSON.parse(resp);
            $('[name="id"]').val(data.id);
            $('[name="title"]').val(data.title);
            $('[name="description"]').val(data.description);
            $('#noticeModal .modal-title').text('Edit Notice');
            $('#noticeModal').modal('show');
        }
    });
});

// View Notice
$('.view_notice').click(function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: 'ajax.php?action=get_notice',
        method: 'GET',
        data: {id: id},
        success: function(resp){
            var data = JSON.parse(resp);
            $('[name="id"]').val(data.id);
            $('[name="title"]').val(data.title);
            $('[name="description"]').val(data.description);
            $('#noticeModal .modal-title').text('View Notice');
            $('#noticeModal').modal('show');
            // Disable form fields for viewing
            $('[name="title"]').prop('disabled', true);
            $('[name="description"]').prop('disabled', true);
            $('.modal-footer').hide(); // Hide the footer (Save/Close buttons) for view mode
        }
    });
});

// Enable form when opening for Edit or New Notice
$('#noticeModal').on('hidden.bs.modal', function () {
    $('[name="title"], [name="description"]').prop('disabled', false);
    $('.modal-footer').show(); // Show the footer (Save/Close buttons) when closing the modal
});

// Delete Notice
$('.delete_notice').click(function(){
    _conf("Are you sure to delete this notice?", "delete_notice", [$(this).attr('data-id')]);
});

function delete_notice(id){
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_notice',
        method: 'POST',
        data: {id: id},
        success: function(resp){
            if(resp == 1){
                alert_toast("Notice successfully deleted.", 'success');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        }
    });
}

// View Notice
$('.view_notice').click(function(){
    var id = $(this).attr('data-id');
    uni_modal("View Notice","view_notice.php?id="+id,'mid-large');
});



</script>
