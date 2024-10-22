<?php 
include 'db_connect.php'; 

$id = isset($_GET['id']) ? $_GET['id'] : '';
$title = '';
$description = '';

if($id){
    $result = $conn->query("SELECT * FROM notices WHERE id = $id");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
    }
}
?>
<form id="noticeForm">
    <input type="hidden" id="noticeId" name="id" value="<?php echo $id; ?>">
    <label for="titleInput">Title:</label>
    <input type="text" id="titleInput" name="title" value="<?php echo $title; ?>" required>
    <br>
    <label for="descriptionInput">Description:</label>
    <textarea id="descriptionInput" name="description" required><?php echo $description; ?></textarea>
    <br>
    <button type="submit">Save Notice</button>
</form>

<script>
    $('#noticeForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: 'admin/ajax.php?action=save_notice',
            type: 'POST',
            data: {
                id: $('#noticeId').val(),
                title: $('#titleInput').val(),
                description: $('#descriptionInput').val()
            },
            success: function(response) {
                if (response == 1) {
                    alert_toast("Notice saved successfully.", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    alert_toast("Failed to save notice.", 'danger');
                }
            }
        });
    });
</script>
