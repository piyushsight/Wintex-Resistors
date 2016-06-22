<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Piyush Aggarwal">
	
	<?php include_once "header.php"; ?>
	
	<?php
		if(!isset($_GET['id']))
			header('location: index.php');
		
		$id = $_GET['id'];
		if (!preg_match('/^[0-9]*$/', $id)) {
			header('location: index.php');
		}
	
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT a.title, a.description FROM product as a WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();

			if(!$stmt->rowCount())
				header('location: index.php');
			else
				$product = $stmt->fetch();
			
			$stmt = $conn->prepare("SELECT * FROM sub_product WHERE pid = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
		}
		catch(PDOException $e){
			header('location: index.php');
		}
		$conn = null;
	?>

    <meta name="description" content="<?php echo $product['1']; ?>">
	<meta name="robots" content="index, follow">
	<meta name="keywords" content="<?php echo $product['0']; ?>, <?php echo $product['0']; ?> Manufacturer in Delhi, Wintex Resistor, Resistor Manufacturer,  Resistor Manufacturer in Delhi">
    <title><?php echo $product['0']; ?> - Wintex Resistor</title>	
	
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $product['0']; ?></h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li class="active"><?php echo $product['0']; ?></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Post Content -->
				<?php echo $product['1']; ?>

                <hr>
				
				<?php while($sub_products = $stmt->fetch()){?>
					<div class="well">
						<?php if($sub_products['4'] != ''){ ?>
							<img src="images/<?php echo $sub_products['4']; ?>" alt="" class="col-md-4" style="float:right; padding-right:0px;"/>
						<?php } ?>
						<h2><?php echo $sub_products['2']; ?></h2>
						<?php echo $sub_products['3']; ?>
						
						<?php if($sub_products['5'] != ''){ ?>
						<h4>Specifications:</h4>
						<ul>
						<?php $spec = explode("\n", $sub_products['5']);
							foreach($spec as $s){
								echo "<li>".$s."</li>";
							}
						?>
						</ul>
						<?php } ?>
						
						<?php if($sub_products['6'] != ''){ ?>
						<h4><?php echo $sub_products['6']; ?>:</h4>
						<ul>
						<?php $b1 = explode("\n", $sub_products['7']);
							foreach($b1 as $s){
								echo "<li>".$s."</li>";
							}
						?>
						</ul>
						<?php } ?>
						<center><a href="#contactForwell"><button class="btn btn-primary">Request Quote</button></a></center>
					</div>

				<?php } ?>

               <hr />

                <!-- Comments Form -->
                <div class="well" id="contactForwell">
                    <h4>Looking for <?php echo $product['0']; ?>?</h4>
                    <form name="sentMessage" id="contactForm" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label>Full Name:</label>
								<input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Phone Number:</label>
								<input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Email Address:</label>
								<input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Message:</label>
								<textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
							</div>
						</div>
						<div id="success"></div>
						<!-- For success/fail messages -->
						<button type="submit" class="btn btn-primary">Send Message</button>
					</form>
				</div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <!-- <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div> -->

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Product Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php while($p = $product_list2->fetch()){?>
									<li>
									<a href="product.php?id=<?php echo $p['0']; ?>"><?php echo $p['1']; ?></a>
								</li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

            </div>

        </div>
        <!-- /.row -->

		<?php include_once "footer.php"; ?>
		<script src="js/jqBootstrapValidation.js"></script>
		<script src="js/contact_me.js"></script>

    </div>
    <!-- /.container -->

</body>

</html>
