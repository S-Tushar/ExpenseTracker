<?php

const DB_NAME = 'expensetraker';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_HOST = 'localhost';
const APP_NAME = 'Expense Tracker';
const LOGO_PATH = '
<img src="assets2/img/logo2.png" alt="">
<span>Expense<span class="text-danger">Traker</span></span>';
const DB_DATE_FORMAT = [
    "DD-MM-YYYY" => "DD-MM-YYYY",
    "MM-DD-YYYY" => "MM-DD-YYYY",
    "YYYY-MM-DD" => "YYYY-MM-DD",
    "MM-DD-YY"   => "MM-DD-YY",
    "DD-MM-YY"   => "DD-MM-YY",
    "YY-MM-DD"   => "YY-MM-DD"];
const CURRENCY=[
    "USD" => "USD, US Dollar" , 
    "AED" => "AED, Emirati Dirham", 
    "GBP" => "GBP, British Pound", 
    "IDR" => "GBP, British Pound", 
    "IDR" => "IDR, Indonesian Rupiah", 
    "INR" => "INR, Indian Rupee", 
    "JPY" => "JPY, Japanese yen"];
const PAYMENT_METHOD=[
    "cash" => "Cash",
    "bank_account" => "Bank Account",
    "credit" => "Credit",
    "assest" => "Assest",
    "deposit" => "Deposit"];
?>