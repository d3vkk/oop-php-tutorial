<!DOCTYPE html>
<html>

<head>
    <title><?php echo 'PHP Object Oriented Programming'; ?></title>
    <style type="text/css">
		body {
            margin: 0;
			font-size: 1.6em;
			background: #F2EEE1;
		}

		.title {
			display: block;
			background-color: #f79999;
			font-size: 3em;
			color: #111;
            position: sticky;
            top: -1px;
		}

		.linehr {
			width: 100%;
			height: 10px;
			background-color: mediumaquamarine;
		}

		.subtitle {
			display: block;
			background-color: #ff9c23;
			font-size: 1em;
			color: #222;
		}

		.notes {
			display: block;
			background-color: #fff;
			font-size: 0.7em;
			color: #333;
		}
	</style>
</head>

<body>
    <?php
    echo '<div class="title">LEARNING OBJECT ORIENTED PHP</div>';

    /*
        OOP -Object Oriented (Functions become methods & Variables become attributes)
            Attributes - Are used across multiple functions in the class
            Value - what is stored inside a variable/attribute e.g $a = 5; - '5' is the value of variable 'a'
            Object - what the programmer can create using the functions & attributes given in a class
                i.e customise functions and values of attributes to suit the program he/she is making
            Class - Group of Functions/Methods
            Superclass - Class from which a subclass inherits its functions and properties
            Subclass - Class that inherits its functions and properties from a superclass
            Pointer i.e. '->' - An object uses a pointer to refer/point to a class attribute & function
            Framework - Group of Classes with convention and coding style

        Inheritance - Cloning/copying a class and changing it's functions and properties to suit the program being made
    */

    /*
        CLASSES
    */

    class Animal implements Singable{
        /*
            Encapsulation is defining permissions for attributes & functions:
                private - only class functions can access & modify the data of the object
                protected - only class functions and subclassess as well can access & modify the data of the object
                public - any code can access & modify the data of the object. Default if functions and attributes are not defined as any of the above
        */
        protected $name;
        protected $food;
        protected $sound;
        protected $id;

        /*
            static attribute - Every object of the class 'Animal' will inherit the attribute 'total'
            & if the number increases it will increase for every object
        */
        public static $total = 0;

        //const - constant(doesn't change)
        const PI = '3.142';

        //Function that returns name as output
        function getName(){
            //'$this' is the object used to point to class atrributes & functions when creating class functions
            return $this->name;
        }

        //Constructor - Gives objects them default values when they are added
        function __construct(){
            //Generates random number between 100 & 1000
            $this->id = rand(100, 1000);

            echo 'ID: ' . $this->id . ' has been assigned<br>';

            //Increases total number of animals by one, once an animal object has been created
            Animal::$total++;
        }

        //Destructor - Notifies when all references to an object have been removed
        public function __destruct(){
            echo $this->name . ' has been removed by the destructor<br>';
        }

        //Getter - gets the value of an attribute.(Attribute passed as a parameter)
        function __get($name){
            echo 'Asked for ' . $name . '<br>';
            /*
                '$this->name;' is not the same as '$this->$name;'
                as we are pointing to the attribute passed into the function and not the class attribute
            */
            return $this->$name;
        }

        //Setter- sets the value of an attribute.(Attribute and value passed as a parameters)
        function __set($name, $value){
            echo 'Set ' . $name . ' to  ' . $value . '<br>';

            //This particular function checks that the attribute is valid first before setting a value
            switch($name) {
            case 'name':
                $this->name = $value;
                break;

            case 'food':
                $this->food = $value;
                break;

            case 'sound':
                $this->sound = $value;
                break;

                //If not valid,
            default:
                echo $name . 'Not found';
            }
        }

        function run(){
            echo $this->name . ' runs<br>';
        }

        //'final' indicates that this class function cannot be changed by subclasses
        final function love_food(){
            echo 'Animals love food<br>';
        }

        //When any object of this class is echoed, this will be printed out instead of the value of the object only
        function __toString(){
            return 'ID: ' . $this->id . '  ' . $this->name . ' eats '. $this->food . ' and likes to ' . $this->sound . '<br>';
            return 'Total Number of Animals/Objects created: ' . Animal::$total  . '<br>';
        }

        function sing(){
            echo $this->name . ' does not sing. It is a duck or a cat<br>';
        }

        //static functions don't need objects to be created so that they can be used
        static function sum($num1, $num2){
            return ($num1 + $num2) . '<br>';
        }
    }

    //Dog is a subclass of the superclass Animal
    class Dog extends Animal implements Singable{
        //Showing inheritance
        function run(){
            echo $this->name . ' runs faster<br>';
        }

        function sing(){
            echo $this->name . ' does not sing. It is a dog<br>';
        }
    }

    /*
        Polymorphism is creating subclasses, adding functions to the subclasses, changing the superclass functions in the subclasses(i.e. Inheritance) & interfaces
            An interface is a class that only declares empty functions that must all be defined when being implemented by a class
            Note that you can only extend a subclass once but you can implement multiple interfaces
    */

    interface Singable{
        public function sing();
    }

    /*
        OBJECTS
    */

    $animal_one = new Animal();

    //Note that the object '$animal_one' points to already defined class attributes
    $animal_one->name = 'Dax';
    $animal_one->food = 'fish';
    $animal_one->sound = 'quack';

    echo 'ID: ' . $animal_one->id . '  ' . $animal_one->name . ' eats '. $animal_one->food . ' and likes to ' . $animal_one->sound . '<br>';
    echo 'Total Number of Animals/Objects created: ' . Animal::$total  . '<br>';

    echo '<br>';

    $animal_two = new Dog();

    $animal_two->name = 'Rex';
    $animal_two->food = 'meat';
    $animal_two->sound = 'bark';

    echo 'ID: ' . $animal_two->id . '  ' . $animal_two->name . ' eats '. $animal_two->food . ' and likes to ' . $animal_two->sound . '<br>';
    echo 'Total Number of Animals/Objects created: ' . Dog::$total  . '<br>';

    echo '<br>';

    $animal_three = new Animal();

    //Note that the object '$animal_one' points to already defined class attributes
    $animal_three->name = 'Mimi';
    $animal_three->food = 'mice';
    $animal_three->sound = 'meow';

    echo 'ID: ' . $animal_three->id . '  ' . $animal_three->name . ' eats '. $animal_three->food . ' and likes to ' . $animal_three->sound . '<br>';
    echo 'Total Number of Animals/Objects created: ' . Animal::$total  . '<br>';

    echo '<br>';

    //Note that constants don't have the preceding dollar sign
    echo 'PI Constant: ' . Animal::PI . '<br>';

    echo '<br>';

    //Note that the objects point to a class function 'run()' showing inheritance
    $animal_one->run();
    $animal_two->run();
    //Note that it doesn't take on the name attribute defined in the objects
    $animal_one->love_food();
    $animal_two->love_food();
    //Showing the '__toString()' function
    echo $animal_one;
    echo $animal_three;

    echo '<br>';

    //Showing polymorphism
    //Showing the use of interfaces
    $animal_one->sing();
    $animal_two->sing();
    $animal_three->sing();

    //Note that the classes don't have to be defined. The function will use all the classes that implement the interface 'Singable' when created objects are used with it
    function make_them_sing(Singable $singing_animal){
        $singing_animal->sing();
    }

    make_them_sing($animal_one);
    make_them_sing($animal_two);
    make_them_sing($animal_three);

    //Note, similarly, that the function will use the 'Animal' class and it's subclasses that have the 'sing()' function defined (i.e. the subclasses that implement the interface 'Singable') when created objects are used with it
    function sing_animal(Animal $singing_animal){
        $singing_animal->sing();
    }

    sing_animal($animal_one);
    sing_animal($animal_two);
    sing_animal($animal_three);

    echo '<br>';

    //Showing static functions
    echo '3 + 5 = '. Animal::sum(3,5);

    echo '<br>';

    //You can check the class an object falls under. This example uses a ternary control stucture
    $is_it_an_animal = ($animal_two instanceof Animal) ? 'True' : 'False';
    echo 'Is $animal_two part of the superclass Animal? ' . $is_it_an_animal . '<br>';

    echo '<br>';

    //You can clone/copy an object
    $animal_clone = clone $animal_one;
    echo $animal_clone . '<br>';

    echo '<br>';

    /*
        Abstraction is
        An abstract class can only have objects through a subclass that inherits it
        An abstract function will be changed in the subclass(es) that inherit the abstract class
    */

    abstract class random_class {
        abstract function random_func($random_attribute);
    }

    echo '<br>';

    echo '<div class="notes" style="font-size:1.2em;">FOR MORE DETAILS CHECK THE EDITOR</div>';
    echo '<hr class="linehr">';

    echo '<br>';

    ?>
</body>

</html>
