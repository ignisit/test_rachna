<?php 
include_once 'git.php';
$obj = new Git();
$res = $obj->search('joyent/node');

?>
<DOCTYPE html>
    <html>
        <head>
             <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
           
            <link rel="stylesheet" type="text/css" href="css/jquery.dataTables_themeroller.css">
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
            </script>
        </head>
        <body>
            <div class="container">
            <div class="row">
                <div class="col-md-12">
            <table id="example" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Commit hash</th>
                        <th>Auther</th>
                        <th>Committer</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach ($res as $key => $value) {
    
    $length=strlen($value['sha'])-1;

    
    ?>
                    <tr <?php if(is_numeric($value['sha'][$length])){    echo 'style = "background-color: #E6F1F6"'; } ?> >
                        <td <?php if(is_numeric($value['sha'][$length])){    echo 'style = "background-color: #E6F1F6"'; } ?>><?php echo $value['sha'];?></td>
                        <td><?php echo $value['author'];?></td>
                        <td><?php echo $value['committer'];?></td>
                        <td><?php echo $value['message'];?></td>
                        <td><?php echo $value['date'];?></td>
                        
                    </tr>
        <?php
}

                    ?>
                    
                </tbody>
               </table>
                    </div>
                    </div>
                    </div>


        </body>
    </html>

