<?php
include('inc/header.php');

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card shadow-lg rounded-lg border-0">
                        <div class="card-header bg-gradient-success text-white">
                            <h3 class="card-title"><i class="fas fa-envelope"></i> Contact Messages List</h3>
                        </div>
                        <div class="card-body">
                            <table id="contactMessagesTable" class="table table-bordered table-hover table-striped text-center align-middle">
                                <thead style="background: #343a40; color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Sender Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th> 
                                        <th>Received At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Including the database connection
                                    include('inc/conn.php');

                                    // SQL Query uses the correct table and column names
                                    $sql = "SELECT * FROM contact_messages ORDER BY id DESC";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            
                                            // 1. Message ID
                                            echo "<td><span class='badge badge-dark p-2'>" . $row['id'] . "</span></td>";
                                            
                                            // 2. Sender Name
                                            echo "<td><strong class='text-primary'>" . htmlspecialchars($row['name']) . "</strong></td>";
                                            
                                            // 3. Email
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            
                                            // 4. Subject
                                            echo "<td>" . htmlspecialchars(substr($row['subject'], 0, 30)) . (strlen($row['subject']) > 30 ? '...' : '') . "</td>";
                                            
                                            // 5. **NEW COLUMN: Message Content (Truncated)**
                                            $message_snippet = htmlspecialchars(substr($row['message'], 0, 70)); // Display up to 70 characters
                                            $full_message = htmlspecialchars($row['message']);
                                            
                                            echo "<td class='text-left' title='" . $full_message . "'>";
                                            echo $message_snippet . (strlen($full_message) > 70 ? '...' : '');
                                            echo "</td>";
                                            
                                            // 6. Received At
                                            echo "<td><span class='badge badge-info p-2'>" . date('d M Y, h:i A', strtotime($row['created_at'])) . "</span></td>";
                                            
                                            // The old 'Actions' column is now completely removed.

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center text-muted'>No Contact Messages Found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
<?php
include('inc/footer.php');
?>