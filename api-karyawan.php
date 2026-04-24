<?php
require_once "connection.php";
if (function_exists($_GET['function'])) {
$_GET['function']();
}

// fungsi ambil data karyawan
function getKaryawan(){
global $connect;
$data = [];
$query = $connect->query("SELECT * FROM tbl_karyawan");
while ($row = mysqli_fetch_object($query)) {
$data[] = $row;
}
$response = array(
'status' => 200,
'message' => 'Success',
'data' => $data
);
header('Content-Type: application/json');
echo json_encode($response);
}

// fungsi tambah data karyawan
function insertKaryawan() {
global $connect;
$check = array('id' => '', 'nama' => '', 'jenis_kelamin' => '',
'handphone' => '', 'alamat' => '');
$check_match = count(array_intersect_key($_POST, $check));
if ($check_match == count($check)) {
$result = mysqli_query($connect, "INSERT INTO tbl_karyawan SET
id = '$_POST[id]',
nama = '$_POST[nama]',
jenis_kelamin = '$_POST[jenis_kelamin]',
handphone = '$_POST[handphone]',
alamat = '$_POST[alamat]'");
if ($result) {
$response = array(
'status' => 201,
'message' => 'Insert Success'
);
} else {
$response = array(
'status' => 400,
'message' => 'Insert Failed.'
);
}
} else {
$response = array(
'status' => 405,
'message' => 'Wrong Parameter'
);
}
header('Content-Type: application/json');
echo json_encode($response);
}

// fungsi ambil data karyawan by id
function getKaryawanById() {
global $connect;
if (!empty($_GET["id"])) {
$id = $_GET["id"];
}
$data = [];
$query = "SELECT * FROM tbl_karyawan WHERE id= $id";
$result = $connect->query($query);
while ($row = mysqli_fetch_object($result)) {
$data[] = $row;
}
if ($data) {
$response = array(
'status' => 200,
'message' => 'Success',
'data' => $data
);
} else {
$response = array(
'status' => 404,
'message' => 'No Data Found'
);
}
header('Content-Type: application/json');
echo json_encode($response);
}

// fungsi ubah data karyawan
function updateKaryawan() {
global $connect;
if (!empty($_GET["id"])) {
$id = $_GET["id"];
}
$check = array('nama' => '', 'jenis_kelamin' => '', 'handphone' => '',
'alamat' => '');
$check_match = count(array_intersect_key($_POST, $check));
if ($check_match == count($check)) {
$result = mysqli_query($connect, "UPDATE tbl_karyawan SET
nama = '$_POST[nama]',
jenis_kelamin = '$_POST[jenis_kelamin]',
handphone = '$_POST[handphone]',
alamat = '$_POST[alamat]' WHERE id = $id");
if ($result) {
$response = array(
'status' => 200,
'message' => 'Update Success'
);
} else {
$response = array(
'status' => 400,
'message' => 'Update Failed'
);
}
} else {
$response = array(
'status' => 405,
'message' => 'Wrong Parameter',
'data' => $id
);
}
header('Content-Type: application/json');
echo json_encode($response);
}

// fungsi hapus data karyawan
function deleteKaryawan() {
global $connect;
$id = $_GET['id'];
$query = "DELETE FROM tbl_karyawan WHERE id=" . $id;
if (mysqli_query($connect, $query)) {
$response = array(
'status' => 200,
'message' => 'Delete Success'
);
} else {
$response = array(
'status' => 400,
'message' => 'Delete Fail.'
);
}
header('Content-Type: application/json');
echo json_encode($response);
}
?>