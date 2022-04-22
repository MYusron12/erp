<?php

function check_login()

{


    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {

        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        //var_dump($menu);
        // die;

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
      //   var_dump($queryMenu);
       //  die;

        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}



function check_access($role_id, $menu_id)
{


    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}


function check_batalikhtisar($id)

{
    $ci = get_instance();

    $ci->db->where('id_ikhtisar', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('ikhtisar_header');

    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";

        // return "aktif = 'style='pointer-events:none; opacity:0.2; background-color:#000;'";

    }
}

function href_batalikhtisar($id)

{
    $ci = get_instance();

    $ci->db->where('id_ikhtisar', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('ikhtisar_header');

    if ($result->num_rows() > 0) {

        return "style='pointer-events:none; opacity:0.2; background-color:#000;''";
    }
}


function check_batalkasbank($id)
{

    $ci = get_instance();
    $ci->db->where('id_transaksi', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi');


    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";
    }
}

function check_batalkasbankkas($id)
{

    $ci = get_instance();
    $ci->db->where('id_transaksi', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi');


    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";
    }
}

function href_batalkasbank($id)

{
    $ci = get_instance();
    $ci->db->where('id_transaksi', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi');


    if ($result->num_rows() > 0) {
        return "style='pointer-events:none; opacity:0.2; background-color:#000;''";
    }
}

function check_batalkasbankbank($id)
{

    $ci = get_instance();
    $ci->db->where('id_transaksi', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi');


    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";
    }
}




function check_batalbspusat($id)

{
    $ci = get_instance();

    $ci->db->where('idbskantorpusat', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('bskantorpusat');

    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";
    }
}

function href_batalbspusat($id)

{
    $ci = get_instance();
    $ci->db->where('idbskantorpusat', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('bskantorpusat');


    if ($result->num_rows() > 0) {
        return "style='pointer-events:none; opacity:0.2; background-color:#000;''";
    }
}

function check_batalbssementara($id)

{
    $ci = get_instance();

    $ci->db->where('id_transaksi_dept', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi_department');

    if ($result->num_rows() > 0) {
        return "checked='checked' disabled";
    }
}

function href_batalbssementara($id)

{
    $ci = get_instance();
    $ci->db->where('id_transaksi_dept', $id);
    $ci->db->where('status', 0);
    $result = $ci->db->get('transaksi_department');



    if ($result->num_rows() > 0) {
        return "style='pointer-events:none; opacity:0.2; background-color:#000;''";
    }
}
