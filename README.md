# Personal Website: HTML, PHP and jQuery (COMP 4621)

Assignment 1 for COMP 4621 (Web Development) at Thompson Rivers University, built in three stages.

| Folder | What it is |
|---|---|
| `part1/` | Static three-page site (profile, course info, contact form) with shared CSS and JavaScript for form validation and a colour theme switcher |
| `part2/` | The same site converted to PHP, with server-side date/time and a contact form that saves messages to MySQL, plus a page to view them |
| `part3/` | A click counter built with jQuery, next to a plain DOM version for comparison |

## Run it locally (XAMPP)
1. Copy this folder into `xampp/htdocs` and start Apache and MySQL.
2. Run `part2/setup.sql` in phpMyAdmin (SQL tab) to create the database.
3. Open `http://localhost/comp4621-web-app/part1/index.html` (or `part2/index.php`, `part3/counter.html`).

The database login in `part2/includes/db.php` is the XAMPP default (root, no password), for local use only.
jQuery loads from a CDN, so you need an internet connection.
