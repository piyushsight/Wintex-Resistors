<?php
$a_url="/wintexresistor/";
$root_url= "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$a_url;

require_once "connection_params.php";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql and bind parameters
	$product_list = $conn->prepare("SELECT id, title FROM product ORDER BY title");
	$product_list->execute();

	$product_list2 = $conn->prepare("SELECT id, title FROM product ORDER BY title");
	$product_list2->execute();	
}
catch(PDOException $e){
	header('location: 404.html');
}
$conn = null;


?>
	<link rel='shortcut icon' type='image/x-icon' href='images/favicon.png' />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="index.php"><img src="images/Winner electronic.png" alt="Wintex Resistor Logo" style="float:left; margin-top:-5px; max-width:100%;"/>
                <!-- Wintex Resistor <small style="font-size:65%;">Trademark of Winner Electronics</small> --></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo $root_url; ?>index.php">Home</a>
                    </li>
					<li>
                        <a href="<?php echo $root_url; ?>about.php">About Us</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo $root_url; ?>product.php" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu">
							<?php while($p = $product_list->fetch()){?>
                            <li>
                                <a href="product.php?id=<?php echo $p['0']; ?>"><?php echo $p['1']; ?></a>
                            </li>
							<?php } ?>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $root_url; ?>contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	

<script type="text/javascript">
var host = window.location.hostname;
var docURL = document.URL;
//docURL = docURL.replace(host, "");
//docURL = docURL.replace("http://", "");
//docURL = docURL.replace("www.", "");
if(docURL.indexOf("?") >= 0)
	docURL = docURL.substring(0, docURL.indexOf('?'));
var links = document.querySelectorAll('a[href="'+docURL+'"]');
links[0].parentNode.className = 'active';
links[0].parentNode.parentNode.parentNode.className = links[0].parentNode.parentNode.parentNode.className + ' active';
</script>