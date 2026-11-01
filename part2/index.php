<?php
$pageTitle = 'Profile';
$current   = 'profile';
$useJquery = false;
include 'includes/header.php';
?>
        <section>
            <div class="profile-top">
                <div class="avatar">AS</div>
                <div>
                    <h2>Hi, I'm Aditya!</h2>
                    <p>I am a student in the Bachelor of Computing Science (BCS) program at
                       Thompson Rivers University (TRU) Open Learning. I live in Kamloops,
                       British Columbia, and I enjoy building things for the web.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>About Me</h2>
            <table>
                <tr><th>Name</th><td>Aditya Subramaniam</td></tr>
                <tr><th>Program</th><td>Bachelor of Computing Science, TRU Open Learning</td></tr>
                <tr><th>Location</th><td>Kamloops, British Columbia, Canada</td></tr>
                <tr><th>Current course</th><td><a href="course.php">COMP 4621</a></td></tr>
                <tr><th>Hobbies</th><td>Badminton</td></tr>
            </table>
        </section>

        <section>
            <h2>Interests</h2>
            <h3>Web development</h3>
            <p>I like seeing an idea turn into something people can actually click on.
               I'm using this course to learn how websites go from static HTML pages to
               full web applications with a server and a database.</p>
            <h3>Badminton</h3>
            <p>When I'm not studying, I'm usually on a badminton court. It's a fast,
               tactical sport and a great way to switch off after a long day of coding.</p>
        </section>

<?php include 'includes/footer.php'; ?>
