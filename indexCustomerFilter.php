<?php
$customerlist = array(
    "1" => array("ten" => "Jeff Seid",
        "ngaysinh" => "1994-06-12",
        "diachi" => "USA",
        "anh" => "1.jpg"),
    "2" => array("ten" => "Lazar Angelov",
        "ngaysinh" => "1984-09-22",
        "diachi" => "Bulgari",
        "anh" => "2.jpg"),
    "3" => array("ten" => "Sergi Constance",
        "ngaysinh" => "1988-10-25",
        "diachi" => "Spain",
        "anh" => "3.jpg"),
    "4" => array("ten" => "Anllela Sagra",
        "ngaysinh" => "1993-10-06",
        "diachi" => "Colombia",
        "anh" => "4.jpg"),
    "5" => array("ten" => "Gal Gadot",
        "ngaysinh" => "1985-04-30",
        "diachi" => "Israel",
        "anh" => "5.jpg")
);

function searchByDate($customers,$from_date,$to_date){
    if (empty($from_date) && empty($to_date)){
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer){
        if (!empty($from_date) && (strtotime($customer['ngaysinh']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['ngaysinh']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="filecss.css"/>
</head>
<body>
<?php
    $from_date = Null;
    $to_date = Null;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $from_date = $_POST["from"];
        $to_date = $_POST["to"];
    }
    $filtered_customers = searchByDate($customerlist,$from_date,$to_date);

?>
    <form method="post">
        From: <input id="from" type="text" name="from" placeholder="yyyy/mm/dd" value="<?php echo isset($from_date)?$from_date:''; ?>"/>
        To: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd" value="<?php echo isset($to_date)?$to_date:''; ?>"/>
        <input type="submit" id="submit" value="Search"/>
    </form>

    <table border="0">
        <caption><h1>Danh sách Fitness Model</h1></caption>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Ảnh</th>
        </tr>
        
        <?php foreach ($filtered_customers as $index=> $customer): ?>
        <tr>
            <td><?php echo $index + 1;?></td>
            <td><?php echo $customer["ten"];?></td>
            <td><?php echo $customer["ngaysinh"];?></td>
            <td><?php echo $customer["diachi"];?></td>
            <td><div class="profile"><img src="<?php echo $customer["anh"];?>"></div></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
