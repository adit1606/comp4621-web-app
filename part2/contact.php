<?php
// contact form - validates again in php then saves to mysql

$pageTitle = 'Contact Me';
$current   = 'contact';
$useJquery = false;

require_once 'includes/db.php';

$values  = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];
$errors  = [];
$success = '';
$dbError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $field => $v) {
        $values[$field] = trim($_POST[$field] ?? '');
    }

    // check again here in case js is turned off
    foreach ($values as $field => $v) {
        if ($v === '') {
            $errors[$field] = ucfirst($field) . ' cannot be left empty.';
        }
    }
    if (!isset($errors['email']) && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address (e.g. name@example.com).';
    }

    if (empty($errors)) {
        try {
            $conn = getConnection();
            // prepared statement so no sql injection
            $stmt = $conn->prepare(
                'INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)'
            );
            $stmt->bind_param('ssss', $values['name'], $values['email'],
                                      $values['subject'], $values['message']);
            $stmt->execute();
            $newId = $stmt->insert_id;
            $stmt->close();
            $conn->close();

            $success = 'Thank you, ' . $values['name'] . '! Your message was saved to the database (record #' . $newId . ').';
            $values  = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];
        } catch (mysqli_sql_exception $e) {
            $dbError = 'Sorry, your message could not be saved. Please make sure MySQL is running '
                     . 'in XAMPP and that setup.sql has been run. (Details: ' . $e->getMessage() . ')';
        }
    }
}

// little helpers for the form below
function val($values, $f)    { return htmlspecialchars($values[$f]); }
function err($errors, $f)    { return isset($errors[$f]) ? htmlspecialchars($errors[$f]) : ''; }
function bad($errors, $f)    { return isset($errors[$f]) ? ' class="invalid"' : ''; }

include 'includes/header.php';
?>
        <section>
            <h2>Contact Me</h2>
            <p>Have a question, or want to play badminton? Send me a message. All fields are required.</p>

            <?php if ($success): ?>
                <div id="formStatus" class="alert success" role="status"><?php echo htmlspecialchars($success); ?>
                    <a href="messages.php">View saved messages</a></div>
            <?php elseif ($dbError): ?>
                <div id="formStatus" class="alert error" role="status"><?php echo htmlspecialchars($dbError); ?></div>
            <?php elseif ($errors): ?>
                <div id="formStatus" class="alert error" role="status">Please fix the highlighted fields and try again.</div>
            <?php else: ?>
                <div id="formStatus" role="status"></div>
            <?php endif; ?>

            <form id="contactForm" action="contact.php" method="post" novalidate>
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" maxlength="100" value="<?php echo val($values, 'name'); ?>"<?php echo bad($errors, 'name'); ?>>
                    <span class="error-msg" id="nameError"><?php echo err($errors, 'name'); ?></span>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" maxlength="150" value="<?php echo val($values, 'email'); ?>"<?php echo bad($errors, 'email'); ?>>
                    <span class="error-msg" id="emailError"><?php echo err($errors, 'email'); ?></span>
                </div>
                <div class="field">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" maxlength="150" value="<?php echo val($values, 'subject'); ?>"<?php echo bad($errors, 'subject'); ?>>
                    <span class="error-msg" id="subjectError"><?php echo err($errors, 'subject'); ?></span>
                </div>
                <div class="field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" maxlength="2000"<?php echo bad($errors, 'message'); ?>><?php echo val($values, 'message'); ?></textarea>
                    <span class="error-msg" id="messageError"><?php echo err($errors, 'message'); ?></span>
                </div>
                <input type="submit" value="Send Message">
                <input type="reset" value="Clear">
            </form>
        </section>

<?php include 'includes/footer.php'; ?>
