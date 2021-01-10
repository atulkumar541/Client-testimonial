<?php
//index.php
$error = '';
$fname = '';
$lname = '';
$email = '';
$phone = '';
$comment = '';
$work = '';
$ratings = '';
$image = '';
function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit"]))
{
    if(empty($_POST["fname"]) && empty($_POST["lname"]))
        {
            $error .= '<p><label class="text-danger">Please Enter your Full Name</label></p>';
        }
        else
            {
                $fname = clean_text($_POST["fname"]);
                $lname = clean_text($_POST["lname"]);
                if(!preg_match("/^[a-zA-Z ]*$/",$fname))
                    {
                        $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
                    }
                    if(!preg_match("/^[a-zA-Z ]*$/",$lname))
                        {
                            $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
                        }
                    }
                    if(empty($_POST["email"]))
                        {
                            $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
                        }
                        else
                            {
                                $email = clean_text($_POST["email"]);
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                                    {
                                        $error .= '<p><label class="text-danger">Invalid email format</label></p>';
                                    }
                                }
                                if(empty($_POST["phone"]))
                                    {
                                        $error .= '<p><label class="text-danger">Phone is required</label></p>';
                                    }
                                    else
                                        {
                                            $phone = clean_text($_POST["phone"]);
                                        }
                                        if(empty($_POST["comment"]))
                                            {
                                                $error .= '<p><label class="text-danger">Comment is required</label></p>';
                                            }
                                            else
                                                {
                                                    $comment = clean_text($_POST["comment"]);
                                                }
                                                if (empty($_POST["check"])) 
                                                {
                                                    $error .= '<p><label class="text-danger">Work is required</label></p>';
                                                }
                                                else
                                                    {
                                                        $work = $_POST["check"];
                                                    }
                                                    if (empty($_POST["ratings"])) 
                                                    {
                                                        $error .= '<p><label class="text-danger">Ratings is required</label></p>';   
                                                    }
                                                    else
                                                    {
                                                        $ratings = $_POST["ratings"];
                                                    }
                                                    if (empty($_POST["image"])) {
                                                        $error .= '<p><label class="text-danger">Attachtment is required</label></p>';
                                                    }
                                                    else
                                                        {
                                                            $image = $_POST["image"];
                                                        }
                                                        if($error == '')
                                                            {
                                                                $file_open = fopen("contact_data.csv", "a");
                                                                $no_rows = count(file("contact_data.csv"));
                                                                if($no_rows > 1)
                                                                {
                                                                    $no_rows = ($no_rows - 1) + 1;
                                                                }
                                                                $form_data = array(
                                                                 'sr_no'  => $no_rows,
                                                                 'fname'  => $fname,
                                                                 'lname'  => $lname,
                                                                 'email'  => $email,
                                                                 'phone'  => $phone,
                                                                 'comment' => $comment,
                                                                 'check' => $work,
                                                                 'ratings' => $ratings,
                                                                 'image' => $image
                                                                );
                                                                fputcsv($file_open, $form_data);
                                                                $error = '<label class="text-success">Thank you for contacting us</label>';
                                                                $fname = '';
                                                                $lname = '';
                                                                $email = '';
                                                                $phone = '';
                                                                $comment = '';
                                                                $work = '';
                                                                $ratings = '';
                                                                $image = '';
                                                            }
                                                        }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Client Testimonial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="body_img">

    <div class="client_testimonial py-5">
        <div class="text-center">
            <img src="logo.png" width="135px"  alt="logo">
        </div>
        <div class="text-center">
            <h2>Client Testimonial</h2>
            <p>Please share your valuble feedback</p>
        </div>
        <div class="container">
            <?php //echo $work; ?>
            <?php echo $error; ?>
            <form method="POST">
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <p>Full Name: <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="row first_name">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input class="form_input" type="text" name="fname" value="<?php echo $fname; ?>" class="mb-3" placeholder="First Name" required/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input class="form_input" type="text" name="lname" value="<?php echo $lname; ?>" class="mb-3" placeholder="Last Name" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12"><p>Email: <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <input class="form_input" type="text" name="email" value="<?php echo $email; ?>" class="mb-3" required/>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12"><p>Phone Number: <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <input class="form_input" type="tel" name="phone" value="<?php echo $phone; ?>" class="mb-3" required/>
                    </div>
                </div>
                <div class="row mb-5">                   
                   <div class="col-12">
                    <label for="comment">Comment: <span class="text-danger">*</span></label>
                    <div class="col-12">
                        <textarea class="form_input2" id="comment" name="comment" value="<?php echo $comment; ?>" rows="3"></textarea>
                    
                 </div>
                   </div>
                </div>

                 <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12"><p>Did you like our work?: <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                    	<label for="check_2">
                    	<input class="form_input3" type="radio" name="check" id="check" value="Yes" class="mb-3"> Yes
                    	</label><br/>
                    	<label for="check_2">
                    	<input class="form_input3" type="radio" name="check" id="check_2" value="No" class="mb-3"> No
                    </label>
                    </div>
                </div>

                 <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12"><p>How would you rate our services?: <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                    	<div class="rating"> 
                    		<input type="radio" name="ratings" value="5" id="5"><label for="5">☆</label>
                    		<input type="radio" name="ratings" value="4" id="4"><label for="4">☆</label> 
                    		<input type="radio" name="ratings" value="3" id="3"><label for="3">☆</label>
                    		<input type="radio" name="ratings" value="2" id="2"><label for="2">☆</label>
                    	    <input type="radio" name="ratings" value="1" id="1"><label for="1">☆</label>
                        </div>
				 </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12"><p class="video_img">Optional Image/Video: (accepts mpg, avi, jpg, jpeg, png, gif): <span class="text-danger">*</span></p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                    	<div id="drop-area">
					  <!-- <form class="my-form"> -->
					    <p class="video_img">Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
					    <input type="file" name="image" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
					    <label class="button" for="fileElem">Select some files</label>
					  <!-- </form> -->
					  <progress id="progress-bar" max=100 value=0></progress>
					  <div id="gallery" /></div>
					</div>
                </div>
				 </div>
				 <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-outline-success px-5" value="Submit" />
				 <!-- <button type="submit" class="btn btn-outline-success px-5">Submit</button>  -->
				 </div>               
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/javascript.js"> </script>
</body>

</html>