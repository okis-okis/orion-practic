<footer>
<?
$sql = "SELECT * FROM site_info WHERE id = '7'";

$result = $conn->query($sql);
    
if($result->num_rows){
    $row = $result->fetch_assoc();
?>
    <p><?echo $row['info'];}?></p>
</footer>