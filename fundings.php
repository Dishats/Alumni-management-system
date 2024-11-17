<?php 
include 'admin/db_connect.php'; 

// Fetch donations
$donations = $conn->query("SELECT * FROM donations ORDER BY created_at DESC");
?>
<style>
/* Common masthead style for both gallery and fundings */
header.masthead {
    background-image: url('admin/assets/uploads/<?php echo $_SESSION['system']['cover_img']; ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 60vh; /* Adjust height as needed */
    color: #fff;
}
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h1 class="text-uppercase text-white font-weight-bold">FUNDINGS</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container mt-3 pt-2">
    <div class="row text-center mb-4">
        <div class="col-md-12">
            <h4 class="text-center text-white">Ways to Donate</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="height: 100%;">
                <div class="card-body">
                    <img src="images/qr.png" alt="Scanner" width="150" height="150" class="mb-2" />
                    <h5 class="card-title">Scan to Donate</h5>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#scannerModal">Scan</a>

                </div>
            </div>
        </div>

  <!-- Scanner Modal -->
<div class="modal fade" id="scannerModal" tabindex="-1" role="dialog" aria-labelledby="scannerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scannerModalLabel">Scan to Donate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p><strong>Bank Name:</strong> Bank of XYZ</p>
                <p><strong>Account Number:</strong> 123456789012</p>
                <p><strong>IFSC Code:</strong> XYZB0001234</p>
                <p><strong>UPI ID:</strong> donate@upi</p>
                <br>
                <p>QR Code (Scan using your payment app):</p>
                <img src="images/qr.png" alt="QR Code" width="250" height="250" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Digital Payments</h5>
                    <ul class="list-unstyled">
                        <br>
                        <li>
                            <a href="https://www.phonepe.com" target="_blank">
                                <img src="images/phonepay.jpeg" alt="PhonePe" width="50" /> PhonePe
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="https://pay.google.com" target="_blank">
                                <img src="images/Gpay.jpeg" alt="Google Pay" width="50" /> Google Pay
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="https://www.paytm.com" target="_blank">
                                <img src="images/paytm.jpeg" alt="Paytm" width="50" /> Paytm
                            </a>
                        </li>
                        <br>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="height: 100%;">
                <div class="card-body">
                    <img src="images/cards.png" alt="Credit/Debit Card" width="150" height="150" class="mb-2" />
                    <br>
                    <h5 class="card-title">Credit/Debit Card Payments</h5>
                    <br>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#cardPaymentModal">Pay Now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body text-center">
            <h4>NEFT/Bank Transfer</h4>
            <p>Please transfer to the following bank account:</p>
            <p>Account Number: XXXX-XXXX-XXXX<br>IFSC Code: ABCD1234</p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4>Recent Donations</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Donor Name</th>
                        <th>Amount</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $donations->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['donor_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Credit/Debit Card Payment -->
<div class="modal fade" id="cardPaymentModal" tabindex="-1" role="dialog" aria-labelledby="cardPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardPaymentModalLabel">Credit/Debit Card Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process_payment.php" method="post">
                    <div class="form-group">
                        <label for="card_name">Cardholder Name</label>
                        <input type="text" class="form-control" id="card_name" name="card_name" required>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; // Common footer ?>

<style>
    body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .card {
        transition: transform 0.3s;
        border: none;
        border-radius: 10px;
        margin-bottom: 20px;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.05);
        color: B9E5E8;
    }

    .card-title {
        font-weight: bold;
    }

    .list-unstyled {
        padding: 0;
    }

    .list-unstyled a {
        text-decoration: none;
        color: #007bff;
        display: flex;
        align-items: center;
        padding: 5px 0;
    }

    .list-unstyled a img {
        margin-right: 10px;
    }

    h4 {
        margin-top: 20px;
        font-weight: bold;
        color: #333;
    }

    table {
        margin-top: 20px;
        background: white;
    }

    table th, table td {
        text-align: center;
        padding: 8px;
        font-size: 16px;
    }

    header.masthead h1 {
        font-size: 3.5rem;
        letter-spacing: 0.1em;
        font-weight: bold;
    }

    .divider {
        border-color: #fff;
        width: 50%;
        margin: 0.5rem auto;
    }

    .card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s;
        border: none;
        border-radius: 10px;
        margin-bottom: 20px;
        height: 100%;
        background-color: #eef5fc; /* Pale blue background color */
    }

    .card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 2px solid transparent;
        border-radius: 10px;
        box-sizing: border-box;
        transition: all 0.4s ease-in-out;
    }

    .card:hover::before {
        border-color: #B9E5E8;
        animation: line-animation 0.4s forwards;
    }

    .card:hover {
        transform: scale(1.05);
    }

    /* Keyframes for line animation */
    @keyframes line-animation {
        0% {
            clip-path: inset(0 100% 100% 0);
        }
        25% {
            clip-path: inset(0 0 100% 0);
        }
        50% {
            clip-path: inset(0 0 0 0);
        }
        75% {
            clip-path: inset(0 0 0 100%);
        }
        100% {
            clip-path: inset(0 0 0 0);
        }
    }
</style>
