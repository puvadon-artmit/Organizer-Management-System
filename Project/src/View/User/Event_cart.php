<?php

include '../../Config/Database.php';
include '../../Router/User/User_login.php';



// // Check if the arrays are not set in the session
// if (!isset($_SESSION["intLine"])) {
//     $_SESSION["intLine"] = 0;
//     $_SESSION["strProductID"] = array(); // Initialize the array
//     $_SESSION["strQty"] = array(); // Initialize the array
// }

// Check if the "id" parameter is set in the URL
if (isset($_GET['id'])) {
    $strProductID = $_GET['id']; // Get the product ID

    
    // Check if the product exists in the event_detail table
    $sql1 = "SELECT event_detail.*, type_detail.type_dtname
    FROM event_detail
    INNER JOIN type_detail ON type_detail.type_dtid = event_detail.type_dtid
    WHERE detail_id = :detail_id";

$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':detail_id', $strProductID);
$stmt1->execute();
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
if(!isset($_SESSION["intLine"]))    //เช็คว่าแถวเป็นค่าว่างมั๊ย ถ้าว่างให้ทำงานใน {}
{
	 $_SESSION["intLine"] = 0;
	 $_SESSION["strProductID"][0] = $_GET["id"];   //รหัสสินค้า
	 $_SESSION["strQty"][0] = 1;                   //จำนวนสินค้า
	 header("location:./Event_cart.php");
}
else
{
	
	$key = array_search($_GET["id"], $_SESSION["strProductID"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else
	{
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProductID"][$intNewLine] = $_GET["id"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}
	 header("location:./Event_cart.php");
}
}
//     if ($result1) {
//         // Initialize the $_SESSION["strProductID"] array if it's not set
//         if (!isset($_SESSION["strProductID"])) {
//             $_SESSION["strProductID"] = array();
//         }

//         // Check if the product is already in the cart
//         $key = array_search($strProductID, $_SESSION["strProductID"]);

//         // If the product is in the cart, increase the quantity
//         if ($key !== false) {
//             $_SESSION["strQty"][$key] += 1;
//         } else {
//             // If the product is not in the cart, add it
//             $intNewLine = $_SESSION["intLine"] + 1;
//             $_SESSION["strProductID"][$intNewLine] = $strProductID;
//             $_SESSION["strQty"][$intNewLine] = 1;
//             $_SESSION["intLine"] = $intNewLine;
//         }
//     }
// }





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

    <title>Cart</title>
</head>

<body>
    <?php
    include '../../Templates/Mainpage/Navbar2.php';
    ?>
    <section class="bg-white dark:bg-white">
  <div class="mx-auto max-w-screen-xl">
       
        

        <div class="container ">
        <form action="../../Router/Cart/Insert_cart.php" id="form1" method="POST">
    
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-8 ">
            <!-- <span class="text-2xl font-extrabold tracking-tight">ชื่ออีเว้น : <span class="text-green-400"><?php echo $result1['']; ?></span></span> -->
                <!-- ปุ่มเลือกสถานที่จัดงาน -->
                <!-- <div
                    class="mt-4 w-100 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto mr-20 ">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 border-gray-400 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">จัดงานที่บ้าน</button>
                    <button type="button"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-400 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-800 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-zinc-800 dark:hover:bg-gray-700">เลือกที่สถานที่จัดงาน</button>
                </div> -->
                

                <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        
                    <tr>
                            <th scope="col" class="px-6 py-3">
                                ลำดับที่
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ภาพสินค้า
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ชื่อสินค้า
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ชื่ออีเว้นท์
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ประเภทรายละเอียดอีเว้นท์
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ราคา
                            </th>

                            <th scope="col" class="px-6 py-3">
                                ราคารวม
                            </th>
                            <th scope="col" class="px-6 py-3">
                                แก้ไข
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ลบ
                            </th>

                        </tr>
                    </thead>



                    <tbody>
                        <?php
                    
           if (isset($_SESSION["intLine"]) > 0) {
        $Total = 0;
        $Sumprice = 0;
        $m = 1;
        $eventNames = array(); // Array to store unique event names

        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
            if (isset($_SESSION["strProductID"][$i]) && $_SESSION["strProductID"][$i] !== "") {
                $sql1 = "SELECT event_detail.*, event.event_name, type_detail.type_dtname
         FROM event_detail
         INNER JOIN event ON event_detail.event_id = event.event_id
         INNER JOIN type_detail ON type_detail.type_dtid = event_detail.type_dtid
         WHERE event_detail.detail_id = :detail_id";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(':detail_id', $_SESSION["strProductID"][$i]);
                $stmt1->execute();
                $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                // ------คำสั่งบล็อคชื่องานอีเว้นท์----
                $isNewEvent = true;
        foreach ($eventNames as $eventName) {
         if ($result1['event_name'] !== $eventName) {
        $isNewEvent = false;
        break;
         }
        }

        if ($isNewEvent) {
          $eventNames[] = $result1['event_name'];
        }else {
            break;
        }
                 
        // ------------------------------------------
                $_SESSION["price"] = $result1['price'];
                $Total = (int)$_SESSION["strQty"][$i] ?? 0;
                $sum = $Total * $result1['price'];
                $Sumprice += $sum;

                $DepositPercent = 20;
                $Deposit = ($Sumprice * $DepositPercent) / 100;
                $NetTotal = $Sumprice - $Deposit;

                $_SESSION["sum_price"] = $Sumprice;
                $_SESSION["de_posit"] = $Deposit;
                $_SESSION["net_Total"] = $NetTotal;


               
            
                
                
                        ?>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


                            <td class="px-6 py-4"><?php echo $m; ?></td>
                            <td class="w-32 p-4">



                                <img class="  rounded-lg" src="../../Image/<?php echo $result1["detail_img"]; ?>"
                                    alt="<?php echo $result1['name_dt']; ?>">
                            </td>
                            <td class="px-6 py-4"><?php echo $result1['name_dt']; ?></td>

                            <td class="px-6 py-4"><?php echo $result1['event_name']; ?></td>
                            <td class="px-6 py-4"><?php echo $result1['type_dtname']?></td>
                            <td class="px-6 py-4"><?php echo $result1['price']; ?></td>

                            <td class="px-6 py-4" style="color: #FF9900;"><?php echo number_format($sum); ?></td>

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">




                                    <a href="../../Router/Cart/Add_order.php?id=<?php echo $result1['detail_id']; ?>"
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                    <div>
                                        <?php echo $_SESSION["strQty"][$i]; ?>
                                    </div>

                                    <a href="../../Router/Cart/Reduce_order.php?id=<?php echo $result1['detail_id']; ?>"
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        </svg>
                                    </a>
                                    <?php } ?>
                                </div>
                            </td>

                            <td>
                                <a class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    type="reset" href="../../Router/Cart/Delete_order.php?Line=<?=$i?>"
                                    role="button">ลบ</a>
                            </td>
                            <?php
                        $m = $m + 1;
                    }
                }
                ?>
                        <tr>


                        </tr>


                        <?php
            }
            ?>
                    </tbody>
                </table>

               
                               
                <div class="mt-4 w-100 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto mr-20">
    <span class="text-2xl font-extrabold tracking-tight" style="white-space: nowrap;">
        ชื่ออีเว้น : 
        <span class="text-green-400">
            <input type="text" name="name_event" value="<?php echo $result1['event_name']; ?>" readonly style="border: none; outline: none;">
        </span>
    </span>
</div>


                <div
                    class="mt-4 w-50 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto ">

                    <div class="flex items-baseline text-gray-900 dark:text-white">
                        <span class="text-2xl font-extrabold tracking-tight">รวมเป็นเงิน : <span
                                class="text-green-400"><?= $Sumprice ?>
                                <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">บาท</span>

                    </div>

                    <div class="flex items-baseline text-gray-900 dark:text-white">
                        <span class="text-2xl font-extrabold tracking-tight">เงินมัดจำ : <span
                                class="text-green-400"><?= $Deposit ?>
                                <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">บาท</span>

                    </div>

                    <!-- <div class="flex items-baseline text-gray-900 dark:text-white">
                        <span class="text-2xl font-extrabold tracking-tight">เงินส่วนที่เหลือ: <span
                                class="text-green-400"><?= $NetTotal ?>
                                <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">บาท</span>

                    </div> -->
                </div>

                <div class="mt-4 w-100 max-w-xl p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto">

                    <h5 class="text-xl font-medium text-gray-900 dark:text-white">ชื่อนามสกุล</h5>

                    <div class="relative w-40 mt-4 ">
                        <h4>วันที่ในการจัดงาน</h4>
                        <div class="col-sm-2 mt-2">
                            <input type="date" name="dateMonth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" autofocus autocomplete required>
                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                   
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อ-นามสกุล</label>
                        <input type="text" id="default-input" name="fl_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                    </div>
                    
                    <div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เบอร์โทรศัพท์</label>
                        <input type="number" id="default-input" name="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus autocomplete required>
                    </div>


                    <button type="submit"
                        class="mt-4 w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">จ้างจัดงาน</button>


                </div>
                <br>
            </div>
           
            <br>
        </form>
    </div>

        </div>
       
    </div>
</section>
    
</body>

</html>