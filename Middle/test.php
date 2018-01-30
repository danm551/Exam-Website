<?php
//fs setacl ~/public_html/some.dir http write
//Display erros in php
//change file pathinfo

//echo "Tharun";

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$code=$_POST['code'];
//$args=$_POST['args'];

//code`
$code = "public static void addTwoNumber(int num1, int num2){ 
          int result;
          result = (num1 + num2); 
          System.out.println(result); 
        }";
$args = "";

$compile_code="public class testProg{ public static void main (String[] args){int num1 = 4; int num2 = 5; addTwoNumber(num1, num2);}".$code. "}";
echo $compile_code;
file_put_contents('/afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/testProg.java',$compile_code);

//$myfile = fopen("/afs/cad.njit.edu/u/t/k/tkt6/UPLOADS/testProg.java", "w") or die("Unable to open file!");
//$txt = "John Doe\n";
//fwrite($myfile, $compile_code);

//compiling
$error = shell_exec("javac /afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/testProg.java 2>&1");

//running and storing the output
//$output = exec("java -cp /afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/ testProg $args 2>&1");
$output = exec("java -cp /afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/ testProg 2>&1"); //2(stderror)>(output)&1(to stdout)
echo $output;

if ($error==null){
  return $output;
}else{
  return $error;
}

echo "Tharun";

///afs/cad.njit.edu/u/t/k/tkt6/UPLOADS

?>