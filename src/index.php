<?php
    /* • Start the session - use this before any HTML tags
       • Use it on every page where you want to use the session variables
    */
    session_start();

    /* • Session variables can be used across the project
       • Not stored in cookies
       • How long it lasts:
         • php.ini or .htaccess session.gc_maxlifetime = default 1440 seconds = 24 minutes
         • => it resets after 24 minutes without activity
    */
    $_SESSION['color'] = "red";
    $_SESSION['name'] = "John";

    //setting cookie - must be done before any HTML tags
    setcookie("user", "John", time() + (86400 * 30), '/'); //valid for 30 days, available through the entire site
?>
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

        //required file contains only return statement
        $number = require 'configuration.php';
        echo $number;

        echo "Hello World 1!";

        echo "<strong>Hello</strong> World 2! ";
        echo 'Hello World 3!';
        $message = "Hello World 4!";
    ?>
    <?
       //These short PHP tags are planned to be deprecated in PHP 9. Meanwhile, their interpretation depends on server setting. Better not to use.
    ?>
    <!-- this was removed in PHP 7:
    <script language="php">
        echo "Hello World!";
    </script>
    -->
    <!--another version of the PHP tags, no ; at the end because the script immediately ends-->
    <?= $message ?>
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
        //To prevent problems with recognizing the variable name
        echo " Name: {$name}, age: {$_age}. ";
        //When using ' it will not parse the variable but treat it as a string
        echo ' Name: $name, age: $_age. ';

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
          ==  equal (e.g. 10 == '10' is true)
          === equal and same type (identical) (e.g. 10 == 10 is true)
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

        //short syntax (array keyword not needed)
        $a = [1, 2, 3, 4];
        $a = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];

        //appending to array
        $greetings = [];
        $greetings[] = "Hello";
        $greetings[] = "Hi";
        $greetings[] = "Greetings";
        
        foreach ($greetings as $greeting) {
            echo $greeting;
        }

        //count number of elements in an array
        echo count($names);

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

        //check, if the array key exists
        if (array_key_exists('David', $people)){
            echo $people['David'];
        };

        //2-dimensional associative array
        $people = array(
            'online'=>array('David', 'Amy'),
            'offline'=>array('John', 'Rob', 'Jack'),
            'away'=>array('Arthur', 'Daniel')
         );

        /*array_filter()
        • used, when we need to filter the array (to get only a subset)
        • iterates over each element and returns a new array containing only the elements of the original array that pass the filter
        • array_filter ($array, function)
            • $array = the original array
            • $function = the function to apply to each element
            • returns true = keeps the element
            • false = removes it (together with the index!) (for reindexing of the new array use array_values())
        */
        $array = [1,2,3,4,5,6,7,8,9,10];
        //in $element will be automatically passed each $array element during the iteration
        $new_array = array_filter($array, function($element){ if ($element%2 == 0) { return true; } else { return false; }});
        //print_r – prints human-readable information about a variable
        echo '<pre>';
        print_r($new_array);
        //var_dump – dumps information about a variable. <pre> keeps the formatting as it occurs in plain text. Some settings are in xdebug.
        var_dump($new_array);
        echo '</pre>';
        //Ending the script after we got the variable dump         
        //die();
        //exit("End of script");

        /*extract()
          • extracts values from array and turns them into set of variables
        */
        $people = array(
            "David"=>"27",
            "Amy"=>"21",
            "John"=>"42"
        );
        extract($people);
        echo $David; //returns 27
        echo $Amy; //returns 21
        echo $John; //returns 42

        // ---- Conditions ----
        //if, else
        $x = 10;
        $y = 20;
        if ($x >= $y) {
            echo $x;
        } else {
            echo $y;
        }

        //alternative syntax
        if ($x < $y) :
            echo $x;
        endif;

        //ternary operator
        //$result = condition ? value1 : value2;
        $smaller_number = ($x < $y) ? $x : $y;
        echo $smaller_number;

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
        //note: fall through mechanism applies (after a case is true, it runs until the next break)
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
        } while ($i <= 7);

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

        //useful syntax for more complicated HTML inside
        $names_array = array("John", "David", "Amy");
        foreach ($names_array as $name) : ?>
            <li><?= $name ?></li>
        <?php endforeach;

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
        //named function        
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

        //function with more parameters (parameters = signature)
        function multiply($num1, $num2) {
            echo $num1 * $num2;
        }
        multiply(3, 6);

        /*default argument
          • if there are arguments and default arguments, list the non-default arguments first! Like this: function sum($num2, $num1 = 1)
          • ∞ infinite: $num=INF
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

        /*Anonymous function (=closure) (=lambda function)
          • For defining a small piece of functionality that will be used only once, and you don't want to define a separate named function for it. 
          • It helps to quickly adjust the function in-place, no need to jump to the function in other place in the code.
          • When used as a parameter that goes into another function, $fn is often used for that.
        */
        $greet = function($name) {
            echo("<br />Hello " . $name);
        };
        //PHP automatically converts this into instance of the Closure internal class. So, $greet is now an object.
        
        $greet('World');
        $greet('PHP');

        /* ---- Predefined variables (superglobals) ----
          • superglobals are predefined variables that are always accessible, regardless of scope.
        */ 

        // $_SERVER
        echo "<br /><br />";
        echo "<strong>Filename: </strong>" .                     $_SERVER['PHP_SELF'];	//Filename of the currently executing script
        echo "<br />";
        echo "<strong>Server CGI version: </strong>" .           $_SERVER['GATEWAY_INTERFACE'];	//Version of the Common Gateway Interface (CGI) the server is using
        echo "<br />";
        echo "<strong>Host server IP: </strong>" .               $_SERVER['SERVER_ADDR'];	//IP address of the host server
        echo "<br />";
        echo "<strong>Server name: </strong>" .                  $_SERVER['SERVER_NAME'];	//name of the host server (such as www.w3schools.com)
        echo "<br />";
        echo "<strong>Server identification string: </strong>" . $_SERVER['SERVER_SOFTWARE'];	//server identification string (such as Apache/2.2.24)
        echo "<br />";
        echo "<strong>Info. protocol name+revision: </strong>" . $_SERVER['SERVER_PROTOCOL'];	//name and revision of the information protocol (such as HTTP/1.1)
        echo "<br />";
        //REQUEST_METHOD - to detect e.g. if we got data from a form 
        echo "<strong>Request method: </strong>" .               $_SERVER['REQUEST_METHOD'];	//request method used to access the page (such as POST)
        echo "<br />";
        echo "<strong>Request timestamp: </strong>" .            $_SERVER['REQUEST_TIME'];	//timestamp of the start of the request (such as 1377687496)
        echo "<br />";
        echo "<strong>Query string: </strong>" .                 $_SERVER['QUERY_STRING'];	//query string if the page is accessed via a query string
        echo "<br />";
        echo "<strong>Accept header: </strong>" .                $_SERVER['HTTP_ACCEPT'];	//Accept header from the current request
        echo "<br />";
        //echo "<strong>Accept_Charset header: </strong>" .        $_SERVER['HTTP_ACCEPT_CHARSET'];	//Accept_Charset header from the current request (such as utf-8,ISO-8859-1)
        echo "<br />";
        //HTTP_HOST - can be used as a part of a path
        echo "<strong>Host header: </strong>" .                  $_SERVER['HTTP_HOST'];	//Host header from the current request
        echo "<br />";
        //REQUEST_URI - can be used as a part of a path
        echo "<strong>Request URI: </strong>" .                  $_SERVER['REQUEST_URI'];	//Host header from the current request
        echo "<br />";
        echo "<strong>URL (not reliable): </strong>" .           $_SERVER['HTTP_REFERER'];	//complete URL of the current page (not reliable because not all user-agents support it)
        echo "<br />";
        //echo "<strong>HTTPS?: </strong>" .                       $_SERVER['HTTPS'];	//Is the script queried through a secure HTTP protocol
        echo "<br />";
        echo "<strong>User's IP: </strong>" .                    $_SERVER['REMOTE_ADDR'];	//IP address from where the user is viewing the current page
        echo "<br />";
        //echo "<strong>User's hostname: </strong>" .              $_SERVER['REMOTE_HOST'];	//Host name from where the user is viewing the current page
        echo "<br />";
        echo "<strong>User's port: </strong>" .                  $_SERVER['REMOTE_PORT'];	//port being used on the user's machine to communicate with the web server
        echo "<br />";
        echo "<strong>Absolute path: </strong>" .                $_SERVER['SCRIPT_FILENAME'];	//absolute pathname of the currently executing script
        echo "<br />";
        echo "<strong>Web server SERVER_ADMIN: </strong>" .      $_SERVER['SERVER_ADMIN'];	//value given to the SERVER_ADMIN directive in the web server configuration file (if your script runs on a virtual host, it will be the value defined for that virtual host) (such as someone@w3schools.com)
        echo "<br />";
        echo "<strong>Web server port: </strong>" .              $_SERVER['SERVER_PORT'];	//port on the server machine being used by the web server for communication (such as 80)
        echo "<br />";
        echo "<strong>Server vers., virt. hostname: </strong>" . $_SERVER['SERVER_SIGNATURE'];	//server version and virtual host name which are added to server-generated pages
        echo "<br />";
        //echo "<strong>Path (file system based): </strong>" .     $_SERVER['PATH_TRANSLATED'];	//file system based path to the current script
        echo "<br />";
        echo "<strong>Path: </strong>" .                         $_SERVER['SCRIPT_NAME'];	//path of the current script
        echo "<br />";
        //echo "<strong>URI: </strong>" .                          $_SERVER['SCRIPT_URI'];	//URI of the current page
        echo "<br />";

        foreach ($_SERVER as $key => $value){
            echo $key." : ".$value."<br>";
        }

        /*parse_url returns array with path and query string (can return other types in different situations)
          • used for separating URI and query string */
        var_dump(
            parse_url($_SERVER['REQUEST_URI'])
        );
        
        /* $GLOBALS
        */
        
        /* $_REQUEST
        */
              
        /* $_FILES
        */
        
        /* $_ENV
        */
        
        /* $_POST
           • in body of HTTP request
           • no limit in amount of data, supports multipart binary files

           $_GET
           • query string is sent in URL
           • limited to 2000 characters

           • the problem is, the user can insert for example a JS tag like <script>alert("hi")</script>
             (principle: The user is guilty until proven innocent.)
             • we cane sanitize the data on input OR
             • we can escape the data in the output (e.g. with htmlspecialchars())

           • validate the input data
             • check, if the input is empty (isset())
             • constrain it to minimum number of characters and maximum number of characters (strlen()-  gives string length)
               • in that case, do not delete everything the user has inserted
             • trim it (trim())
             • validate e-mail address string: filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)
        */
     
    ?>
    <!-- form - action is a php page, that runs after the form is submitted (without action set, it runs itself) -->
    <form action="index.php" method="post">
        <!-- required: client side check if the field is not empty -->
        <p>Name: <input type="text" name="name" required /></p>
        <p>Age: <input type="text" name="age" /></p>
        <p><input type="submit" name="submit" value="Submit" /></p>
    </form>
    <?php    
        //escaping the data in the output    
        echo "Your name: " . htmlspecialchars($_POST["name"]) . "<br />";
        echo "Your age: " . $_POST["age"];
    ?>
    <form action="index.php" method="get">
        <!-- "income" and "iq" are sent as query string parameters (these are often db column names) -->
        <p>Income: <input type="text" name="income" /></p>
        <!-- keeping the input text in the input field-->
        <p>IQ: <input type="text" name="iq" value="<?= $_GET["iq"] ?? "" ?>" /></p>
        <p><input type="submit" name="submit" value="Submit" /></p>
    </form>
    <?php        
        /*
        • long form:
          echo "Your income: " . (isset($_GET["income"]) ? $_GET["income"] : "Empty input") . "<br />";

        • modern short form (PHP 8) (null coalescing operator): */
        echo "Your income: " . ($_GET["income"] ?? "Empty input") . "<br />";
        echo "Your IQ: " . $_GET["iq"];
    ?>
    <?php
        /* $_SESSION (see beginning of this file)
        */
        echo "<br />Session color: " . $_SESSION['color'];
        echo "<br />Session name: " . $_SESSION['name'];
        //remove all session variables
        session_unset();
        //end of all sessions, destroys the session's data, use at the end of the script
        session_destroy();

        /* ----- COOKIES ----
           • used to identify the user
           • cookie = small file on the user's computer
           • Each time the same computer requests a page through a browser, it will send the cookie, too.

           setcookie(name, value, expire, path, domain, secure, httponly);
             • name (required) - other parameters are optional
             • expire - in seconds, default is 0 (= end of session)
             • path   - where on server is the cookie available. "/" = entire domain.  The default value is the current directory in which the cookie is being set.
             • domain - e.g. "yourdomain.com" - available in all sub-domains.
             • secure - TRUE = the cookie will only be set if a secure connection (HTTPS) exists. Default = FALSE.
             • httponly - TRUE = the cookie will be accessible only via HTTP protocol (not accessible to scripting languages) - helps reduce identity theft using XSS attacks. Default = FALSE.
             (see it used at the beginning of this file)
        */
        echo "<br />Current Unix timestamp (seconds since the Unix Epoch (1.1. 1970 00:00 GMT)): " . time();

        if(isset($_COOKIE['user'])) {   //isset() - checks if the variable is declared and not null
            echo "<br />Value of the cookie is: ". $_COOKIE['user'];
          }

        // ---- Magic constants ----
        echo '<br />Magic constant __DIR__: ' . __DIR__; //directory of the current file.
        // go up in path: /../path/to/file

        // ---- Creating/opening a file ----
        $my_file = fopen("file.txt", "w");
        /* r: Opens file for read only.
           w: Opens file for write only. Erases the contents of the file or creates a new file if it doesn't exist.
           a: Opens file for write only. Appends new data to the end of the file.
           x: Creates new file for write only.
           r+: Opens file for read/write.
           w+: Opens file for read/write. Erases the contents of the file or creates a new file if it doesn't exist.
           a+: Opens file for read/write. Creates a new file if the file doesn't exist
           x+: Creates new file for read/write.          
        */

        //returns file pointer resource (reference to an open file) or false if the file could not be opened or created
        echo $my_file;

        //in case of failure, show the last error
        if ($my_file === false) {
            $error = error_get_last();
            echo "<br />Failed to open file: " . $error['message'];
        }

        //write to file
        fwrite($my_file, "Peter\n");
        fwrite($my_file, "John\n");

        //close the file (returns true on success/false on failure)
        fclose($my_file);

        //append to file
        $my_file = fopen("file.txt", 'a'); //Places the pointer at the end of the file
        fwrite($my_file, "Maria");
        fclose($my_file);

        //read the whole file and place the contents into array (1 line = 1 element)
        $my_file = file('file.txt');
        foreach ($my_file as $line) {
            echo $line .", ";
        }

        /* ---- DATABASES ----
           • PDO = PHP Data Objects 
           • in real life, use 

          Initialize PDO - create new object from PDO class + connect to db
          • $dsn = Data Source Name (a string with connection settings)
          • we need pdo, pdo_mysql PHP extensions installed (otherwise, we get error "could not find driver")
        */
        $dsn = "mysql:host=172.19.0.4;port=3306;dbname=myapp;charset=utf8mb4";
        $username = "root";
        $password = "example";

        //Try-catch block to catch connection errors
        try {
            //If the connection fails, the $pdo object will be not created, so it will be null
            $pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        /* Using connections options – setting default mode to PDO::FETCH_ASSOC
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        */

        //Testing, if $pdo object exists or the variable is null
        if ($pdo) {    
            //Prepare SQL query
            $statement = $pdo->prepare("SELECT * FROM posts");
            //Execute SQL query
            $statement->execute();

            /*SQL injection proof way
              • This is called prepared statements with parameterized queries
              • PDO execute() will escape the parameters (using mysql_real_escape_string()), so the malicious code is not executed
              • This is safe only 90%, for 100% one possibility is to make sure that we use safe db connection encoding (like utf8)
            */
            $statement = $pdo->prepare("SELECT * FROM posts WHERE id =?"); //? = placeholder, will be replaced by parameter
            $id = $_GET['id'];
            $statement->execute($id);
            //alternative syntax
            $statement = $pdo->prepare("SELECT * FROM posts WHERE id = :id"); //:id = placeholder, will be replaced by parameter
            $id = $_GET['id'];
            $statement->execute(['id' => $id]); //syntax alternative: [':id' => $id]. It means: replace :id with $id value.


            /*Fetch all results of the SQL query
            • ->fetchAll() method gives everything twice (indexed version and key version)
                • PDO::FETCH_ASSOC gives us associative array (everything just once)
            */
            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);    

            echo "<br /><strong>Titles in my database:</strong><br />";
            foreach ($posts as $post) {
                echo "<li>" . $post['title'] . "</li>";
            }

            //Fetch just one result
            $statement = $pdo->prepare("SELECT * FROM posts WHERE id = 1");
            $statement->execute();
            $post = $statement->fetch(PDO::FETCH_ASSOC);
            echo $post['title']. "<br />";
        }

        // ---- OOP ----
        class Person {
            public $age; //property (member variable)

            public function speak() { //method
              echo "Hi!";
              echo $this->age; //"$this" means in this class/object
            }
        }

        //new instance of the class (=new object)
        $person = new Person();

        //access the object's properties (object operator -> instead of . in Java)
        $person->age = 23;  //note missing $ before age (age is not a variable but object property)
        echo $person->age; 
        $person->speak();

        /*Constructor
          • automatically runs when object is created
        */
        class Car {
            public function __construct() {
                echo "<br />Object created!";
            }
        }
        $car = new Car();

        //initializing a new object with parameters
        class Animal {
            public $name;
            public $age;
            public function __construct($name, $age) {
                $this->name = $name;
                $this->age = $age;
            }
        }
        $animal = new Animal("Rex",7);
        echo $animal->name;

        /*Destructor
          • automatically runs when object is destroyed
          • never run it explicitly
          • when object is not needed, it will be collected by garbage collector
          • when the script ends, the object will be destroyed and the destructor will be called
          • using unset() or null the variable referencing the object is complicated and has side effects, it is usually not used in PHP
        */
        class Flower {
            public function __destruct() {
                //Here we can e.g. release resources, write to log files, close a database connection, etc.
                echo "Object destroyed";
            }
        }
        $flower = new Flower();

        /*Inheritance
          • is-a relationship (Dog IS AN Animal)
          • reusing the code from the parent class, adding new code in the child class (subclass)
          • If the subclass defines an own constructor, it will run. If not, then it will be inherited from the parent class (if it is not "private").
        */
        class Dog extends Animal {
            function woof () {
                echo "Woof!";
            }
        }
        
        $dog = new Dog("Fox",5);
        $dog->woof();

        /*Visibility keywords
          • public - accessible from anywhere
          • protected - accessible only within the class itself, by inheriting, and by parent classes
          • private - accessible only by the class

          • methods without a visibility keyword are public
        */

        /*Interface
          • An interface specifies a list of methods that a class must implement.
          • These methods must be public.
          • The interface does not contain implementations.
          • Class can implement multiple interfaces (separate with ,) (ex.: class X implements A, B {}) 
        */
        
        interface AnimalInterface {
            public function makeSound();
        }
        
        class MyDog implements AnimalInterface {
            public function makeSound() {
                echo "Woof! <br />";
            }
        }
        class MyCat implements AnimalInterface {
            public function makeSound() {
                echo "Meow! <br />";
            }
        }
        
        $myObj1 = new MyDog();
        $myObj1->makeSound();
        
        $myObj2 = new MyCat();
        $myObj2->makeSound();

        /*Abstract class
          • abstract class is an abstraction of subclasses - we make subclass from it, and only from this subclass we can create object
            (it is not possible to create object from an abstract class)
          • can contain both methods with implementation (will be inherited by subclass) and abstract methods (must be implemented by subclass)
          • Subclass must implement all the abstract methods.
          • is-a relationship (Apple IS A Fruit)
         */
         abstract class Fruit { 
            private $color; 
            
            abstract public function eat(); 
            
            public function setColor($c) { 
                $this->color = $c; 
            } 
        } 
        
        class Apple extends Fruit {
            public function eat() {
                echo "Eating... Yummy!";
            }
        }
        
        $obj = new Apple();
        $obj->eat();

        /*Static
          • Static property/method of a class can be accessed without creating an object from that class.
          • Accessed by using the scope resolution operator :: between the class name and the property/method name.
          • Objects of a class cannot access static properties in the class but they can access static methods.
          • Can be used for "pure functions" or very simple functions, that are totally self contained and simply convert input to output.
        */
        class MyClass {
            //Constant declaration (constant is always public)
            public const SOME_CONST = 1;
            static $myStaticProperty = 10000000;
            static function myMethod() {
                //referencing the class itself (static)
                echo self::$myStaticProperty;
            }
         }
         
        echo MyClass::$myStaticProperty;
        echo MyClass::SOME_CONST;

        /*Final
          • final methods cannot be overridden in child classes
          • final classes cannot be inherited
          • properties cannot be marked final
        */

        class ParentClass {
            final function myFunction() {
                echo "Parent";
            }
        }
        /*(this is not allowed)
        class ChildClass extends ParentClass {
            function myFunction() {
                echo "Child";
            }
        }
        */

        final class myFinalClass {
        }       
        /*(this is not allowed)
        class myClass extends myFinalClass {
        }
        */

        // ---- HTTP ----
        //Get response code
        //http_response_code();

        //Set response code
        //http_response_code(404);

        //Build query string from array
        $array = array(
            'foo' => 'bar',
            'baz' => 'boom',
            'cow' => 'milk',
            'null' => null,
            'php' => 'hypertext processor'
        );
        
        echo http_build_query($array, '', '&');

        /* ---- Fluent interface ----
           • allows to chain method calls
           • instead of 
             $object->function1();
             $object->function2();
             $object->function3();

             we can do this:
             $object->function1()->function2()->function3();
        */
        class MyNiceClass {
            public function myFunction() {
               //returning the object itself
               return $this;
            }
            public function anotherFunction() {   
            }
        }

        $myObject = new MyNiceClass();
        $myObject->myFunction()->anotherFunction();

        /* ---- Automatically load class from a file ----
          • automatically loads class files on demand
          • we can use it at the beginning of our app, it is triggered every time, when we are using a class name, that not manually included in our app
          • used in big apps, so we do not need to include classes manually by "include", we simply make a file for each class and include classes automatically.
          • we can also register classes from 3rd party libraries, that have class files in other places than the main app

        /*This is a generic code that will trigger only after using a class name not included in our app
          We do not know yet what the classes' names will be, so we use just $class_name*/         
        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });
        //This class is not defined in this file but in a separate file and will be auto loaded
        $interestingObject = new ClassToBeAutoload();
        $interestingObject->Scream();



        

        




    ?>


    </body>
</html>