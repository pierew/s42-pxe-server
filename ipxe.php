<?php
header("Content-type: text/plain");
require_once './config.php';
require_once './functions.php';
require_once './db.php';
$kernelboot = getKernelBoot();
$sanboot = getSanBoot();
$memdiskboot = getMemDiskBoot();
$chainloads = getChainloads();

echo '#!ipxe'. " \n";
echo 'login'. " \n";
echo ':start'. " \n";
echo 'menu PXE Server (ClientIP: ${net0/ip})'. " \n";


foreach ($kernelboot as $item) {
    echo "item " . strtolower(cleanWhitespace($item['name'])) . " " . $item['name'] . " \n";
}
foreach ($sanboot as $item) {
    echo "item " . strtolower(cleanWhitespace($item['name'])) . " " . $item['name'] . " \n";
}
foreach ($memdiskboot as $item) {
    echo "item " . strtolower(cleanWhitespace($item['name'])) . " " . $item['name'] . " \n";
}
foreach ($chainloads as $item) {
    echo "item " . strtolower(cleanWhitespace($item['name'])) . " " . $item['name'] . " \n";
}
?>
item --gap
item reboot Reboot computer
item exit Exit iPXE and continue BIOS boot
choose selected && goto selected || goto start

:reboot
reboot

:exit
exit

<?php
foreach ($kernelboot as $item) {
    echo ":" . strtolower(cleanWhitespace($item['name'])) . " \n";
    echo "kernel http://" . $_SERVER["SERVER_ADDR"] . "/images/kernelboot/" . cleanWhitespace($item['name']) . "/" . $item['kernel'] . " \n";
    echo "initrd http://" . $_SERVER["SERVER_ADDR"] . "/images/kernelboot/" . cleanWhitespace($item['name']) . "/" . $item['ramdisk'] . " \n";
    echo "imgargs " . $item['options'] . " \n";
    echo "boot" . " \n";
    echo " \n";
}
foreach ($sanboot as $item) {
    echo ":" . strtolower(cleanWhitespace($item['name'])) . " \n";
    echo "sanboot http://" . $_SERVER["SERVER_ADDR"] . "/images/iso/" . $item['file'] . " \n";
    echo " \n";
}
foreach ($memdiskboot as $item) {
    echo ":" . strtolower(cleanWhitespace($item['name'])) . " \n";
    echo "initrd http://" . $_SERVER["SERVER_ADDR"] . "/images/iso/" . $item['file'] . " \n";
    echo "chain memdisk" . " \n";
    echo " \n";
}
foreach ($chainloads as $item) {
    echo ":" . cleanWhitespace($item['name']) . " \n";
    echo "chain tftp://" . $item['server'] . "/" . $item['file'] . " \n";
    echo " \n";
}
?>
