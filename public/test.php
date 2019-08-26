<?php
class Name 
{

    public function Name($number,$name, $sername, $age) 
    {
       // self::$show1 = self::$show1+1;

        $this->number = $number;
        $this->name = $name;
        $this->sername = $sername;
        $this->age = $age;
    }

    public  function say_name() 
    {
        echo "<tr>";
        echo "<td>  " . $this->number . "</td>";
        echo "<td>  " . $this->name . "</td>";
        echo "<td> " . $this->sername. "</td>";
        echo "<td>" . $this->age ."</td>";
        echo "<tr/>";
    }

}
$show[] = new Name(1,"ริสา", "เบ็ญมูซา", 25);
$show[] = new Name(2,"เยาวเรศ", "วงศ์สามารถ", 25);
$show[] = new Name(3,"วงศธร", "ด้วงนิล", 25);
$show[] = new Name(4,"วชิระ", "ขันคำ", 25);
$show[] = new Name(5,"พิชชาพร", "ทองคลัง", 25);
$show[] = new Name(6,"ภัทรวดี", "ป๊อกเทิ่ง", 25);
//print_r($show);
echo "<table cellpadding='10' cellspacing'10' border='1'>";
echo "<tr> <th>number</th> <th>name</th> <th>sername</th> <th>age</th> </tr>";
foreach ($show as $car) {
   // echo "<tr> <td>$car->number</td> <td>$car->name</td> <td>$car->sername</td> <td>$car->age</td>";
    $car->say_name();
}

//$show->province="นนทบุรี";
//$show->say_name();




?>