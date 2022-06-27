<?php
include "inc/header.php";
include "process/contact.php";
?>
<section class="Contact">
    <form class="contactForm row" action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <h1>Contact Us</h1>
        <div class="mb-3 col-6">
            <label for="exampleInputEmail1" class="form-label" >Name</label>
            <input type="text" class="form-control" name="name" value="<?= $name?>"/>
            <span class="error"><?= $name_error; ?></span>
        </div>
        <div class="mb-3 col-6">
            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contactnumber" value="<?= $contactnumber?>"/>
            <span class="error"><?= $contactnumber_error; ?></span>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control" name="email" value="<?= $email?>"/>
            <span class="error"><?= $email_error; ?></span>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" name="message" rows="9"></textarea>
            <span class="error"><?= $message_error; ?></span>
        </div>
        <button type="submit" class="btn btn-primary contactBtn">Submit</button>
        <span class="success"><?= $success?></span>
    </form>
</section>

<?php
include "inc/footer.php";
?>