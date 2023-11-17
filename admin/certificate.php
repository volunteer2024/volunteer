<?php

//include "header.php";
include "../conn.php";
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h1>Not Found</h1>";
    exit;
}

$id = $_GET['id'];
$sql = "select o.id, vc.name cat_name,
       u.name, vc.start_date, vc.end_date , vc.hours_number
from volunteering_orders o
join volunteering_categories vc on vc.id = o.category_id
join users u on u.id = o.user_id
where o.id = $id 
order by o.id desc;";

$re = $con->query($sql);

$row = $re->fetch_assoc();

if($row === null) {
    echo "<h1>Not data</h1>";
    exit;
}
?>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-icons.css" rel="stylesheet">
<link href="../css/templatemo-kind-heart-charity.css" rel="stylesheet">


<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester');

    .cursive {
        font-family: 'Pinyon Script', cursive;
    }

    .sans {
        font-family: 'Open Sans', sans-serif;
    }

    .bold {
        font-weight: bold;
    }

    .block {
        display: block;
    }

    .underline {
        border-bottom: 1px solid #777;
        padding: 5px;
        margin-bottom: 15px;
    }

    .margin-0 {
        margin: 0;
    }

    .padding-0 {
        padding: 0;
    }

    .pm-empty-space {
        height: 40px;
        width: 100%;
    }

    /*body {*/
    /*    padding: 20px 0;*/
    /*    background: #ccc;*/
    /*}*/

    .pm-certificate-container {
        position: relative;
        width: 800px;
        height: 600px;
        background-color: #6bc3e6;
        padding: 30px;
        color: #333;
        font-family: 'Open Sans', sans-serif;
        box-shadow: 0 0 5px rgba(0, 0, 0, .5);
    /*background: -webkit-repeating-linear-gradient(
      45deg,
      #618597,
      #618597 1px,
      #b2cad6 1px,
      #b2cad6 2px
    );
    background: repeating-linear-gradient(
      90deg,
      #618597,
      #618597 1px,
      #b2cad6 1px,
      #b2cad6 2px
    );*/

    .outer-border {
        width: 794px;
        height: 594px;
        position: absolute;
        left: 50%;
        margin-left: -397px;
        top: 50%;
        margin-top:-297px;
        border: 2px solid #fff;
    }

    .inner-border {
        width: 730px;
        height: 530px;
        position: absolute;
        left: 50%;
        margin-left: -365px;
        top: 50%;
        margin-top:-265px;
        border: 2px solid #fff;
    }

    .pm-certificate-border {
        position: relative;
        width: 720px;
        height: 500px;
        padding: 0;
        border: 1px solid #E1E5F0;
        background-color: rgba(255, 255, 255, 1);
        background-image: none;
        left: 50%;
        margin-left: -360px;
        top: 50%;
        margin-top: -260px;

    .pm-certificate-block {
        width: 650px;
        height: 200px;
        position: relative;
        left: 50%;
        margin-left: -325px;
        top: 70px;
        margin-top: 0;
    }

    .pm-certificate-header {
        margin-bottom: 10px;
    }

    .pm-certificate-title {
        position: relative;
        top: 40px;

    h2 {
        font-size: 34px !important;
    }
    }

    .pm-certificate-body {
        padding: 20px;

    .pm-name-text {
        font-size: 20px;
    }
    }

    .pm-earned {
        margin: 15px 0 20px;
    .pm-earned-text {
        font-size: 20px;
    }
    .pm-credits-text {
        font-size: 15px;
    }
    }

    .pm-course-title {
    .pm-earned-text {
        font-size: 20px;
    }
    .pm-credits-text {
        font-size: 15px;
    }
    }

    .pm-certified {
        font-size: 12px;

    .underline {
        margin-bottom: 5px;
    }
    }

    .pm-certificate-footer {
        width: 650px;
        height: 100px;
        position: relative;
        left: 50%;
        margin-left: -325px;
        bottom: -105px;
    }
    }
    }
.ce {
    text-align: center;
}
</style>
<div class="ce" id="ce">
    <div class="container">
        <div class="container pm-certificate-container">
            <div class="outer-border"></div>
            <div class="inner-border"></div>

            <div class="pm-certificate-border col-xs-12">
                <div class="row pm-certificate-header">
                    <div class="pm-certificate-title cursive col-xs-12 text-center">
                        <h2>Volunteering Certificate of Completion</h2>
                    </div>
                </div>

                <div class="row pm-certificate-body">

                    <div class="pm-certificate-block">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-certificate-name underline margin-0 col-xs-8 text-center">
                                    <span class="pm-name-text bold"><?=$row['name']?></span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-earned col-xs-8 text-center">
                                    <span class="pm-earned-text padding-0 block cursive">has earned</span>
                                    <span class="pm-credits-text block bold sans"><?=$row['hours_number']?> Credit Hours</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="col-xs-12"></div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-course-title col-xs-8 text-center">
                                    <span class="pm-earned-text block cursive">while completing the training course entitled</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-course-title underline col-xs-8 text-center">
                                    <span class="pm-credits-text block bold sans"><?=$row['cat_name']?></span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row2">
                            <div class="pm-certificate-footer row">
                                <div class="col-4 pm-certified text-center">
                                    <span class="pm-credits-text block sans">School signature</span>
                                    <span class="pm-empty-space block underline"></span>
                                    <span class="bold block"></span>
                                </div>
                                <div class="col-4">
                                    <!-- LEAVE EMPTY -->
                                </div>
                                <div class="col-4 pm-certified text-center">
                                    <span class="pm-credits-text block sans">Date Completed</span>
                                    <span class="pm-empty-space block underline"><?=$row['end_date']?></span>
                                    <span class="bold block"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div>
            <button id="btn_print" onclick="printdiv()" class="btn btn-primary">Print</button>
        </div>
    </div>
</div>

<script>
    function printdiv() {
        const btn = document.getElementById('btn_print');
        btn.style.display = 'none';
        var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
        var footer_str = '</body></html>';
        var new_str = document.getElementById("ce").innerHTML;
        var old_str = document.body.innerHTML;
        document.body.innerHTML = header_str + new_str + footer_str;
        window.print();
        document.body.innerHTML = old_str;
        btn.style.display = 'block';
        return false;
    }
</script>
<?php

//include "footer.inc";
?>
