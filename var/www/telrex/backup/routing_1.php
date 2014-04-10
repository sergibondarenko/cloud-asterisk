<!DOCTYPE html>
<html>
<head>

    <title>OSIS PBX</title>

    <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="styles/kendo.common.min.css" rel="stylesheet">
    <link href="styles/kendo.default.min.css" rel="stylesheet">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.web.min.js"></script>
    <script src="examples/content/shared/js/console.js"></script>

</head>
<body>
    <h3>OSIS PBX</h3>
    
<?php include($_SERVER['DOCUMENT_ROOT']."/osispbx/includes/mainmenu.php"); ?>
        
<div id="grid"></div> 

    <script>

        $(function() {
            $("#grid").kendoGrid({
                dataSource: {
                    transport: {
                        read: "php/dbrouting.php"
                    },
                    schema: {
                        data: "php"
                    }
                },
                columns: [{ field: "FirstName" }, { field: "LastName" }, { field: "Address" }, { field: "City" }],
                detailTemplate: kendo.template($("#template").html()),
                detailInit: detailInit,
                editable: true
            });
        });

    </script> 
     
    
<?php include($_SERVER['DOCUMENT_ROOT']."/osispbx/includes/footer.php"); ?>
    
    
</body>
</html>
