<?php get_header();?>
<?php
/**
* Template Name:Author Page
*
* @package WordPress
*/
?>

<?php 
// Check if form has been submitted
if ( isset( $_POST['contact_submit'] ) ) {

  // Retrieve form data
  $name = sanitize_text_field( $_POST['contact_name'] );
  $email = sanitize_email( $_POST['contact_email'] );
  $message = esc_textarea( $_POST['contact_message'] );

  // Validate form fields
  $errors = array();

  if ( empty( $name ) ) {
    $errors[] = 'Please enter your name';
  }

  if ( empty( $email ) || ! is_email( $email ) ) {
    $errors[] = 'Please enter a valid email address';
  }

  if ( empty( $message ) ) {
    $errors[] = 'Please enter a message';
  }

  // If there are no errors, send the email
  if ( empty( $errors ) ) {

    $to = 'albinsadiku99@gmail.com';
    $subject = 'New message from ' . $name;
    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Message: ' . $message;
    $headers = array( 'From: ' . $name . ' <' . $email . '>' );

    wp_mail( $to, $subject, $body, $headers );
    echo '<div class="success">Thank you for contacting us!</div>';

  } else {
    // If there are errors, display them
    echo '<div class="error">' . implode( '<br>', $errors ) . '</div>';
  }

} // End form submission check
?>

<style>
  #contact-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    width: 100%;
  }

  label {
    font-weight: bold;
    margin-bottom: 5px;
  }

  input, textarea {
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #ffffff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
    font-size: 16px;
    color: #333333;
  }

  button[type="submit"] {
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #2F80ED;
    color: #ffffff;
    font-size: 16px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #8C8C8C;
  }

  .success {
    color: #2F80ED;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
  }
</style>

<form id="contact-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>">
  <div class="form-group">
    <label for="contact_name">Name:</label>
    <input type="text" name="contact_name" id="contact_name" required>
  </div>

  <div class="form-group">
    <label for="contact_email">Email:</label>
    <input type="email" name="contact_email" id="contact_email" required>
  </div>

  <div class="form-group">
    <label for="contact_message">Message:</label>
    <textarea name="contact_message" id="contact_message" rows="5" required></textarea>
  </div>

  <div class="form-group">
    <button type="submit" name="contact_submit">Send Message</button>
  </div>
</form>

<?php get_footer();?>