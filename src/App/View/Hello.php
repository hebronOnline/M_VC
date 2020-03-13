<?php
use App\Shared\Layout\MasterLayout;

$MasterLayout = new MasterLayout("Hello World");

$MasterLayout->AddHeader();

?>

<h1>Hello <?php echo $name;?></h1>

<?php
MasterLayout::AddFooter();
?>