$(document).ready(function(){
    Insert_record();
    view_record();
    get_record();
    update_record();
    delete_record();
});

//Insert REcord into Database
function Insert_record(){

    $(document).on("click", "#btn_register", function(){
        var User = $("#UserName").val();
        var Email = $("#UserEmail").val();
        
        if(User == "" || Email == ""){
            $("#message").html("Please fill in the blank");
        }else{
            $.ajax(
                {
                url: "insert.php",
                method: "POST",
                data: { UName:User, UEmail:Email},
                success: function(data){
                    $("#message").html(data);
                    $("#Registration").modal("show");
                    $("form").trigger('reset');
                    view_record();
                }
            });
        }
    });


    $(document).on("click", "#btn_close", function(){
        $("form").trigger("reset");
        $("#message").html("");
        
    });
}



//Display REcord
function view_record(){
    $.ajax(
        {
            url: "view.php",
            method: "POST",
            success: function(data){
                data = $.parseJSON(data);
                if(data.status == "success"){
                    $("#table").html(data.html);
                }
            },
        }
    );
}

//Get Particular Record
function get_record(){


    $(document).on("click", "#btn_edit", function(){
        var ID = $(this).attr("data-id");
        $.ajax(
            {
            url: "get_data.php",
            method: "POST",
            data: {UserID: ID},
            dataType: "JSON",
            success: function(data){
               $("#Up_User_ID").val(data[0]);
               $("#Up_UserName").val(data[1]);
               $("#Up_UserEmail").val(data[2]);
               $("#update").modal("show");
            },
        });
    });
}


//Update Record
function update_record(){

    $(document).on("click", "#btn_update", function(){

        var UpdateID = $("#Up_User_ID").val();
        var UpdateUser = $("#Up_UserName").val();
        var UpdateEmail = $("#Up_UserEmail").val();

        if(UpdateUser == "" || UpdateEmail == ""){
            $("#up-message").html("Please fill in the blanks");
            $("#update").modal("show");
        }else{
            $.ajax({
                url: "update.php",
                method: "POST",
                data: {U_ID: UpdateID, U_User: UpdateUser, U_Email: UpdateEmail},
                success: function(data){
                    $("#up-message").html(data);
                    $("#update").modal("show");
                    view_record();
                }
            });
        }
    });
}


//Delete function
function delete_record(){
    $(document).on("click", "#btn_delete", function(){
        var Delete_ID = $(this).attr("data-id1");
        $("#delete").modal("show");
       $(document).on("click", "#btn_delete_record", function(){
            $.ajax(
                {
                    url: "delete.php",
                    method: "POST",
                    data: {Del_ID: Delete_ID},
                    success: function(data){
                        $("#delete-message").html(data).hide(1000);
                        view_record();
                    },
                }
            );
       });
    });
}
