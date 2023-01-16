<?php

session_start();
session_destroy();

echo "Выход <script> window.location = 'http://photo.loc/start.php';</script>";