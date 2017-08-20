<?php

function getHelpActive($item, $page) {
    if ($item == $page) {
        return 'class="list-group-item active"';
    } else {
        return 'class="list-group-item"';
    }
}

function getKernelBoot() {
    $result = queryDB_RAW("SELECT * FROM kernelboot;");
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    return $data;
}

function getSanBoot() {
    $result = queryDB_RAW("SELECT * FROM sanboot;");
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    return $data;
}

function getMemDiskBoot() {
    $result = queryDB_RAW("SELECT * FROM memdiskboot;");
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    return $data;
}

function getChainloads() {
    $result = queryDB_RAW("SELECT * FROM chainloads;");
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    return $data;
}

function getCPUInfo() {
    return shell_exec("cat /proc/cpuinfo | grep 'model name' -m 1 | cut -d':' -f2");
}

function getUptime() {
    return shell_exec("uptime -p");
}

function getCPULoad() {
    return '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="' . shell_exec("grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage}'") . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . shell_exec("grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage \"%\"}'") . ';"></div></div>';
}

function getRAMLoad() {
    $total = shell_exec("free | grep Mem: | awk '{print $2}'");
    $used = shell_exec("free | grep Mem: | awk '{print $3}'");
    $percentage = ((100 / $total) * $used);
    return '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percentage . '%;"></div></div>';
}

function getSWAPLoad() {
    $total = shell_exec("free | grep Swap: | awk '{print $2}'");
    $used = shell_exec("free | grep Swap: | awk '{print $3}'");
    $percentage = ((100 / $total) * $used);
    return '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percentage . '%;"></div></div>';
}

function getDISKLoad() {
    return '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' . shell_exec("df | grep root | awk '{print $5}'") . ';"></div></div>';
}

function getServiceDNSMASQ() {
    if (strpos(shell_exec("systemctl status dnsmasq | grep Active:"), 'failed') !== false) {
        return '<a href="?view=system&action=start-dnsmasq"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-danger">Failed</span>';
    } else if (strpos(shell_exec("systemctl status dnsmasq | grep Active:"), 'inactive') !== false) {
        return '<a href="?view=system&action=start-dnsmasq"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-warning">Stopped</span>';
    } else {
        return '<a href="?view=system&action=stop-dnsmasq"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a> <span class="label label-success">Started</span>';
    }
}

function getServiceTFTPD() {
    if (strpos(shell_exec("systemctl status tftp | grep Active:"), 'failed') !== false) {
        return '<a href="?view=system&action=start-tftp"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-danger">Failed</span>';
    } else if (strpos(shell_exec("systemctl status tftp | grep Active:"), 'inactive') !== false) {
        return '<a href="?view=system&action=start-tftp"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-warning">Stopped</span>';
    } else {
        return '<a href="?view=system&action=stop-tftp"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a> <span class="label label-success">Started</span>';
    }
}

function getServiceHTTPD() {
    if (strpos(shell_exec("systemctl status httpd | grep Active:"), 'failed') !== false) {
        return '<a href="?view=system&action=start-httpd"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-danger">Failed</span>';
    } else if (strpos(shell_exec("systemctl status httpd | grep Active:"), 'inactive') !== false) {
        return '<a href="?view=system&action=start-httpd"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-warning">Stopped</span>';
    } else {
        return '<a href="?view=system&action=stop-httpd"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a> <span class="label label-success">Started</span>';
    }
}

function getServiceMARIADB() {
    if (strpos(shell_exec("systemctl status mariadb | grep Active:"), 'failed') !== false) {
        return '<a href="?view=system&action=start-db"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-danger">Failed</span>';
    } else if (strpos(shell_exec("systemctl status mariadb | grep Active:"), 'inactive') !== false) {
        return '<a href="?view=system&action=start-db"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a> <span class="label label-warning">Stopped</span>';
    } else {
        return '<a href="?view=system&action=stop-db"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a> <span class="label label-success">Started</span>';
    }
}

function cleanWhitespace($string) {
    return str_replace(' ', '', $string);
}
