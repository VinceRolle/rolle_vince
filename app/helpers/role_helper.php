<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Role Helper
 * Provides role-based access control functions
 */
class RoleHelper {
    
    /**
     * Check if current user has admin role
     * 
     * @return bool
     */
    public static function is_admin() {
        $session = new Session();
        return $session->userdata('user_role') === 'admin';
    }
    
    /**
     * Check if current user has student role
     * 
     * @return bool
     */
    public static function is_student() {
        $session = new Session();
        return $session->userdata('user_role') === 'student';
    }
    
    /**
     * Check if current user has specific role
     * 
     * @param string $role
     * @return bool
     */
    public static function has_role($role) {
        $session = new Session();
        return $session->userdata('user_role') === $role;
    }
    
    /**
     * Require admin role, redirect if not admin
     * 
     * @return void
     */
    public static function require_admin() {
        if (!self::is_admin()) {
            redirect('auth/login');
            exit;
        }
    }
    
    /**
     * Require specific role, redirect if not authorized
     * 
     * @param string $role
     * @return void
     */
    public static function require_role($role) {
        if (!self::has_role($role)) {
            redirect('auth/login');
            exit;
        }
    }
    
    /**
     * Get current user role
     * 
     * @return string|null
     */
    public static function get_current_role() {
        $session = new Session();
        return $session->userdata('user_role');
    }
}
