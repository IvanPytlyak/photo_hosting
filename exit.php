<?php

session_start();
session_destroy();

echo "Выход <script> window.location = '/';</script>";