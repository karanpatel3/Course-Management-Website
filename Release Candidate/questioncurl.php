<?php
$problem = urldecode($_POST['problem']);
$pdata = $_POST;
print_r($pdata);
echo $problem;

$difficulty = $_POST['difficulty'];
$constraint = $_POST['question_type'];
//$points  = $_POST['points'];
$topic = $_POST['topic'];
$testcase1 = $_POST['testcase1'];
$testcase1op = $_POST['testcase1op'];
$testcase2 = $_POST['testcase2'];
$testcase2op = $_POST['testcase2op'];
$testcase3 = $_POST['testcase3'];
$testcase3op = $_POST['testcase3op'];
$testcase4 = $_POST['testcase4'];
$testcase4op = $_POST['testcase4op'];
$testcase5 = $_POST['testcase5'];
$testcase5op = $_POST['testcase5op'];
$testcase6 = $_POST['testcase6'];
$testcase6op = $_POST['testcase6op'];

  $data = array ('problem'=>$problem, 'difficulty'=>$difficulty, 'topic'=>$topic, 'test_case_1'=>$testcase1,'test_case_2'=>$testcase2,'test_case_3'=>$testcase3,'test_case_4'=>$testcase4,'test_case_5'=>$testcase5,'test_case_6'=>$testcase6,'constraint'=>$constraint,
'test_case_1_op'=>$testcase1op,'test_case_2_op'=>$testcase2op,'test_case_3_op'=>$testcase3op,'test_case_4_op'=>$testcase4op,'test_case_5_op'=>$testcase5op,'test_case_6_op'=>$testcase6op);
  // 'type'=>'create_questions', 'points'=>$points
  // $dataOP = array ('test_case_1_op'=>$testcase1op,'test_case_2_op'=>$testcase2op,'test_case_3_op'=>$testcase3op,'test_case_4_op'=>$testcase4op,'test_case_5_op'=>$testcase5op,'test_case_6_op'=>$testcase6op);

  // $data2 = array('test_case_1'=>$testcase1,'test_case_2'=>$testcase2,'test_case_3'=>$testcase3,'test_case_4'=>$testcase4,'test_case_5'=>$testcase5,'test_case_6'=>$testcase6);

  $string = http_build_query($data);
  $ch = curl_init("http://afsaccess1.njit.edu/~kp486/AddQuestion.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);
  $test = json_decode($answer, true);
  //print_r($test);
  //echo $answer;
  echo "   sent..."

//   $string = http_build_query($data2);
//   $ch = curl_init("http://afsaccess1.njit.edu/~kp486/AddQuestion.php");
//   curl_setopt($ch, CURLOPT_POST, true);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//   $answer = curl_exec($ch);
//   curl_close($ch);
//   $test = json_decode($answer, true);
//   //print_r($test);
//   //echo $answer;
//   echo "  test cases sent..."
// ?>
