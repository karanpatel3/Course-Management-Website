<!-- <link rel="stylesheet" type="text/css" href="ExamQuestion2.css" /> -->
<?php
include ('DBconnect.php');

$Keyword = $_POST['keyword'];


$Difficulty= $_POST['difficulty'];


$Topic= $_POST['topic'];

$Constraint= $_POST['constraint'];

$query = "SELECT `QID`, `Question`, `Topic`, `Difficulty`, `Constraint`, `FunctionName` FROM Question_Bank WHERE `Question` LIKE '%$Keyword%' AND `Difficulty`Like '%$Difficulty%' AND `Topic` LIKE '%$Topic%' AND `Constraint` LIKE '%$Constraint%'";


$result = mysqli_query($conn, $query);

echo "<table>
<tr>
<th>QID</th>
<th>Question</th>
<th>Difficulty</th>
<th>Topic</th>
<th>Constraint</th>
<th>Function Name</th>
<th>Points</th>
<th>Select Question</th>
</tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['QID'] . "</td>";
    echo "<td>" . $row['Question'] . "</td>";
    echo "<td>" . $row['Difficulty'] . "</td>";
    echo "<td>" . $row['Topic'] . "</td>";
    echo "<td>" . $row['Constraint'] . "</td>";
    echo "<td>" . $row['FunctionName'] . "</td>";
    echo "<td id='Points'><input type = 'textarea' class='points' name='points[]' id='points'></textarea>";
    echo "<td><input type = 'checkbox' name='check[]' value='checkbox' id='Checkbox'></checkbox>";
                    
    echo "</tr>";
}
echo "</table>";


?>
