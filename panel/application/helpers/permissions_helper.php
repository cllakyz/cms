<?php
function isAllowedViewModule($module=NULL){
    $t = &get_instance();
    $user       = is_login();
    $user_roles = getUserRoles();
    if(is_null($module)){
        $module = $t->router->fetch_class();
    }
    if(isset($user_roles[$user->user_role])){
        $permission = json_decode($user_roles[$user->user_role]);
        if(isset($permission->$module) && isset($permission->$module->read)){
            return true;
        }
    }
    return false;
}

function isAllowedWriteModule($module=NULL){
    $t = &get_instance();
    $user       = is_login();
    $user_roles = getUserRoles();
    if(is_null($module)){
        $module = $t->router->fetch_class();
    }
    if(isset($user_roles[$user->user_role])){
        $permission = json_decode($user_roles[$user->user_role]);
        if(isset($permission->$module) && isset($permission->$module->write)){
            return true;
        }
    }
    return false;
}

function isAllowedEditModule($module=NULL){
    $t = &get_instance();
    $user       = is_login();
    $user_roles = getUserRoles();
    if(is_null($module)){
        $module = $t->router->fetch_class();
    }
    if(isset($user_roles[$user->user_role])){
        $permission = json_decode($user_roles[$user->user_role]);
        if(isset($permission->$module) && isset($permission->$module->edit)){
            return true;
        }
    }
    return false;
}

function isAllowedDeleteModule($module=NULL){
    $t = &get_instance();
    $user       = is_login();
    $user_roles = getUserRoles();
    if(is_null($module)){
        $module = $t->router->fetch_class();
    }
    if(isset($user_roles[$user->user_role])){
        $permission = json_decode($user_roles[$user->user_role]);
        if(isset($permission->$module) && isset($permission->$module->delete)){
            return true;
        }
    }
    return false;
}