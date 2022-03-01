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
    "d-m-Y" => "DD-MM-YYYY",
    "m-d-Y" => "MM-DD-YYYY",
    "Y-m-D" => "YYYY-MM-DD",
    "y-m-d"   => "YY-MM-DD"];
const CURRENCY=[
    "USD" => "USD, US Dollar" , 
    "AED" => "AED, Emirati Dirham", 
    "GBP" => "GBP, British Pound", 
    "IDR" => "GBP, British Pound", 
    "IDR" => "IDR, Indonesian Rupiah", 
    "INR" => "INR, Indian Rupee", 
    "JPY" => "JPY, Japanese yen"];
const PAYMENT_METHOD=[
    "CASH" => "Cash",
    "BANK_ACCOUNT" => "Bank Account",
    "CREDIT" => "Credit",
    "ASSET" => "Asset",
    "DEPOSIT" => "Deposit"];
const BANK_ACCOUNT="BANK_ACCOUNT";
const CREDIT="CREDIT";
?>