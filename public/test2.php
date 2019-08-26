<?php

$user = array(
    array("number"=>"01", "name"=>"ภัทรวดี", "sername"=>"ป๊อกเทิ่ง","age"=>"21"),
    array("number"=>"02", "name"=>"พิชชาพร", "sername"=>"ทองคลัง","age"=>"21"),
    array("number"=>"03", "name"=>"ริสา", "sername"=>"เบ็ญมูซา","age"=>"21"),
    array("number"=>"04", "name"=>"เยาวเรศ", "sername"=>"วงศ์สามารถ","age"=>"21"),
    array("number"=>"05", "name"=>"วงศธร", "sername"=>"ด้วงนิล","age"=>"21")
    );

echo "<table cellpadding='10' cellspacing'10' border='1'>";
echo "<tr> <th>number</th> <th>name</th> <th>sername</th> <th>age</th> </tr>";
foreach($user as $user) {
    echo "<tr><td>$user[number]</td> <td>$user[name]</td> <td>$user[sername]</td> <td>$user[age]</td></tr>";
}
echo "</table>";

?>$car->name