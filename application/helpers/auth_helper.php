<?php 

function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id')) {
        redirect('login');
    }
}

function is_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('role') != 'Petugas') {
        redirect('profile');
    }
}