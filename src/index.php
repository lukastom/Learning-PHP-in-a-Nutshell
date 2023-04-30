<html>
    <head>
        <title>My First PHP Page</title>
    </head>
    <body>
    <?php
        // Uncomment to see your PHP and xdebug configuration. Xdebug is a PHP extension needed for debugging your app.
        //phpinfo();
        //echo xdebug_info();
        
        /* ---- Include, require ----
           = insertion of the content of one PHP file into another PHP file, before the server executes our script.
           • absolute or relative path to the file
           • include = after file not found, the script continues
           • require = after file not found, the script stops
        */
        include 'header.php';
        require 'header.php';

        echo "Hello World 1!";
    ?>
    <?
        echo "<strong>Hello</strong> World 2! ";
        echo 'Hello World 3!'
    ?>
    <!-- this was removed in PHP 7:
    <script language="php">
        echo "Hello World!";
    </script>
    -->
    <?php
        // This is a single-line comment
        /*
          This is a multi-line
          comment block
        */

        // ---- Variables ----
        $name = 'John';
        $_age = 25;
        echo $name;
        echo $_age;
        // ---- Concatenation ----
        echo $name . $_age;
        echo " Name: $name, age: $_age. ";

        /* ---- Constants ----
           define(name, value, case-insensitive)
           case-insensitive - default is false
        */
        define("constant",3.14);
        //no $ sign:
        echo constant;

        /* ---- Data types ----
           String = "string" 'string'
           Integer = -123 +123
           Float = 3.14
           Boolean = true false
           Array
           Object
           NULL
           Resource
        */

        //Automatic conversion - string converted to number
        $number_string = "12";
        $number = 13;
        $number = $number + $number_string;
        echo $number;

        /*Variables Scope
          local = declared in a function, can be accessed only within the function
          global = declared outside a function, can be accessed only outside the function (unless we use "global" command)
        */
        $my_name = 'David';
        function getName() {
            //access global variable
            global $my_name;
            echo $my_name;
        }
        getName();

        //use variable as another's variable name
        $a = 'hello';
        $hello = "Hi!";
        echo $$a;

        // ---- Operators ----
        $a = 2;
        $b = 3;

        $c = $a + $b;
        $c = $a - $b;
        $c = $a / $b;
        $c = $a * $b;
        $c = $a % $b; //modulo

        //increment & decrement (pre- and -post)
        $a = 2; $b = $a++; // $a=3,  $b=2
        $a = 2; $b = ++$a; // $a=3,  $b=3

        //assignment operators
        $c += $a;   //this is same as $c = $c + $a;
        $c -= $a;
        $c *= $a;
        $c /= $a;
        $c %= $a;

        /*comparison operators
          ==  equal
          === equal and same type (identical)
          !=  not equal
          <>  not equal
          !== not equal or not same type (identical)
          >   greater than
          <   less than
          >=  greater than or equal
          <=  less than or equal
        */

        /*logical operators
          and   AND
          or    OR
          xor   XOR
          &&    AND
          ||    OR
          !     NOT
        */

        // ---- Arrays ----

        //Numeric arrays
        //• arrays can store mixed data types
        $names = array("David", "Amy", "John");

        $names[0] = 123;
        $names[1] = "<strong>Amy</strong>";
        $names[2] = 3.14;

        echo $names[1];

        //Associative Arrays (key => value)
        $people = array(
            "David"=>"27",
            "Amy"=>"21",
            "John"=>"42"
        );
        // or
        $people['David'] = "27";
        $people['Amy'] = "21";
        $people['John'] = "42";

        //2-dimensional associative array
        $people = array(
            'online'=>array('David', 'Amy'),
            'offline'=>array('John', 'Rob', 'Jack'),
            'away'=>array('Arthur', 'Daniel')
         );

        // ---- Conditions ----
        //if, else
        $x = 10;
        $y = 20;
        if ($x >= $y) {
            echo $x;
        } else {
            echo $y;
        }

        //elseif
        $age = 21;
        if ($age<=13) {
            echo " Child";
        } elseif ($age>13 && $age<19) {
            echo " Teenager";
        } else {
            echo " Adult";
        }

        //else without {}
        $age = 5;
        if($age<=13)
            echo " Child";
        else
            echo " Adult";
        
        //switch
        //note: fall through mechanism applies (after case is true, it runs until next break)
        $today = 'Tue';
        switch ($today) {
            case "Mon":
                echo " Today is Monday. ";
                break;
            case "Tue":
                echo " Today is Tuesday. ";
                break;
            case "Wed":
                echo " Today is Wednesday. ";
                break;
            default:
                 echo " Invalid day. ";
        }

        // ---- Loops ----
        //while
        $i = 1;
        while ($i < 7) {
            echo "The value is $i <br />";
            $i++;
        }

        //do while (runs at least once)
        $i = 5;
        do {
            echo "The number is " . $i . "<br/>";
            $i++;
        } while($i <= 7);

        //for
        //for (init; test; increment) {}
        for ($a = 0; $a < 6; $a++) {
            echo "Value of a : ". $a . "<br />";
        }

        //foreach
        $names_array = array("John", "David", "Amy");
        foreach ($names_array as $name) {
            echo $name.'<br />';
        }

        $names_array = array("John"=>23, "David"=>25, "Amy"=>18);
        foreach ($names_array as $name => $value) {
            echo $name. " " .$value. '<br />';
        } 

        /*break
          • stops: for, foreach, while, do-while, switch, whole program

          continue
          • skips the rest of current iteration in loop and goes back to beginning of the loop
        */
        for ($i=0; $i<10; $i++) {
            if ($i%2==0) {
                continue;
            }
            echo $i . ' ';
        }

        // ---- Functions ----
        function sayHello() {
            echo "Hello!";
        }
    
        sayHello(); //call the function

        //function with a parameter
        function multiplyByTwo($number) {
            $answer = $number * 2;
            echo $answer;
        }
        multiplyByTwo(3); //3 = argument passed to the function

        //function with more parameters
        function multiply($num1, $num2) {
            echo $num1 * $num2;
        }
        multiply(3, 6);

        /*default argument
          • if there are arguments and default arguments, list the non-default arguments first! Like this: function sum($num2, $num1 = 1)
        */
        function setCounter($num=10) {
            echo "Counter is ".$num."<br />";
        }
        setCounter(42);  //Counter is 42
        setCounter();  //Counter is 10

        /*return
          • if there is no return in function, the result will be NULL
          • if we want to return more values, we can use e.g. array 
        */
        function multiplicate($num1, $num2) {
            $res = $num1 * $num2;
            return $res;
        }
    
        echo multiplicate(8, 3);

        /* ---- Predefined variables (superglobals) ----
          • superglobals are predefined variables that are always accessible, regardless of scope.
        */

       


        









        
    ?>
    </body>
</html>