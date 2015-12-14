<?php

  //response generation function

  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";

  //user posted variables
  $name = $_POST['event_name'];
  $date = $_POST['message_start_date'];
  $message = $_POST['message_text'];
  $start = $_POST['message_start_time'];
  $end = $_POST['message_end_time'];
  $cost = $_POST['message_cost'];
  $location = $_POST['message_location'];
  $notes = $_POST['message_notes'];
  $human = $_POST['message_human'];



  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a message from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {

        }
      }
    }
  }
  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);

?>

<?php get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>

              <style type="text/css">
                .error{
                  padding: 5px 9px;
                  border: 1px solid red;
                  color: red;
                  border-radius: 3px;
                }

                .success{
                  padding: 5px 9px;
                  border: 1px solid green;
                  color: green;
                  border-radius: 3px;
                }

                form span{
                  color: red;
                }
              </style>

              <div id="respond">
                <?php echo $response; ?>
                <form action="<?php the_permalink(); ?>" method="post">
                  <p><label for="name">Event Name: <span>*</span> <br><input type="text" name="event_name" value="<?php echo esc_attr($_POST['event_name']); ?>"></label></p>
                  <p><label for="message_start_date">Start Date: <span>*</span> <br><input type="text" name="message_start_date" value="<?php echo esc_attr($_POST['message_start_date']); ?>"></label></p>
                  <p><label for="message_text">Event Description: <span>*</span> <br><textarea type="text" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea></label></p>
                  <p><label for="message_start_time">Start Time: <span>*</span> <br><input type="text" name="message_start_time" value="<?php echo esc_attr($_POST['message_start_time']); ?>"></label></p>
                  <p><label for="message_end_time">End Time: <span>*</span> <br><input type="text" name="message_end_time" value="<?php echo esc_attr($_POST['message_end_time']); ?>"></label></p>
                  <p><label for="message_cost">Cost: <span>*</span> <br><input type="text" name="message_cost" value="<?php echo esc_attr($_POST['message_cost']); ?>"></label></p>
                  <p><label for="message_location">Location: <span>*</span> <br><textarea type="text" name="message_location"><?php echo esc_textarea($_POST['message_location']); ?></textarea></label></p>
                  <p><label for="message_notes">Notes: <span>*</span> <br><textarea type="text" name="message_notes"><?php echo esc_textarea($_POST['message_notes']); ?></textarea></label></p>
                  <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
                  <input type="hidden" name="submitted" value="1">
                  <p><input type="submit"></p>
                </form>
              </div>


            </div><!-- .entry-content -->

          </article><!-- #post -->

      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
