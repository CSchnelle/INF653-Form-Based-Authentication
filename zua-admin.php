<?php
    session_start();
    //require_once('util/secure_conn.php');
    require_once('util/valid_admin.php');
    require('model/database.php'); 
    require('model/vehicle_db.php');
    require('model/type_db.php');
    require('model/class_db.php');
    require('model/make_db.php');

    
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';

    switch ($action) {
        case 'list_vehicles':
            $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
            $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
            $make_name = filter_input(INPUT_GET, 'make');
            $sort = filter_input(INPUT_GET, 'sort');

            // ternary statement replaces the switch statement from previous solution
            $sort = ($sort == "year") ? "year" : "price";

            // *****new code block to use ALL filter options in any combination*****
            // will also use these names to show selected options in menu
            $class_name = get_class_name($class_id);
            $type_name = get_type_name($type_id);

            $vehicles = get_all_vehicles($sort);
            // apply make filter 
            if (!empty($make_name)) {
                $vehicles = array_filter($vehicles, function($array) use ($make_name) {
                    return $array["make"] == $make_name;
                });
            }
            // apply type filter
            if (!empty($type_id)) {
                $vehicles = array_filter($vehicles, function($array) use ($type_name) {
                    return $array["typeName"] == $type_name;
                });
            }
            // apply class filter 
            if (!empty($class_id)) {
                $vehicles = array_filter($vehicles, function($array) use ($class_name) {
                    return $array["className"] == $class_name;
                });
            }
            // *****end new code block*****
            // use in drop menus 
            $types = get_types();
            $classes = get_classes();
            $makes = get_makes();
            include('view/header-admin.php');
            include('zua_vehicle_list.php');
            include('view/footer.php');
            break;
        case 'list_types':
            $types = get_types();
            include('view/header-admin.php');
            include('type_list.php');
            include('view/footer.php');
            break;
        case 'list_classes':
            $classes = get_classes();
            include('view/header-admin.php');
            include('class_list.php');
            include('view/footer.php');
            break;
        case 'delete_vehicle':
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
            if (empty($vehicle_id)) {
                $error = "Missing or incorrect vehicle id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_vehicle($vehicle_id);
                header("Location: zua-admin.php"); 
            }
            break;
        case 'delete_type':
            $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
            if (empty($type_id)) {
                $error = "Missing or incorrect type id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_type($type_id);
                header("Location: zua-admin.php?action=list_types");
            }
            break;
        case 'delete_class':
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
            if (empty($class_id)) {
                $error = "Missing or incorrect class id.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_class($class_id);
                header("Location: zua-admin.php?action=list_classes");
            }
            break;
        case 'show_add_form':
            $classes = get_classes();
            $types = get_types();
            include('view/header-admin.php');
            include('add_vehicle_form.php');
            include('view/footer.php');
            break;
        case 'add_vehicle':
            $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'vyear', FILTER_VALIDATE_INT);
            $make = filter_input(INPUT_POST, 'make');
            $model = filter_input(INPUT_POST, 'model');
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
            if (empty($type_id) || empty($class_id) || empty($year) || empty($make) || empty($model) || empty($price)) {
                $error = "Invalid vehicle data. Check all fields and try again.";
                include('view/header-admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                add_vehicle($type_id, $class_id, $year, $make, $model, $price);
                header("Location: zua-admin.php");
            }
            break;
        case 'add_type':
            $type_name = filter_input(INPUT_POST, 'type_name');
            add_type($type_name);
            header("Location: zua-admin.php?action=list_types");
            break;
        case 'add_class':
            $class_name = filter_input(INPUT_POST, 'class_name');
            add_class($class_name);
            header("Location: zua-admin.php?action=list_classes");
            break;
        case 'logout':
            $_SESSION = array();    //Clear all session data from memory
            session_destroy();      //Clean up the session ID
            header("Location: zua-login.php");
    }
?> 

   
