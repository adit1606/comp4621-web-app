<?php
// shows all the messages saved from the contact form

$pageTitle = 'Messages';
$current   = 'messages';
$useJquery = false;

require_once 'includes/db.php';

$rows    = [];
$dbError = '';
try {
    $conn   = getConnection();
    $result = $conn->query('SELECT id, name, email, subject, message, submitted_at
                            FROM contacts ORDER BY submitted_at DESC, id DESC');
    $rows   = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $dbError = 'Could not read from the database. Make sure MySQL is running in XAMPP '
             . 'and that setup.sql has been run. (Details: ' . $e->getMessage() . ')';
}

include 'includes/header.php';
?>
        <section>
            <h2>Saved Messages</h2>
            <p>These messages were sent with the <a href="contact.php">Contact Me</a> form and stored in the
               <code>comp4621.contacts</code> MySQL table.</p>

            <?php if ($dbError): ?>
                <div class="alert error"><?php echo htmlspecialchars($dbError); ?></div>
            <?php elseif (count($rows) === 0): ?>
                <p><em>No messages yet.</em></p>
            <?php else: ?>
                <p><?php echo count($rows); ?> message(s) found.</p>
                <?php foreach ($rows as $r): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($r['subject']); ?></h3>
                        <p><strong><?php echo htmlspecialchars($r['name']); ?></strong>
                           &lt;<?php echo htmlspecialchars($r['email']); ?>&gt;
                           &middot; #<?php echo (int)$r['id']; ?>
                           &middot; <?php echo htmlspecialchars($r['submitted_at']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($r['message'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

<?php include 'includes/footer.php'; ?>
