<?php
    include "controller/main.php";
    $main = new Main();
    $getData = $main->getData();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/test.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <script src="js/test.js"></script>
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/ajaxupload.3.5.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <script>
        $(document).ready(function(){
            var checkboxes = $("input[type='checkbox']"),
                submitButt = $("input[id='submit']");

            checkboxes.click(function() {
                submitButt.attr('disabled', !checkboxes.is(':checked'));
            });

            submitButt.click(function(){
                var msg =confirm('Are you sure you want to delete the selected data?');

                if(msg !== true){
                    return false;
                }

                window.location.reload('index.php');
            });

        });
    </script>

    <div class="wrapper">
        <form class="prog_lang_table" action="" method="post">

            <table class="table table-hover">
                <caption><h3>Select the position you wish to delete.</h3></caption>
                <thead class="table_title">
                <tr >
                    <th class="text-center" align="center">№</th>
                    <th class="text-center" align="center">NAME</th>
                </tr>
                </thead>

                <?php foreach($getData as $key=>$data){ ?>
                <?php if(is_array($data)){?>
                <tr>
                    <td align="center" class="id">
                        <input class="checkbox" type="checkbox" id="langId" name="number[]" value="<?php echo $data[0];?>" />
                    </td>
                    <td align="center" class="name">
                        <?php echo $data[1];?>
                    </td>
                </tr>
                <?php } }?>
            </table>

            <div class="button">
                <input id="submit" type="submit" class="btn btn-danger btn-lg " value="Delete" name="submit" disabled>
                <input id="default" type="submit" class="btn btn-link btn-lg " value="default" name="default">
            </div>

        </form>
    </div>
</body>
</html>