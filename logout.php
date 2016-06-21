<?php

/**
 * Logout
 *
 * Destroy the session
 */

if (isset($_GET['logout'])) {
    header("Location: register.html");
}