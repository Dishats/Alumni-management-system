<?php
ob_start();
include 'admin_class.php';
$crud = new Action();

// Check if 'action' exists in GET or POST
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

if ($action) {
    if ($action == 'login') {
        $login = $crud->login();
        if ($login)
            echo $login;
    }
    if ($action == 'login2') {
        $login = $crud->login2();
        if ($login)
            echo $login;
    }
    if ($action == 'logout') {
        $logout = $crud->logout();
        if ($logout)
            echo $logout;
    }
    if ($action == 'logout2') {
        $logout = $crud->logout2();
        if ($logout)
            echo $logout;
    }
    if ($action == 'save_user') {
        $save = $crud->save_user();
        if ($save)
            echo $save;
    }
    if ($action == 'delete_user') {
        $save = $crud->delete_user();
        if ($save)
            echo $save;
    }
    if ($action == 'signup') {
        $save = $crud->signup();
        if ($save)
            echo $save;
    }
    if ($action == 'update_account') {
        $save = $crud->update_account();
        if ($save)
            echo $save;
    }
    if ($action == "save_settings") {
        $save = $crud->save_settings();
        if ($save)
            echo $save;
    }
    if ($action == "save_course") {
        $save = $crud->save_course();
        if ($save)
            echo $save;
    }
    if ($action == "delete_course") {
        $delete = $crud->delete_course();
        if ($delete)
            echo $delete;
    }
    if ($action == "update_alumni_acc") {
        $save = $crud->update_alumni_acc();
        if ($save)
            echo $save;
    }
    if ($action == "save_gallery") {
        $save = $crud->save_gallery();
        if ($save)
            echo $save;
    }
    if ($action == "delete_gallery") {
        $save = $crud->delete_gallery();
        if ($save)
            echo $save;
    }
    if ($action == "save_career") {
        $save = $crud->save_career();
        if ($save)
            echo $save;
    }
    if ($action == "delete_career") {
        $save = $crud->delete_career();
        if ($save)
            echo $save;
    }
    if ($action == "save_forum") {
        $save = $crud->save_forum();
        if ($save)
            echo $save;
    }
    if ($action == "delete_forum") {
        $save = $crud->delete_forum();
        if ($save)
            echo $save;
    }
    if ($action == "save_comment") {
        $save = $crud->save_comment();
        if ($save)
            echo $save;
    }
    if ($action == "delete_comment") {
        $save = $crud->delete_comment();
        if ($save)
            echo $save;
    }
    if ($action == "save_event") {
        $save = $crud->save_event();
        if ($save)
            echo $save;
    }
    if ($action == "delete_event") {
        $save = $crud->delete_event();
        if ($save)
            echo $save;
    }
    if ($action == "participate") {
        $save = $crud->participate();
        if ($save)
            echo $save;
    }
    if ($action == "get_venue_report") {
        $get = $crud->get_venue_report();
        if ($get)
            echo $get;
    }
    if ($action == "save_art_fs") {
        $save = $crud->save_art_fs();
        if ($save)
            echo $save;
    }
    if ($action == "delete_art_fs") {
        $save = $crud->delete_art_fs();
        if ($save)
            echo $save;
    }
    if ($action == "get_pdetails") {
        $get = $crud->get_pdetails();
        if ($get)
            echo $get;
    }
    if ($action == 'save_notice') {
        $save = $crud->save_notice();
        if ($save)
            echo $save;
    }
    if ($action == 'delete_notice') {
        $delete = $crud->delete_notice();
        if ($delete)
            echo $delete;
    }
    if ($action == 'get_notices') {
        $get = $crud->get_notices();
        if ($get)
            echo $get;
    }
    if ($action == 'get_notice' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $qry = $conn->query("SELECT * FROM notices WHERE id = $id");
        if($qry->num_rows > 0){
            echo json_encode($qry->fetch_assoc());
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $middlename = $conn->real_escape_string($_POST['middlename']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $batch = $conn->real_escape_string($_POST['batch']);
    $course_id = $conn->real_escape_string($_POST['course_id']);
    $email = $conn->real_escape_string($_POST['email']);
    $country_code = $conn->real_escape_string($_POST['country_code']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $employed = $conn->real_escape_string($_POST['employed']);
    $mentorship = $conn->real_escape_string($_POST['mentorship']);
    $mentorship_domain = isset($_POST['mentorship_domain']) ? $conn->real_escape_string($_POST['mentorship_domain']) : NULL;
    $linkedin = isset($_POST['linkedin']) ? $conn->real_escape_string($_POST['linkedin']) : NULL;
    
    $avatar = NULL;
    if (!empty($_FILES['img']['tmp_name'])) {
        $imagePath = 'uploads/' . basename($_FILES['img']['name']);
        move_uploaded_file($_FILES['img']['tmp_name'], $imagePath);
        $avatar = $conn->real_escape_string($imagePath);
    }

    $check = $conn->query("SELECT * FROM alumnus_bio WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo '2';
    } else {
        $query = "INSERT INTO alumnus_bio (firstname, middlename, lastname, gender, batch, course_id, email, country_code, phone, employed, mentorship, mentorship_domain, linkedin, avatar, status, date_created) 
                  VALUES ('$firstname', '$middlename', '$lastname', '$gender', '$batch', '$course_id', '$email', '$country_code', '$phone', '$employed', '$mentorship', '$mentorship_domain', '$linkedin', '$avatar', 0, NOW())";

        if ($conn->query($query)) {
            echo '1';
        } else {
            echo 'Error: ' . $conn->error;
        }
    }
}

ob_end_flush();
?>
