<div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                            <div class="text-2xl">ผู้ใช้งาน</div>
                            <ul role="list" class="max-w-sm divide-y divide-gray-200 dark:divide-gray-700">
                                <?php 
        $sql = "SELECT firstname, lastname, email, profile_img, urole, created_at FROM users WHERE urole = 'user' ORDER BY created_at DESC LIMIT 3";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch()) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $created_at = $row['created_at'];
            $profile_img = $row['profile_img'];
            $urole = $row['urole'];
    ?>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <!-- <img class="w-8 h-8 rounded-full"
                                                src="../../Image/<?php echo $profile_img; ?>" alt="Neil image"> -->



                                            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                                                data-dropdown-placement="bottom-start"
                                                class="w-10 h-10 rounded-full cursor-pointer"
                                                src="../../Image/<?php echo $profile_img; ?>" alt="User dropdown">

                                            <!-- Dropdown menu -->
                                            <div id="userDropdown"
                                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                               
                                                <ul class="py-2 text-sm dark:text-gray-200"
                                                    aria-labelledby="avatarButton">
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ดูโปรไฟล์</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">แก้ไขข้อมูล</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ลบบัญชี</a>
                                                    </li>
                                                </ul>
                                               
                                            </div>

                                            <!-- ----- -->
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                                <?php echo $firstname . ' ' . $lastname; ?>
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                <?php echo $email; ?>
                                            </p>
                                            <p class="text-xs text-gray-500 truncate dark:text-gray-400 mt-2">
                                                <?php echo $created_at; ?>
                                            </p>
                                        </div>
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            สมาชิกใหม่
                                        </span>
                                    </div>
                                </li>
                                <?php
        }
    ?>
                            </ul>
                            <div class="flex -space-x-4 justify-center mt-4">
                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                    src="https://i.redd.it/ozl7zgrpe5e81.jpg" alt="">
                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                    src="https://media.tenor.com/xf_Ux1eyEeQAAAAC/takumi-fujiwara-initial-d.gif" alt="">
                                <img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                    src="https://media.tenor.com/rt1Nr6kjzAsAAAAC/initial-d-takumi.gif" alt="">
                                <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                                    href="../../View/Admin/Member/Alluser.php">+99</a>
                            </div>
                        </div>
                    </div>
                </div>