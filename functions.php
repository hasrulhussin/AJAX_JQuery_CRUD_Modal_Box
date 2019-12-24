<?php


require_once("connection.php");

//Insert Record Function
function InsertRecord(){

    global $conn;
    
    $UserName = $_POST["UName"];
    $UserEmail = $_POST['UEmail'];

    $query = "INSERT INTO user_record (UserName, UserEmail) VALUES ('$UserName', '$UserEmail')";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "Your record has been saved in the database";
    }else{
        echo "Please check your query";
    }
}

//Display Data Function
function display_record(){
    global $conn;
    $value = "";
    $value =          
            '<table class="table table-bordered text-dark">
                <tr>
                    <td>User ID</td>
                    <td>User Name</td>
                    <td>User Email</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>';

    $query = "SELECT * FROM user_record";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        $value .= ' <tr>
                        <td>'.$row['ID'].'</td>
                        <td>'.$row['UserName'].'</td>
                        <td>'.$row['UserEmail'].'</td>
                        <td>
                            <button class="btn btn-success" id="btn_edit" data-id='.$row['ID'].'>
                                <span class="fas fa-edit"></span>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger" id="btn_delete" data-id1='.$row['ID'].'>
                                <span class="fas fa-trash"></span>
                            </button>
                        </td>
                    </tr>';
    }

    $value .= '</table>';
    echo json_encode(['status' => 'success', 'html' => $value]);

}


//Get particular Record
function get_record(){
    
    global $conn;

    $UserID = $_POST['UserID'];
    $query = "SELECT * FROM user_record WHERE ID='$UserID'";
    $result = mysqli_query($conn, $query);
    

    while($row = mysqli_fetch_assoc($result)){
        $User_data = [];
        $User_data[0] = $row['ID'];
        $User_data[1] = $row['UserName'];
        $User_data[2] = $row['UserEmail'];
    }

    echo json_encode($User_data);
}


//Update Function
function update_value(){
    global $conn;

    $Update_ID = $_POST["U_ID"];
    $Update_User = $_POST["U_User"];
    $Update_Email = $_POST["U_Email"];

    $query = "UPDATE user_record SET UserName='$Update_User', UserEmail='$Update_Email' WHERE ID='$Update_ID'";

    $result = mysqli_query($conn, $query);

    if($result){
        echo "Your record has been updated.";
    }else{
        echo "Please check your query.";
    }
}


function delete_record(){

    global $conn;

    $Del_ID = $_POST["Del_ID"];
    $query = "DELETE FROM user_record WHERE ID='$Del_ID'";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "Your record has been deleted";
    }else{
        echo "Please check your connection";
    }
}
?>

