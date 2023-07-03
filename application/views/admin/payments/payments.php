<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="clearfix">
        <?php

            if(isset($payments) && count($payments) > 0){
        ?>
        <table class="table table-bordered table-striped dt">
        <thead>
            <tr>
                <th>#</th>
                <th style="">Reference</th>
                <th>Name</th>
                <th>Phone</th>
                <th>InvoiceID</th>
                <th>Amount</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            # var_dump($payments[0]);

            foreach($payments as $payment){
                $name = $payment->sender_name;
        ?>
            <tr>
                <td><?php echo $payment->id; ?></td>
                <td><?php echo $payment->transaction_code; ?></td>
                <td><?php echo ucwords($name); ?></td>
                <td><?php echo $payment->sender_number; ?></td>
                <td><?php echo $payment->invoice_number; ?></td>
                <td><?php echo $payment->amount_paid; ?></td>
                <td><?php echo date('jS M Y, H:i A', strtotime($payment->transaction_time)); ?></td>
                <td>-</td>
            </tr>
        <?php 
            } # ENDFOREACH: Loop through payments
        ?>
        </tbody>
        </table>
        <?php
            }
            else{
                echo '<div class="alert alert-warning">No payments found</div>';
            }
        ?>
    </div>
</div>