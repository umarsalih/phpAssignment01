<?php
//header('Content-type: text/plain');

require("lib.php");

display_html_head("Assignment");

$degree = 2;
$num_of_terms = 2 * $degree + 3;


function generate_expression($degree_input) {
    
    $coefficients = array();
    $exponents = array();

    //populates the coefficients array from -20 to 20, exluding 0
    for ($x = 0; $x < $GLOBALS['num_of_terms']; $x++) {
        do {
            $rand_num = rand(-20, 20);
        } while (in_array($rand_num, array(0)));

        array_push($coefficients, $rand_num);
        
    }

    //populates the exponents arrary.
    for ($x = 0; $x < $GLOBALS['num_of_terms']; $x++) {
        array_push($exponents, rand(0, $degree_input));
    }
    

    $terms = array(
        'coefficient' => $coefficients,
        'exponent' => $exponents
    );

    return $terms;
}

function meets_requirements($two_d_array, $input_degree) {
    
    $met_requirements = true;
    $exponents = $two_d_array['exponent'];
    $total_to_meet = ($input_degree + 1) * 2;

    //an array with all exponent values
    $dummy_array = array();
    for ($x = 0; $x < $total_to_meet; $x++) {
        array_push($dummy_array, $exponents[$x]);
    }

    // print_r($dummy_array);

    $counter = 0;

    for ($x = 0; $x <= $total_to_meet; $x++) {
        if(($key = array_search($counter, $dummy_array)) !== false) {
            unset($dummy_array[$key]);

            if(($key = array_search($counter, $dummy_array)) !== false) {
                unset($dummy_array[$key]);
                $counter++;

                if($counter == $input_degree + 1) {
                    break;
                }
            }else {
                $met_requirements = false;
                //echo "broke and evaluated to false, this array does not meet requirements";
                break;
            }
        }
        else {
            $met_requirements = false;
            //echo "broke and evaluated to false, this array does not meet requirements";
            break;
        }
        
    }

    if($met_requirements == true) {
        //echo "**this expression alright** \n";
        return true;
        
    }
    else {
        //echo "**this expression ain't it** \n";
        return false;
    }

}

function print_expression($two_d_array) {

    $exponents = $two_d_array['exponent'];
    $coefficient = $two_d_array['coefficient'];

    for($i = 0; $i < count($exponents); $i++) {

        //if first coefficient is positive
        if($i == 0 && $coefficient[0] > 0) {
            //if first coefficient is 1 - do not print 1
            if($coefficient[$i] == 1) {
                if($exponents[$i] == 0) {
                    echo "$coefficient[$i] \n";
                }
                elseif($exponents[$i] == 1) {
                    echo "x \n";
                }
                else {
                    echo "x<sup>$exponents[0]</sup> \n";
                }
            }
            else {
                if($exponents[$i] == 0) {
                    echo "$coefficient[$i] \n";
                }
                elseif($exponents[$i] == 1) {
                    echo "$coefficient[$i]x \n";
                }
                else {
                    echo "$coefficient[$i]x<sup>$exponents[0]</sup> \n";
                }
            }

        }else{

            //if coefficient is 1, do not print one
            if($coefficient[$i] == 1) {
                if($coefficient[$i] >= 0) {
                    if($exponents[$i] == 0) {
                        echo " +$coefficient[$i] \n";
                    }
                    elseif($exponents[$i] == 1) {
                        echo " +x";
                    }
                    else {
                        echo " +x<sup>$exponents[$i]</sup> \n";
                    }
                }
                else {
                    if($exponents[$i] == 0) {
                        echo " $coefficient[$i] \n";
                    }
                    elseif($exponents[$i] == 1) {
                        echo " -x";
                    }
                    else {
                        echo " -x<sup>$exponents[$i]</sup> \n";
                    }
                }
            }else {
                if($coefficient[$i] >= 0) {
                    if($exponents[$i] == 0) {
                        echo " +$coefficient[$i] \n";
                    }
                    elseif($exponents[$i] == 1) {
                        echo " +$coefficient[$i]x";
                    }
                    else {
                        echo " +$coefficient[$i]x<sup>$exponents[$i]</sup> \n";
                    }
                }
                else {
                    if($exponents[$i] == 0) {
                        echo " $coefficient[$i] \n";
                    }
                    elseif($exponents[$i] == 1) {
                        echo " $coefficient[$i]x";
                    }
                    else {
                        echo " $coefficient[$i]x<sup>$exponents[$i]</sup> \n";
                    }
                }
            }




        }
        
    }
}


function display_expression($degree) {

    $perfect_expression_found = false;

    while($perfect_expression_found == false) {
        $my_array = array();
        $my_array = generate_expression($degree);
    
        $result = meets_requirements($my_array, $degree);

        if($result == true) {
            $perfect_expression_found = true;
            print_expression($my_array);
        }
    }
}

display_expression($degree);



display_html_foot();


?> 