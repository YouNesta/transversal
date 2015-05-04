<?php
    function addMessageFlash($type, $message)
        {
            $types = ['success','error','alert','info'];
            if (!isset($types[$type])){
                return false;
            }

            if (!isset($_SESSION['flashBag'][$type])) {
                $_SESSION['flashBag'][$type] = [];
            }

            // on ajoute le message
            $_SESSION['flashBag'][$type][] = $message;
        }