<?php

/*
    Project: 8-1
    Names: Jonathan Warfield, Charles Link, Nate Nading, Joseph Summerlin
    Date: 4/1/2020
*/

// receive input from form and validate it
$customer_type = filter_input(INPUT_POST, 'type');
$invoice_subtotal = filter_input(INPUT_POST, 'subtotal');

// switch determines discount based on customer type
switch($customer_type) {
    case 'r':
    case 'R':
        // lowercase and uppercase fall through and discount is determined based on subtotal
        if ($invoice_subtotal < 100) {
            $discount_percent = .0;
        } else if ($invoice_subtotal >= 100 && $invoice_subtotal < 250) {
            $discount_percent = .1;
        } else if ($invoice_subtotal >= 250 && $invoice_subtotal < 500) {
            $discount_percent = .25;
        } else if ($invoice_subtotal >= 500) {
            $discount_percent = .3;
        }
        break;
    case 'c':
    case 'C':
        // flat discount regardless of subtotal
        $discount_percent = .2;
        break;
    case 't':
    case 'T':
        // after customer type, full discount determined based on subtotal
        if ($invoice_subtotal < 500) {
            $discount_percent = 0.4;
        } else if ($invoice_subtotal >= 500) {
            $discount_percent = 0.5;
        }
        break;
    default:
        // invalid or no customer type results in flat discount of 10%
        $discount_percent = .1;
        break;
}

// switch statement takes these if statements' place
//
// if ($customer_type == 'R' || $customer_type == 'r') {
//     if ($invoice_subtotal < 100) {
//         $discount_percent = .0;
//     } else if ($invoice_subtotal >= 100 && $invoice_subtotal < 250) {
//         $discount_percent = .1;
//     } else if ($invoice_subtotal >= 250 && $invoice_subtotal < 500) {
//         $discount_percent = .25;
//     } else if ($invoice_subtotal >= 500) {
//         $discount_percent = .3;
//     }
// } else if ($customer_type == 'C' || $customer_type == 'c') {
//     $discount_percent = .2;
// } else if ($customer_type == 'T' || $customer_type == 't') {
//     if ($invoice_subtotal < 500) {
//         $discount_percent = 0.4;
//     } else if ($invoice_subtotal >= 500) {
//         $discount_percent = 0.5;
//     }
// } else {
//     $discount_percent = .1;
// }

$discount_amount = $invoice_subtotal * $discount_percent; // calculate discount amount
$invoice_total = $invoice_subtotal - $discount_amount; // apply discount to total

// normalize the input and send it off
$percent = number_format(($discount_percent * 100));
$discount = number_format($discount_amount, 2);
$total = number_format($invoice_total, 2);

include 'invoice_total.php';

?>